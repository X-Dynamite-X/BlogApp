import $ from "jquery";

const handleDeletePost = function (url) {
    $.ajax({
        url: url,
        method: "DELETE",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            window.location.href = response.redirect;

        },
        error: function (response) {
            console.error("An error occurred:", response);
        },
    })

}
const handleupdatePost = function (url) {
    $.ajax({
        url: url,
        method: "PUT",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            window.location.href = response.redirect;

        },
        error: function (response) {
            console.error("An error occurred:", response);
        },
    })
}
 


$(document).ready(function () {
    $(document).on("click", ".delete-btn", function () {
        $("#deleteModal").removeClass("hidden");
    });
    $(document).on("click", "#cancelDelete", function () {
        $("#deleteModal").addClass("hidden");
    });
     $(document).on("click", "#confirmDelete", function () {
         const url = $(this).data("url");
         console.log(url);
         handleDeletePost(url);
     });
    $(document).on("click", ".update-btn", function () {
        const url = $(this).data("url");
        console.log(url);
        handleupdatePost(url);
    });

});
