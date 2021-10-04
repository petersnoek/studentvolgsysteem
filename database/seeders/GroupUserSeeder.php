<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GroupUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students_per_group = 25;

        foreach(Group::all() as $group) {
            for($i = 0; $i<$students_per_group; $i++) {
                DB::table('group_student')->insert([
                    'group_id' => $group->id,
                    'student_id' => Student::all()->random()->id,
                    'active_from' => Carbon::now(),
                    'active_until' => null,
                    'created_at' => Carbon::now(),
                    'updated_at' => null,
                ]);
            }

            $this->command->info('- seeded ' . $students_per_group . ' students in group: ' . $group->code . " (" . $group->description . ")");

        }


    }
}
