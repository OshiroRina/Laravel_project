
// $(function(){
//     $('#search_button').on('click',function(){
//  $.ajax({
//      url:'/product/search',
//      type:'GET',
//      dataType:'json',
     
//  }).done(function(){
//      alert('ajax成功');
//  }).fail(function(json){
//      alert('ajax失敗');
//  });


// });
// });

//===========検索の非同期処理====================//


$(document).ready(function() {
    readData();

    $("#search_button").on('click',function(){
        var data = $('#company').val();

        if(data != ""){
          $("#read").html(data);
        
       $.ajax({
         
           url:"{{ route('search') }}",
           type:'GET',
           data:{query: data},
         }).done(function(data){
             $("#read").html(data);
           });
    }else{
       readData();
    }
});

});

       function readData() {
           $.get("{{ url('read') }}",{},
           
           function(data,status) {
               $("#read").html(data);
           });
       }

 //===========削除の非同期処理====================//
