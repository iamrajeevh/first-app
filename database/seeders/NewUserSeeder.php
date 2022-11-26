<?php

namespace Database\Seeders;

use App\Models\NewUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        NewUser::factory()->count(10)->create();
    }
}
