<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentImage extends Model
{
    use HasFactory;

    protected $table = 'content_images';

    protected $fillable = 
    [
        'id',
        'product_id',
        'file_path',
        'file_name'
       

    ];
    
     //画像表示   
     public function getImagePath1()
     {
         $product = Product::all();
         $file_path = ContentImage::select('file_path')
          ->first();
     
        if(isset($file_path)){
         $product['file_path'] = $file_path['file_path'];
         }
     
         return $file_path;
     }
 

    //画像表示   
    public function getImagePath($product_id)
    {
        $product = Product::all();
        $file_path = ContentImage::select('file_path')
        ->where('product_id',$product_id)
        ->first();
    
       if(isset($file_path)){
        $product['file_path'] = $file_path['file_path'];
        }
    
        return $file_path;
    }

      //Productリレーション記載
      public function product()
      {
        return $this->belongsTo(Product::class);
      }

     
}
