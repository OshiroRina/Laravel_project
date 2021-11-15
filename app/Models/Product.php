<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = 
    [
        'id',
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
       

    ];
 
    //Companyリレーション記載
    public function company()
    {
        return $this->belongsTo(Company::class);
       
    }
   
    
    //Saleリレーション記載
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    
}
