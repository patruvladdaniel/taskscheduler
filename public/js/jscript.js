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
//validation - 20 hours max
$("input.enter-hours-input").keyup(function(){
    let hours = $(this).val();
    //innocent until proven guilty
    $(this).removeClass('is-invalid');
    $(this).siblings('div.invalid-feedback').hide();
    if(hours <= 0 || hours > 20) {
        $(this).addClass('is-invalid');
        $(this).siblings('div.invalid-feedback').show();
    }
});