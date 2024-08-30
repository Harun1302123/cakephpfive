$(document).on("click", "#search-query", function (e) {
    // Element to indecate

    e.preventDefault();
    //check if no search query
    var searchQuery = $("#searchQuery").val();

    if (!searchQuery) {
        return false;
    }

    //get current location & check empty
    var target = window.location.href;

    if (!target) {
        return false;
    }

    var button = document.querySelector("#search-query");
    //make seach query as query string
    target = target + "?" + "searchQuery= " + searchQuery;

    button.setAttribute("data-kt-indicator", "on");
    $.get(
        target,
        function (data) {
            // alert(data);
            button.removeAttribute("data-kt-indicator");

            $(".rep_content").html(jQuery(data).find(".rep_content").html());
        },
        "html"
    );
    return false;
});
