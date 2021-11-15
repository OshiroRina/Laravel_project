@extends('layouts.app')
@section('title','商品一覧')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-10 col-md-offset-2">
   
      <h2>商品検索結果</h2> 
     
     <!-- @if(!empty($message))
              <div class="alert alert-primary" role="alert">{{ $message}}</div>
              @endif

     @if(isset($products)) -->
     
     <p class="text-right"><a href="{{ route('showList') }}">←商品一覧へ戻る</a></p>
     


            <table class="table table-striped">
              <tr>
                <th>商品番号</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー名</th>

              </tr>
              @foreach($products as $product)

                <tr>
                  <td>{{ $product -> id }}</td>
                  <td>{{ $product -> product_name }}</td>
                  <td>{{ $product -> price }}円</td>
                  <td>{{ $product -> stock }}</td>
                  <td>{{ $product -> company -> company_name }}</td>
  
                </tr>
              @endforeach
            </table>
            @endif
            
       </div>
</div>


@endSection