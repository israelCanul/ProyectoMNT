// funcion que carga los parametros  de busquedas en hoteles
function generaBookin(habitaciones,detalle){

    var hab=habitaciones;
    if(hab>1) {
        var room = detalle;

        for (var i = 1; i < hab; i++) {
            var details = room[i];
            var cadena = '<div class="col s12 m6 l4">' +
                '<div class="col s12"><h6 class="red white-text" style="padding:5px;">Room <span id="numHab">' + (i + 1) + '</span></h6></div>' +
                '<div class="input-field col s12 m12 l6">' +
                '<input required type="number" min="1" max="9" value="' + details.Adults + '" name="hotelAdults_' + i + '" id="hotelAdults_' + i + '"  >' +
                '<label for="hotelAdults" class="label-activo">Adult(s)</label>' +
                '</div>' +
                '<div class="input-field col s12 m12 l6">' +
                '<select required type="number" min="0" data-hab="' + i + '" class="age_nino1 select-Numchild" value="0" name="hotelChild_' + i + '" id="hotelChild_' + i + '" >';
            for (var a = 0; a < 10; a++) {
                var selected = '';
                if (details.Childs == a) {
                    selected = 'selected="selected"';
                }
                cadena += '<option value="' + a + '" ' + selected + '>' + a + '</option>';
            }

            cadena += '</select>' +
                '<label>Children</label>' +
                '</div>' +
                '<div>';

            $("#guesthab").append(cadena);
        }

        /* se generan las edades de los niños */
        var numCuartos = hab;
        for (var i = 1; i < numCuartos; i++) {
            var details = room[i];
            var hab = $('#hotelChild_' + i).data('hab');
            //console.log("hab: "+hab);
            var num = $('#hotelChild_' + i).val();
            //console.log(num);
            if (num > 0) {
                console.log("hab: " + hab);
                console.log(num);
                var cadena = '<div class="col s12">' +
                    '<div class="col s12"><h6 class="red lighten-3 white-text" style="padding:5px;">Children on room <span id="numHab">' + (hab + 1) + '</span></h6></div>';
                for (var y = 0; y < num; y++) {
                    cadena += '<div class="col s6 m4 l3">' +
                        '<h6 class="red-text" style="padding:5px;">Child <span id="numHab">' + (y + 1) + '</span></h6>' +
                        '<div class="input-field col s12">' +
                        '<select required class="select-child1" required type="number" min="0" max="9" value="" name="child_' + (i) + '_' + (y) + '">';
                    for (var a = 0; a < 10; a++) {
                        var selected = '';
                        if (details.ChildAges[y] == a) {
                            selected = 'selected="selected"';
                        }
                        cadena += '<option value="' + a + '" ' + selected + '>' + a + '</option>';
                    }

                    cadena += '</select>' +
                        '<label>Children</label>' +
                        '</div></div>';
                }
                cadena += '<div>';
                $("#dataChild").append(cadena);
            }
        }
        ;

        $("#dataChild1").html("");

        var num = room[0].ChildAges.length;
        if (num != 0) {
            var cadena = '<div class="col s12">' +
                '<div class="col s12"><h6 class="red lighten-3 white-text" style="padding:5px;">Children on room <span id="numHab">1</span></h6></div>';
            for (var i = 0; i < num; i++) {
                cadena += '<div class="col s6 m3">' +
                    '<h6 class="red-text" style="padding:5px;">Child <span id="numHab">' + (i + 1) + '</span></h6>' +
                    '<div class="input-field col s12">' +
                    '<select required class="select-child" required type="number" min="0" max="9" value="" name="child_0_' + i + '">';
                for (var a = 0; a < 10; a++) {
                    var selected = '';
                    if (room[0].ChildAges[i] == a) {
                        selected = 'selected="selected"';
                    }
                    cadena += '<option value="' + a + '" ' + selected + '>' + a + '</option>';
                }

                cadena += '</select>' +
                    '<label>Children</label>' +
                    '</div></div>';
            }
            cadena += '<div>';
            $("#dataChild1").append(cadena);
        }
    }
}



function despliegalistahoteles() {
    "undefined" != typeof searchToken && $.getJSON("/hoteles/ordenacion.html?hotelName=&Stars=0&minPrice=0&maxPrice=9999999&token=" + searchToken + "&Order=0", function(e) {
        for (var o = [], t = 0; t < e.Hotels.length; t++) o.push({
            label: e.Hotels[t].Name,
            value: e.Hotels[t].Name,
            clave: e.Hotels[t].Id
        });
        $("#hotelName").autocomplete({
            source: function(e, t) {
                if (e.term.length > 0) {
                    var i = new RegExp($.ui.autocomplete.escapeRegex(cambiaSimbolos(e.term)), "i");
                    t($.grep(o, function(e) {
                        return label = e.label, e = e.label, clave = e.value, i.test(label) || i.test(cambiaSimbolos(label))
                    }))
                }
            },
            select: function(e, o) {
                $("#clave_hotel").val(o.item.label), updateResults()
            },
            autoFocus: !0,
            minLength: 2
        })
    })
}

function abrirContenedor(){
    if($("#contenedorBookin").hasClass('oculta')){
        $("#contenedorBookin").switchClass("oculta","nooculta",1000);
    }else{
        $("#contenedorBookin").switchClass("nooculta","oculta",1000);
    }    
}

$(document).ready(function(){
        $(".curved").on("click", function() {
        var valor = $(this).attr("rel");
        var reservaChat = new Array();
        reservaChat["abrirChat"] = "true";
        reservaChat["17"] = "true";
        reservaChat["18"] = "true";
        reservaChat["12"] = "true";
        reservaChat["13"] = "true";
        reservaChat["19"] = "true";
        reservaChat["20"] = "true";
        reservaChat["23"] = "true";
        reservaChat["24"] = "true";
        reservaChat["25"] = "true";
        reservaChat["26"] = "true";
        reservaChat["27"] = "true";
        reservaChat["28"] = "true";
        reservaChat["31"] = "true";
        reservaChat["32"] = "true";
        if (reservaChat[valor]) {
            $("#lhnchatimg").trigger("click");
            return false;
        }
    });

    // realizar que al seleccionar una tab si el bookin esta replegado .. cambie de estado y se despliege
    $('li.tab a').on("click",function(){
        if($("#contenedorBookin").hasClass('oculta')){
            $("#contenedorBookin").switchClass("oculta","nooculta",1000);
        }
    });
    //plegar desplegar el bookin
    $("#ocultarContenedorBookin").on("click",function(){
        console.log("W");
        abrirContenedor();
    });

/* variables  de el js */

/* ////////////////////////////////////////////////////////////////////////////////////////////////////////   */
    var diasTrans=0;
    $('.datepicker-trans').pickadate({
        selectMonths: true,// Creates a dropdown to control month
        selectYears: 15,// Creates a dropdown of 15 years to control year
        min:2,
        // The title label to use for the month nav buttons
        labelMonthNext: 'Next Month',
        labelMonthPrev: 'Beforre Month',
        // The title label to use for the dropdown selectors
        labelMonthSelect: 'Select a Month',
        labelYearSelect: 'Select a year',
        // Months and weekdays
        //monthsFull: [ 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro' ],
        //monthsShort: [ 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez' ],
        //weekdaysFull: [ 'Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado' ],
        //weekdaysShort: [ 'Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab' ],
        // Materialize modified
        //weekdaysLetter: [ 'D', 'S', 'T', 'Q', 'Q', 'S', 'S' ],
        // Today and clear
        today: 'Today',
        clear: 'Clear',
        close: 'Enter',
        // The format to show on the `input` element
        format: 'mm/dd/yyyy',
        onOpen: function() {
            //console.log('Opened up!')
        },
        onClose: function() {
            //console.log('Closed now');
            var from_$input_trans = $('#date-trans-book').pickadate(),
                from_picker_trans = from_$input_trans.pickadate('picker')

            var to_$input = $('#date1-trans-book').pickadate(),
                to_picker = to_$input.pickadate('picker')

            // Check if there’s a “from” or “to” date to start with.
            if ( from_picker_trans.get('value') ) {
                to_picker.set('min', [from_picker_trans.get('select')["year"],from_picker_trans.get('select')["month"],from_picker_trans.get('select')["date"]+diasTrans])

                /*console.log(from_picker_trans.get('select'));*/
            }
            if ( to_picker.get('value') ) {
                from_picker_trans.set('max', to_picker.get('select'))
            }

        },
        onRender: function() {

        },
        onStart: function() {

        },
        onStop: function() {
        },
        onSet: function(thingSet) {

        }
    });
    var to_$input = $('#date1-trans-book').pickadate();
    var to_picker = to_$input.pickadate('picker');
    var from_$input_trans = $('#date-trans-book').pickadate();
    var from_picker_trans = from_$input_trans.pickadate('picker');

    from_picker_trans.on('close', function(event) {
        var to_$input = $('#date1-trans-book').pickadate();
        var to_picker = to_$input.pickadate('picker');
        to_picker.open(true);
    });

    // When something is selected, update the “from” and “to” limits.
    from_picker_trans.on('set', function(event) {
        if ( event.select ) {
            to_picker.set('min', from_picker_trans.get('select'),{ format:'mm/dd/yyyy'}),
                to_picker.set('clear',{ format:'mm/dd/yyyy'}),
                from_picker_trans.close(),
                to_picker.open()
            console.log('entro');
        }
        else if ( 'clear' in event ) {
            to_picker.set('min', false,{ format:'mm/dd/yyyy'})
        }
    });
    to_picker.on('set', function(event) {
        if ( event.select ) {
            from_picker_trans.set('max', to_picker.get('select'),{ format:'mm/dd/yyyy'})

        }
        else if ( 'clear' in event ) {
            from_picker_trans.set('max', false,{ format:'mm/dd/yyyy'})
        }
    });





/* /////////////////////////////////////////////////////////////////////////////////////////////////////////   */
    var diasHotel=3;// dia de diferencia para la reserva y regreso

$('.datepicker-hotel').pickadate({
    selectMonths: true,// Creates a dropdown to control month
    selectYears: 15,// Creates a dropdown of 15 years to control year
    min:2,
    // The title label to use for the month nav buttons
    labelMonthNext: 'Next Month',
    labelMonthPrev: 'Beforre Month',
    // The title label to use for the dropdown selectors
    labelMonthSelect: 'Select a Month',
    labelYearSelect: 'Select a year',
    // Months and weekdays
    //monthsFull: [ 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro' ],
    //monthsShort: [ 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez' ],
    //weekdaysFull: [ 'Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado' ],
    //weekdaysShort: [ 'Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab' ],
    // Materialize modified
    //weekdaysLetter: [ 'D', 'S', 'T', 'Q', 'Q', 'S', 'S' ],
    // Today and clear
    today: 'Today',
    clear: 'Clear',
    close: 'Enter',
    // The format to show on the `input` element
        format: 'mm/dd/yyyy',
          onOpen: function() {
            //console.log('Opened up!')
          },
      onClose: function() {
        //console.log('Closed now');
            var from_$input = $('#hotelCheckin').pickadate(),
            from_picker = from_$input.pickadate('picker')

           var to_$input = $('#hotelCheckout').pickadate(),
               to_picker = to_$input.pickadate('picker')

           // Check if there’s a “from” or “to” date to start with.
           if ( from_picker.get('value') ) {
             to_picker.set('min', [from_picker.get('select')["year"],from_picker.get('select')["month"],from_picker.get('select')["date"]+diasHotel])

             /*console.log(from_picker.get('select'));*/
           }
           if ( to_picker.get('value') ) {
             from_picker.set('max', to_picker.get('select'))
           }

      },
      onRender: function() {

      },
      onStart: function() {

      },
      onStop: function() {
      },
      onSet: function(thingSet) {

      }    
});
    var to_$input = $('#hotelCheckout').pickadate();
    var to_picker = to_$input.pickadate('picker');
    var from_$input = $('#hotelCheckin').pickadate();
    var from_picker = from_$input.pickadate('picker');

    from_picker.on('close', function(event) {
        var to_$input = $('#hotelCheckout').pickadate();
        var to_picker = to_$input.pickadate('picker');
        to_picker.open(true);
    });

    // When something is selected, update the “from” and “to” limits.
    from_picker.on('set', function(event) {
        if ( event.select ) {
            to_picker.set('min', from_picker.get('select'),{ format:'mm/dd/yyyy'}),
                to_picker.set('clear',{ format:'mm/dd/yyyy'}),
                from_picker.close(),
                setTimeout(function(){
                   to_picker.open(); 
                },8000); 
            console.log('entro');
        }
        else if ( 'clear' in event ) {
            to_picker.set('min', false,{ format:'mm/dd/yyyy'})
        }
    });
    to_picker.on('set', function(event) {
        if ( event.select ) {
            from_picker.set('max', to_picker.get('select'),{ format:'mm/dd/yyyy'}),
            to_picker.close()
        }
        else if ( 'clear' in event ) {
            from_picker.set('max', false,{ format:'mm/dd/yyyy'})
        }
    });


$('.datepicker').pickadate({
    selectMonths: true,// Creates a dropdown to control month
    selectYears: 15,// Creates a dropdown of 15 years to control year
    min:2,
    // The title label to use for the month nav buttons
    labelMonthNext: 'Next Month',
    labelMonthPrev: 'Beforre Month',
    // The title label to use for the dropdown selectors
    labelMonthSelect: 'Select a Month',
    labelYearSelect: 'Select a year',
    // Months and weekdays
    //monthsFull: [ 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro' ],
    //monthsShort: [ 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez' ],
    //weekdaysFull: [ 'Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado' ],
    //weekdaysShort: [ 'Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab' ],
    // Materialize modified
    //weekdaysLetter: [ 'D', 'S', 'T', 'Q', 'Q', 'S', 'S' ],
    // Today and clear
    today: 'Today',
    clear: 'Clear',
    close: 'Close',
    // The format to show on the `input` element
      format: 'mm/dd/yyyy',
      onOpen: function() {
            //console.log('Opened up!')
      },
      onClose: function() {
        //console.log('Closed now');
      },
      onRender: function() {
        //    
      },
      onStart: function() {
        //console.log('Hello there :)')
      },
      onStop: function() {
        //console.log('See ya')
      },
      onSet: function(thingSet) {
          this.close();
      }    
});


//////////////////////////////////////////////////////////////////////////////////////////////////////
        
        // autocomplete customisado para el bookin
        $.widget("custom.MixCombo", $.ui.autocomplete, {
            _create: function() {
                this._super();
                this.widget().menu("option", "items", "> :not(.ui-autocomplete-category)");
            },
            _renderItem: function( ul, item ) {
                return $( "<li>" )
                    .attr("data-value", item.value)
                    .data("ui-autocomplete-item", item)
                    .data("item", item)
                    .append(item.label)
                    .appendTo( ul );
            },
            _renderMenu:function(e,t){
                var n=this,r="";
                $.each(t,function(t,i){
                    if(i.categoria!=r){
                        e.append("<li class='ui-autocomplete-category ui-autocomplete-destination'>"+i.categoria+"</li>");
                        r=i.categoria
                    }
                    n._renderItem(e,i);
                });
            }
        });
////////////////////////////////////////////////////////////////////////////////////////////////////////////

$("#hotel_destination").MixCombo({
    delay: 0,
    minLength: 3,
    source: function(e, t) {
        var o = new RegExp($.ui.autocomplete.escapeRegex(e.term), "i");
        t($.grep(HotelsData, function(e) {
            return e = e.label || e.value || e, o.test(e) || o.test(normalize(e))
        })), $("#HotelId").addClass("notNull"), $("#HotelId").val(""), $("#hotel_keyword").val(""), $("#cCode").addClass("notNull"), $("#cCode").val("")
    },
    change: function(e, t) {
        $("#HotelId").val(""), $("#cCode").val(""), null == t.item || void 0 == t.item ? $(this).val("") : 1 == t.item.tipo ? ($("#cCode").val(t.item.id), $("#HotelId").removeClass("notNull")) : ($("#HotelId").val(t.item.id), $("#hotel_keyword").val(t.item.keyword), $("#cCode").removeClass("notNull"))
    },
    select: function(e, t) {
        console.log(t.item.id);
        1 == t.item.tipo ? ($("#cCode").val(t.item.id), $("#HotelId").removeClass("notNull")) : ($("#HotelId").val(t.item.id), $("#hotel_keyword").val(t.item.keyword), $("#cCode").removeClass("notNull"))
    }
});

    ////////////////////////////////////////////////////////////// autocomplete y funciones de transfers [Inicio]  ///////////////////
    $("#transfer_from").MixCombo({
        delay: 0,
        minLength: 3,
        source: function(e, t) {
            var o = new RegExp($.ui.autocomplete.escapeRegex(e.term), "i");
            t($.grep(transferData, function(e) {
                return e = e.label || e.value || e, o.test(e) || o.test(normalize(e))
            }))
        },
        change: function(e, t) {

        },
        select: function(e, t) {
            $("#clave_ini").val(t.item.id);
            $("#transfer_option_hotel").val("");
            setAutocomplete(t.item.id,t.item.zona);
        }
    });
    setAutocomplete(1,1);


    function setAutocomplete(dest,zona){
        var url="http://beta.etravelpartners.com/RestTransfers/FindDestinations.html?zona_inicio="+dest+":"+zona+"&lan=en";
        var data=[];
        $.ajax({
            url: url,
            dataType: "json",
            success: function(response) {
             data=response;
            }
        });

        $("#transfer_option_hotel").MixCombo({
            delay: 0,
            minLength: 3,
            source: function(e, t) {
                var o = new RegExp($.ui.autocomplete.escapeRegex(e.term), "i");
                t($.grep(data, function(e) {
                    return e = e.label || e.value || e, o.test(e) || o.test(normalize(e))
                }))
            },
            change: function(e, t) {

            },
            select: function(e, t) {
                $("#clave_end").val(t.item.id);
                $("#clave_transfer").val(t.item.clave);
                if($("#clave_end").val() == $("#clave_ini").val()){
                    $("#clave_end").val("");
                    $("#transfer_option_hotel").val("");
                    $("#transfer_option_hotel").text('');
                    Materialize.toast('wrong!,The origin and  destination is the same', 5000, 'rounded') // 'rounded' is the class I'm applying to the toast
                    return false;
                }else{
                    $("#clave_end").val(t.item.id);
                }
            }
        });
    }

    $("#AirportCode_in").change(function () {
        if($(this).val()==1){
            $("#clave_ini").val("1");
            $("#transfer_option_hotel").val("");
            setAutocomplete(1,1);
        }else{
            $("#clave_ini").val("361");
            $("#transfer_option_hotel").val("");
            setAutocomplete(361,11);
        }
    });

    $("#transfer_option_type").change(function(){
        switch (parseInt($(this).val())){
           case 1:
               $("#round_trip").val("1");
               $("#hotel_ini").addClass("hide");
               $("#airport_ini").removeClass("hide");
               $("#date1-trans-book-wrap").removeClass("hide");
               break;
            case 2:
                $("#round_trip").val("0");
                $("#hotel_ini").addClass("hide");
                $("#airport_ini").removeClass("hide");
                $("#date1-trans-book-wrap").addClass("hide");
                break;
            case 3:
                $("#round_trip").val("0");
                $("#hotel_ini").addClass("hide");
                $("#airport_ini").removeClass("hide");
                $("#date1-trans-book-wrap").addClass("hide");
                break;
            case 4:
                $("#round_trip").val("0");
                $("#hotel_ini").removeClass("hide");
                $("#airport_ini").addClass("hide");
                $("#date1-trans-book-wrap").addClass("hide");
                break;
            case 5:
                $("#round_trip").val("1");
                $("#hotel_ini").removeClass("hide");
                $("#airport_ini").addClass("hide");
                $("#date1-trans-book-wrap").removeClass("hide");
                break;
        }
        $("#transfer_option_hotel").val("");

    });


    ////////////////////////////////////////////////////////////// autocomplete y funciones de transfers [Final] ///////////////////

    /* validate del formulario de bookin [Inicio]*/

    $("#book_hotels").validate();
    $("#book_tours").validate();
    $("#book_tranfers").validate();

    /* validate del formulario de bookin [final]*/


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////77
$("#tour_destination").MixCombo({
        delay: 0,
        minLength: 3,
        source: function(e, t) {
            var o = new RegExp($.ui.autocomplete.escapeRegex(e.term), "i");
            t($.grep(ToursData, function(e) {
                return e = e.label || e.value || e, o.test(e) || o.test(normalize(e))
            })), $("#TourId").addClass("notNull"), $("#dest").addClass("notNull")
        },
        change: function(e, t) {
            (null == t.item || void 0 == t.item) && $(this).val("")
        },
        select: function(e, t) {
            $("#cat").val("");
            $("#TourId").val("");
            $("#sup").val("");
            $("#dest").val("");
            $("#clave").val("");
            if (t.item.tipo == 'category')  $("#cat").val(t.item.id);
            if (t.item.tipo == 'tour')  $("#TourId").val(t.item.id) ;
            if (t.item.tipo == 'supplier') $("#sup").val(t.item.id);
            if (t.item.tipo == 'destination') $("#dest").val(t.item.id);
            $("#clave").val(t.item.clave);
            $("#tipo").val(t.item.tipo);
            console.log(t.item.id);
            console.log(t.item.tipo);
        }
    });

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var accentMap = {
    "á": "a",
    "é": "e",
    "í": "i",
    "ó": "o",
    "ú": "u"
};
var normalize = function(e) {
    for (var t = "", o = 0; o < e.length; o++) t += accentMap[e.charAt(o)] || e.charAt(o);
    return t
};

Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};


// formularios de la pagina bookin de hoteles [Inicio] /////////////////////////////////////////////////////////////////

$("#hotelRoom").on("change",function(){
 $("#dataChild").html("");
 $("#dataChild").html("");
 $("#guesthab").html("");          
  var hab=$(this).val();
  for (var i = 1; i < hab; i++) {
  var cadena='<div class="col s12 m6 l4">'+
             '<div class="col s12"><h6 class="red white-text" style="padding:5px;">Room <span id="numHab">'+(i+1)+'</span></h6></div>'+
             '<div class="input-field col s12 m12 l6">'+
             '<input required type="number" min="1" max="9" value="" name="hotelAdults_'+i+'" id="hotelAdults_'+i+'"  >'+
             '<label for="hotelAdults" class="label-activo">Adult(s)</label>'+
             '</div>'+
             '<div class="input-field col s12 m12 l6">'+
             '<select required type="number" min="0" data-hab="'+i+'" class="age_nino1 select-Numchild" value="0" name="hotelChild_'+i+'" id="hotelChild_'+i+'" >'+
        '<option value="0">0</option>'+
        '<option value="1">1</option>'+
        '<option value="2">2</option>'+
        '<option value="3">3</option>'+
        '<option value="4">4</option>'+
        '<option value="5">5</option>'+
        '<option value="6">6</option>'+
        '<option value="7">7</option>'+
        '<option value="8">8</option>'+
        '<option value="9">9</option>'+
      '</select>'+  
             '<label>Children</label>'+
             '</div>'+
             '<div>'; 
    
      $("#guesthab").append(cadena);
  }
 $('.select-Numchild').material_select();// inicializar los select de la pagina
 
   $(".age_nino1").on("change",function(){
      $("#dataChild").html("");
      var numCuartos=$("#hotelRoom").val();
      for (var i =1; i < numCuartos; i++) {
      var hab=$('#hotelChild_'+i).data('hab');
      //console.log("hab: "+hab);
      var num=$('#hotelChild_'+i).val();
      //console.log(num);
      if(num>0){
        console.log("hab: "+hab);
        console.log(num);
        var cadena='<div class="col s12">'+
                 '<div class="col s12"><h6 class="red lighten-3 white-text" style="padding:5px;">Children on room <span id="numHab">'+(hab+1)+'</span></h6></div>';
           for (var y = 0; y < num; y++) {
           cadena+='<div class="col s6 m4 l3">'+
               '<h6 class="red-text" style="padding:5px;">Child <span id="numHab">'+(y+1)+'</span></h6>'+
               '<div class="input-field col s12">'+
                   '<select required class="select-child1" required type="number" min="0" max="9" value="" name="child_'+(i)+'_'+(y)+'">'+
              '<option value="">0</option>'+
              '<option value="1">1</option>'+
              '<option value="2">2</option>'+
              '<option value="3">3</option>'+
              '<option value="4">4</option>'+
              '<option value="5">5</option>'+
              '<option value="6">6</option>'+
              '<option value="7">7</option>'+
              '<option value="8">8</option>'+
              '<option value="9">9</option>'+
             '</select>'+
                   '<label>Children</label>'+
                   '</div></div>';
         }
          cadena+='<div>';
          $("#dataChild").append(cadena);
      }
      };
      $('.select-child1').material_select();// inicializar los select de la pagina
      return false;

  });
});


    $(".age_nino1").on("change",function(){
        $("#dataChild").html("");
        var numCuartos=$("#hotelRoom").val();
        for (var i =1; i < numCuartos; i++) {
            var hab=$('#hotelChild_'+i).data('hab');
            //console.log("hab: "+hab);
            var num=$('#hotelChild_'+i).val();
            //console.log(num);
            if(num>0){
                console.log("hab: "+hab);
                console.log(num);
                var cadena='<div class="col s12">'+
                    '<div class="col s12"><h6 class="red lighten-3 white-text" style="padding:5px;">Children on room <span id="numHab">'+(hab+1)+'</span></h6></div>';
                for (var y = 0; y < num; y++) {
                    cadena+='<div class="col s6 m4 l3">'+
                        '<h6 class="red-text" style="padding:5px;">Child <span id="numHab">'+(y+1)+'</span></h6>'+
                        '<div class="input-field col s12">'+
                        '<select required class="select-child1" required type="number" min="0" max="9" value="" name="child_'+(i)+'_'+(y)+'">'+
                        '<option value="">0</option>'+
                        '<option value="1">1</option>'+
                        '<option value="2">2</option>'+
                        '<option value="3">3</option>'+
                        '<option value="4">4</option>'+
                        '<option value="5">5</option>'+
                        '<option value="6">6</option>'+
                        '<option value="7">7</option>'+
                        '<option value="8">8</option>'+
                        '<option value="9">9</option>'+
                        '</select>'+
                        '<label>Children</label>'+
                        '</div></div>';
                }
                cadena+='<div>';
                $("#dataChild").append(cadena);
            }
        };
        $('.select-child1').material_select();// inicializar los select de la pagina
        return false;

    });


$(".age_nino").change(function(){
  $("#dataChild1").html("");          
  var hab=$(this).data('hab');
  console.log(hab);
  var num=$(this).val();
  if(num==0) return false;
  var cadena='<div class="col s12">'+
             '<div class="col s12"><h6 class="red lighten-3 white-text" style="padding:5px;">Children on room <span id="numHab">'+(hab+1)+'</span></h6></div>';
    for (var i = 0; i < num; i++) {
       cadena+='<div class="col s6 m3">'+
           '<h6 class="red-text" style="padding:5px;">Child <span id="numHab">'+(i+1)+'</span></h6>'+
           '<div class="input-field col s12">'+
               '<select required class="select-child" required type="number" min="0" max="9" value="" name="child_0_'+i+'">'+
          '<option value="">0</option>'+
          '<option value="1">1</option>'+
          '<option value="2">2</option>'+
          '<option value="3">3</option>'+
          '<option value="4">4</option>'+
          '<option value="5">5</option>'+
          '<option value="6">6</option>'+
          '<option value="7">7</option>'+
          '<option value="8">8</option>'+
          '<option value="9">9</option>'+
         '</select>'+              
               '<label>Children</label>'+
               '</div></div>';           
     }
    cadena+='<div>';
  $("#dataChild1").append(cadena);
  $('.select-child').material_select();// inicializar los select de la pagina
});

// formularios de la pagina bookin de hoteles [Final] ///////////////////////////////////////////////////////////////


});
 
