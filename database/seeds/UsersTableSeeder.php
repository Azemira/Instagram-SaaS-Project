<?php
use App\Models\User;
use Illuminate\Database\Seeder;

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
        $admin->save();
        
      }
}
