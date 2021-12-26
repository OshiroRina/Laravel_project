@extends('layouts.app')
@section('title','商品一覧')

<head>
    <meta name="token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/list.js') }}"></script>

</head>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2>商品情報一覧</h2>

            <form class="form-inline mt-5 mb-3 bg-white p-3 border" action="{{ url('/product') }}" method="post">
                {{ csrf_field()}}
                {{method_field('post')}}

                <div class="form-group col-md-4 col-sm-5">
                    <label for="product_name">商品名:</label>
                    <input type="text" class="form-control ml-2" id="search_name" name="product_name"
                        placeholder="商品名を入力">
                </div>
                <div class="form-group col-md-4 col-sm-5">
                    <label for="company_id">メーカー名:</label>
                    <select type="text" class="form-control ml-2" id="search_name" name="company_id">
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
        <table class="table table-striped data-table">
            <thead>
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
            </thead>

            <tbody id="read">
                @foreach($products as $product)
                <tr>
                    <td></td>
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
                    <td>
                        <form method="POST" action="{{ route('delete', $product->id) }}" name="delete_form"
                            onSubmit="return checkDelete()">
                            @csrf

                            <button type="submit" name="delete_form" class="btn btn-danger delete_form"
                                id="deleteProduct" onclick=> {{ __('削除') }} </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>


        </table>
    </div>
    {{ $products->appends(request()->query())->links() }}
</div>

@endSection

<script>
function checkDelete() {

    if (window.confirm('削除してよろしいですか？')) {
        return true;
    } else {
        return false;
    }
}
</script>