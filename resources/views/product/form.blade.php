@extends('layouts.app')
@section('title','商品登録')

@section('content')

<body>
 <div class="row justify-content-center">
　<div class="col-md-8 col-md-offset-2">
  <h2>商品新規登録画面</h2>
       
   <br>
  <div class="border col-8">
    <form method="post" action="{{ route('store') }}" enctype="multipart/form-data">
       @csrf
        <div class="form-group">
          <br>
            <h3>商品登録フォーム</h3>
              <br>
              <label for="product_name">商品名</label>
               <input type="text" id="product_name" name="product_name" class="form-control" value="{{ old('product_name') }}" >
                    @if ($errors->has('product_name'))
                            <div class="text-danger">
                                {{ $errors->first('product_name') }}
                            </div>
                    @endif
        </div>
         <div class="form-group">
         
            <label for="company_name">メーカー名</label>
                <select type="text" id="company_name" name="company_name" class="form-control" >
                
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company-> company_name }}</option>
                    @endforeach
                </select>
       
                @if ($errors->has('company_name'))
                        <div class="text-danger">
                            {{ $errors->first('company_name') }}
                        </div>
                @endif
         </div>
         
         <div class="form-group">
            <label for="price">価格</label>
                <input type="number" id="price" name="price" type="text" class="form-control" value="{{ old('price') }}" >
                    @if ($errors->has('price'))
                            <div class="text-danger">
                                {{ $errors->first('price') }}
                            </div>
                    @endif
         </div>
         
         <div class="form-group">
            <label for="stock">在庫数</label>
                <input type="number" id="stock" name="stock" type="text" class="form-control" value="{{ old('stock') }}" > 
                    @if ($errors->has('stock'))
                            <div class="text-danger">
                                {{ $errors->first('stock') }}
                            </div>
                    @endif
         </div>
         
         <div class="form-group">
            <label for="comment">コメント</label>
            <textarea type="text" name="comment" id="comment" cols="30" rows="8" class="form-control" value="{{ old('comment') }}"></textarea>
                
         </div>
        
         <div class="form-group">
            <label for="inputFile">商品画像</label>
             <div class="custom-file">
                <input id="image" name="image" type="file" class="custom-file-input">
                <label class="custom-file-label" for="inputFile" data-browse="参照">画像ファイルを選択</label>
            </div>
         </div>
         
         <div class="mt-5">
            <button type="submit" class="btn btn-primary">登録する</button>
            <a class="btn btn-secondary" href="{{ route('showList') }}">戻る</a>
        </div>
        <br>
    </form>

  </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script>
  bsCustomFileInput.init();
</script>

</body>

@endSection
