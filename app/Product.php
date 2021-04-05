<?php

namespace App;

use App\Stock;
use App\ProductImage;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'product_image', 'is_deleted'
    ];

    public function stock()
    {
    	return $this->hasOne(Stock::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // public function getProduct(){
    //     return Product::join('stocks', ['stocks.product_id' => 'products.id'])
    //                 ->selectRaw('products.*,stocks.quantity, stocks.threshold')
    //                     ->where('is_deleted', '!=', 1)
    //                         ->latest()
    //                             ->get();
    // }
    public function getProduct(){
        return Product::join('product_stocks', ['product_stocks.product_id' => 'products.id'])
                    ->selectRaw('products.*, SUM(product_stocks.quantity) AS quantity, SUM(product_stocks.threshold) AS threshold')
                        ->where('products.is_deleted', 0)
                            ->groupBy('product_stocks.product_id')
                                ->latest()
                                    ->get();
    }
}
