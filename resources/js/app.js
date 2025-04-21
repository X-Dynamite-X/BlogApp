import $ from "jquery";
$.ajaxSetup({

    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },

});

import "./auth/login";
import "./auth/register";
import "./posts/actionPost";
import "./posts/pageination";
import "./posts/requstApi";
