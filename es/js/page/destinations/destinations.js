function despliegalistahoteles(){if(typeof searchToken!=="undefined"){  $.getJSON("/destinations/ordenacion.html?hotelName=&Stars=0&minPrice=0&maxPrice=9999999&token="+searchToken+"&Order=0",function(e){var t=[]; for(var n=0;n<e.Hotels.length;n++){ t.push({label:e.Hotels[n].Name, value:e.Hotels[n].Name, clave:e.Hotels[n].Id})} $("#hotelName").autocomplete({source:function(e,n){ if(e.term.length>0){var r=new RegExp($.ui.autocomplete.escapeRegex(cambiaSimbolos(e.term)),"i");n($.grep(t,function(e){ label=e.label;e=e.label;clave=e.value;return r.test(label)||r.test(cambiaSimbolos(label))}))}else{} },select:function(e,t){ $("#clave_hotel").val(t.item.label);updateResults()},autoFocus:true,minLength:2 })  }) }}
function btnsViewMore(){$(".display_more_info_hab").unbind("click");$(".display_more_info_hab").bind("click");$(".display_more_info_hab").click(function(){ if($(this).hasClass("show_more_info_hab")){ var e=$(this).attr("rel");$("span",$(".display_more_info_hab")).html(_view_more_);  $(".display_more_info_hab").removeClass("hide_more_info_hab");$(".display_more_info_hab").addClass("show_more_info_hab");$(this).removeClass("show_more_info_hab"); $(this).addClass("hide_more_info_hab"); $("span",$(this)).html(_hide_); $(".tr_hab_more_info").hide();$(this.parentNode.parentNode.parentNode).next().show()}else{$("span",$(".display_more_info_hab")).html(_view_more_);$(".display_more_info_hab").removeClass("hide_more_info_hab");$(".display_more_info_hab").addClass("show_more_info_hab"); $(this).removeClass("hide_more_info_hab");$(".tr_hab_more_info").hide()}return false})}
function btnsViewPromotion(){$(".display_more_info_hab_").unbind("click");$(".display_more_info_hab_").bind("click");$(".display_more_info_hab_").click(function(){ if($(this).hasClass("show_more_info_hab_")){var e=$(this).attr("rel");$(".display_more_info_hab_").removeClass("hide_more_info_hab_");$(".display_more_info_hab_").addClass("show_more_info_hab_"); $(this).removeClass("show_more_info_hab_"); $(this).addClass("hide_more_info_hab_");$(".tr_hab_more_info").hide();$(this.parentNode.parentNode.parentNode).next().show()}else{$(".display_more_info_hab_").removeClass("hide_more_info_hab_");$(".display_more_info_hab_").addClass("show_more_info_hab_"); $(this).removeClass("hide_more_info_hab_"); $(".tr_hab_more_info").hide()}return false})}
function updateResults(){
  jQuery.facebox(function(){
    var e="";
    $.get("/site/searching.html",{},function(e){
      $.facebox(e)
    })
  });
  btnsViewMore();
  btnsViewPromotion();
  $("#pagination_product").hide();
  var e=$("#sorterBy").val();
  var t=$("#HotelFilters").serialize();
  t+="&token="+searchToken+"&Order="+e;
  $.getJSON(hotelsOrderingXML,t,function(e){
    $(".filter_results_obj_cr").each(function(){
      $("input",$(this.parentNode)).removeAttr("disabled")
    });
    $(".MainHotelOption").hide();
    $("#ajaxHotelResults").empty().removeClass("whileSearch");
    $("#hotelsResult").html(e.Results);
    if(e.Results==0||e.Results=="0"){
      $(".no_results").show()
    }else{
      $(".no_results").hide()
    }
    $(".filter_results_obj_cr").each(function(){
      $(this).html("(0)")
    });
    var t=new Array;
    $.facebox.close();
    $.each(e.Hotels,function(e,n){
      if(isMapDisplayed){
        var r=0;
        for(var i=0;i<BaseHoteles.length;i++){
          var s=BaseHoteles[i];if(s[4]==n.Id){
            t.push(BaseHoteles[i]);r++
          }
        }
        debugHoteles=t;
        initialize(t)
      }
      var o=0;
      o=$("#filter_obj_dStars_"+n.dStars).html();
      o=limpiaFilterCounter(o)+1;
      $("#filter_obj_dStars_"+n.dStars).html("("+o+")");
      var u=0;
      u=$("#filter_obj_OnlyAdults_"+n.OnlyAdults).html();
      u=limpiaFilterCounter(u)+1;
      $("#filter_obj_OnlyAdults_"+n.OnlyAdults).html("("+u+")");
      $(".hotel_category_filter_relayer").each(function(){
        var e=$(this).attr("rel");if(e==n.Category){
          var t=0;
          t=$(this).html();
          t=limpiaFilterCounter(t)+1;
          $(this).html("("+t+")")
        }
      });
      if(typeof n.MealPlans=="object"){
        $.each(n.MealPlans,function(e,t){
          $(".hotel_mealplan_filter_relayer").each(function(){
            var e=$(this).attr("rel");
            if(e==changeToUtf8Str(t[0])){
              var n=0;
              n=$(this).html();
              n=limpiaFilterCounter(n)+1;
              $(this).html("("+n+")")
            }
          })
        })
      }
      var a=$("#Hotel_"+n.Id).html();
      $("#ajaxHotelResults").append("<div class='bloque OptionHotel'>"+a+"</div>");
      btnsViewMore();
      btnsViewPromotion();
      btnsViewMore();
      $(".hotelRoomsTable .misc_select_btn_blue").unbind("click");
      $(".hotelRoomsTable .misc_select_btn_blue").bind("click");
      $(".hotelRoomsTable .misc_select_btn_blue").click(function(){
        $("form",this.parentNode.parentNode).submit();
        return false
      });$(".hotelRoomsTable .btnGreenSbmt").unbind("click");
      $(".hotelRoomsTable .btnGreenSbmt").bind("click");
      $(".hotelRoomsTable .btnGreenSbmt").click(function(){
        $("form",this.parentNode.parentNode.parentNode).submit();
        return false
      })
    });

    $(".filter_results_obj_cr").each(function(){
      var e=$(this).html();
      if(e=="(0)"){
        $("input",$(this.parentNode)).attr("disabled","disabled")
      }
    })
  })
}


function limpiaFilterCounter(e){if(e){e=e.replace(" ","");e=e.replace("(","");e=e.replace(")","");e=e*1}else{e=0}return e}
function changeToUtf8Str(e){if(e){e=e.replace("&oacute;","ó");e=e.replace("&aacute;","á");e=e.replace("&eacute;","é")}else{e=""}return e}
function cambiaSimbolos(e){var t=[/[\300-\306]/g,/[\340-\346]/g,/[\310-\313]/g,/[\350-\353]/g,/[\314-\317]/g,/[\354-\357]/g,/[\322-\330]/g,/[\362-\370]/g,/[\331-\334]/g,/[\371-\374]/g,/[\321]/g,/[\361]/g,/[\307]/g,/[\347]/g];var n=["A","a","E","e","I","i","O","o","U","u","N","n","C","c"];for(var r=0;r<t.length;r++){e=e.replace(t[r],n[r])}return e}
function valida_correo(e){if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(e)){return true}return false}
//function findCategoryHotel(){location.href=$(this).attr("data-href-category")}



$(document).ready(function(){

  $(".hotelRoomsTable .btnGreenSbmt").unbind("click");
  $(".hotelRoomsTable .btnGreenSbmt").bind("click");
  $(".hotelRoomsTable .btnGreenSbmt").click(function(){
    $("form",this.parentNode.parentNode).submit();
    return false
  });
  $(".show_room_info_display_btn").click(function(){
    $(".show_detailed_rate_info").removeAttr("style");
    if($(this).hasClass("current")){
      $(".show_more_opt_label",$(this)).show();
      $(".show_less_opt_label",$(this)).hide();
      $(this).removeClass("current")
    }else{
      $(".show_more_opt_label",$(this)).hide();
      $(".show_less_opt_label",$(this)).show();
      $(this).addClass("current");
      var e=$(this).attr("rel");
      
      $("#"+e).css("display","block");
    }
    return false
  });
  $(".show_info_room").click(function(){
    $(".show_detailed_room_info").removeAttr("style");
    if($(this).hasClass("current")){
      $(".show_more_opt_room",$(this)).show();
      $(".show_less_opt_room",$(this)).hide();
      $(this).removeClass("current")
    }else{
      $(".show_more_opt_room",$(this)).hide();
      $(".show_less_opt_room",$(this)).show();
      $(this).addClass("current");
      var e=$(this).attr("rel");
      
      $("#"+e).css("display","block");
    }
    return false
  });
  
  $(".show_info_room_all").click(function(){
    if($(this).hasClass("current")){
      $(".show_more_opt_room",$(this)).show();
      $(".show_less_opt_room",$(this)).hide();
      $(this).removeClass("current")
      $(".room_detailed_all").css("display","none");
    }else{
      $(".show_more_opt_room",$(this)).hide();
      $(".show_less_opt_room",$(this)).show();
      $(this).addClass("current");
      $(".room_detailed_all").css("display","block");
    }
    return false
  });
    

/*  $(".btnNewSearchFilter").click(function(){
    $(".StarsPicker, .CatPicker, .mPlanPicker, .mPlanPicker").removeAttr("checked");
    $(".StarsPicker[value=0]").attr("checked","checked");
    updateResults();
    $("#hotel_checkin").focus();
    return false
  });

  $(".hotelRoomsTable .misc_select_btn_blue").unbind("click");
  $(".hotelRoomsTable .misc_select_btn_blue").bind("click");
  $(".hotelRoomsTable .misc_select_btn_blue").click(function(){
    $("form",this.parentNode.parentNode).submit();
    return false
  });

  $(".hotelRoomsTable .selectBook").unbind("click");
  $(".hotelRoomsTable .selectBook").click(function(){
    $("form",this.parentNode.parentNode.parentNode).submit();
    return false
  });

  $(".StarsPicker, .CatPicker, .mPlanPicker").click(function(){
    updateResults()
  });

  $("#sorterBy").change(function(){
    updateResults()
  });

  $(".sorter").click(function(){
    $(".sorter").removeClass("sortSelected");
    $(this).addClass("sortSelected");updateResults();
    return false
  });*/

  /*var e=$("#from, #to").datepicker({
    defaultDate:"+1w",
    minDate:1,
    numberOfMonths:2,
    onSelect:function(t){
      var n=this.id=="from"?"minDate":"maxDate",
      r=$(this).data("datepicker"),
      i=$.datepicker.parseDate(r.settings.dateFormat||$.datepicker._defaults.dateFormat,t,r.settings);
      if(this.id!="to"){
        e.not(this).datepicker("option",n,i)}
      }
    });*/
  /*$("#rooms").change(function(){
    buildRooms()
  });*/

  $(".chooserDivContent").hide();
  $("#priceSelector").show();
  $(".priceSelector").click(function(){
    $(".optionsHotel").removeClass("optionsHotelSelected");
    $(".optionsDivChooser .priceSelector").addClass("optionsHotelSelected");
    $(".chooserDivContent").hide();$("#priceSelector").show();
    return false
  });

  $(".locationSelector").click(function(){
    $(".optionsHotel").removeClass("optionsHotelSelected");
    $(".optionsDivChooser .locationSelector").addClass("optionsHotelSelected");
    $(".chooserDivContent").hide();
    $("#locationSelector").show();
    return false
  });

  $(".detailSelector").click(function(){
    $(".optionsHotel").removeClass("optionsHotelSelected");
    $(".optionsDivChooser .detailSelector").addClass("optionsHotelSelected");
    $(".chooserDivContent").hide();
    $("#detailSelector").show();
    return false
  });

  $(".optn_selector:first").addClass("optn_selector_selected");
  $(".opt_facility:first").show();
  $(".optn_selector").click(function(){
    var e=$(this).attr("rel");$(".optn_selector").removeClass("optn_selector_selected");
    $(this).addClass("optn_selector_selected");
    $(".opt_facility").hide();
    $("#facility_div_"+e).show();
    return false
  });
  
  //suscriptionDeclaracion();
  despliegalistahoteles();
  //buildRooms();
  btnsViewMore();
  btnsViewPromotion();

  //$("#categories-hotels li").bind("click",findCategoryHotel)

});


//function buildRooms(e){if(typeof e!="undefined"){e=e}else{e=0}populateBookingBoxHoteles(e)}

//function buildChildsInfo(e,t){var n="";$(".childOtion").unbind("change");$(".childOtion").bind("change");$(".childOtion").on("change",function(){var e=$(this).attr("id");e=e.replace("child_","");var t=$(this).val();buildChildsInfo(t,e)});if(e>0){n+="<td colspan='2'><label>"+hab_var_name+" "+(t==0?1:t)+" <br>"+menor_var_name+"</label>";for(i=1;i<=e;i++){n+=""+i+":";n+="<select id='Room_"+t+"_"+i+"_Childs' name='Room["+t+"][ChildAges]["+i+"]' class='decorated' style='color:black;'>";n+="<option value='0'>0</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option><option value='6'>6</option><option value='7'>7</option><option value='8'>8</option><option value='9'>9</option><option value='10'>10</option><option value='11'>11</option><option value='12'>12</option><option value='13'>13</option><option value='14'>14</option><option value='15'>15</option><option value='16'>16</option><option value='17'>17</option>";n+="</select>&nbsp;&nbsp;"}n+="</td>"}else{var n=""}$("#child_info_more_room_"+t).html(n)}
//Object.size=function(e){var t=0,n;for(n in e){if(e.hasOwnProperty(n))t++}return t};
   
      var accentMap={"á":"a","é":"e","í":"i","ó":"o","ú":"u"};$.widget("custom.hotelCombo",$.ui.autocomplete,{_renderMenu:function(e,t){var n=this,r="";$.each(t,function(t,i){if(i.categoria!=r){e.append("<li class='ui-autocomplete-destination'>"+i.categoria+"</li>");r=i.categoria}n._renderItem(e,i)})}});var normalize=function(e){var t="";for(var n=0;n<e.length;n++){t+=accentMap[e.charAt(n)]||e.charAt(n)}return t};(function(e){e.datepicker.regional["es"]={renderer:e.ui.datepicker.defaultRenderer,monthNames:["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],monthNamesShort:["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"],dayNames:["Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado"],dayNamesShort:["Dom","Lun","Mar","Mi&eacute;","Juv","Vie","S&aacute;b"],dayNamesMin:["Do","Lu","Ma","Mi","Ju","Vi","S&aacute;"],dateFormat:"dd/mm/yyyy",firstDay:1,prevText:"&#x3c;Ant",prevStatus:"",prevJumpText:"&#x3c;&#x3c;",prevJumpStatus:"",nextText:"Sig&#x3e;",nextStatus:"",nextJumpText:"&#x3e;&#x3e;",nextJumpStatus:"",currentText:"Hoy",currentStatus:"",todayText:"Hoy",todayStatus:"",clearText:"-",clearStatus:"",closeText:"Cerrar",closeStatus:"",yearStatus:"",monthStatus:"",weekText:"Sm",weekStatus:"",dayStatus:"DD d MM",defaultStatus:"",isRTL:false};e.extend(e.datepicker.defaults,e.datepicker.regional["es"])})(jQuery)


//function suscriptionDeclaracion(){$("#formSubcriptionOutlet","#main_container").bind("submit",valida_registro_correo);$("#formSubcriptionOffer","#footer_info").bind("submit",valida_registro_correo)}function valida_registro_correo(a){a.preventDefault();var b=$(this).closest("form").closest("ul");var d=$("#emailSubscriptionOutlet",b);d.removeClass("error");if(d.val()!="Escribe tu Email"){if(valida_correo(d.val())){var c="title=Suscripci&oacute;n a Newsletter&email="+d.val()+"&type=N";$.ajax({cache:false,dataType:"xml",url:"/site/Enviamail",data:c,contentType:"application/xml;charset=utf-8",success:function(e){respuesta_registro($(b))},error:function(){}})}else{d.addClass("error");d.removeClass("placeholder")}}}function respuesta_registro(a){$("#requestSubcriptionOutlet",a).hide();$("#responseSubcriptionOutlet",a).removeClass("hidden").show();$("#responseSubcriptionOutlet",a).css("visibility","show")}function valida_correo(a){if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(a)){return true}return false}function findCategoryHotel(){location.href=$(this).attr("data-href-category")+"&destino="};
