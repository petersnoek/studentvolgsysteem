<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amount = 10;

        Group::factory()->count($amount)->create()->each(function($u){
            $this->command->info('- seeded group: ' . $u->code . " (" . $u->description . ")");
        });
    }
}
