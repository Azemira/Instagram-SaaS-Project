<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::paginate(10);

        return view('users.index', compact(
            'data'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:users',
            'password'      => 'required|string|min:6|same:password_confirmation',
            'trial_ends_at' => 'nullable|date',
        ]);

        $request->request->add([
            'password' => Hash::make($request->password),
        ]);

        if (!$request->filled('is_admin')) {
            $request->request->add([
                'is_admin' => false,
            ]);
        }

        $user = User::create($request->all());

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
            'name' => __('Most followed accounts on Instagram'),
        ]);

        foreach ($templates['users'] as $username) {

            $users_list->items()->create([
                'text' => $username,
            ]);

        }

        return redirect()->route('settings.users.index')
            ->with('success', __('Created successfully'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact(
            'user'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,' . $user->id,
            'password'      => 'nullable|string|min:6|same:password_confirmation',
            'trial_ends_at' => 'nullable|date',
        ]);

        if ($request->filled('password')) {
            $request->request->add([
                'password' => Hash::make($request->password),
            ]);
        } else {
            $request->request->remove('password');
        }

        if (!$request->filled('is_admin')) {
            $request->request->add([
                'is_admin' => false,
            ]);
        }

        $user->update($request->all());

        return redirect()->route('settings.users.edit', $user)
            ->with('success', __('Updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        if ($request->user()->id == $user->id) {
            return redirect()->route('settings.users.index')
                ->with('error', __('You can\'t remove yourself.'));
        }

        try {
            if ($user->subscription('main')) {
                $user->subscription('main')->cancel();
            }
        } catch (\Exception $e) {
            // Nothing special
        }

        foreach ($user->lists()->get() as $list) {
            $list->items()->delete();
            $list->delete();
        }

        $user->autopilots()->delete();
        $user->accounts()->delete();
        $user->messages_on_queue()->delete();
        $user->messages_sent()->delete();
        $user->messages_failed()->delete();
        $user->delete();

        return redirect()->route('settings.users.index')
            ->with('success', __('Deleted successfully'));
    }

    public function profile(Request $request)
    {
        $user = $request->user();

        return view('auth.profile', compact(
            'user'
        ));
    }

    public function profile_update(Request $request)
    {
        $request->validate([
            'name'     => 'required|max:255',
            'password' => 'same:password_confirmation',
        ]);

        if ($request->filled('password')) {
            $request->request->add([
                'password' => Hash::make($request->password),
            ]);
        } else {
            $request->request->remove('password');
        }

        $request->user()->update($request->all());

        return redirect()->route('profile.index')
            ->with('success', __('Updated successfully'));
    }
}
