<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 4) as $i) {
            factory(App\Product::class)->create([
                'src' => "/images/products/" . $i . ".jpeg",
            ]);
        }
    }
}
