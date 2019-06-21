<?php
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->name = 'Super Admin';
        $admin->email = 'admin@autodimes.com';
        $admin->password = bcrypt('DarthVader123#!');
        $admin->is_admin = true;
        $admin->email_verified_at = Carbon::now()->toDateTimeString();
        $admin->save();
        
      }
}
