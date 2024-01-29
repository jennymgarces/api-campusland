<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            DB::table('products')->insert([
                'name' => $faker->name,
                'description' => $faker->text,
                'status' => 1,
                'created_by' => 1,
                'update_by' => 1,
            ]);
        }
    }
}
