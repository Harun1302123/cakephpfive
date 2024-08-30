"use strict";
var KTSigninGeneral = (function () {
    var e, t, i, path = base_url + '/Users/login';
    let currentUrl = window.location.href;
    if (currentUrl.includes('client')) {
        path = base_url + '/client/users/login';
    }

    return {
        init: function () {
            (e = document.querySelector("#kt_sign_in_form")),
                (t = document.querySelector("#kt_sign_in_submit")),
                (i = FormValidation.formValidation(e, {
                    fields: {
                        Username: { validators: { notEmpty: { message: "Username is required" } } },
                        Password: { validators: { notEmpty: { message: "The password is required" } } },
                    },
                    plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
                })),
                t.addEventListener("click", function (n) {
                    n.preventDefault(),
                        i.validate().then(function (i) {

                            if ("Valid" !== i) {
                                return;
                            }

                            t.setAttribute("data-kt-indicator", "on"),
                            (t.disabled = !0),
                                $.ajax({
                                    url: path,
                                    type: 'post',
                                    dataType: 'json',
                                    data: $('form#kt_sign_in_form').serialize(),
                                    success: function(data) {
                                        t.setAttribute("data-kt-indicator", "off")
                                        if (data && data.redirectUrl) {
                                            return window.location.href = base_url + data.redirectUrl;
                                        }
                                        window.location.href = base_url + '/admin/Users/dashboard';
                                    },
                                    error: function(xhr, status, error) {
                                        t.setAttribute("data-kt-indicator", "off")
                                        $('#kt_sign_in_submit').attr('disabled', false);
                                        Swal.fire({
                                            text: "Sorry, looks like there are some errors detected, please try again.",
                                            icon: "error",
                                            buttonsStyling: !1,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: { confirmButton: "btn btn-primary" },
                                        });
                                    }
                                })

                        });
                });
        },
    };
})();
KTUtil.onDOMContentLoaded(function () {
    KTSigninGeneral.init();
});
