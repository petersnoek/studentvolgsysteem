<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Group::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $lo = ['MB', 'LP'];
        $opl = ['IAO', 'TBO'];
        $jaar = ['13', '14', '15', '16', '16', '16', '17', '17', '17', '18', '18', '18', '19', '19', '19', '20', '20', '20', '21', '21', '21'];
        $soort = ['A', 'B', 'M', 'R'];

        $jaar_select = $jaar[array_rand($jaar,1)];
        $soort_select = $soort[array_rand($soort,1)];
        $volgnr_select = $this->faker->numberBetween(0,7);

        // MBIAO16A5, LPTBO18B0
        return [
            'code' =>
                $lo[array_rand($lo,1)] .
                $opl[array_rand($opl,1)] .
                $jaar_select .
                $soort_select .
                $volgnr_select,
            'description' => ( ($jaar_select == '20' || $jaar_select == '21') ? 'Software developer' : 'Applicatieontwikkelaar') . ' 25187 BOL4',
            'user_id' => User::all()->first()->id,
            'created_at' => Carbon::now(),
        ];

    }
}
