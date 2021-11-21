@extends('layouts.app')
@section('title','商品詳細')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-10 col-md-offset-2">
   
      <h2>商品詳細</h2>
           <br>
            
              <dl class="row">
                <dt class="col-sm-3">商品情報ID: </dt>
                <dd class="col-sm-9">{{ $product -> id }}</dd>

                <dt class="col-sm-3">商品画像: </dt>
                <dd class="col-sm-9">
                  @if (isset($product['file_path']))
                   <img src="{{asset('storage/'. $product['file_path'])}}" width="200px" height="250px" alt="画像">
                  @endif
                </dd> 

                <dt class="col-sm-3">商品名:</dt>
                <dd class="col-sm-9">{{ $product -> product_name }}</dd>

                <dt class="col-sm-3">メーカー名:</dt>
                <dd class="col-sm-9">{{ $product -> company -> company_name  }}</dd>

                <dt class="col-sm-3">価格:</dt>
                <dd class="col-sm-9">{{ $product -> price }}円</dd>

                <dt class="col-sm-3">在庫数:</dt>
                <dd class="col-sm-9">{{ $product -> stock }}</dd>

                <dt class="col-sm-3">コメント:</dt>
                <dd class="col-sm-9">{{ $product -> comment }}</dd>

               
              </dl>
            
                <button type="button" class="btn btn-primary" onclick="location.href='/product/edit/{{ $product->id }}'">{{ __('編集') }}</button>
                <a href="/product" class="btn btn-secondary">{{ __('戻る') }} </a>
             
             
           
       </div>
</div>
@endSection