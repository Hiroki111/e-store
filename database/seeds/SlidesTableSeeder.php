<?php

use Illuminate\Database\Seeder;

class SlidesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 3) as $i) {
            factory(App\Slide::class)->create([
                'product_id' => $i,
                'src'        => "/images/slides/" . $i . ".jpeg",
                'is_active'  => 1,
            ]);
        }
    }
}
