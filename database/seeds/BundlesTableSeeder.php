<?php

use Illuminate\Database\Seeder;

class BundlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = App\Product::all();
        foreach (range(1, 4) as $i) {
            $bundle = factory(App\Bundle::class)->create([
                'src' => "/images/bundles/" . $i . ".jpeg",
            ]);

            $sizeOfBundle    = rand(4, 12);
            $bundledProducts = $products->shuffle()
                ->filter(function ($product, $i) use ($sizeOfBundle) {
                    return $i <= $sizeOfBundle;
                })
                ->map(function ($product) {
                    return $product->id;
                })
                ->toArray();
            $bundle->products()->sync($bundledProducts);
        }
    }
}
