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
    $(this).siblings(".task-text").css("color", "gray");
});
//validation - 20 hours max
$("input.enter-hours-input").on('change keyup', function(){
    let hours = $(this).val();
    //innocent until proven guilty
    $(this).removeClass('is-invalid');
    $(this).siblings('div.invalid-feedback').hide();
    if(hours <= 0 || hours > 20) {
        $(this).addClass('is-invalid');
        $(this).siblings('div.invalid-feedback').show();
    }
});
//add task
$("form.add-task").submit(function(event) {
    event.preventDefault();

    let form = $(this);
    let form_data = {};
    form.serializeArray().forEach(function(obj, index){
        form_data[obj.name] = obj.value;
    });

    $.ajax({
        method: "POST",
        url: "/addTask",
        data: form_data,
        complete: function (jqXHR, statusText) {
            if (jqXHR.statusText === "success" && jqXHR.status == 200) {
                //clear form
                form[0].reset();
                //update view
                $.ajax({
                    method: "GET",
                    url: "/tasks/",
                    data: null,
                    complete: function(jqXHR, statusText) {
                        if (jqXHR.statusText === "success" && jqXHR.status == 200) {
                            $("div#tasks").html(jqXHR.responseText);
                        }
                    }
                });
            }
        }
    });
});