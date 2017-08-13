<?php

use Illuminate\Database\Seeder;
use App\Product;
class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product();
        $product->name = 'Shtiker';
        $product->sku = 1234;
        $product->price = 1.40;
        $product->unit = 'meter';
        $product->suplier = 'Bujari';
        $product->quantity = 1000;
        $product->save();

        $product = new Product();
        $product->name = 'Led DirectoryIterator';
        $product->sku = 4321;
        $product->price = 2.80;
        $product->unit = 'piece';
        $product->suplier = 'Bujari';
        $product->quantity = 1000;
        $product->save();

        $product = new Product();
        $product->name = 'Kabell';
        $product->sku = 1111;
        $product->price = 0.42;
        $product->unit = 'meter';
        $product->suplier = 'Bujari';
        $product->quantity = 1000;
        $product->save();

        $product = new Product();
        $product->name = 'Kabell Interneti';
        $product->sku = 222;
        $product->price = 0.62;
        $product->unit = 'meter';
        $product->suplier = 'Bujari';
        $product->quantity = 1000;
        $product->save();

        $product = new Product();
        $product->name = 'Poq';
        $product->sku = 4444;
        $product->price = 1.90;
        $product->unit = 'piece';
        $product->suplier = 'Bujari';
        $product->quantity = 1000;
        $product->save();
    }
}
