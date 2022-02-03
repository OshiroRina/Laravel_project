@extends('layouts.app')
@section('title','商品一覧')
@section('content')
<link rel ="stylesheet" href ="{{ asset('css/style.css') }}">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2>商品情報一覧</h2>

            <form id="searchForm" class="form-inline mt-5 mb-3 bg-white p-4 border" action="{{ url('/product/search') }}" method="get">
                {{ csrf_field()}}
                {{method_field('get')}}

                <div class="form-group col-md-4 col-sm-2">
                    <label for="product_name" >商品名:</label>
                    <input type="text" class="form-control ml-2 input" id="product_name" name="product_name"
                        placeholder="商品名を入力">
                </div>
                <div class="form-group col-md-4 col-sm-2">
                    <label for="company_id">メーカー名:</label>
                    <select type="text" class="form-control ml-2 input" id="company_id" name="company_id">
                        <option selected value="0">選択してください</option>
                        @foreach($companies as $company)
                        <option value="{{ $company->id }}"> {{ $company -> company_name }} </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group col-md-5 col-sm-2 mt-4">
                    <label for="product_name">価格:</label>
                    <p><input type="number" style="width: 100px;" class="form-control ml-2" id="min_price" name="min_price" placeholder="下限">円～</p>
                    <p><input type="number"  style="width: 100px;" class="form-control ml-2 " id="max_price" name="max_price" placeholder="上限">円</p>
                </div>
                
                <div class="form-group col-md-4 col-sm-2 mt-4">
                    <label for="product_name">在庫数:</label>
                    <p><input type="text" style="width: 100px;" class="form-control ml-2 " id="min_stock" name="min_stock" placeholder="下限">～</p>
                    <p><input type="text"  style="width: 100px;" class="form-control ml-2 " id="max_stock" name="max_stock" placeholder="上限"></p>
                </div>

                <div class="form-group searchButton col-md-4 col-sm-2">
                    <button type="button" class="btn btn-primary text-white px-5" name="search_button" id="search_button">検索</button>
                </div>

            </form>
        </div>
    </div>
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


