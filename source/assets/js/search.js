$(function(){
    var url = "/api/search/";
    $("[type=search]").on('keyup', function(){
        $("#search-result").html("");
        
        if($(this).val().length > 2){
           $.get({
                url : url+$(this).val(),
                success : function(data){
                    $("#search-result").html(data);
                    $(".search-result").show();
                },
            }); 
        } else {
            $(".search-result").hide();
        }
    });
});