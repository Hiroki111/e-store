<?php

use Illuminate\Database\Seeder;

class RecommendedBundlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 4) as $i) {
            factory(App\RecommendedBundle::class)->create([
                'bundle_id' => $i,
            ]);
        }
    }
}
