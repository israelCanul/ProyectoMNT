<?php
    $fecha_inicial = date("Y-m-d",mktime(0,0,0,date("m"),date("d")+3,date("Y")));
    $fecha_final   = date("Y-m-d",mktime(0,0,0,date("m"),date("d")+6,date("Y")));
    $fecha         = date("m/d/Y",mktime(0,0,0,date("m"),date("d")+3,date("Y")));
    $fecha2        = date("d/m/Y",mktime(0,0,0,date("m"),date("d")+3,date("Y")));
    $checkIn       = date("Y-m-d",mktime(0,0,0,date("m"),date("d") + 2,date("Y")));
    $checkOut      = date("Y-m-d",mktime(0,0,0,date("m"),date("d") + 3,date("Y")));
    $vz            = array(4,5,3,25,23,20,6,10,21,22);
    $tM            = array(2,3,5,6,7,8,9,11,12,14);
    $languaje      = strtoupper(Yii::app()->language);

?>
<style type="text/css">
input[type=text], input[type=password], input[type=email], input[type=url], input[type=time], input[type=date], input[type=datetime-local], input[type=tel], input[type=number], input[type=search], textarea.materialize-textarea {
    background-color: transparent;
    border: none;
    border: 1px solid #9e9e9e;
    border-radius: 0;
    outline: none;
    height: 3rem;
    width: 100%;
    font-size: 1rem;
    margin: 0 0 15px 0;
    padding: 0;
    box-shadow: none;
    -webkit-box-sizing: content-box;
    -moz-box-sizing: content-box;
    box-sizing: content-box;
    transition: all .3s;
}

</style>
<div class="row"></div>
<div class="row">
<div class="col s12 m10 offset-m1">
    <div  class="row">
        <div  class="col s12 m10 offset-m1">
            
            <div>
               
                <img class="grupsImg responsive-img" src="<?php echo Yii::app()->request->baseUrl; ?>/images/bg/groups.jpg" alt="Deals" />

            </div>

        </div>
    </div>
    <div class="bloque">
        <div id="text-groups">
            <p>En Lomas Travel tenemos un &aacute;rea exclusiva para sus viajes en grupo a Canc&uacute;n y la Riviera Maya. 
                Rel&aacute;jese y permita que profesionales del turismo se hagan cargo de la reservación de vuelos, 
                hoteles, traslados y actividades de su grupo.</p>

            <div class="expert_groups">
                <p>Nos especializamos en: </p>
                <ul>
                    <li>Vacaciones familiares</li>
                    <li>Viajes entre amigos</li>
                    <li>Viajes de incentivo</li>
                    <li>Convenciones</li>
                </ul>

                <ul>
                    <li> Viajes de graduaci&oacute;n </li>
                    <li>Bodas</li>
                    <li>Eventos corporativos</li>
                    <li>Actividades y tours para grupos</li>
                </ul>
            </div>


            <p>P&oacute;ngase en contacto con nosotros y compruebe lo f&aacute;cil que es organizar su viaje grupal a Canc&uacute;n y la Riviera Maya con Lomas Travel.</p>
        </div>
        <div id="form_groups">
            <form class="form-horizontal" id="form_grupos" name="insert" method="post">
                <div class="row">
                    <div class="col s12"><h4>DETALLE DE GRUPO</h4></div>
                </div>
                <div class="control-group card-panel">
                    <h5 class="red-text" for="event">Evento:<span class="textRed">*</span></h5>
                    <div id="checkbox-event" class ="row">
                        <div class="input-field col s12 m4 l2">
                            <input class="" type="checkbox" id="event0" name="event[0]" value="Incentive" />
                            <label for='event0'>Incentivo</label>
                        </div>
                        <div class="input-field col s12 m4 l2">
                            <input type="checkbox" class="" name="event[1]" id="event1" value="Conference" />
                            <label for='event1'>Conferencia</label>
                        </div>
                        <div class="input-field col s12 m4 l2">
                            <input type="checkbox" id="event2" class="" name="event[2]" value="Meeting/Seminar" /> 
                            <label for='event2'>Reunión/Seminario</label>
                        </div>                   
                        <div class="input-field col s12 m4 l2">
                            <input type="checkbox" id="event3" class="" name="event[3]" value="Workshop" />
                            <label for='event3'>Taller</label>
                        </div>                   
                        <div class="input-field col s12 m4 l2">
                            <input type="checkbox" id='event4' class="" name="event[4]" value="Product Presentation" />
                            <label for='event4'>Presentación de un Producto</label>
                        </div>    
                        <div class="row"></div>                    
                        <div class="input-field col s12 m4 l4">
                            <input type="text" id="otherevent" class="" name="otherEvent" value="" class="classBaseColorLightTone" size="30"/>
                            <label for="otherevent">Otro Evento:</label>
                        </div>
                    </div>
                </div>
                
                <div class="control-group card-panel">
                    <div class="row">
                        <h5 class="red-text" for="event">Nombre de la Compañía:<span class="textRed">*</span></h5>
                        <div class="input-field col s12 m4 l4">
                            <input type="text" name="companyName" id="companyName" value="" size="47"/>
                        </div>
                    </div>
                </div>
                <div class="control-group card-panel">
                    <div class="row">
                        <div class="col s12 m8 l5">
                            <h5 class="red-text" for="event">Detalles de contacto<span class="textRed">*</span></h5>
                            <div >
                                <label>Título:<span class="textRed">*</span></label>
                                <input type="text" name="title" value="" class="classBaseColorLightTone" size="15" />
                            </div>
                            <div  >
                                <label>Apellido:<span class="textRed">*</span></label>
                                <input type="text" name="surname" value="" class="classBaseColorLightTone" size="15" />
                            </div>
                            <div  >
                                <label> Nombre:<span class="textRed">*</span></label>
                                <input type="text" name="lastname" value="" class="classBaseColorLightTone" size="15" />
                            </div>
                            <div  >
                                <label> Dirección:</label>
                                <input type="text" name="address" value="" class="classBaseColorLightTone"  size="36"/>
                            </div>
                            <div  >
                                <label> Ciudad:</label>
                                <input type="text" name="zip" value="" class="classBaseColorLightTone"  size="15" />
                            </div>
                            <div  >
                                <label> City:<span class="textRed">*</span> </label>
                                <input type="text" name="city" value="" class="classBaseColorLightTone"  size="15" />
                            </div>
                            <div  >
                                <label> Provincia: </label>
                                <input type="text" name="state" value="" class="classBaseColorLightTone"  size="15" />
                            </div>
                            <div  >
                                <label> País:<span class="textRed">*</span> </label>
                                <input type="text" name="country" value="" class="classBaseColorLightTone"  size="10"/>
                            </div>
                            <div  >
                                <label> Tel (Código de País):<span class="textRed">*</span> </label>
                                <input type="text" name="tel" value="" class="classBaseColorLightTone" size="17"/>
                            </div>
                            <div  >
                                <label> Fax: </label>
                                <input type="text" name="fax" value="" class="classBaseColorLightTone" size="15" />
                            </div>
                            <div  >
                                <label> E-Mail:<span class="textRed">*</span> </label>
                                <input type="text" name="email" value="" class="classBaseColorLightTone" size="39"/>
                            </div>
                            <div >
                                <label> Web: </label>
                                <input type="text" name="web" value="" class="classBaseColorLightTone" size="36"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12"><h4>SOLICITUD DE RESERVA</h4></div>
                </div>

                <div class="control-group card-panel">
                    <div class="row">
                        <h5 class="red-text" for="event">Días Aprox:<span class="textRed">*</span></h5>
                        <div class="col s12 m6 l5">
                            <label> Desde: </label>
                            <input type="text" id="group_fecha" name="fromDate" value="<?=Yii::app()->GenericFunctions->convertPresentableDates($checkIn); ?>" class="classBaseColorLightTone" size="20"/> &nbsp;&nbsp;&nbsp;
                        </div>
                        <div class="col s12 m6 l5">
                            <label>Hasta: </label>
                            <input type="text" id="group_fecha2" name="untilDate" value="<?=Yii::app()->GenericFunctions->convertPresentableDates($checkOut); ?>" class="classBaseColorLightTone" size="20"/> &nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="row">
                        <h5 class="red-text" for="event">Destino:<span class="textRed">*</span></h5>
                        <div class="col s12 m6 l5">
                            <label> Ciudad: <span class="textRed">*</span></label>
                            <input type="text" name="destCity" value="" class="classBaseColorLightTone" size="20"/>
                        </div>
                        <div class="col s12 m6 l5">
                            <label>Provincia: </label>
                            <input type="text" name="destState" value="" class="classBaseColorLightTone" size="20"/>
                        </div>
                        <div class="col s12 m6 l5">
                            <label>País:<span class="textRed">*</span></label>
                            <input type="text" name="destCountry" value="" class="classBaseColorLightTone" size="20"/>
                        </div>
                    </div>
                    <div class="row">    
                        <h5 class="red-text" for="event">Participantes:<span class="textRed">*</span></h5>
                        <div class="col s12 m4 l2">
                            Número:
                            <input type="number" min="0" name="numberP" value="" class="classBaseColorLightTone" size="5"/>
                        </div>
                        <div class = "col s12">
                            <h6> Edad promedio.: </h6>
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox"  name="ages[1]"  class="ages" id="ages0" value="20-40 years" />
                                <label for='ages0'>20-40 años</label>
                            </div>
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox" class="ages" name="ages[2]" id="ages1" value="40-60 years" />
                                <label for='ages1'>40-60 años</label>
                            </div>
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox" class="ages" name="ages[3]" id="ages2" value="60+ years" />
                                <label for='ages2'>60+ años</label>
                            </div>
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox" class="ages" name="ages[4]" id="ages3" value="Mixed Ages" />
                                <label for='ages3'>Variedad de edades</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12"><h4>ALOJAMIENTO</h4></div>
                </div>

                <div class="control-group card-panel">
                    <div class="row">
                            <h5 class="red-text" for="event">Categoría:<span class="textRed">*</span></h5>
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox" class="accommodation" name="accommodation[0]" value="Hotel" id="accommodation0"/>
                                <label for="accommodation0">Hotel</label>
                            </div>
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox" class="accommodation" name="accommodation[1]" value="Apartments" id="accommodation1"/>
                                <label for="accommodation1">Apartamento</label>
                            </div>
                            <div class="input-field col s12 m4 l3">
                                <input type="checkbox" class="accommodation" name="accommodation[2]" value="Private Villa/Finca" id="accommodation2"/>
                                <label for="accommodation2">Villa Privada/Finca</label>
                            </div>
                            <div class="row"></div>
                            <div class="input-field col s12 m3">
                                <input type="text" name="otherAcc" id="otherAcc" value="" class="classBaseColorLightTone" size="45"/>
                                <label for="otherAcc">Otro</label>
                            </div>                                                                         
                    </div>
                    <div class="row">    
                       
                            <h5 class="red-text" for="event">Locación:<span class="textRed">*</span></h5>
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox" name="location[0]" class="location" value="Town Centre" id="location0"/>
                                <label for="location0">Centro De La Ciudad</label>
                            </div>
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox" name="location[1]" class="location" value="Beach" id="location1"/>
                                <label for="location1">Playa</label>
                            </div>
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox" name="location[2]" class="location" value="Rural" id="location2"/> 
                                <label for="location2">Rural</label>
                            </div>
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox" name="location[3]" class="location" value="Mountains" id="location3"/>
                                <label for="location3">Mountañas</label>
                            </div>
                            <div class="row"></div>
                            <div class="input-field col s12 m4">
                                <input type="text" name="otherLoc" id="otherLoc" value="" class="classBaseColorLightTone" size="38"/>
                                <label for="otherLoc">Otro</label>
                            </div>                             
                        
                    </div>
                    <div class="row">    
                        <h5 class="red-text" for="event">Número de cuartos:<span class="textRed">*</span></h5>
                        
                        <div class="col s12 m4 l3">
                            Sencillo:
                            <input type="number" min="0" name="numberSingle" value="" class="classBaseColorLightTone" size="7"/> 
                        </div>
                        <div class="col s12 m4 l3">
                            Doble:
                            <input type="number" min="0" name="numberDouble" value="" class="classBaseColorLightTone" size="7"/>
                        </div>
                        <div class="col s12 m4 l3">

                            Doble de uso individual: 
                            <input type="number" min="0" name="numberDoubleSingleUse" value="" class="classBaseColorLightTone" size="6"/>
                        </div>
                        <div class="col s12 m4 l3">
                            Suites: 
                            <input type="number" min="0" name="numberSuite" value="" class="classBaseColorLightTone" size="6"/>
                        </div>
                    </div>
                    <div class="row">    
                            <h5 class="red-text" for="event">Comidas:<span class="textRed">*</span></h5>
                            <div class="input-field col s12 m4 l3">
                                <input type="checkbox" name="meals[0]" class="meals" value="Bed & Breakfast" id="meals0"/>
                                <label for="meals0">Alojamiento y desayuno</label>
                            </div>
                            <div class="input-field col s12 m4 l3">
                                <input type="checkbox" name="meals[1]" class="meals" value="Half Board" id="meals1"/>
                                <label for="meals1">Media Pensión</label>
                            </div>
                            <div class="input-field col s12 m4 l3">
                                <input type="checkbox" name="meals[2]" class="meals" value="Full Board" id="meals2"/> 
                                <label for="meals2">Pensión Completa</label>
                            </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col s12"><h4>INSTALACIONES DE CONFERENCIAS</h4></div>
                </div>

                <div class="control-group card-panel">
                    <div class="row">
                        
                        <h5 class="red-text" for="event">Conferencia / Sala de reuniones para:<span class="textRed">*</span></h5>
                        <div class="col s12 m4">
                            <label> personas</label>
                            <input type="number" min="0" name="confPeople" value="" class="classBaseColorLightTone" size="10"/>
                        </div>
                    </div>
                    <div class="row">
                        <h5 class="red-text" for="event">Sala de reuniones para:<span class="textRed">*</span></h5>
                        <div class = "checkbox-group">
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox" name="roomType[0]" class="roomType" value="Classroom" id="roomType0"/>
                                <label for="roomType0">Salón de clases</label>
                            </div>
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox" name="roomType[1]" class="roomType" value="Theatre" id="roomType1"/> 
                                <label for="roomType1">Teatro</label>
                            </div>
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox" name="roomType[2]" class="roomType" value="U-shape" id="roomType2"/>
                                <label for="roomType2">U-shape</label>
                            </div>
                            <div class="row"></div>
                            <div class="input-field col s12 m4">
                                <input type="text" name="otherRoomType" id="otherRoomType" value="" class="classBaseColorLightTone" size="34"/>
                                <label for="otherRoomType">Otro:</label>
                            </div>                          
                        </div>
                    </div>
                    <div class="row">

                            <h5 class="red-text" for="event">Equipo:<span class="textRed">*</span></h5>
                            <div class="input-field col s12 ">
                                <input type="checkbox" name="techEquip" id="techEquip"/>
                                <label for="techEquip">Equipo Técnico Necesario</label>
                            </div>                            
                            <div class="row"></div>
                            <div class="input-field col s12 ">
                                <textarea name="detailsTechEquip" id="detailsTechEquip" rows="4" cols="110" class="classBaseColorLightTone"></textarea>
                                
                            </div>
                    </div>
                    <div class="row">
                            <h5 class="red-text" for="event">Alimentación y bebidas:<span class="textRed">*</span></h5>                    
                            <div class="input-field col s12 ">
                                <input type="checkbox" name="foodBev" id="foodBev"/>
                                <label for="foodBev">Alimentación y bebidas Servicio Necesario</label>
                            </div>                            
                            <div class="row"></div>
                            <div class="input-field col s12 ">
                                <textarea name="detailsFoodBev" id="detailsFoodBev" rows="4" cols="110" class="classBaseColorLightTone"></textarea>
                                
                            </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col s12"><h4>PRESUPUESTO ESTIMADO</h4></div>
                </div>

                <div class="control-group card-panel">
                    <h5 class="red-text" for="event">Presupuesto estimado:<span class="textRed">*</span></h5>
                    <h6>
                       Para asegurarnos de que le mostramos las ofertas más relevantes para los participantes de su grupo,
                        es importante que nos haga saber su presupuesto.<br>
                    </h6>
                    <div class="row">
                        <div class="input-field col s12 m6 l4">
                            <input type="checkbox" name="budget[0]" class="budget" value="Per person" id="budget0"/>
                            <label for="budget0">Por persona</label>
                        </div>
                        <div class="input-field col s12 m6 l4">
                            <input type="checkbox" name="budget[1]" class="budget" value="Group Total" id="budget1"/>
                            <label for="budget1">Total en grupo</label>
                        </div>
                    </div>
                    <div class="row">
                            <div class="input-field col s12 m4">
                                <input type="number" min="0" name="amount" id="amount" value="" class="classBaseColorLightTone" size="10"/>
                                <label for="amount">Cantidad:</label>
                            </div>                      
                            <div class="input-field col s12 m4">
                                <input type="text" name="currency" id="currency" value="" class="classBaseColorLightTone number_input" size="10"/>
                                <label for="currency">Moneda:</label>
                            </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="col s12"><h4>PROGRAMA</h4></div>
                </div>
                <div class="control-group card-panel">
                    <div class="row">
                        <h5 class="red-text" for="event">Programa:<span class="textRed">*</span></h5>
                    
                        <div class="input-field col s12 m4 l4">
                            <input type="checkbox" name="program[0]" class="program" value="None" id="program0"/>
                            <label for="program0">Ninguno</label>
                        </div>
                        <div class="input-field col s12 m4 l4">
                            <input type="checkbox" name="program[1]" class="program" value="Culture" id="program1"/>
                            <label for="program1">Cultural</label>
                        </div>
                        <div class="input-field col s12 m4 l4">
                            <input type="checkbox" name="program[3]" class="program" value="Leisure" id="program3"/>
                            <label for="program3">Ocio</label>
                        </div>
                        <div class="input-field col s12 m4 l4">
                            <input type="checkbox" name="program[4]" class="program" value="Gastronomy/Wine" id="program4"/>
                            <label for="program4">Gastronomía/Vinos</label>
                        </div>
                        <div class="input-field col s12 m4 l4">
                            <input type="checkbox" name="program[5]" class="program" value="Golf" id="program5"/>
                            <label for="program5">Golf</label>
                        </div>
                        <div class="input-field col s12 m4 l4">
                            <input type="checkbox" name="program[6]" class="program" value="Health & Beauty/Wellness" id="program6"/>
                            <label for="program6">Salud & Belleza/Bienestar</label>
                        </div>
                        <div class="row"></div>
                        <div class="col s12 m4 l3">
                            <div class="col s12">
                                <input type="checkbox" name="program[2]" class="program" value="Sport" id="program2"/>
                                <label for="program2">Deporte:</label>
                            </div>
                            <div class="col s12">
                                <input type="text" name="sport" value="" class="classBaseColorLightTone" size="15" />
                            </div>
                        </div>
                        <div class="input-field col s12 m4">
                            <input type="text" name="otherProgram" id="otherProgram" value="" class="classBaseColorLightTone" size="40"/>
                            <label for="otherProgram">Otro:</label>
                        </div>                         
                    </div>
                </div>

                <div class="row">
                    <div class="col s12"><h4>TRASLADO DESDE AEROPUERTO</h4></div>
                </div>
                <div class="control-group card-panel">
                    <div class="row">
                        <h5 class="red-text" for="event">Traslado:<span class="textRed">*</span></h5>
                        <div class="col s12 m8 l5">
                            <div class="col s12">
                                <input type="checkbox" name="airport" id="airport" />
                                <label for="airport">Transferencia y / o excursiones Aeropuerto necesarios</label>
                            </div>
                            <div class="col s12">
                                <textarea name="detailsAirport" rows="4" cols="84" class="classBaseColorLightTone"></textarea>
                                <small>Por favor, tenga en cuenta que cuantos más detalles nos proporcione, mas fácil será identificar las necesidades de su grupo
                    y para dar un resultado lo más preciso posible.</small>
                            </div>
                        </div>
                    </div> 
                </div>                           
                    
            
                <div class="row">
                    <div class="col s12"><h4>OTRAS PREGUNTAS / SOLICITUDES</h4></div>
                </div>

                <div class="control-group card-panel">
                    <div class="row">
                        <h5 class="red-text" for="event">Otras preguntas /Solicitudes: </h5>
                        <div class="col s12 m8 l5">
                            <textarea name="detailsQuestion" rows="4" cols="84" class="classBaseColorLightTone"></textarea></br>
                            <small>Necesita mas información o si tiene mas peticiones de acuerdo a su viaje/evento planeado,
                    por favor no dude en hacernóslo saber por e-mail o utilizando el cuadro de texto. Nos agradará llamarle para
                    discutir los detalles.</small>
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    <div class="checkbox-group" >
                        <input style="float: left;" id="enviaFormaGrupos" type="submit" value="Enviar Peticion" title="<?= Yii::t("global","Send"); ?>" class="btn btn-large btn-success curved misc_select_btn_green" />
                        <div class="card-panel hoverable grey darken-4 darken-1" style="float: right;">
                            <div class="card-content white-text">
                                Si usted prefiere contactarnos directamente<br/>
                                Número telefónico: 414-921-99-(34 / 35)<br/>
                                E-mail: groups@lomas-travel.com
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>