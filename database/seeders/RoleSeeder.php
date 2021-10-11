<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('roles')->insert([
            'id' => 1,
            'description' => 'Administrator',
            'created_at' => $now,
        ]);
        $this->command->info("- seeded role Administrator (1)");

        DB::table('roles')->insert([
            'id' => 2,
            'description' => 'Teacher',
            'created_at' => $now,
        ]);
        $this->command->info("- seeded role Teacher (2)");

        DB::table('roles')->insert([
            'id' => 3,
            'description' => 'User',
            'created_at' => $now,
        ]);
        $this->command->info("- seeded role User (3)");

    }
}
