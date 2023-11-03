<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member;
use Faker\Factory;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        for ($i=0; $i < 122; $i++) {
            $member = new Member;
            $member->first_name = $faker->firstName;
            $member->surname = $faker->lastName;
            $member->email = $faker->email;
            $member->address = $faker->address;
            $member->save();
        }
    }
}
