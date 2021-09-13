<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\User;
use App\Models\Group;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(User::all()->count() == 0 ) {
            $this->command->error('Cant seed students. Please add a user first.');
        } elseif(Group::all()->count() == 0) {
            $this->command->error('Cant seed students. Please add a group first.');
        }
        else {
            $amount = 50;

            // create <amount> Student models and attach an existing (random) group
            Student::factory()->count($amount)->create()->each(function ($student) {
                $randomGroup = Group::inRandomOrder()->first()->id;
                $randomUser = User::inRandomOrder()->first()->id;
                //$student->created_by = $randomUser;
                //$student->groups()->attach($randomGroup, ['created_at' => Carbon::now()]);

                $this->command->info('- seeded student: ' . $student->firstname . " " . $student->suffix . " " . $student->lastname . " (" . $student->studentnummer . ")");
            });
            $this->command->info('~ seeded ' . $amount . ' Students, each belonging to 1 random group');
        }
    }
}
