//switch on click task icon
$("span.task-deselected").click(function (){
    //icons
    $(this).attr("hidden", true);
    $(this).siblings(".task-selected").removeAttr("hidden");
    //font
    $(this).siblings(".task-text").css("font-weight", 700);
    $(this).siblings(".task-text").css("color", $("span.task-hours").css('color'));
});
$("span.task-selected").click(function (){
    //switch icons
    $(this).attr("hidden", true);
    $(this).siblings(".task-deselected").removeAttr("hidden");
    //font
    $(this).siblings(".task-text").css("font-weight", 400);
    $(this).siblings(".task-text").css("color", "lightgray");
});