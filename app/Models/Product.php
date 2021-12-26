<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\DB;

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
        'image'
       

    ];

    use Sortable; 
    public $sortable = ['id', 'image', 'product_name', 'price','stock', 'company_name'];

    //Companyリレーション記載
    public function company()
    {
        return $this->belongsTo(Company::class);
       
    }

    //ContentImageリレーション記載
    public function contentImage()
    {
        return $this->hasOne(ContentImage::class,'product_id','id');
       
    }
   
    
    //Saleリレーション記載
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    
}
