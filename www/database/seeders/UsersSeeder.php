<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    private $table = "users";

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suffixMail = '@example.com';
        $timestamps = Carbon::now()->format('Y-m-d H:i:s');
        DB::table($this->table)->insert([
            [
                'name' => Str::random(10),
                'email' => Str::random(10).$suffixMail,
                'password' => Hash::make('password'),
                'document' => fake()->cpf(),
                'type_id' => 1,
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'name' => Str::random(10),
                'email' => Str::random(10).$suffixMail,
                'password' => Hash::make('password'),
                'document' => fake()->cpf(),
                'type_id' => 1,
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'name' => Str::random(10),
                'email' => Str::random(10).$suffixMail,
                'password' => Hash::make('password'),
                'document' => fake()->cpf(),
                'type_id' => 1,
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],

            [
                'name' => Str::random(10),
                'email' => Str::random(10).$suffixMail,
                'password' => Hash::make('password'),
                'document' => fake()->cnpj(),
                'type_id' => 2,
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
            [
                'name' => Str::random(10),
                'email' => Str::random(10).$suffixMail,
                'password' => Hash::make('password'),
                'document' => fake()->cnpj(),
                'type_id' => 2,
                'created_at' => $timestamps,
                'updated_at' => $timestamps,
            ],
        ]);
    }
}
