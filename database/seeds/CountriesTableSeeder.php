<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            "Australia", "Argentina", "Czech", "Chile", "Denmark", "France", "Germany", "Netherlands", "Romania", "South Africa", "Spain",
        ];
        foreach ($names as $name) {
            factory(App\Country::class)->create([
                'name' => $name,
            ]);
        }
    }
}
