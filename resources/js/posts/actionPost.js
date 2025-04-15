import $ from "jquery";


const handleLike = function (postId, isActive) {
    $.ajax({
        url: `/post/${postId}/like`,
        method: "POST",
        data: { isActive },
        success: function (response) {
            const likeButton = $(`#like-btn-${postId}`);
            const likeIsActive = !isActive;
            likeButton.data("is-active", likeIsActive);
            const dislikeIsActive = false;
            const dislikeButton = $(`#dislike-btn-${postId}`);
            const likeCount = response.likes;
            const dislikeCount = response.dislikes;

            dislikeButton.data("is-active", dislikeIsActive);
            dislikeButton.find("span").text(dislikeCount);
            likeButton.find("span").text(likeCount);
            likeButton
                .find("svg")
                .attr("fill", likeIsActive ? "currentColor" : "none");
            dislikeButton
                .find("svg")
                .attr("fill", dislikeIsActive ? "currentColor" : "none");
            dinamicChangeActionPostButton(
                likeButton,
                dislikeButton,
                likeIsActive,
                dislikeIsActive
            );
        },
        error: function (response) {
            console.error("An error occurred:", response);
        },
    });
};

const handleDislike = function (postId, isActive) {
    $.ajax({
        url: `/post/${postId}/dislike`,
        method: "POST",
        data: { isActive },
        success: function (response) {
            const likeCount = response.likes;
            const dislikeCount = response.dislikes;
            const likeButton = $(`#like-btn-${postId}`);
            const dislikeButton = $(`#dislike-btn-${postId}`);
            const dislikeIsActive = !isActive;
            likeButton.data("is-active", false);
            const likeIsActive = false;
            likeButton.find("span").text(likeCount);
            dislikeButton.data("is-active", dislikeIsActive);
            dislikeButton.find("span").text(dislikeCount);
            dinamicChangeActionPostButton(
                likeButton,
                dislikeButton,
                likeIsActive,
                dislikeIsActive
            );
        },
        error: function (response) {
            console.error("An error occurred:", response);
        },
    });
};


const dinamicChangeActionPostButton = function (
    likeButton,
    dislikeButton,
    likeIsActive,
    dislikeIsActive
) {
    // تعريف الألوان المستخدمة
    const activeColors = {
        like: "text-blue-600 dark:text-blue-400",
        dislike: "text-red-600 dark:text-red-400",
        default: "text-gray-500 dark:text-gray-400",
    };

    const hoverColors = {
        like: "group-hover:text-blue-600 dark:group-hover:text-blue-400",
        dislike: "group-hover:text-red-600 dark:group-hover:text-red-400",
    };

    // تحديث زر الإعجاب
    updateButton(likeButton, {
        isActive: likeIsActive,
        activeColor: activeColors.like,
        defaultColor: activeColors.default,
        hoverColor: hoverColors.like,
    });

    // تحديث زر عدم الإعجاب
    updateButton(dislikeButton, {
        isActive: dislikeIsActive,
        activeColor: activeColors.dislike,
        defaultColor: activeColors.default,
        hoverColor: hoverColors.dislike,
    });
};

function updateButton(
    button,
    { isActive, activeColor, defaultColor, hoverColor }
) {
    const svg = button.find("svg");
    const span = button.find("span");

    // إزالة جميع الألوان السابقة
    [activeColor, defaultColor, hoverColor].forEach((color) => {
        svg.removeClass(color);
        span.removeClass(color);
    });

    // تطبيق الألوان الجديدة
    if (isActive) {
        svg.addClass(activeColor);
        span.addClass(activeColor);
    } else {
        svg.addClass(defaultColor);
        span.addClass(defaultColor);
        svg.addClass(hoverColor);
    }

    // تحديث حالة الملء للأيقونة
    svg.attr("fill", isActive ? "currentColor" : "none");

    // تحديث حالة الزر
    button.data("is-active", isActive);
}
window.handleLike = handleLike;
window.handleDislike = handleDislike;


$(document).ready(function () {
    // Event listeners for dynamic content
    $(document).on("click", ".like-btn", function () {
        const postId = $(this).data("post-id");
        const isActive = $(this).data("is-active");
        console.log(isActive);

        if (postId.length != 0) {
            handleLike(postId, isActive);
        }
    });

    $(document).on("click", ".dislike-btn", function () {
        const postId = $(this).data("post-id");
        const isActive = $(this).data("is-active");
        console.log(isActive);

        if (postId.length != 0) {
            handleDislike(postId, isActive);
        }
    });
});

