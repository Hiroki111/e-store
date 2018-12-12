<?php

use App\Bundle;
use App\Product;
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
        $aussieWines = Product::whereIn('product_type_id', [2, 3])
            ->where('country_id', 1)
            ->get();
        $latinAmericanWines = Product::whereIn('product_type_id', [2, 3])
            ->whereIn('country_id', [2, 4])
            ->get();
        $europeanWines = Product::whereIn('product_type_id', [2, 3])
            ->whereIn('country_id', [6, 9, 11])
            ->get();
        $bears = Product::where('product_type_id', 1)
            ->get();

        collect([$aussieWines, $latinAmericanWines, $europeanWines, $bears])->each(function ($products, $i) {
            $bundle = factory(Bundle::class)->create([
                'src'       => "/images/bundles/" . ($i + 1) . ".jpeg",
                'src_large' => "/images/bundles/large/" . ($i + 1) . ".jpg",
            ]);

            $bundledProducts = $products->shuffle()
                ->take(rand(8, 10))
                ->map(function ($product) {
                    return $product->id;
                })
                ->toArray();

            foreach (array_merge($bundledProducts, $bundledProducts) as $key => $id) {
                $bundle->products()->attach($id);
            }
        });
    }
}
