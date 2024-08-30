"use strict";

$(document).ready(function () {
    var dateFormat = "d/m/y";

    flatpickr("#trade_lic_issue_date", {
        dateFormat: dateFormat,
        onChange: function (selectedDates, dateStr, instance) {
            $("#trade_lic_expire_date").flatpickr({
                dateFormat: dateFormat,
                onReady: function () {
                    this.jumpToDate(selectedDates[0]);
                },
                disable: [
                    {
                        from: "1970-01-01",
                        to: selectedDates[0],
                    },
                ],
            });
        },
    });

    flatpickr("#immigra_card_issue_date", {
        dateFormat: dateFormat,
        onChange: function (selectedDates, dateStr, instance) {
            $("#immigra_card_expiry_date").flatpickr({
                dateFormat: dateFormat,
                onReady: function () {
                    this.jumpToDate(selectedDates[0]);
                },
                disable: [
                    {
                        from: "1970-01-01",
                        to: selectedDates[0],
                    },
                ],
            });
        },
    })

    flatpickr("#dubai_chamber_expire_date", {
        dateFormat: dateFormat,
    });

    flatpickr("#moe_end_date", {
        dateFormat: dateFormat,
    });

    flatpickr("#contract_start_date", {
        dateFormat: dateFormat,
        onChange: function (selectedDates, dateStr, instance) {
            $("#contract_end_date").flatpickr({
                dateFormat: dateFormat,
                onReady: function () {
                    this.jumpToDate(selectedDates[0]);
                },
                disable: [
                    {
                        from: "1970-01-01",
                        to: selectedDates[0],
                    },
                ],
            });
        },
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

var KTAppEcommerceSaveCategory = (function () {
    return {
        init: function () {
            (() => {
                let e;
                const t = document.getElementById("fileupload"),
                    o = document.getElementById("submit");
                (e = FormValidation.formValidation(t, {
                    fields: rules(),
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: "",
                        }),
                    },
                })),
                    o.addEventListener("click", (a) => {
                        a.preventDefault(),
                            e &&
                                e.validate().then(function (e) {
                                    console.log(e);
                                    if ("Valid" !== e && !validate()) {
                                        return;
                                    }

                                    o.setAttribute("data-kt-indicator", "on")

                                    var data = new FormData($("form#fileupload")[0]);

                                    $.ajax({
                                        url: $("form").attr("action"),
                                        type: "POST",
                                        data: data,
                                        cache: false,
                                        processData: false,
                                        contentType: false,
                                        context: this,
                                        success: function (result) {

                                            o.removeAttribute("data-kt-indicator")

                                            var result = JSON.parse(result);
                                            if (result.status) {
                                                toastr.success(result.message);

                                                setTimeout(function () {
                                                    window.location.href = result.url;
                                                }, 2000);
                                            } else {
                                                toastr.error(result.message);
                                                //window.location.href =result.url;
                                            }
                                        },
                                    });
                                });
                    });
            })();
        },
    };
})();

/**
 *
 * @returns Object
 */
function rules() {
    return {
        name: {
            validators: {
                notEmpty: {
                    message: "Company name is required",
                },
            },
        },
        trade_license_no: {
            validators: {
                notEmpty: {
                    message: "Trade License Number is required",
                },
            },
        },
        trade_license_issue_date: {
            validators: {
                notEmpty: {
                    message: "Trade License Issue Date is required",
                },
            },
        },
        trade_license_expiry_date: {
            validators: {
                notEmpty: {
                    message: "Trade License Expiry Date is required",
                },
            },
        },
        immigration_card_no: {
            validators: {
                notEmpty: {
                    message: "Immigration Card No is required",
                },
            },
        },
        immigration_card_issue_date: {
            validators: {
                notEmpty: {
                    message: "Immigration Card Issue Date is required",
                },
            },
        },
        immigration_card_expiry_date: {
            validators: {
                notEmpty: {
                    message: "Immigration Card Expiry Date is required",
                },
            },
        },
        estblishment_card_no: {
            validators: {
                notEmpty: {
                    message: "Establishment Card No is required",
                },
            },
        },
        dubai_chember_no: {
            validators: {
                notEmpty: {
                    message: "Dubai Chamber No is required",
                },
            },
        },
        dubai_chember_expiry_date: {
            validators: {
                notEmpty: {
                    message: "Dubai Chamber Expiry Date is required",
                },
            },
        },
        contract_start_date: {
            validators: {
                notEmpty: {
                    message: "Contract Start Date is required",
                },
            },
        },
        contract_end_date: {
            validators: {
                notEmpty: {
                    message: "Contract End Date is required",
                },
            },
        },
        moe_certificate: {
            validators: {
                notEmpty: {
                    message: "MOE Certificate is required",
                },
            },
        },
        moe_end_date: {
            validators: {
                notEmpty: {
                    message: "MOE End Date is required",
                },
            },
        },
        responsible_person: {
            validators: {
                notEmpty: {
                    message: "Responsible Person is required",
                },
            },
        },
        cc_emails: {
            validators: {
                notEmpty: {
                    message: "CC-Email is required",
                },
            },
        },
    };
}

/**
 *
 * @returns bool
 */
function validate() {
    var flag = true;
    var inputs = $("form input, form select , form textarea");

    var i = 0;
    inputs.each(function (index) {
        var input = $(this);
        //console.log(input[0].type.required);
        if (
            (!input.val() && input[0].required && input[0].type != "hidden") ||
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

    return flag;
}

$('#files').change(function(){
    var numFiles = $(this, this)[0].files.length;
    if (!numFiles) {
        $("#count_image").html("Add Files");
        return;
    }
    $("#count_image").html(numFiles + " File Selected");
});

KTUtil.onDOMContentLoaded(function () {
    KTAppEcommerceSaveCategory.init();
});
