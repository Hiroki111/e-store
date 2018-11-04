<?php

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Beer', 'Red Wine', 'White Wine', 'Whiskey'];
        foreach (range(0, 3) as $i) {
            factory(App\Type::class)->create([
                'name' => $names[$i],
            ]);
        }
    }
}
