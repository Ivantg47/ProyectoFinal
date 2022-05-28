$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});
/*
$(document).ready(function(){
   var i = 1;
   $('#mas').click(function(){
      i++;
      $('#campo_dinamico').append('<tr id="row'+i+'"><td><input type="text" name="tituloCancion[]" id="tituloCancion" placeholder="titulo de cancion"></td><td><input type="text" name="compositor[]" id="compositor" placeholder="compositor"></td><td><button name="menos" id="'+i+'" class="btn_remove">-</button></td></tr>')
   });
   $(document).on('click', '.btn_remove', function(){
      var button_id = $(this).attr("id");
      $('#row'+button_id+'').remove();
   });
});
*/
$(document).ready(function(){
    //group add limit
    var maxGroup = 10;
    
    //add more fields group
    $(".addMore").click(function(){
        if($('body').find('.fieldGroup').length < maxGroup){
            var fieldHTML = '<div class="form-group fieldGroup">'+$(".fieldGroupCopy").html()+'</div>';
            $('body').find('.fieldGroup:last').after(fieldHTML);
        }else{
            alert('Maximum '+maxGroup+' groups are allowed.');
        }
    });
    
    //remove fields group
    $("body").on("click",".remove",function(){ 
        $(this).parents(".fieldGroup").remove();
    });
});