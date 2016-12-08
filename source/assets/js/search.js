$(function(){
   
    var url = "/api/search/";
    $("[type=search]").on('keyup', function(){
        console.info('typing..');
        $("#search-result").html("");
        if($(this).val().length > 2){
            
           $.get({
                url : url+$(this).val(),
                success : function(data){
                    console.log(data);
                    $("#search-result").html(data);
                },
            }); 
        }
    });
});