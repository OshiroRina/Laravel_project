@extends('layouts.app')
@section('title','商品一覧')
@section('content')


<div class="row justify-content-center">
    <div class="col-md-10 col-md-offset-2">
   
      <h2>商品情報一覧</h2>

      <form class="form-inline mt-5 mb-3 bg-white p-3 border" action="{{ url('/product/search') }}" method="post">
        {{ csrf_field()}}
      {{method_field('get')}}
     
        <div class="form-group">
          <label for="product_name">商品名:</label>
            <input type="text" class="form-control mr-sm-3 ml-2" name="product_name" placeholder="商品名を入力"  >
        </div>
        <div class="form-group col-5">
          <label for="company_id">メーカー名:</label>
            <select type="text" class="form-control ml-2" name="company_id">
              <option selected value="0">選択してください</option>
              @foreach($companies as $company)
               <option value="{{ $company->id }}"> {{ $company -> company_name }} </option>
              @endforeach
          </select>
       </div>
        
          <button type="submit" class="btn btn-primary text-white col-2">検索</button>
      </form>
     

                 @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                  @endif
           <br>
            <table class="table table-striped">
              <tr>
                <th>商品番号</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー名</th>
                
                <th><a href="{{ route('create') }}"><button type="button" class="btn btn-outline-primary">+新規登録</button></a></th>
                <th></th>
              </tr>

              @foreach($products as $product)
                <tr>
                  <td>{{ $product -> id }}</td>
                  <td>
                  @if (isset($product['file_path']))
                    <img src="{{asset('storage/'. $product['file_path'])}}" width="100px" height="100px" alt="画像">
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