<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypesSeeder extends Seeder
{
    private $table = "user_types";

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestamps = Carbon::now()->format('Y-m-d H:i:s');
        DB::table($this->table)->insert([
            [
                'id' => 1,
                'name' => 'User',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'id' => 2,
                'name' => 'Shop',
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
        ]);
    }
}
