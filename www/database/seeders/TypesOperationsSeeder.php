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
                'payer_type_id' => 1,
                'payee_type_id' => 1,
                'enabled' => true,
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'payer_type_id' => 1,
                'payee_type_id' => 2,
                'enabled' => true,
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],

            [
                'payer_type_id' => 2,
                'payee_type_id' => 1,
                'enabled' => false,
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'payer_type_id' => 2,
                'payee_type_id' => 2,
                'enabled' => false,
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
        ]);
    }
}
