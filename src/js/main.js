$(document).ready(function () {
    var request;
    $('.admin__logout').on('click', function (event) {
        event.preventDefault();
        if (request) {
            request.abort();
        }
        request = $.ajax({
            url: "logout/logout.php",
            type: "post"
        });
        request.done(function (response, textStatus, jqXHR) {
            if (response == 1) {
                window.location.href = "login/?status=logout";
            }
        });
        request.fail(function (jqXHR, textStatus, errorThrown) {

        });
    });
});
$(".select_user_registry").change(function () {
    if ($(".select_user_registry").val() == "ucitel") {
        $(".teacher_password").css("display", "flex");
        $(".groupidcontainer").css("display", "none");
    } else {
        $(".teacher_password").css("display", "none");
        $(".groupidcontainer").css("display", "flex");
    }
}).trigger("change");

function getAdressPart(str) {
    return str.split('@')[1];
}

function getTeacher() {
    if ($(".select_user_registry").val() == "ucitel") {
        return true;
    }
}