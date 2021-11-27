@extends('layouts.app')
@section('title','商品一覧')
@section('content')

<div class="container">
<div class="row justify-content-center">
    <div class="col-12">
     
      <h2>商品検索結果</h2> 
      
        <p class="text-right"><a href="{{ route('showList') }}">←商品一覧へ戻る</a></p>
     
   
      <div class="table-responsive-sm">
        <table class="table table-striped">
              <tr>
                <th>商品番号</th>
                <th>画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー名</th>
                <th></th>
                <th></th>
              </tr>

              @foreach($products as $product)

                <tr>
                  <td>{{ $product -> id }}</td>
                  <td>
                  @if (isset($product['image']))
                    <img src="{{asset('storage/'. $product['image'])}}" width="100px" height="100px" alt="画像">
                  @endif
                  </td>
                  <td>{{ $product -> product_name }}</td>
                  <td>{{ $product -> price }}円</td>
                  <td>{{ $product -> stock }}</td>
                  <td>{{ $product -> company -> company_name }}</td>

                  <td><a href="/product/{{ $product->id }}" class="btn btn-primary">{{ __('詳細') }} </a></td>
                  <form method="post" action="{{ route('delete', $product->id) }}" onSubmit="return checkDelete()">
                    @csrf
                    <td><button type="submit" class="btn btn-danger" onclick=> {{ __('削除') }} </button></td>
                  </form>
                </tr>

              @endforeach
          </table>
          
        </div>
      </div>
    </div>
  </div>


 <script>
function checkDelete(){
    if(window.confirm('削除してよろしいですか？'))
    {
        return true;
    } else {
        return false;
    }
}
</script>

@endSection