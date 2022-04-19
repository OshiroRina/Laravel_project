@extends('layouts.app')
@section('title','商品一覧')
@section('content')
<link rel ="stylesheet" href ="{{ asset('css/style.css') }}">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2>商品情報一覧</h2>
            <br>
            <form id="searchForm" class="form-inline" action="{{ url('/product/search') }}" method="get">
                {{ csrf_field()}}
                {{method_field('get')}}
             <div class="card card-dark card-outline">
                <div class="card-header font-weight-bold h5 bg-light">検索</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table>
                          <tbody>
                              <tr>
                                <th><label for="product_name">商品名:</label></th>
                                    <td>
                                        <input type="text" class="form-control input" id="product_name" name="product_name"
                                        placeholder="商品名を入力">
                                    </td>
                                <th><label for="company_id">メーカー名:</label></th>
                                 <td>
                                    <select type="text" class="form-control input" id="company_id" name="company_id">
                                        <option selected value="0">選択してください</option>
                                        @foreach($companies as $company)
                                        <option value="{{ $company->id }}"> {{ $company -> company_name }} </option>
                                        @endforeach
                                    </select>
                                </td>
                              </tr>
                              <tr>
                                <th><label for="product_name">価格:</label></th>
                                 <td>
                                     <p>
                                         <input type="number" style="width: 100px;" class="form-control mt-2 mr-2" id="min_price" name="min_price" placeholder="下限">～
                                         <input type="number"  style="width: 100px;" class="form-control mt-2 ml-2 mr-2" id="max_price" name="max_price" placeholder="上限">円
                                     </p>
                                </td>
                              </tr>
                            <tr>
                                <th><label for="product_name">在庫数:</label></th>
                                <td>
                                    <p>
                                     <input type="text" style="width: 100px;" class="form-control mr-2" id="min_stock" name="min_stock" placeholder="下限">～
                                     <input type="text"  style="width: 100px;" class="form-control ml-2" id="max_stock" name="max_stock" placeholder="上限">
                                    </p>
                                </td>
                                <td>
                                 <button type="button" class="btn btn-primary text-white px-5 mb-3 ml-3" name="search_button " id="search_button" >検索</button>
                                </td>
                            <tr>
                          </tbody>
                       </table>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
        <!-- <form id="ImportFile" class="form-group col-md-4 col-sm-4 " style="margin-left:auto;" >
                <div class="form-group">
                    <label for="exampleFormControlFile1">ファイルインポート</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1">
                </div>
         </form> -->
   </div>

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<br>

<div class="container">
    <div class="products-table">
      @include('product.search')
    </div>
</div>


@endSection


