<table class="table table-striped">
    <thead>
        <tr>
            <th>@sortablelink('id','↑↓商品番号')</th>
            <th>@sortablelink('image','商品画像')</th>
            <th>@sortablelink('product_name','商品名')</th>
            <th>@sortablelink('price','価格')</th>
            <th>@sortablelink('stock','在庫数')</th>
            <th>@sortablelink('company_name','メーカー名')</th>

            <th><a href="{{ route('create') }}"><button type="button" class="btn btn-outline-primary">+新規登録</button></a></th>
            <th><a href="{{ route('exportCSV') }}"><button type="button" class="btn  btn-success">CSV出力</button></a></th>
            
           

        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr id="product_id{{ $product->id }}">
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
                <!-- <a href="javascript:void(0)" onclick="destroy({{ $product->id }})" class="btn btn-danger">{{ __('削除') }}</a> -->
                <form method="post" action="{{ route('destroy', $product->id) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger deleteProduct" data-id="{{ $product->id }}" >{{ __('削除') }}</button>
               </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $products->appends(request()->query())->links() }}
