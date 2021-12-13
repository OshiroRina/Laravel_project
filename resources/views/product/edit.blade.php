@extends('layouts.app')
@section('title','商品編集')
@section('content')

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-md-offset-2">
                <h2>商品編集画面</h2>
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <br>
                <div class="border col-8">
                    <form method="post" action="{{ route('update',$product->id) }}" onSubmit="return checkSubmit()"
                        enctype="multipart/form-data">

                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="form-group">
                            <br>
                            <h3>商品編集フォーム</h3>
                            <br>
                            <label for="product_name">商品名</label>
                            <input type="text" id="product_name" name="product_name" class="form-control"
                                value="{{ old('product_name', $product->product_name) }}">
                            @if ($errors->has('product_name'))
                            <div class="text-danger">
                                {{ $errors->first('product_name') }}
                            </div>
                            @endif
                        </div>
                        <div class="form-group">

                            <label for="company_name">メーカー名</label>
                            <select type="text" id="company_name" name="company_name" class="form-control"
                                value="{{ old('company_id') ?: $product->company_id}}">

                                @foreach($companies as $company)
                                <option value="{{ $company->id }}" @if($company->id == $product->company_id) selected
                                    @endif> {{ $company -> company_name }} </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="price">価格</label>
                            <input type="number" id="price" name="price" type="text" class="form-control"
                                value="{{ old('price', $product->price) }}">
                            @if ($errors->has('price'))
                            <div class="text-danger">
                                {{ $errors->first('price') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="stock">在庫数</label>
                            <input type="number" id="stock" name="stock" type="text" class="form-control"
                                value="{{ old('stock',$product->stock) }}">
                            @if ($errors->has('stock'))
                            <div class="text-danger">
                                {{ $errors->first('stock') }}
                            </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="comment">コメント</label>
                            <textarea type="text" name="comment" id="comment" cols="30" rows="8"
                                class="form-control">{{ old('comment',$product->comment) }}</textarea>

                        </div>

                        <div class="form-group">
                            <label for="inputFile">商品画像</label>
                            <div class="custom-file">
                                <input id="image" name="image" type="file" class="custom-file-input">
                                <label class="custom-file-label" for="inputFile"
                                    data-browse="参照">{{ old('image',$product->image) }}</label>
                            </div>
                        </div>

                        <div class="mt-5">
                            <button type="submit" class="btn btn-primary">更新する</button>
                            <a class="btn btn-secondary" href="{{ route('detail', $product->id ) }}">戻る</a>
                        </div>
                        <br>
                    </form>

                </div>
            </div>
        </div>

        <script>
        function checkSubmit() {
            if (window.confirm('更新してよろしいですか？')) {
                return true;
            } else {
                return false;
            }
        }
        </script>
         <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
        <script>
        bsCustomFileInput.init();
        </script>

</body>

@endSection