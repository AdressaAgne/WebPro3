$(function(){
   
    var url = "/api/search/";
    $("[type=search]").on('keyup', function(){
        console.info('typing..');
        $("#search-result").html("");
        if($(this).val().length > 2){
            
           $.get({
                url : url+$(this).val(),
                dataType : 'json',
                success : function(data){
                    console.log(data);
                    
                    
                    for(var i = 0; i < data.length; i++){
                        $("#search-result").append("<li><a href='/taxon/item/"+data[i].taxonId+"'>"+data[i].navn+"</a></li>");
                    }

                },
            }); 
        }
    });
});