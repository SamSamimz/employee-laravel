<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\Employee;
use App\Models\State;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();
        User::create([
            'first_name' => 'Native',
            'last_name' => 'User',
            'username' => 'User',
            'address' => $faker->city(),
            'phone' => $faker->phoneNumber(),
            'email' => 'user@user.com',
            'password' => bcrypt('password'),
            
        ]);
        User::factory(15)->create();
        Country::factory(5)->create();
        State::factory(10)->create();
        City::factory(15)->create();
        Department::factory(15)->create();
        Employee::factory(50)->create();
    }
}
