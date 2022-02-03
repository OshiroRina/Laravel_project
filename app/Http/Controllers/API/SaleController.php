<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    //商品購入処理
    public function buy(Request $request)
    {
      $product = Product::find($request->product_id);  
      $stock = $product->stock;                       //商品在庫数を出す
      
      //在庫が０でなければ以下の処理
       if($stock != 0) {
          $sale = new Sale;                        //Saleテーブルに購入リクエスト追加
          $sale->product_id = $request->product_id;
          $sale->save();

          Product::where('id',$request->product_id) -> decrement('stock', 1);   //Productテーブルから在庫数減算
          return response()->json(['message' => '商品を購入しました'],200);
        
        } else {                                                                 
           return response()->json(['message' => '在庫がありませんでした'],404);   //在庫０の時は買えません 
        }
    }
}
