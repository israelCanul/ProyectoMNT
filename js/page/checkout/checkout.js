$(document).ready(function(){

    $(".whatisCvv").button(), $(".btn_nav_next_pagination").on("click", function() {
        var e = $(".misc_pagination_page_selector_option").length,
            t = 1;
        $(".misc_pagination_page_selector_option").each(function() {
            $(this).hasClass("active") && (t = $(this).attr("rel"))
        });
        var a = 1 * t + 1;
        a > e && (a = 1), $(".prod_pagination").hide(), $("#pagination_" + a).show(), $(".misc_pagination_page_selector_option").removeClass("active"), $(".misc_pagination_page_selector_option").each(function() {
            $(this).attr("rel") == a && $(this).addClass("active")
        })
    }), $(".seal_amipci").on("click", function() {
        var e = $(this).attr("href");
        return window.open(e, "seal_amipci", "location=0,status=0,scrollbars=0,width=500,height=618"), !1
    }), $(".seal_verisign").on("click", function() {
        var e = $(this).attr("href");
        return window.open(e, "seal_verisign", "location=0,status=0,scrollbars=0,width=516,height=430"), !1
    }), $(".btn_nav_prev_pagination").on("click", function() {
        var e = $(".misc_pagination_page_selector_option").length,
            t = 1;
        $(".misc_pagination_page_selector_option").each(function() {
            $(this).hasClass("active") && (t = $(this).attr("rel"))
        });
        var a = 1 * t - 1;
        1 > a && (a = e), $(".prod_pagination").hide(), $("#pagination_" + a).show(), $(".misc_pagination_page_selector_option").removeClass("active"), $(".misc_pagination_page_selector_option").each(function() {
            $(this).attr("rel") == a && $(this).addClass("active")
        })
    }), $(".misc_pagination_page_selector_option").on("click", function() {
        $(".misc_pagination_page_selector_option").removeClass("active"), $(this).addClass("active");
        var e = $(this).attr("rel");
        $(".prod_pagination").hide(), $("#pagination_" + e).show()
    }), $(".flight_activator_checker").on("click", function() {
        var e = $(this).attr("href");
        return jQuery.facebox(function() {
            $.get("/site/searching.html", {}, function(t) {
                $.facebox(t), setTimeout(function() {
                    window.location.href = e
                }, 100)
            })
        }), !1
    });

});