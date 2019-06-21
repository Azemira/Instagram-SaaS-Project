<?php

namespace App\Http\Controllers;

use App\Library\Helper;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class InstallController extends Controller
{
    private $minPhpVersion = '7.1.3';
    private $extensions    = [
        'openssl',
        'pdo',
        'mbstring',
        'xml',
        'ctype',
        'gd',
        'tokenizer',
        'JSON',
        'bcmath',
        'cURL',
    ];
    private $permissions = [
        'storage'         => '0775',
        'bootstrap/cache' => '0775',
    ];

    public function install_check(Request $request)
    {
        // Clear cache, routes, views
        Artisan::call('optimize:clear');

        $passed = true;

        // Permissions checker
        $results['permissions'] = [];
        foreach ($this->permissions as $folder => $permission) {
            $results['permissions'][] = [
                'folder'     => $folder,
                'permission' => substr(sprintf('%o', fileperms(base_path($folder))), -4),
                'required'   => $permission,
                'success'    => substr(sprintf('%o', fileperms(base_path($folder))), -4) >= $permission ? true : false,
            ];
        }

        // Extension checker
        $results['extensions'] = [];
        foreach ($this->extensions as $extension) {
            $results['extensions'][] = [
                'extension' => $extension,
                'success'   => extension_loaded($extension),
            ];
        }

        // PHP version
        $results['php'] = [
            'installed' => PHP_VERSION,
            'required'  => $this->minPhpVersion,
            'success'   => version_compare(PHP_VERSION, $this->minPhpVersion) >= 0 ? true : false,
        ];

        // Pass check
        foreach ($results['permissions'] as $permission) {
            if ($permission['success'] == false) {
                $passed = false;
                break;
            }
        }

        foreach ($results['extensions'] as $extension) {
            if ($extension['success'] == false) {
                $passed = false;
                break;
            }
        }

        if ($results['php']['success'] == false) {
            $passed = false;
        }

        return view('install.database', compact(
            'results',
            'passed'
        ));

    }

    public function install_db(Request $request)
    {
        $request->validate([
            'APP_URL'     => 'required|url',
            'DB_HOST'     => 'required|string|max:50',
            'DB_PORT'     => 'required|numeric',
            'DB_DATABASE' => 'required|string|max:50',
            'DB_USERNAME' => 'required|string|max:50',
            'DB_PASSWORD' => 'nullable|string|max:50',
        ]);

        // Check DB connection
        try {

            $pdo = new \PDO(
                'mysql:host=' . $request->DB_HOST . ';port=' . $request->DB_PORT . ';dbname=' . $request->DB_DATABASE,
                $request->DB_USERNAME,
                $request->DB_PASSWORD, [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                ]
            );

        } catch (\PDOException $e) {

            return redirect()->route('install.db')->with('error', 'Database connection failed: ' . $e->getMessage());

        } catch (\Exception $e) {

            return redirect()->route('install.db')->with('error', 'Database error: ' . $e->getMessage());

        }

        // Setup .env file
        try {

            Helper::setEnv('APP_URL', $request->APP_URL);
            Helper::setEnv('APP_ENV', 'production');
            Helper::setEnv('APP_DEBUG', 'false');
            Helper::setEnv('DB_HOST', $request->DB_HOST);
            Helper::setEnv('DB_PORT', $request->DB_PORT);
            Helper::setEnv('DB_DATABASE', $request->DB_DATABASE);
            Helper::setEnv('DB_USERNAME', $request->DB_USERNAME);
            Helper::setEnv('DB_PASSWORD', $request->DB_PASSWORD);

        } catch (Exception $e) {

            return redirect()->route('install.db')->with('error', 'Can\'t save changes to .env file: ' . $e->getMessage());

        }

        return redirect()->route('install.setup');

    }

    public function setup()
    {
        // Application key
        try {

            Artisan::call('key:generate', ["--force" => true]);

        } catch (\Exception $e) {

            return redirect()->route('install.db')->with('error', 'Can\'t generate application key: ' . $e->getMessage());

        }

        // Migrate
        try {

            Artisan::call('migrate', ["--force" => true]);

        } catch (\Exception $e) {

            return redirect()->route('install.db')->with('error', 'Can\'t migrate database: ' . $e->getMessage());

        }

        return redirect()->route('install.administrator');
    }

    public function install_administrator()
    {
        return view('install.administrator');
    }

    public function install_finish(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|same:password_confirmation',
        ]);

        // Create admin account
        $user = User::create([
            'is_admin' => true,
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Pre-loaded messages list
        $templates = __('templates');

        foreach ($templates['messages'] as $group => $messages) {

            $messages_list = $user->lists()->create([
                'type' => 'messages',
                'name' => $group,
            ]);

            foreach ($messages as $message) {

                $messages_list->items()->create([
                    'text' => $message,
                ]);

            }
        }

        // Pre-loaded users list
        $users_list = $user->lists()->create([
            'type' => 'users',
            'name' => 'Most followed accounts on Instagram',
        ]);

        foreach ($templates['users'] as $username) {

            $users_list->items()->create([
                'text' => $username,
            ]);

        }

        // Create packages
        $packages = [
            [
                'title'          => 'Starter',
                'price'          => 4.99,
                'interval'       => 'month',
                'accounts_count' => 1,
            ],
            [
                'title'          => 'Captain',
                'price'          => 14.99,
                'interval'       => 'month',
                'accounts_count' => 3,
            ],
            [
                'title'          => 'Jet Pilot',
                'price'          => 29.99,
                'interval'       => 'month',
                'accounts_count' => 30,
            ],
        ];

        foreach ($packages as $package) {
            Package::create($package);
        }

        // Save installation
        touch(storage_path('installed'));

        return redirect()->route('landing')->with('success', 'Installation finished successfully');

    }

    public function update_check(Request $request)
    {
        return view('install.update');
    }

    public function update_finish(Request $request)
    {
        // Migrate
        try {

            Artisan::call('migrate', ["--force" => true]);

            // Save installation
            touch(storage_path('installed'));

        } catch (\Exception $e) {

            return redirect()->route('update.check')->with('error', 'Can\'t migrate database: ' . $e->getMessage());

        }

        return redirect()->route('landing')->with('success', 'Update finished successfully');
    }
}
