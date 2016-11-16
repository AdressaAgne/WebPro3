// @codekit-prepend "prototype.js"

var info = 0;
function upload(files){
    ajax('recipie/uploadimage', {file : files[0]}, function(data){
        data = JSON.parse(data);
        window.console.log(data);
        
        if(isset(data.error)){
            elm('.error').innerHTML = '<h2>'+data.error+'</h2>';
        } else {
            
            elm('#fileText').value = data.id;
            elm('#drop-container').style.backgroundImage = "url('"+data.path+"')";
        
        }
    }, function(e){
        // Loading % text
        var p = Math.floor( (e.loaded / e.total) * 100 );
        if(info === 0){
            info++;
            elm('.info-text').textContent = "Uploading";
        }
        if(p >= 100){
            elm('.info-text').textContent = "Processing";
            document.getElementById("svg").setAttribute("class", "pie-chart processing");
        }
        elm('[data-percent]').setAttribute("data-percent", p);
        elm('tspan').textContent = p+"%";
    });
    
}

elm("#drop-container").onDrop(function(files){
    upload(files);
}).onDragOver(function(){
    this.className = "drop active";
    
}).onDragLeave(function(){
    this.className = "drop";
    
});

elm("#file").addEventListener('change', function(){
   upload(this.files);
});