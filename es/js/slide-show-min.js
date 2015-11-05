/*slide-show.js*/
$.slideShow = (function(a) {
    a.fn.extend({
        slideShow: function(b) {
            var c = {
                transitionSpeed: 2000,
                displayTime: 4000,
                textholderHeight: 0.2,
                displayThumbnails: 1
            };
            var b = a.extend(c, b);
            return this.each(function() {
                var q = a(this);
                a(".slide-show-content li", q).each(function() {
                    var i = a(this).children("a");
                    i.html("<img width='728' height='399' alt='" + i.attr("title") + "' data-src='" + i.attr("ref") + "'/>")
                });
                var j = a("img", q);

                function s(i) {
                    i.data[0](i.data[1] + 1)
                }

                function p(o) {
                    var i = a(j[o]);
                    i.one("load error", [arguments.callee, o], s);
                    i.attr("src", i.attr("data-src")).each(function() {
                        if (this.complete) {
                            a(this).trigger("load")
                        }
                    })
                }
                p(0);
                var h = Math.round(Math.random() * 100000000);
                var m = b;
                var l = 1;
                var e = 0;
                var r = a("img", q).length;
                var g = q.parent().width();
                q.width(g).css({
                    overflow: "hidden",
                    position: "relative"
                });
                a(".slide-show-content li", q).width(g);
                a("img", q).width(g);
                a(".slide-show-content", q).width(9999).css({
                    "list-style": "none",
                    margin: "0",
                    padding: "0",
                    position: "relative"
                });
                if (m.displayThumbnails) {
                    q.after('<ul class="controls notstylelist" id="thumbs' + h + '"></u>');
                    for (var k = 0; k <= r - 1; k++) {
                        thumb = a("img:eq(" + (k + 1) + ")", q).attr("src");
                        a("#thumbs" + h).append('<li class="' + ((k == 0) ? "active" : ((k == r - 1) ? "last" : "")) + '" id="thumb' + h + "_" + (k + 1) + '" >' + (k + 1) + "</li>")
                    }
                    a("#thumbs" + h + " li").bind("click", n);
                    a("#thumbs" + h).width((r * (14 + 7)) - 7)
                }

                function n(t) {
                    target_num = this.id.split("_");
                    if (l != target_num[1]) {
                        clearTimeout(f);
                        setTimeout(function() {}, 10000);
                        clearTimeout(f);
                        f = setInterval(function() {
                            d("next")
                        }, m.displayTime + m.transitionSpeed)
                    }
                    if (target_num[1] > l) {
                        diff = target_num[1] - l;
                        d("next", diff)
                    }
                    if (target_num[1] < l) {
                        diff = l - target_num[1];
                        d("prev", diff)
                    }
                    for (var o = 1; o <= r; o++) {
                        a("#" + target_num[0] + "_" + o).removeClass("active")
                    }
                    a("#" + this.id).addClass("active")
                }

                function d(v, u) {
                	if ($(".slide-show-content li").size() == "2") {
                        var text = $(".slide-show-content").html();
                        text = text + text;
                        $(".slide-show-content").html(text);
                    }
                    var o = a(".slide-show-content", q);
                    for (var t = 1; t <= r; t++) {
                        a("#thumb" + h + "_" + t).removeClass("active")
                    }
                    if (v == "next") {
                        if (l == r) {
                            l = 0
                        }
                        if (u > 1) {
                            o.children("li:lt(2)").insertAfter(o.children("li:last"));
                            o.animate({
                                left: -g * (u + 1)
                            }, m.transitionSpeed, function() {
                                for (var i = 1; i <= u - 2; i++) {
                                    o.children("li:first").insertAfter(o.children("li:last"))
                                }
                                a(this).css({
                                    left: -g
                                });
                                l = l + u
                            })
                        } else {
                            if (e < 1) {
                                o.animate({
                                    left: -g
                                }, m.transitionSpeed, function() {
                                    l++;
                                    e++
                                })
                            } else {
                                o.animate({
                                    left: -g * 2
                                }, m.transitionSpeed, function() {
                                    o.children("li:first").insertAfter(o.children("li:last"));
                                    o.css("left", -g + "px");
                                    l++
                                })
                            }
                        }
                        a("#thumb" + h + "_" + (l + 1)).addClass("active")
                    }
                    if (v == "prev") {
                        if (u > 1) {
                            o.children("li:gt(" + (r - (u + 1)) + ")").insertBefore(o.children("li:first"));
                            o.css({
                                left: (-g * (u + 1))
                            }).animate({
                                left: -g
                            }, m.transitionSpeed, function() {
                                l = l - u
                            })
                        } else {
                            o.children("li:last").insertBefore(o.children("li:first"));
                            o.css("left", -g * 2 + "px").animate({
                                left: -g
                            }, m.transitionSpeed, function() {
                                l = l - 1;
                                if (l == 0) {
                                    l = r
                                }
                            })
                        }
                    }
                }
                var f = setInterval(function() {
                    d("next")
                }, m.displayTime + m.transitionSpeed)
            })
        }
    })
})(jQuery);
$(".slide-show-skin").slideShow({
    transitionSpeed: 2000,
    displayTime: 4000
});