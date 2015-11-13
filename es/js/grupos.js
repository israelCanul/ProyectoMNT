$(document).ready(function(e) {

   var html = "<img src='/img/flag-EN.gif' style='height: 20px;''> 414-921-99-(34 / 35)";
   $("#contact_live").html(html);
   var dateFormat='dd/mm/yy';
	var tour_dates = $( "#group_fecha").datepicker({
		defaultDate: 1,
		changeMonth: false,
		dateFormat: dateFormat,
		minDate: 1,
		numberOfMonths: 1
	});  

  	var tour_dates = $( "#group_fecha2").datepicker({
		defaultDate: 1,
		changeMonth: false,
		dateFormat: dateFormat,
		minDate: 1,
		numberOfMonths: 1
	}); 

	$("#form_grupos").on("submit", function(e){
		$("input[type=submit]").attr("disabled", "disabled");
    	e.preventDefault();
      	if(verifica()){
      		//var error		= $(".mc-valid","#mc").length>0?false:true;
      		var dataString 	= $(this).serialize();
        	//console.log('Datos serializados: '+dataString);
        	$.ajax({
            	type: "POST",
            	url: "/es/grupos/Solicitud",
            	data: dataString,
            	success: function(data) {
                  console.log(data);
                  alert(data);
                  $("#form_grupos")[0].reset();
                  location.reload();
            	},
				error: function(data) {
					alert(data);
				}
        	});

      }else{
			$("input").removeAttr('disabled');
      }
	});


});


	function verifica(){
         var existEvent = false;
         //Verific daca sunt toate evenimentele deselectate
		 
		 $('#checkbox-event input[type=checkbox]:checked').each(function() {
			//$(this).val() es el valor del checkbox correspondiente
			existEvent = true;
		});
		
		if ((window.document.insert.otherEvent.value == "") && (!existEvent)){
            alert("No events selected\nPlease complete in Other Event if your event is different from the purposed ones !");
            window.document.insert.otherEvent.focus();
            return false;
         }
		
         if (window.document.insert.companyName.value == ""){
            alert("Insert company name as required field !");
            window.document.insert.companyName.focus();
            return false;
         }
         if (window.document.insert.title.value == "" ||
            window.document.insert.surname.value == "" ||
            window.document.insert.lastname.value == "" ||
            window.document.insert.city.value == "" ||
            window.document.insert.country.value == "" ||
            window.document.insert.tel.value == ""){
            alert("Insert Contact Person Details in required fields !");
            window.document.insert.title.focus();
            return false;
         }
         var regex = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
         if(!regex.test(window.document.insert.email.value)){
            alert("Email Address of the Contact Person is invalid !");
            window.document.insert.email.focus();
            return false;
         }
         if (window.document.insert.fromDate.value == "" && window.document.insert.untilDate.value == "" && !window.document.insert.noDates.checked){
            alert("Insert Approx. Dates as required fields !");
            window.document.insert.fromDate.focus();
            return false;
         }
         if (window.document.insert.destCity.value == "" || window.document.insert.destCountry.value == ""){
            alert("Insert Destination as required fields !");
            window.document.insert.destCity.focus();
            return false;
         }

         var existAges = false;
         
         //Verific daca sunt toate grupele de varsta deselectate
         for (var i = 0; i < $('.ages').length; i++){
            
            if(eval('window.document.getElementById("ages' + i + '").checked')){

               var existAges = true;
            }
         }
         
         if (isNaN(window.document.insert.numberP.value) || (!existAges)){
            alert("Insert Participants as required fields !");
            window.document.insert.numberP.focus();
            return false;
         }
         var existAcc = false;
         //Verific daca sunt toate evenimentele deselectate
         for (var i = 0; i < $('.accommodation').length; i++){
            if(eval('window.document.getElementById("accommodation' + i + '").checked')){
               existAcc = true;
            }
         }
         if ((window.document.insert.otherAcc.value == "") && (!existAcc)){
            alert("Insert Accommodation Category as required fields !");
            window.document.insert.otherAcc.focus();
            return false;
         }
         var existLoc = false;
         //Verific daca sunt toate evenimentele deselectate
         for (var i = 0; i < $('.location').length; i++){
            if(eval('window.document.getElementById("location' + i + '").checked')){
               existLoc = true;
            }
         }
         if ((window.document.insert.otherLoc.value == "") && (!existLoc)){
            alert("Insert Accommodation Location as required fields !");
            window.document.insert.otherLoc.focus();
            return false;
         }
         if (isNaN(window.document.insert.numberSingle.value) && isNaN(window.document.insert.numberDouble.value) && isNaN(window.document.insert.numberDoubleSingleUse.value) && isNaN(window.document.insert.numberSuite.value)){
            alert("Insert Number of Rooms as required fields !");
            window.document.insert.numberSingle.focus();
            return false;
         }
         var existBudget = false;
         //Verific daca sunt toate grupele de varsta deselectate
         for (var i = 0; i < $('.budget').length; i++){
            if(eval('window.document.getElementById("budget' + i + '").checked')){
               existBudget = true;
            }
         }
         if (isNaN(window.document.insert.amount.value) || window.document.insert.currency.value == "" || !existBudget){
            alert("Insert ESTIMATED BUDGET as required fields !");
            window.document.insert.amount.focus();
            return false;
         }
         return true;
      }
