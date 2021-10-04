<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        if(env('NEW_ADMIN_DEFAULT_PASS')==null | env('NEW_USER_DEFAULT_PASS')==null) {
            $this->command->error('Cant seed users. Please add NEW_ADMIN_DEFAULT_PASS and NEW_USER_DEFAULT_PASS to .env file.');
        } else {
            DB::table('users')->insert([
                'name' => 'Peter Snoek',
                'email' => 'psnoek@davinci.nl',
                'email_verified_at' => $now,
                'password' => bcrypt(env("NEW_ADMIN_DEFAULT_PASS")),
                'role' => 'admin',
                'created_at' => $now
            ]);
            $this->command->info("- seeded user Peter Snoek (psnoek@davinci.nl) with password '*******'");

            DB::table('users')->insert([
                'name' => 'Stefano Verhoeve',
                'email' => 'sverhoeve@davinci.nl',
                'email_verified_at' => $now,
                'password' => bcrypt(env("NEW_ADMIN_DEFAULT_PASS")),
                'role' => 'admin',
                'created_at' => $now
            ]);
            $this->command->info("- seeded user Stefano Verhoeve (sverhoeve@davinci.nl) with password '*******'");

            DB::table('users')->insert([
                'name' => 'Demo Docent',
                'email' => 'docent@davinci.nl',
                'email_verified_at' => $now,
                'password' => bcrypt(env("NEW_USER_DEFAULT_PASS")),
                'role' => 'teacher',
                'created_at' => $now
            ]);
            $this->command->info("- seeded user Demo Docent (docent@davinci.nl) with password '*******'");

        }
    }
}
