<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Models\Sale;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateRequest;
use Illuminate\Support\Facades\DB;
use App\Models\ContentImage;
use Illuminate\Support\Facades\Storage;

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
        $companies = Company::all();
        $products = Product::sortable()->paginate(5);
        
        foreach($products as $product) {  

            $content_image = new ContentImage;
            $image = $content_image->getImagePath1();
        }
        
        return view('product.list',compact('products','companies'));
           
    }

    /**
     * 商品一覧２ページ目以降
     */
    public function ajaxList(Request $request)
    {
      if($request->ajax()) {
        $products = Product::orderBy('created_at')->paginate(5);
        return view('product.search',compact('products'))->render();
      }

    }
    
     /**
     * 商品詳細を表示する
     * @param int $id
     * @return view
     */

    public function showDetail($id)
    {
        $product = Product::find($id);
        
        if(is_null($product)) {
            \Session::flash('err_msg','データがありません。');
            return redirect(route ('showList'));
        }

         $content_image = new ContentImage;
         $image = $content_image->getImagePath($id);

        return view('product.detail',compact('product','image'));
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
        return DB::transaction(function() use($request) {
            $product = new Product();
            $product->product_name = $request->product_name;
            $product->company_id = $request->company_name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->comment = $request->comment;
            $product->save();

        if ($request->file('image')) {
            $this->validate($request, [
                'image' => [
                   'required',
                    'file',
                    'image',
                    'mimes:jpeg,png',
                ]
            ]);

            if($request->file('image')->isValid([])) {
                $file_name = request()->file('image')->getClientOriginalName();
                $file_path = Storage::putFileAs('/images', $request->file('image'), $file_name);
                $product->image = $file_path;
                $product->save();

                $image_info = new ContentImage();
                $image_info->product_id = $product->id;
                $image_info->file_name = $file_name;
                $image_info->file_path = $file_path;
                $image_info->save();
            }
        }
        
        return redirect(route('showList'))->with('success','商品を登録しました。');
      });
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
        
        if(is_null($product)) {
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
    
    public function exeUpdate(UpdateRequest $request)
   {    
        $product = Product::find($request->id);
        
        return DB::transaction(function() use($product,$request) {
        $product->product_name = $request->product_name;
        $product->company_id = $request->company_name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->comment = $request->comment;
        $product->save();

        if ($request->file('image')) {
            $this->validate($request, [
                'image' => [
                   'required',
                    'file',
                    'image',
                    'mimes:jpeg,png',
                ]
            ]);

            if($request->file('image')->isValid([])) {
                $file_name = request()->file('image')->getClientOriginalName();
                $file_path = Storage::putFileAs('/images', $request->file('image'), $file_name);
                $product->image = $file_path;
                $product->save();

                $image_info = new ContentImage();
                $image_info->product_id = $product->id;
                $image_info->file_name = $file_name;
                $image_info->file_path = $file_path;
                $image_info->save();
            }
        }
        
        return redirect(route('showList')) -> with('success','商品を更新しました。');
      });
    }

    /**
     * 商品削除
     * @param int $id
     * @return view
     */

    public function destroy($id)
    {
        // $products = Product::find($id);
        // $products->delete();
        // //  return response()->json(['success'=>'削除しました']);
    
            $companies = Company::all();
            $products = Product::find($id);
            $products = Product::destroy($id);
            $products = Product::orderBy('created_at','desc')->paginate(5);

            return redirect(route('showList')) -> with('success','商品を削除しました。');
           
            // return view('product.list',[
            //     'companies'=> $companies,
            //     'products' => $products,
            // ])->with('success','商品を削除しました。');
    }

    /**
     * API削除
     */
     public function deleteApi($id)
     {
        $product = Product::find($id);
        if($product){
            $product->delete();
            return response()->json(['message'=>'商品を購入（データ削除）しました'],200);
        } else {
            return response()->json(['message'=>'商品は見つかりませんでした'],404);
        }
     }
       
     /**
     * 通常の商品検索
     * 
     * @param $request
     * @return view
     */
    public function exeSearch(Request $request)
   {   
        $companies = Company::all();
        $product_name = $request->product_name;
        $company_id = $request->company_id;

        $query = Product::query();

        $query->when($product_name,function($query,$product_name) {
                return $query->where('product_name','LIKE',"%{$product_name}%");
            });

            $query->when($company_id,function($query,$company_id) {
                return $query->where('company_id',$company_id);
            });

        $products = $query->paginate(5);
        
        return view('product.list')->with(['products'=>$products,'companies'=>$companies]);
    }    

     /**
     * ajax商品検索
     * 
     * @param $request
     * @return view
     */

     public function ajaxSearch(Request $request)
     {

        $product_name = $request->product_name;
        $company_id = $request->company_id;
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        $min_stock = $request->min_stock;
        $max_stock = $request->max_stock;

        if($request->ajax()){
            $query = Product::query();

            $query->when($product_name,function($query,$product_name) {
                    return $query->where('product_name','LIKE',"%{$product_name}%");
                });

            $query->when($company_id,function($query,$company_id) {
                    return $query->where('company_id',$company_id);
                });
            
            if(!empty($min_price && $max_price)){
                $query->when($min_price,function($query,$min_price) {
                        return $query->where('price','>=',$min_price);
                    });
                $query->when($max_price,function($query,$max_price) {
                        return $query->where('price','<=',$max_price);
                    });
            }
            if(!empty($min_stock && $max_stock)){
                $query->when($min_stock,function($query,$min_stock) {
                        return $query->where('stock','>=',$min_stock);
                    });
                $query->when($max_stock,function($query,$max_stock) {
                        return $query->where('stock','<=',$max_stock);
                    });
            }

            $products = $query->paginate(5);

            return  view('product.search',compact('products'))->render();
        }
    }


    public function exportCSV()
    {
        $products = Product::all();
    
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=file.csv",
        ];
       
        $callback = function() use($products){
            $handle = fopen('php://output','w');

            $columns = [
               
                'id' => '商品番号',
                'image' => '商品画像',
                'product_name' => '商品名',
                'price' => '価格',
                'stock' => '在庫数',
                'comment' => '備考',
                'company_name' => 'メーカー名',
                'created_at' => '登録日',
                'updated_at' => '更新日',
               
            ];

            mb_convert_variables('SJIS-win','UTF-8',$columns);

            fputcsv($handle,$columns);

            foreach($products as $product){
                $csv = [
                    $product -> id,
                    $product -> image,
                    $product -> product_name,
                    $product -> price,
                    $product -> stock,
                    $product -> comment,
                    $product -> company -> company_name,
                    $product -> created_at,
                    $product -> updated_at,
                  
                ];

                mb_convert_variables('SJIS-win', 'UTF-8', $csv);
                fputcsv($handle, $csv);
            }
            fclose($handle);
        };
        
        return response()->stream($callback,200,$headers);
     }

     public function __get($key)
    {
    return Product::get($this->all(), $key, function () use ($key) {
        return $this->route($key);
    });
}
}
                    