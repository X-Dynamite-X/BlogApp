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
const handleupdatePost = function ( ) {
    // Create FormData object
    const formData = new FormData();
    formData.append('title', $("#title").val());
    formData.append('content', $("#content").val());

    // Add image if exists
    const imageFile = $("#image-upload")[0].files[0];
    if (imageFile) {
        formData.append('image', imageFile);
    }


    $.ajax({
        url: $("#post-form").attr("action"),
        method: "POST", // Change to POST
        data: formData,
        processData: false, // Don't process the data
        contentType: false, // Don't set content type
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            "X-HTTP-Method-Override": "PUT" // Override method to PUT
        },
        success: function (response) {
            window.location.href = response.redirect;
            console.log(response);

        },
        error: function (response) {
            console.error("An error occurred:", response);
        },
    });
};;



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
    $(document).on("click", ".update-btn", function (e) {
        e.preventDefault();

        handleupdatePost( );
    });
    $(document).on("input", "#content", function () {
        const contentPreview = $("#content-preview");
        contentPreview.text($(this).val());
    });
    $(document).on("input", "#image-upload", function () {
        const imagePreview = $("#current-image");
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.attr("src", e.target.result);
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.attr("src", "");
        }
    });
});



