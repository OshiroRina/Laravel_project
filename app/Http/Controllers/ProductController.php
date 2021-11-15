<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;

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
     * 商品を登録する
     * 
     * @param $request
     * @return view
     */
    
    public function exeStore(ProductRequest $request)
   {    
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->company_id = $request->company_name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->comment = $request->comment;
        $product->save();

        
        return redirect(route('showList'))->with('success','商品を登録しました。');

        
    }



     /**
     * 商品編集画面を表示する
     * @param int $id
     * @return view
     */

    public function showEdit($id)
    {
        $companies = Company::all();
        $product = Product::find($id);
        
        
        if(is_null($product))
        {
            \Session::flash('err_msg','データがありません。');
            return redirect(route ('showList'));
        }
       
         return view('product.edit',compact('product','companies'))->with('success','更新しました。'); 
       
           
    }

     /**
     * 商品情報を更新する
     * 
     * @param $request
     * @param $id
     * @return view
     */
    
    public function exeUpdate(Request $request)
   {    
        $product = Product::find($request->id);
        
        $product->product_name = $request->product_name;
        $product->company_id = $request->company_id;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->comment = $request->comment;
        $product->save();

     return redirect(route('showList'))->with('success','商品を更新しました。');

        
    }

 /**
     * 商品削除
     * @param int $id
     * @return view
     */

    public function exeDelete($id)
    {
        if(empty($id))
        {
            \Session::flash('err_msg','データがありません。');
            return redirect(route ('showList'));
        }
        
        try{
            Product::destroy($id);
        } catch(\Throwable $e){
            abort(500);

       };
       return redirect(route ('showList'))->with('success','削除しました。');
           
    }
   

     /**
     * 商品検索
     * 
     * @param $request
     * @return view
     */
    public function exeSearch(Request $request)
   {   
    
     $product_name = $request->product_name;
     $company_id = $request->company_id;
   

     $products = Product::query()
        ->when($request->has('product_name'), function($query) use ($product_name) {
            $query->where('product_name', 'like', "%{$product_name}%");
        })
        ->when($request->has('company_name'), function($query) use ($company_id) {
            $query->where('company_name', 'like', "%{$company_id}%");
        })
     ->paginate(5);     
       
    return view('product.search')->with([
        
        'products' => $products,
       
    ]);
        
   }        
   





            

            
        
    
    
}
