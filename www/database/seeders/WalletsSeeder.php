<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletsSeeder extends Seeder
{
    private $table = "wallets";
    private $usersTable = "users";

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wallets = collect([]);

        $users = DB::table($this->usersTable)
            ->select('id')
            ->get();

        foreach ($users as $user) {
            $wallets->push([
                'user_id' => $user->id,
                'balance' => 1000 * 100,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }

        DB::table($this->table)->insert($wallets->toArray());
    }
}
