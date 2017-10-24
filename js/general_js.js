
  $(document).ready(function(){
    $(".share_note").click(function(){
      if($("#popup").css("display") == "none"){
          $("#popup").slideToggle();
        } else {
          $("#popup").slideToggle();
        }
    });
  });


  $(document).ready(function(){
    $(".info_note").click(function(){
      if($("#sharedwith").css("display") == "none"){
        $("#sharedwith").slideToggle();
      } else {
        $("#sharedwith").slideToggle();
      }
    });
  });
