$(document).on("click", ".delete_row", function () {
    const tr = $(this).closest("tr");
    const td = tr[0].querySelectorAll("td");
    const r = td[0].innerText;
    const subUrl = $(this).attr("sub-url");

    Swal.fire({
        text: "Are you sure you want to delete " + r + "?",
        icon: "warning",
        showCancelButton: !0,
        buttonsStyling: !1,
        confirmButtonText: "Yes, delete!",
        cancelButtonText: "No, cancel",
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary",
        },
    }).then(function (t) {
        if (t.value) {
        console.log(baseUrl + subUrl, csrfToken)

            $.ajax({
                type: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                url: baseUrl + subUrl,
                success: function () {
                    Swal.fire({
                        text: "You have deleted " + r + "!.",
                        icon: "success",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        },
                    }).then(function () {
                        ajaxPagination();
                        $(tr).remove();
                    });
                },
                error: function () {
                    Swal.fire({
                        text: r + " was not deleted.",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        },
                    });
                },
            });
            return;
        }

        // "cancel" === t.dismiss &&
        //     Swal.fire({
        //         text: r + " was not deleted.",
        //         icon: "error",
        //         buttonsStyling: !1,
        //         confirmButtonText: "Ok, got it!",
        //         customClass: { confirmButton: "btn fw-bold btn-primary" },
        //     });
    });

    function ajaxPagination() {
        var target = $(".pagination li a").attr("href");
        if (!target) return false;
        var searchQuery = $("#searchQuery").val();
        if (typeof searchQuery != "undefined" && searchQuery != "") {
            target = target + "?" + "searchQuery= " + searchQuery;
        }
        $.get(
            target,
            function (data) {
                $(".rep_content").html(
                    jQuery(data).find(".rep_content").html()
                );
                url = jQuery(data).find(".next a").attr("href");
                finalQueryString = url
                    .substring(url.indexOf("?") + 1)
                    .replace(/\d+/, jQuery(data).find(".active a").html());
                var newurl =
                    window.location.protocol +
                    "//" +
                    window.location.host +
                    window.location.pathname +
                    "?" +
                    finalQueryString;
                window.history.pushState({ path: newurl }, "", newurl);
            },
            "html"
        );
    }
});
