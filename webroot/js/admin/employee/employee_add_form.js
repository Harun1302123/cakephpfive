$(document).ready(function () {
    var dateFormat = "d/m/y";

    flatpickr(".date_expiry", {
        dateFormat: dateFormat,
    });

    $("input.file").change(function () {
        var numFiles = $(this, this)[0].files.length;
        $(this)
            .parent()
            .siblings("span.count_image")
            .html(numFiles + " File Selected");
    });

    $(".other_doc").change(function () {
        if (this.checked) {
            var name = $(this).attr("name");
            name = name.replace("_admin", "");

            $(this)
                .parent()
                .parent("td")
                .append(
                    '<div style="margin-top: 5px;" class="other-doc-parent form_block"><input  name="' +
                        name +
                        '_value" type="text"  class="form-control mb2 input_field" style="width: 90%" required /></div>'
                );
        } else {
            $(this).parent().parent().children(".other-doc-parent").remove();
        }
    });

    $(".person_documents input").change(function () {
        if (this.checked) {
            $(this)
                .parent()
                .append(
                    '<span class="documents_date">' +
                        formatDate(new Date()) +
                        "</span>"
                );
            date = new Date();
            $('input[name="' + $(this).attr("name") + '_date"]').val(
                date.getFullYear() +
                    "-" +
                    (date.getMonth() + 1) +
                    "-" +
                    date.getDate()
            ); //$(this).attr('name')
        } else {
            $(this).parent().children(".documents_date").remove();
        }
    });

    function formatDate(date) {
        var monthNames = [
            "Jan",
            "Feb",
            "March",
            "April",
            "May",
            "June",
            "July",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
        ];

        var day = date.getDate();
        var monthIndex = date.getMonth();
        var year = date.getFullYear();
        return day + " " + monthNames[monthIndex] + " " + year;
    }

    var inputs = $("form input, form select , form textarea");

    $("#submit").click(function (event) {
        var i = 0;
        var flag = true;
        event.preventDefault();
        inputs.each(function (index) {
            var input = $(this);
            //console.log(input[0].type.required);
            if (
                (!input.val() &&
                    input[0].required &&
                    input[0].type != "hidden") ||
                (input[0].type === "radio" && !input[0].type.is(":checked"))
            ) {
                $(this).css("border", "1px solid red");
                //console.log(input[0]);
                if (i == 0) {
                    flag = false;
                    window.scrollTo("#" + $(this).attr("id"), 200);
                }
                i++;
                //validForm = false;
            } else {
                $(this).css("border", "1px solid rgba(0,0,0,.15)");
            }
        });

        if (flag) {
            var data = new FormData($("form#fileupload")[0]);
            console.log($(this).html());
            $(this)
                .children("i")
                .removeClass("fa-floppy-o")
                .addClass("fa-spinner fa-spin");
            $.ajax({
                url: $("form").attr("action"),
                type: "POST",
                data: data,
                cache: false,
                processData: false,
                contentType: false,
                context: this,
                success: function (result) {
                    $(this)
                        .children("i")
                        .addClass("fa-floppy-o")
                        .removeClass("fa-spinner fa-spin");
                    var result = JSON.parse(result);
                    if (result.status) {
                        toastr.success(result.message);

                        // $.notify(result.message, "success");
                        setTimeout(function () {
                            window.location.href = result.url;
                        }, 2000);
                    } else {
                        toastr.error(result.message);

                        // $.notify(result.message, "error");
                        //window.location.href =result.url;
                    }
                },
            });
        }
    });

    jQuery.fn.scrollTo = function (elem, speed) {
        $(this).animate(
            {
                scrollTop:
                    $(this).scrollTop() -
                    $(this).offset().top +
                    $(elem).offset().top,
            },
            speed == undefined ? 1000 : speed
        );
        return this;
    };
});
