<?php

namespace App;

use App\ProductFileReport;
use App\ReplacementProduct;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Product_Report extends Model
{
    protected $table = "product_reports";

    protected $fillable = [
        'report_type','product_id', 'store_id',  'size', 'flavor', 'client_id', 'issued_by', 'is_replaced', 'reason'
    ];

    public function products()
    {
    	return $this->hasMany(ReplacementProduct::class, 'product_report_id');
    }

    public function client()
    {
    	return $this->belongsTo(User::class, 'client_id');
    }

    public function images()
    {
    	return $this->hasMany(ProductFileReport::class, 'product_report_id');
    }
}
