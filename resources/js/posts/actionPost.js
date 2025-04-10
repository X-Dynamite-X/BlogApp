import $ from "jquery";

// تعريف الدوال كمتغيرات محلية
const handleLike = function (postId) {
    $.ajax({
        url: `/post/${postId}/like`,
        method: "POST",

        success: function (response) {
            const likeCount = response.likes;
            const dislikeCount = response.dislikes;
            $(`#like-count-${postId}`).text(likeCount);
            $(`#dislike-count-${postId}`).text(dislikeCount);
        },
        error: function (response) {
            console.error("An error occurred:", response);
        },
    });
};

const handleDislike = function (postId) {

    $.ajax({
        url: `/post/${postId}/dislike`,
        method: "POST",

        success: function (response) {
            const likeCount = response.likes;
            const dislikeCount = response.dislikes;
            $(`#like-count-${postId}`).text(likeCount);
            $(`#dislike-count-${postId}`).text(dislikeCount);
        },
        error: function (response) {
            console.error("An error occurred:", response);
        },
    });
};

const handleView = function (postId) {
    console.log(postId);

    $.ajax({
        url: `/post/${postId}/view`,
        method: "POST",

        success: function (response) {
            const viewCount = response.views;
            $(`#view-count-${postId}`).text(viewCount);
            console.log(response);
        },
        error: function (response) {
            console.error("An error occurred:", response);
        },
    });
};

// إضافة الدوال إلى الكائن window لتكون متاحة عالميًا
window.handleLike = handleLike;
window.handleDislike = handleDislike;
window.handleView = handleView;

$(document).ready(function () {
    // Event listeners for dynamic content
    $(document).on("click", ".like-btn", function () {
        const postId = $(this).data("post-id");
        handleLike(postId);
    });

    $(document).on("click", ".dislike-btn", function () {
        const postId = $(this).data("post-id");
        handleDislike(postId);
    });

    $(document).on("click", ".view-btn", function () {
        const postId = $(this).data("post-id");
        handleView(postId);
    });
});
