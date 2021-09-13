<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tv = ['', '', '', '', 'van der', 'de', 'van de'];
        $count = Student::all()->count();
        $ovnr = ( $count == 0 ? "99" . $this->faker->unique()->randomNumber(6, true) : Student::max('student_code')+1);
        return [
            'studentnumber' => $ovnr,                       // 99000001
            'firstname' => $this->faker->firstName,         // Peter
            'suffix' => $tv[array_rand($tv,1)],       // van der
            'lastname' => $this->faker->lastName,           // Snoek

            //'created_by' => User::all()->random()->id,
            'created_at' => Carbon::now(),

        ];
    }
}
