

//===========検索の非同期処理====================//

$(function () {
    $('#search_button').on('click', function () {
        let keyword = $('input[id="#search_name"]').val();

        $.ajaxSetup({
            headers: {
                 'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
             }
        });

        $.ajax({
            url: '/product/search' + keyword,
            type: 'post',
            async: true,
            dataType:'text',
            data: {'keyword': keyword},
            
         }).done(function (data) {
             console.log("ajax成功");
            // $('#read').html(data);
        }).fail(function(jqXHR, textStatus, errorThrown) {
            alert('ファイルの取得に失敗しました。');
            console.log("ajax通信に失敗しました");
            console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
            console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
            console.log("errorThrown    : " + errorThrown.message); // 例外情報
            console.log("URL            : " + url);
        });


    });
});

 //===========削除の非同期処理====================//
 
 $(function(){
     $('#deleteProduct').on('click',function(){
       var deleteConfirm = confirm('削除してよろしいでしょうか？');
       
        if(deleteConfirm == true) {
           var clickEle = $(this);
           var productID = clickEle.attr('product_id');
        };
           $.ajaxSetup({
               headers: {
                    'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                }
           });

        $.ajax({
            type:'POST',
            url:'/product/delete/{id}' + productID,
            data: {'id':productID},
            dataType: 'text',

        }).done(function (data) {
           clickEle.parents('tr').remove();
       }).fail(function() {
           alert('エラー');
       });
     
    });
});
