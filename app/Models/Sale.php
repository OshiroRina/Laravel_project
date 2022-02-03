<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    use HasFactory;
    
    protected $table = 'sales';

    protected $fillable = 
    [
        'id',
        'product_id'
    ];
    
    //Productリレーション記載
     public function product()
     {
         return $this->belongsTo(Product::class,'product_id');
     }
}
