<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesOperationsSeeder extends Seeder
{
    private $table = "type_operations";

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestamps = Carbon::now()->format('Y-m-d H:i:s');
        DB::table($this->table)->insert([
            [
                'type_id' => 1,
                'send' => true,
                'receive' => true,
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'type_id' => 2,
                'send' => false,
                'receive' => true,
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ]
        ]);
    }
}
