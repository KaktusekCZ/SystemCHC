$(document).ready(function() {
    var request;
    $('.admin__logout').on('click', function(event) {
        event.preventDefault();
        if (request) {
            request.abort();
        }
        request = $.ajax({
            url: "logout/logout.php",
            type: "post"
        });
        request.done(function(response, textStatus, jqXHR) {
            if (response == 1) {
                window.location.href = "login/?status=logout";
            }
        });
        request.fail(function(jqXHR, textStatus, errorThrown) {

        });
    });
    $(".select_user_registry").change(function() {
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

    function userlength() {
        if ($("input[name=username]").val().length > 16) {
            return true
        }
    }

    function getTeacher() {
        if ($(".select_user_registry").val() == "ucitel") {
            return true;
        }
    }

    function alertTimeout(el, time) {
        clearTimeout(alert);
        alert = setTimeout(function() {
            $('.' + el).removeClass('is-visible').addClass('is-hidden');
        }, time);
    }

    alertTimeout('alert__topbar', 3000);

    var request;
    $(".js-admin-logout").on('click', function(event) {
        event.preventDefault();
        if (request) {
            request.abort();
        }
        request = $.ajax({
            url: "../actions/logout.php",
            type: "post",
        });
        request.done(function(response) {
            if (response == 1) {
                window.location.href = "../login/?status=logout";
            } else {
                alert('chyba');
            }
        });
    });
    $(".js-admin-vote").on("click", function(event) {
        event.preventDefault();
        if (request) {
            request.abort();
        }
        var id = $(this).closest('.admin__votes__item').attr('data-eventid');
        request = $.ajax({
            url: "../actions/vote.php",
            type: "post",
            data: {
                "id": id
            }
        });
        request.done(function(response) {
            $("#modal-space").html(response);
            $(".vote-modal").modal("show");
        });
        request.fail(function(jqXHR, textStatus, errorThrown) {
            alert("Chyba. Prosím, kontaktujte správce.")
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        });
    });
    $(document).on('submit', 'form#vote-form', function() {
        event.preventDefault();
        if (request) {
            request.abort();
        }
        var time = $.now() / 1000;
        var dataForm = getFormData($(this));
        var eventID = $(this).closest('.modal').attr('data-eventid');
        console.log(dataForm);
        request = $.ajax({
            url: "../actions/sendVote.php",
            type: "post",
            data: {
                "form": dataForm,
                "time": time,
                "eventid": eventID
            }
        });
        request.done(function(response) {
            if (response == 1) {
                $(".vote-modal").find(".alert").removeClass("is-visible").addClass("is-hidden");
                $(".vote-modal").modal("hide");
                $(".alert__topbar").html('Hodnocení úspěšně odesláno. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fas fa-times"></i></button>').removeClass("is-hidden").addClass("is-visible");
                alertTimeout('alert__topbar', 3000);
            } else {
                $(".vote-modal").find(".alert").removeClass("is-hidden").addClass("is-visible");
                console.log(response);
            }
        });
        request.fail(function(jqXHR, textStatus, errorThrown) {
            alert("Chyba. Prosím, kontaktujte správce.")
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        });
    });

    function getFormData($form) {
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};
        $.map(unindexed_array, function(n, i) {
            indexed_array[n['name']] = n['value'];
        });
        return indexed_array;
    }
});
