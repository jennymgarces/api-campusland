<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class WarehouseSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('warehouses')->insert([
            'name' => 'Bucaramanga',
            'id_responsible' => 1,
            'status' => 1,
            'created_by' => 1,
            'update_by' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
