$("span.task-deselected").click(function (){
    $(this).attr("hidden", true);
    $(this).siblings(".task-selected").removeAttr("hidden");
});
$("span.task-selected").click(function (){
    $(this).attr("hidden", true);
    $(this).siblings(".task-deselected").removeAttr("hidden");
});