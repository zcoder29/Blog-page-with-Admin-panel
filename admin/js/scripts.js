
    
    var div_box = "<div id='load-screen'><div id ='loading'></div></div>";
    $("body").prepend(div_box);
    $('#load-screen').delay(700).fadeOut(600, function(){
        
        $(this).remove();
    });
    
    
    


// ck Editor
ClassicEditor
    .create( document.querySelector( '#body' ) )
    .catch( error => {
        console.error(error);
});


// Select All Check Boxes
$(document).ready(function(){
    
    $('#selectAllBoxes').click(function(event){
        
        if(this.checked){
            
            $('.checkBoxes').each(function(){
            
            this.checked = true;
                
            });
        } else{
            
            $('.checkBoxes').each(function(){
            
            this.checked = false;
                
            });
        }
    });

});
 
function LoadUsersOnline() {
    
    $.get("functions.php?onlineusers=result", function(data){
        
        $(".usersonline").text(data);
    
    });
    
}
 
setInterval(function(){
    
    LoadUsersOnline(); 
    
},500);    
   
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    



