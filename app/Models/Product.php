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

  //画像表示   
   public static function image(){

    $product=Product::all();
    $file_path = ContentImage::select('file_path')
    ->where('product_id','id')
    ->first();

    if(isset($file_path)){
       $product['file_path'] = $file_path['file_path'];
   }

   return $file_path;
    
   }

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
