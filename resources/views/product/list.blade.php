@extends('layouts.app')
@section('title','商品一覧')
@section('content')

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/list.js') }}"></script>

</head>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>商品情報一覧</h2>

            <form class="form-inline mt-5 mb-3 bg-white p-3 border" action="{{ url('/product/search') }}" method="post">
                {{ csrf_field()}}
                {{method_field('get')}}

                <div class="form-group col-md-4 col-sm-5">
                    <label for="product_name">商品名:</label>
                    <input type="text" class="form-control ml-2" id="company" name="product_name" placeholder="商品名を入力">
                </div>
                <div class="form-group col-md-4 col-sm-5">
                    <label for="company_id">メーカー名:</label>
                    <select type="text" class="form-control ml-2" id="company_name" value="company_id"
                        name="company_id">
                        <option selected value="0">選択してください</option>
                        @foreach($companies as $company)
                        <option value="{{ $company->id }}"> {{ $company -> company_name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 col-sm-2">
                    <button type="submit" class="btn btn-primary text-white px-3" id="search_button">検索</button>
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
    <div class="table-responsive-sm">
        <table class="table table-striped">

            <tr>
                <th class="text-primary">↑↓</th>
                <th>@sortablelink('id','商品番号')</th>
                <th>@sortablelink('image','商品画像')</th>
                <th>@sortablelink('product_name','商品名')</th>
                <th>@sortablelink('price','価格')</th>
                <th>@sortablelink('stock','在庫数')</th>
                <th>@sortablelink('company_name','メーカー名')</th>

                <th><a href="{{ route('create') }}"><button type="button"
                            class="btn btn-outline-primary">+新規登録</button></a></th>
                <th></th>
            </tr>

          @foreach($products as $product)
            <div id="read">
                <tr>
                    <td></td>
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
                        <td><button type="submit" class="btn btn-danger" onclick=> {{ __('削除') }}</button></td>
                    </form>
                </tr>
            </div>
            @endforeach

        </table>

        {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}

    </div>
</div>

<script>
function checkDelete() {
    if (window.confirm('削除してよろしいですか？')) {
        return true;
    } else {
        return false;
    }
}
</script>


@endSection