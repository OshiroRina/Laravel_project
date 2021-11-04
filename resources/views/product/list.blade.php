@extends('layouts.app')
@section('title','商品一覧')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-10 col-md-offset-2">
   
      <h2>商品情報一覧</h2>
           <br>
            <table class="table table-striped">
              <tr>
                <th>商品番号</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー名</th>
                <th> </th>
                <th> </th>

              </tr>
              @foreach($products as $product)
                <tr>
                  <td>{{ $product -> id }}</td>
                  <td>{{ $product -> product_name }}</td>
                  <td>{{ $product -> price }}円</td>
                  <td>{{ $product -> stock }}</td>
                  <td>{{ optional($product -> company) -> company_name }}</td>
                  <td><a href="#" class="btn btn-primary">{{ __('削除') }} </a></td>
                  <td><a href="/product/{{ $product->id }}" class="btn btn-primary">{{ __('詳細') }} </a></td>
                </tr>
              @endforeach
            </table>
       </div>
</div>
@endSection