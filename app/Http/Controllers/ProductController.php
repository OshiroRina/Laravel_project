<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * 商品一覧
     * 
     * @return view
     */
    public function showList()
    {
        $products = Product::all();
        $companies = Company::with('company');
        
    
        return view('product.list',compact('products','companies'));
           
    }
    
    /**
     * 商品詳細を表示する
     * @param int $id
     * @return view
     */

    public function showDetail($id)
    {
        $product = Product::find($id);

        if(is_null($product))
        {
            \Session::flash('err_msg','データがありません。');
            return redirect(route ('showList'));
        }
       
         return view('product.detail',['product' => $product]); 
       
           
    }
    
     /**
     * 商品登録画面を表示する
     * 
     * @return view
     */
    
    public function showCreate()
    {
        $companies = Company::all();
        return view('product.form', compact('companies'));
    }

     /**
     * 商品を表示する
     * @return view
     */
    
    public function exeStore(ProductRequest $request)
    {
        $inputs = $request->all(); 
       
        \DB::beginTransaction();
        
        try{
           Product::create($inputs);
          \DB::commit();
          
         } catch(\Throwable $e){
            \DB::rollback();
             abort(500);
         }
       
        \Session::flash('err_msg','商品を登録しました');
        return redirect(route('showList'));
    }



     /**
     * 詳細画面を表示する
     * @param int $id
     * @return view
     */

    public function editList($id)
    {
        $product = Product::find($id);

        if(is_null($product))
        {
            \Session::flash('err_msg','データがありません。');
            return redirect(route ('showList'));
        }
       
         return view('product.detail',['product' => $product]); 
       
           
    }

}
