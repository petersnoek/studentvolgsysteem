<?php

namespace Database\Seeders;

use App\Models\CustomColumn;
use App\Models\Group;
use Database\Factories\CustomColumnFactory;
use Illuminate\Database\Seeder;

class CustomColumnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amount = 10;

        CustomColumn::factory()->count($amount)->create()->each(function($u){
            $this->command->info('- seeded CustomColumn: ' . $u->name);
        });
    }
}
