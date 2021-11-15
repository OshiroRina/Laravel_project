<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Company extends Model
{
    use HasFactory;
    protected $table = 'companies';

    protected $fillable = 
    [
        'id',
        'company_name',
        'street_address',
    ];

    //Productリレーション記載
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    

}

