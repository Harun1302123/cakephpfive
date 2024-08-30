$(document).ready(function () {
    $(document).on("click", ".attach_for_upload_modal", function () {
        var company_id = $(this).attr("data-attach-modal");
        $(".company-id").val(company_id);
        $("#upload-model").modal("show");
    });

    var uploadFileModal = (function () {
        return {
            init: function () {
                (() => {
                    let e;
                    const t = document.getElementById("attac_upload"),
                        o = document.getElementById("modal-submit");
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
                    o && o.addEventListener("click", (a) => {
                            a.preventDefault(),
                                e &&
                                    e.validate().then(function (e) {
                                        console.log(e);
                                        if ("Valid" !== e && !validate()) {
                                            return;
                                        }

                                        o.setAttribute(
                                            "data-kt-indicator",
                                            "on"
                                        );

                                        var data = new FormData(
                                            $("form#attac_upload")[0]
                                        );

                                        $.ajax({
                                            url: $("form#attac_upload").attr("action"),
                                            type: "POST",
                                            data: data,
                                            cache: false,
                                            processData: false,
                                            contentType: false,
                                            context: this,
                                            success: function () {
                                                o.removeAttribute(
                                                    "data-kt-indicator"
                                                );
                                                toastr.success("file saved successfully.");
                                            },
                                            error: function() {
                                                o.removeAttribute(
                                                    "data-kt-indicator"
                                                );

                                                toastr.error("some error occured, try again.");
                                            }
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
            "attachment-title": {
                validators: {
                    notEmpty: {
                        message: "Title is required",
                    },
                },
            },
            "attachment-file": {
                validators: {
                    notEmpty: {
                        message: "File is required",
                    },
                },
            },
        };
    }

    KTUtil.onDOMContentLoaded(function () {
        uploadFileModal.init();
    });
});
