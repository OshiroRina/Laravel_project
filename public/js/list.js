//===========一覧ページネーションの非同期====================//

$(function(){
    $(document).on('click','.pagination a',function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        ajaxList(page);

    });

    function ajaxList(page)
    {
        $.ajax({
            url:"/product/ajaxList?page=" + page,
        }).done(function (data) {
            $('.products-table').html(data);
            
        }).fail(function(jqXHR, textStatus, errorThrown) {
            alert('ファイルの取得に失敗しました。');
            console.log("ajax通信に失敗しました");
            console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
            console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
            console.log("errorThrown    : " + errorThrown.message); // 例外情報
        });
    }
});

//===========検索の非同期処理====================//

$(function () {
    $('#search_button').on('click', function () {
        var product_name = $('#product_name').val();
        var company_id = $('#company_id').val();
        var min_price = $('#min_price').val();
        var max_price = $('#max_price').val();
        var min_stock = $('#min_stock').val();
        var max_stock = $('#max_stock').val();
                      
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/product/search',
            type:'get',
            dataType:'text',
            data: {
                   'product_name':product_name,
                   'company_id':company_id,
                   'min_price':min_price,
                   'max_price':max_price,
                   'min_stock':min_stock,
                   'max_stock':max_stock,
                },
            }).done(function (data) {
             console.log(data);
            $('.products-table').html(data);

        }).fail(function(jqXHR, textStatus, errorThrown) {
            alert('ファイルの取得に失敗しました。');
            console.log("ajax通信に失敗しました");
            console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
            console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
            console.log("errorThrown    : " + errorThrown.message); // 例外情報
        });
     });
});

//===========削除の非同期処理====================//

// function exeDelete(id){

//     if(confirm("削除してよろしいですか？")){

//         $.ajax({
//                 url:'/product/delete' + id,
//                 type:'DELETE',
//                 data: {
//                     _token : $("input[name=_token]").val()
//                 },
//                 dataType:'text',
//              }).done(function(){
//                 $("#product_id" + id).remove();
//             }).fail(function(jqXHR, textStatus, errorThrown) {
//                 alert('ファイルの取得に失敗しました。');
//                 console.log("ajax通信に失敗しました");
//                 console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
//                 console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
//                 console.log("errorThrown    : " + errorThrown.message); // 例外情報
//             });  
//     }
// }


 function checkDelete() {
   if (window.confirm('削除してよろしいですか？')) {
        return true;
    } else {
        return false;
    }
};
 
 $(function(){
     $(document).on('click','.deleteProduct',function(){
       var deleteConfirm = checkDelete();
       
        if(deleteConfirm == true) {
            var click = $(this);
            var id = $(this).attr('data-id');
             
         $.ajax({
             headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/product/delete' + id,
            data: {'id':id, '_method':'DELETE'},
         }).done(function(){
            click.parents(tr).remove();
        
        }).fail(function(jqXHR, textStatus, errorThrown) {
        alert('ファイルの取得に失敗しました。');
        console.log("ajax通信に失敗しました");
        console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
        console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
        console.log("errorThrown    : " + errorThrown.message); // 例外情報
        
       });
    };
 });
});
