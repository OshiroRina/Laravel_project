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

      //Productリレーション記載
      public function product()
      {
          return $this->belongsTo(Product::class);
         
      }
     
}
