@extends('layouts.app')
@section('title','商品一覧')

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/list.js') }}"></script>
    
</head>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">

            <h2>商品情報一覧</h2>
            <form class="form-inline mt-5 mb-3 bg-white p-3 border" action="{{ url('/product/search') }}" method="post">
                {{ csrf_field()}}
                {{method_field('post')}}

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
            <p class="text-right"><a href="{{ route('showList') }}">←商品一覧へ戻る</a></p>
            <div class="table-responsive-sm">
                <table class="table table-striped">
                  <thead>
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
                </thead>
                    
                        @foreach($products as $product)
                    <tbody id ="read">
                        <tr>
                            <td>{{ $product -> id }}</td>
                            <td>
                                @if (isset($product['image']))
                                <img src="{{asset('storage/'. $product['image'])}}" width="100px" height="100px"
                                    alt="画像">
                                @endif
                            </td>
                            <td>{{ $product -> product_name }}</td>
                            <td>{{ $product -> price }}円</td>
                            <td>{{ $product -> stock }}</td>
                            <td>{{ $product -> company -> company_name }}</td>

                            <td><a href="/product/{{ $product->id }}" class="btn btn-primary">{{ __('詳細') }} </a></td>
                            <form method="post" action="{{ route('delete', $product->id) }}"
                                onSubmit="return checkDelete()">
                                @csrf
                                <td><button type="submit" class="btn btn-danger" onclick=> {{ __('削除') }} </button></td>
                            </form>
                        </tr>
                    </tbody>
                        @endforeach
                    
                </table>

            </div>
        </div>
    </div>
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

