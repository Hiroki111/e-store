<?php

use Illuminate\Database\Seeder;

class RecommendedProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 4) as $i) {
            factory(App\RecommendedProduct::class)->create([
                'product_id' => $i,
            ]);
        }
    }
}
