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

$(document).ready(function(){
  switch(window.location.hash){
      case "vs":  $(".popup").addClass("class1"); break;
      case "bod":  $(".popup").addClass("class2"); break;
      case "ptf":  $(".popup").addClass("class3"); break;
  }
});
