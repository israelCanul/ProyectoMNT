function validacampos(e){$("span.mainNoticeErr").remove(),$("input").removeClass("error");var t=new Array;if($("input",e).removeClass("error"),$(".dnAlfa",e).each(function(e){var a=$(this).val();if(a&&!a.match(/^([a-zA-Z\ }}]+)$/)){var n=$(this.parentNode).prev().text();t.push(n),$(this).addClass("error"),$(this.parentNode).append(" <span class='mainNoticeErr'>Solo letras</span>")}}),$(".dnAlnum",e).each(function(e){var a=$(this).val();if(a&&!a.match(/^([ a-zA-Z0-9 ?]+)$/)){var n=$(this.parentNode).prev().text();t.push(n),$(this).addClass("error"),$(this.parentNode).append(" <span class='mainNoticeErr'>Solo tetras y n?meros</span>")}}),$(".dnLong",e).each(function(e){var a=$(this).val();if(a.length<5){var n=$(this.parentNode).prev().text();t.push(n),$(this).addClass("error"),$(this.parentNode).append(" <span class='mainNoticeErr'>Only 5 Chars Allowed</span>")}}),$(".dnTxt",e).each(function(e){var a=$(this).val();if(a&&!a.match(/^([ a-zA-Z0-9\s_ ?\.\-,:;\(\)\[\]\!\?\#\-\&\*\/\%\$\n\r]+)$/)){var n=$(this.parentNode).prev().text();t.push(n),$(this).addClass("error"),$(this.parentNode).append(" <span class='mainNoticeErr'>Text Only</span>")}}),$(".notNull",e).each(function(e){var a=$.trim($(this).val());if(""==a){var n=$(this.parentNode).prev().text();t.push(n),$(this).addClass("error"),$(this.parentNode).append(" <span class='mainNoticeErr'>* Obligatory</span>")}}),$(".dnInt",e).each(function(e){var a=$(this).val();if(a&&!a.match(/^([0-9\.]+)$/)){var n=$(this.parentNode).prev().text();t.push(n),$(this).addClass("error"),$(this.parentNode).append(" <span class='mainNoticeErr'>Solo n?meros</span>")}}),$(".dnMail",e).each(function(e){var a=($(this),$(this).val());if(a&&!a.match(/^([a-zA-Z0-9][_\.\-a-zA-Z0-9]+)@([a-zA-Z0-9][\-a-zA-Z0-9]+(\.[a-zA-Z0-9][\-a-zA-Z0-9]+)?)(\.[a-zA-Z]{2,3})$/)){var n=$(this.parentNode).prev().text();t.push(n),$(this).addClass("error"),$(this.parentNode).append(" <span class='mainNoticeErr'>Incorrect Mail</span>")}}),$(".dnSelect",e).each(function(e){if($(this),$(this).val(),"0"==$(this).val()){var a=$(this.parentNode).prev().text();t.push(a),$(this).addClass("error"),$(this.parentNode).append(" <span class='mainNoticeErr'>Choose an Option</span>")}}),$(".dnEqual",e).each(function(e){var a=$(this).val(),n=$(this).attr("alt");(""==n||null==n)&&(n=$(this).attr("rel"));var o=$("#"+n).val();if(a!=o){var i=$(this.parentNode).prev().text();t.push(i),$(this).addClass("error"),$(this.parentNode).append(" <span class='mainNoticeErr'>No Match</span>"),$("#"+n).append(" <span class='mainNoticeErr'>No</span>")}}),$(".dncheckbox",e).each(function(e){var a=$(this),n=($(this).val(),a.is(":checked"));if(0==n){var o=$(this.parentNode).prev().text();t.push(o),$(this).addClass("error"),$(this.parentNode).append(" <span class='mainNoticeErr'>Accept terms and conditions</span>")}}),t.length>0){$(".error")[0].focus();var a=$("input",e).attr("id");return"hotel_destination"==a||"transfer_from"==a?(alert("Please enter your destination"),$(".mainNoticeErr").empty().append(" <span class='mainNoticeErr'>* Please enter your destination</span>"),!1):"isTourCategory"==a?(alert("Please enter your destination or activity"),!1):(alert("Review the form."),!1)}return $("#flightsCheckout").hide(),$("#imgLoading").show(),!0}function CurrencyFormatted(e){var t=parseFloat(e);isNaN(t)&&(t=0);var a="";return 0>t&&(a="-"),t=Math.abs(t),t=parseInt(100*(t+.005)),t/=100,s=new String(t),s.indexOf(".")<0&&(s+=".00"),s.indexOf(".")==s.length-2&&(s+="0"),s=a+s,s}function CurrencyFormattedNoDecimals(e){var t=parseFloat(e);isNaN(t)&&(t=0);var a="";return 0>t&&(a="-"),t=Math.abs(t),t=parseInt(100*(t+.005)),t/=100,s=new String(t),s.indexOf(".")<0&&(s+=".00"),s.indexOf(".")==s.length-2&&(s+="0"),s=a+s,s}function CommaFormatted(e){var t=",",a=e.split(".",2),n=a[1],o=parseInt(a[0]);if(isNaN(o))return"";var i="";0>o&&(i="-"),o=Math.abs(o);for(var r=new String(o),a=[];r.length>3;){var c=r.substr(r.length-3);a.unshift(c),r=r.substr(0,r.length-3)}return r.length>0&&a.unshift(r),r=a.join(t),e=n.length<1?r:r+"."+n,e=i+e}function getGET(){try{for(var e=document.location.href,t=e.split("#")[1],a=t.split("&"),n={},o=0,i=a.length;i>o;o++){var r=a[o].split("=");n[r[0]]=unescape(decodeURI(r[1]))}}catch(c){n=1}return n}function obtenerBannerLocalizador(e){var t="";return t}function updateTour(e,t,a,n){jQuery.facebox(function(){$.get(e,{ws:1,fecha:t,pax_adulto:a,pax_menor:n},function(o){var i="";i+="<div class='bloque' style='margin-left:16px; margin-bottom:10px;width:384px;margin-top:-5px;background-color:white;'>",i+="<table class='hotelRoomsTable' cellspacing='0' cellpadding='0' width='95%'>",i+="<thead>",i+="<tr>",i+="<th style='background-color: #009bdb; color: #fff; font-weight: bold;' width='1%' colspan='2'>",i+="Selecciona tus opciones",i+="</th>",i+="<th style='background-color: #009bdb; color: #fff; font-weight: bold; text-align: right !important;' width='1%''></th>",i+="<th style='background-color: #009bdb; color: #fff; font-weight: bold;' width='20%'>&nbsp;</th>",i+="</tr>",i+="</thead>",i+="<tbody style='color: #9a999f;'>",i+="<tr>",i+="<td>",i+="Fecha",i+="</td>",i+="<td>",i+="Adultos",i+="</td>",i+="<td>",i+="Ninos",i+="</td>",i+="</tr>",i+="<tr>",i+="<td>",i+="<input style='margin:1px; padding:4px;'readonly='readonly' size='12' type='text' id='FechaTour' value ='"+t+"' />",i+="</td>",i+="<td>",i+="<select style='margin:1px;' id='adultosField'>",i+=buildComboInt(1,6,a),i+="</select>",i+="</td>",i+="<td>",i+="<select style='margin:1px;' id='menoresField'>",i+=buildComboInt(0,4,n),i+="</select>",i+="</div>",i+="</td>",i+="</tr>",i+="</div>",$.facebox(o+i),$("#FechaTour").datepicker({defaultDate:1,changeMonth:!1,dateFormat:dateFormat,minDate:3,numberOfMonths:2,numberOfMonths:2}),$("#adultosField").unbind("change"),$("#adultosField").bind("change"),$("#adultosField").change(function(){updateTour(e,$("#FechaTour").val(),$("#adultosField").val(),$("#menoresField").val())}),$("#menoresField").unbind("change"),$("#menoresField").bind("change"),$("#menoresField").change(function(){updateTour(e,$("#FechaTour").val(),$("#adultosField").val(),$("#menoresField").val())}),$("#FechaTour").unbind("change"),$("#FechaTour").bind("change"),$("#FechaTour").change(function(){updateTour(e,$("#FechaTour").val(),$("#adultosField").val(),$("#menoresField").val())}),$(".btnAddtoCart").unbind("click"),$(".btnAddtoCart").bind("click"),$(".btnAddtoCart").click(function(){var e=$("#flightsCheckoutFormToursAjax").attr("action"),t=$("#flightsCheckoutFormToursAjax").serialize();return $.post(e,t,function(e){alert("Se ha agregado el producto"),jQuery.facebox.close()}),!1})})})}function buildComboInt(e,t,a){var n="";for(i=e;i<=t;i++)n+=i==a?"<option selected='selected' value='"+i+"'>"+i+"</option>":"<option value='"+i+"'>"+i+"</option>";return n}function get_cookie(e){var t=document.cookie,a=t.split(";");for(x=0;x<a.length;x++){var n=a[x].split("=");if(n[0].trim()==e){var o=n[1];break}}return o}!function(e){function t(){return n()?void 0:(e("#facebox_overlay").fadeOut(200,function(){e("#facebox_overlay").removeClass("facebox_overlayBG"),e("#facebox_overlay").addClass("facebox_hide"),e("#facebox_overlay").remove()}),!1)}function a(){return n()?void 0:(0==e("#facebox_overlay").length&&e("body").append('<div id="facebox_overlay" class="facebox_hide"></div>'),e("#facebox_overlay").hide().addClass("facebox_overlayBG").css("opacity",e.facebox.settings.opacity).click(function(){e(document).trigger("close.facebox")}).fadeIn(200),!1)}function n(){return 0==e.facebox.settings.overlay||null===e.facebox.settings.opacity}function o(t,a){e.get(t,function(t){e.facebox.reveal(t,a)})}function i(t,a){var n=new Image;n.onload=function(){e.facebox.reveal('<div class="image"><img src="'+n.src+'" /></div>',a)},n.src=t}function r(t,a){if(t.match(/#/)){var n=window.location.href.split("#")[0],r=t.replace(n,"");if("#"==r)return;e.facebox.reveal(e(r).html(),a)}else t.match(e.facebox.settings.imageTypesRegexp)?i(t,a):o(t,a)}function c(){var t=e.facebox.settings;t.loadingImage=t.loading_image||t.loadingImage,t.closeImage=t.close_image||t.closeImage,t.imageTypes=t.image_types||t.imageTypes,t.faceboxHtml=t.facebox_html||t.faceboxHtml}function s(){var e;return self.innerHeight?e=self.innerHeight:document.documentElement&&document.documentElement.clientHeight?e=document.documentElement.clientHeight:document.body&&(e=document.body.clientHeight),e}function l(){var e,t;return self.pageYOffset?(t=self.pageYOffset,e=self.pageXOffset):document.documentElement&&document.documentElement.scrollTop?(t=document.documentElement.scrollTop,e=document.documentElement.scrollLeft):document.body&&(t=document.body.scrollTop,e=document.body.scrollLeft),new Array(e,t)}function d(t){if(e.facebox.settings.inited)return!0;e.facebox.settings.inited=!0,e(document).trigger("init.facebox"),c();var a=e.facebox.settings.imageTypes.join("|");e.facebox.settings.imageTypesRegexp=new RegExp(".("+a+")$","i"),t&&e.extend(e.facebox.settings,t),e("body").append(e.facebox.settings.faceboxHtml);var n=[new Image,new Image];n[0].src=e.facebox.settings.closeImage,n[1].src=e.facebox.settings.loadingImage,e("#facebox").find(".b:first, .bl").each(function(){n.push(new Image),n.slice(-1).src=e(this).css("background-image").replace(/url\((.+)\)/,"$1")}),e("#facebox .close").click(e.facebox.close),e("#facebox .close_image").attr("src",e.facebox.settings.closeImage)}e.facebox=function(t,a){e.facebox.loading(),t.ajax?o(t.ajax,a):t.image?i(t.image,a):t.div?r(t.div,a):e.isFunction(t)?t.call(e):e.facebox.reveal(t,a)},e.extend(e.facebox,{settings:{opacity:.2,overlay:!0,loadingImage:"/loading.gif",closeImage:"http://www.lomasbeta.com.mx/img/closelabel.png",imageTypes:["png","jpg","jpeg","gif"],faceboxHtml:'\n    <div id="facebox" style="display:none;"> \n      <div class="popup"> \n        <div class="content"> \n        </div> \n        <a href="#" class="close" ><img src="http://www.lomasbeta.com.mx/img/closelabel.png" title="close" class="close_image" style="*position:absolute;*margin-left:-355px;margin-top:-5px;" /></a> \n      </div> \n    </div>'},loading:function(){return d(),1==e("#facebox .loading").length?!0:(a(),e("#facebox .content").empty(),e("#facebox .body").children().hide().end().append('<div class="loading"><img src="'+e.facebox.settings.loadingImage+'"/></div>'),e("#facebox").css({top:l()[1]+s()/10,left:e(window).width()/2-205}).show(),e(document).bind("keydown.facebox",function(t){return 27==t.keyCode&&e.facebox.close(),!0}),void e(document).trigger("loading.facebox"))},reveal:function(t,a){e(document).trigger("beforeReveal.facebox"),a&&e("#facebox .content").addClass(a),e("#facebox .content").append(t),e("#facebox .loading").remove(),e("#facebox .body").children().fadeIn("normal"),e("#facebox").css("left",e(window).width()/2-e("#facebox .popup").width()/2),e(document).trigger("reveal.facebox").trigger("afterReveal.facebox")},close:function(){return e(document).trigger("close.facebox"),!1}}),e.fn.facebox=function(t){function a(){e.facebox.loading(!0);var t=this.rel.match(/facebox\[?\.(\w+)\]?/);return t&&(t=t[1]),r(this.href,t),!1}return 0!=e(this).length?(d(t),this.bind("click.facebox",a)):void 0},e(document).bind("close.facebox",function(){e(document).unbind("keydown.facebox"),e("#facebox").fadeOut(function(){e("#facebox .content").removeClass().addClass("content"),e("#facebox .loading").remove(),e(document).trigger("afterClose.facebox")}),t()})}(jQuery),$("#numero_tarjeta").keyup(function(){var e=$(this).attr("id");filters.numero("#"+e)||(alert("Please enter only numbers!"),$("#"+e).val(""),$("#"+e).focus())});var filters={numero:function(e){return/^[0-9]*$/.test($(e).val())},letras:function(e){return/^[aA-zZ ]*$/.test($(e).val())}},dad_field,toSubmit=!1;$(document).ready(function(){$("form").on("submit",function(){return validacampos($(this))?!0:!1}),$(".whatisCvv").button(),$(".btn_nav_next_pagination").on("click",function(){var e=$(".misc_pagination_page_selector_option").length,t=1;$(".misc_pagination_page_selector_option").each(function(){$(this).hasClass("active")&&(t=$(this).attr("rel"))});var a=1*t+1;a>e&&(a=1),$(".prod_pagination").hide(),$("#pagination_"+a).show(),$(".misc_pagination_page_selector_option").removeClass("active"),$(".misc_pagination_page_selector_option").each(function(){$(this).attr("rel")==a&&$(this).addClass("active")})}),$(".seal_amipci").on("click",function(){var e=$(this).attr("href");return window.open(e,"seal_amipci","location=0,status=0,scrollbars=0,width=500,height=618"),!1}),$(".seal_verisign").on("click",function(){var e=$(this).attr("href");return window.open(e,"seal_verisign","location=0,status=0,scrollbars=0,width=516,height=430"),!1}),$(".btn_nav_prev_pagination").on("click",function(){var e=$(".misc_pagination_page_selector_option").length,t=1;$(".misc_pagination_page_selector_option").each(function(){$(this).hasClass("active")&&(t=$(this).attr("rel"))});var a=1*t-1;1>a&&(a=e),$(".prod_pagination").hide(),$("#pagination_"+a).show(),$(".misc_pagination_page_selector_option").removeClass("active"),$(".misc_pagination_page_selector_option").each(function(){$(this).attr("rel")==a&&$(this).addClass("active")})}),$(".misc_pagination_page_selector_option").on("click",function(){$(".misc_pagination_page_selector_option").removeClass("active"),$(this).addClass("active");var e=$(this).attr("rel");$(".prod_pagination").hide(),$("#pagination_"+e).show()}),$(".flight_activator_checker").on("click",function(){var e=$(this).attr("href");return jQuery.facebox(function(){$.get("/site/searching.html",{},function(t){$.facebox(t),setTimeout(function(){window.location.href=e},100)})}),!1}),$("#flightsCheckout").on("click",function(){return $("#flightsCheckoutForm").attr("action"),$("#flightsCheckoutForm"),validacampos($("#flightsCheckoutForm"))?($.get("/site/booking.html",{},function(e){setTimeout(function(){$("#flightsCheckoutForm").submit()},100)}),!1):!1}),$("#main_home_booking_box_new form .btnGreenSbmt").on("click",function(){var e=$(this.parentNode.parentNode);return validacampos($(this.parentNode.parentNode))?($(e).submit(),!1):!1}),$(".whatisCvv").on("click",function(){return jQuery.facebox(function(){$.get("/site/cvv.html",{},function(e){$.facebox(e)})}),!1}),$(".whatIs").on("click",function(){return jQuery.facebox(function(){$.get("/site/cvv.html",{},function(e){$.facebox(e)})}),!1}),$(".terminoscondiciones").on("click",function(){var e=$("#tipoproducto").attr("value");return jQuery.facebox(function(){$.get("/site/terminos.html",{id:e},function(e){$.facebox(e)})}),!1}),$(".option_chooser_type").on("click",function(){var e=$(this.parentNode).attr("id");e=e.split("#");var t=$(this).attr("rel");return $(".option_chooser_type").removeClass("active"),$(this).addClass("active"),$("."+e[0]).hide(),$("#"+e[1]+"_"+t).show(),!1})}),$(document).ready(function(){$("a[name=modal]").click(function(e){e.preventDefault();var t=$(this).attr("href"),a=$(document).height(),n=$(window).width();$("#mask").css({width:n,height:a}),$("#mask").fadeIn(1e3),$("#mask").fadeTo("slow",.8);var o=$(window).height(),i=$(window).width();$(t).css("top",o/2-$(t).height()/2),$(t).css("left",i/2-$(t).width()/2),$(t).fadeIn(2e3)}),$(".window .close").click(function(e){e.preventDefault(),$("#mask").hide(),$(".window").hide()}),$("#mask").click(function(){$(this).hide(),$(".window").hide()}),$(window).resize(function(){$(".menu-resp").css("display","none");var e=$("#boxes .window"),t=$(document).height(),a=$(window).width(),n=$(window).height(),o=$(window).width();e.css("top",n/2-e.height()/2),e.css("left",o/2-e.width()/2),$("#mask").css({width:a,height:t})}),$("#lhnChatButton").click(function(){var e=Math.random()+"",t=1e13*e,a=document.body.appendChild(document.createElement("div"));a.setAttribute("id","DCLK1"),a.style.position="absolute",a.style.top="0",a.style.left="0",a.style.width="1px",a.style.height="1px",a.style.display="none",a.innerHTML='<iframe src="http://4344202.fls.doubleclick.net/activityi;src=4344202;type=lomas784;cat=mx_lo711;ord='+t+'?" width="1" height="1" frameborder="0" style="display:none"></iframe>',document.getElementById("DCLK").appendChild(a)}),$(".menu").clone().insertBefore("#deals").addClass("menu-resp").removeClass("menu"),$("#icn-menu").on("click",function(){$(".menu-resp").slideToggle()}),$(".openBooking").on("click",function(){$(".hiddenBooking").slideDown("slow")}),$(".closeBooking").on("click",function(){$(".hiddenBooking").slideUp("slow")}),$(".img_chat").click(function(){$(".openlhnchat").trigger("click")}),$(".cerrar_chat").click(function(){$(".chat_lomas").hide();var e=new Date,t="oculta=ocultar";e.setTime(e.getTime()+864e6);var a=e.toUTCString();document.cookie=t+"; expires="+a+"; path= /"}),function(){var e={Android:function(){return navigator.userAgent.match(/Android/i)},BlackBerry:function(){return navigator.userAgent.match(/BlackBerry/i)},iOS:function(){return navigator.userAgent.match(/iPhone|iPad|iPod/i)},Opera:function(){return navigator.userAgent.match(/Opera Mini/i)},Windows:function(){return navigator.userAgent.match(/IEMobile/i)}},t=0;t=e.Android()?1:e.BlackBerry()?1:e.iOS()?1:e.Opera()?1:e.Windows()?1:0,1==t&&$(".chat_lomas").hide();var a=get_cookie("oculta");return"undefined"==a?!1:void("ocultar"==a&&$(".chat_lomas").hide())}(),$("#LomasAg").click(function(){$("#afiliado_id").val(""),$("#afiliado_pw").val(""),$("#formAfi").dialog()}),$("#enviaFormAfi").click(function(){var e=$("#afiliado_id").val(),t=$("#afiliado_pw").val();return""==e||" "==e?void alert("Please enter your affiliate id"):""==t||" "==t?void alert("Please enter your password"):void $.ajax({type:"POST",url:"/inc/components/login_en_lomas.php",data:{afiliado_id:e,afiliado_pw:t},success:function(a){$("#afiliado_idHide").val(""),$("#afiliado_pwHide").val(""),1==a?($("#afiliado_idHide").val(e),$("#afiliado_pwHide").val(t),$("#formAfiHide").submit()):alert("Login error")},error:function(){}})})});