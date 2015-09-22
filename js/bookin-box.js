


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


$(document).ready(function(){



/* variables  de el js */
var diasHotel=3;


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
                to_picker.open()
            console.log('entro');
        }
        else if ( 'clear' in event ) {
            to_picker.set('min', false,{ format:'mm/dd/yyyy'})
        }
    });
    to_picker.on('set', function(event) {
        if ( event.select ) {
            from_picker.set('max', to_picker.get('select'),{ format:'mm/dd/yyyy'})
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
            $("#TourId").val("0"), $("#dest").val(""), $("#isTourCategory").val(0), 1 == t.item.tipo ? ($("#dest").val(t.item.id), $("#TourId").removeClass("notNull"), $("#ProveedorId").val(0)) : 2 == t.item.tipo ? ($("#TourId").val(t.item.id), $("#dest").removeClass("notNull"), $("#ProveedorId").val(0)) : 3 == t.item.tipo && ($("#dest").val("Category"), $("#TourId").removeClass("notNull"), $("#ProveedorId").val(0), $("#isTourCategory").val(t.item.id)), 4 == t.item.tipo && ($("#TourId").removeClass("notNull"), $("#dest").removeClass("notNull"), $("#ProveedorId").val(t.item.id))
        }
    });


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


// formularios de la pagina bookin de hoteles [Inicio]


$("#hotelRoom").on("change",function(){
$("#dataChild").html("");     
 $("#dataChild").html("");
 $("#guesthab").html("");          
  var hab=$(this).val();
  for (var i = 1; i < hab; i++) {
  var cadena='<div class="col s12 m6 l4">'+
             '<div class="col s12"><h6 class="red white-text" style="padding:5px;">Room <span id="numHab">'+(i+1)+'</span></h6></div>'+
             '<div class="input-field col s12 m12 l6">'+
             '<input required type="number" min="1" max="9" value="" name="hotelAdults_'+i+'" id="hotelAdults"  >'+
             '<label for="hotelAdults">Adult(s)</label>'+
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
                   '<select class="select-child1" required type="number" min="0" max="9" value="" name="child_'+(i)+'_'+(y)+'">'+
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
               '<select class="select-child" required type="number" min="0" max="9" value="" name="child_0_'+i+'">'+
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
// formularios de la pagina bookin de hoteles [Final]


});
 
