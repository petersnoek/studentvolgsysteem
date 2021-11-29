<?php

namespace Database\Seeders;

use App\Models\Group;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColumnTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('column_types')->insert([
            'type' => 'textarea',
            'created_at' => Carbon::now(),
        ]);
        $this->command->info("- Seeded column_types with type: textarea");

    }
}
