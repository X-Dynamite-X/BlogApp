import $ from "jquery";

$(document).ready(function () {
    $(document).on("click", ".pagination-wrapper a", function (e) {
        e.preventDefault();
        const url = $(this).attr("href");
        $.ajax({
            url: url,
            method: "GET",
            success: function (response) {
                $(".articlesPage").html(response.posts);
                window.history.pushState({}, "", url);
                $(".pagination-wrapper").html(response.pagination);
            },
            error: function (response) {
                console.error("An error occurred:", response);
            },
        });

    })
});
