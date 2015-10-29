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
    margin: 0 0 0px 0;
    padding: 0;
    box-shadow: none;
    -webkit-box-sizing: content-box;
    -moz-box-sizing: content-box;
    box-sizing: content-box;
    transition: all .3s;
}
input[type=text]:focus:not([readonly]), input[type=password]:focus:not([readonly]), input[type=email]:focus:not([readonly]), input[type=url]:focus:not([readonly]), input[type=time]:focus:not([readonly]), input[type=date]:focus:not([readonly]), input[type=datetime-local]:focus:not([readonly]), input[type=tel]:focus:not([readonly]), input[type=number]:focus:not([readonly]), input[type=search]:focus:not([readonly]), textarea.materialize-textarea:focus:not([readonly]) {
    border: 1px solid #FF5A14;
    box-shadow: 0 1px 0 0 #FF5A14;
}
.input-field label.active {
    font-size: 1rem;
    -webkit-transform: translateY(-140%);
    -moz-transform: translateY(-140%);
    -ms-transform: translateY(-140%);
    -o-transform: translateY(-140%);
    transform: translateY(-140%);
}
</style>
<div class="row"></div>
<div class="row">
<div class="col s12 m10 offset-m1">
    <div  class="row">
        <div  class="col s12 m4">
            <?php foreach($_banners as $_banner){ ?>
            <div>
                <a rel="no-follow" href="<?php echo $_banner["url"]; ?>" title="<?php echo $_banner["titulo"]; ?>">
                <img class="grupsImg responsive-img" src="<?php echo Yii::app()->request->baseUrl; ?>/img/slideshow/<?php echo $_banner["img_desktop"] ?>" alt="Deals" />
                </a>
            </div>
            <? } ?>
        </div>
    </div>
    <div class="bloque">
        <div id="text-groups">
            <p>In Lomas Travel we have a department assigned exclusively to group trips to Cancun and Riviera Maya.
            Unwind and let our professional team, expert in tourism, get in charge and reserve the flight tickets,
            hotel, transfers and activities for your group.</p>

            <div class="expert_groups">
                <p> We are experts in: </p>
                <ul>
                    <li>Family vacations</li>
                    <li>Social groups travel</li>
                    <li>Incentive travel</li>
                    <li>Conventions</li>
                </ul>

                <ul>
                    <li>Graduation trips</li>
                    <li>Weddings</li>
                    <li>Corporative events</li>
                    <li>Group Activities and Tours</li>
                </ul>
            </div>


            <p>Contact us and prove how easy is to organize your group trip to Cancun and Riviera Maya with Lomas Travel.</p>
        </div>
        <div id="form_groups">
            <form class="form-horizontal" id="form_grupos" name="insert" method="post">
                <div class="row">
                    <div class="col s12"><h4>GROUP DETAILS</h4></div>
                </div>
                <div class="control-group card-panel">
                    <h5 class="red-text" for="event">Event:<span class="textRed">*</span></h5>
                    <div id="checkbox-event" class ="row">
                        <div class="input-field col s12 m4 l2">
                            <input class="" type="checkbox" id="event0" name="event[0]" value="Incentive" />
                            <label for='event0'>Incentive</label>
                        </div>
                        <div class="input-field col s12 m4 l2">
                            <input type="checkbox" class="" name="event[1]" id="event1" value="Conference" />
                            <label for='event1'>Conference</label>
                        </div>
                        <div class="input-field col s12 m4 l2">
                            <input type="checkbox" id="event2" class="" name="event[2]" value="Meeting/Seminar" /> 
                            <label for='event2'>Meeting/Seminar</label>
                        </div>                   
                        <div class="input-field col s12 m4 l2">
                            <input type="checkbox" id="event3" class="" name="event[3]" value="Workshop" />
                            <label for='event3'>Workshop</label>
                        </div>                   
                        <div class="input-field col s12 m4 l2">
                            <input type="checkbox" id='event4' class="" name="event[4]" value="Product Presentation" />
                            <label for='event4'>Product Presentation</label>
                        </div>    
                        <div class="row"></div>                    
                        <div class="input-field col s12 m4 l4">
                            <input type="text" id="otherevent" class="" name="otherEvent" value="" class="classBaseColorLightTone" size="30"/>
                            <label for="otherevent">Other Event:</label>
                        </div>
                    </div>
                </div>
                
                <div class="control-group card-panel">
                    <div class="row">
                        <h5 class="red-text" for="event">Company Name<span class="textRed">*</span></h5>
                        <div class="input-field col s12 m4 l4">
                            <input type="text" name="companyName" id="companyName" value="" size="47"/>
                        </div>
                    </div>
                </div>
                <div class="control-group card-panel">
                    <div class="row">
                        <div class="col s12 m8 l5">
                            <h5 class="red-text" for="event">Contact Person Details<span class="textRed">*</span></h5>
                            <div >
                                <label>Title:<span class="textRed">*</span></label>
                                <input type="text" name="title" value="" class="classBaseColorLightTone" size="15" />
                            </div>
                            <div  >
                                <label>Surname:<span class="textRed">*</span></label>
                                <input type="text" name="surname" value="" class="classBaseColorLightTone" size="15" />
                            </div>
                            <div  >
                                <label> Name:<span class="textRed">*</span></label>
                                <input type="text" name="lastname" value="" class="classBaseColorLightTone" size="15" />
                            </div>
                            <div  >
                                <label> Address:</label>
                                <input type="text" name="address" value="" class="classBaseColorLightTone"  size="36"/>
                            </div>
                            <div  >
                                <label> Postal Code:</label>
                                <input type="text" name="zip" value="" class="classBaseColorLightTone"  size="15" />
                            </div>
                            <div  >
                                <label> City:<span class="textRed">*</span> </label>
                                <input type="text" name="city" value="" class="classBaseColorLightTone"  size="15" />
                            </div>
                            <div  >
                                <label> Province: </label>
                                <input type="text" name="state" value="" class="classBaseColorLightTone"  size="15" />
                            </div>
                            <div  >
                                <label> Country:<span class="textRed">*</span> </label>
                                <input type="text" name="country" value="" class="classBaseColorLightTone"  size="10"/>
                            </div>
                            <div  >
                                <label> Tel (Country Code):<span class="textRed">*</span> </label>
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
                    <div class="col s12"><h4>BOOKING REQUEST</h4></div>
                </div>

                <div class="control-group card-panel">
                    <div class="row">
                        <h5 class="red-text" for="event">Approx. Dates:<span class="textRed">*</span></h5>
                        <div class="col s12 m6 l5">
                            <label> From: </label>
                            <input type="text" id="group_fecha" name="fromDate" value="<?=Yii::app()->GenericFunctions->convertPresentableDates($checkIn); ?>" class="classBaseColorLightTone" size="20"/> &nbsp;&nbsp;&nbsp;
                        </div>
                        <div class="col s12 m6 l5">
                            <label>Until: </label>
                            <input type="text" id="group_fecha2" name="untilDate" value="<?=Yii::app()->GenericFunctions->convertPresentableDates($checkOut); ?>" class="classBaseColorLightTone" size="20"/> &nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="row">
                        <h5 class="red-text" for="event">Destination:<span class="textRed">*</span></h5>
                        <div class="col s12 m6 l5">
                            <label>City: <span class="textRed">*</span></label>
                            <input type="text" name="destCity" value="" class="classBaseColorLightTone" size="20"/>
                        </div>
                        <div class="col s12 m6 l5">
                            <label>Province: </label>
                            <input type="text" name="destState" value="" class="classBaseColorLightTone" size="20"/>
                        </div>
                        <div class="col s12 m6 l5">
                            <label>Country:<span class="textRed">*</span></label>
                            <input type="text" name="destCountry" value="" class="classBaseColorLightTone" size="20"/>
                        </div>
                    </div>
                    <div class="row">    
                        <h5 class="red-text" for="event">Participants:<span class="textRed">*</span></h5>
                        <div class="col s12 m4 l2">
                            Number:
                            <input type="number" min="0" name="numberP" value="" class="classBaseColorLightTone" size="5"/>
                        </div>
                        <div class = "col s12">
                            <h6> Average age aprox.: </h6>
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox"  name="ages[1]"  class="ages" id="ages0" value="20-40 years" />
                                <label for='ages0'>20-40 years</label>
                            </div>
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox" class="ages" name="ages[2]" id="ages1" value="40-60 years" />
                                <label for='ages1'>40-60 years</label>
                            </div>
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox" class="ages" name="ages[3]" id="ages2" value="60+ years" />
                                <label for='ages2'>60+ years</label>
                            </div>
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox" class="ages" name="ages[4]" id="ages3" value="Mixed Ages" />
                                <label for='ages3'>Mixed Ages</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12"><h4>ACCOMMODATION</h4></div>
                </div>

                <div class="control-group card-panel">
                    <div class="row">
                            <h5 class="red-text" for="event">Category:<span class="textRed">*</span></h5>
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox" class="accommodation" name="accommodation[0]" value="Hotel" id="accommodation0"/>
                                <label for="accommodation0">Hotel</label>
                            </div>
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox" class="accommodation" name="accommodation[1]" value="Apartments" id="accommodation1"/>
                                <label for="accommodation1">Apartments</label>
                            </div>
                            <div class="input-field col s12 m4 l3">
                                <input type="checkbox" class="accommodation" name="accommodation[2]" value="Private Villa/Finca" id="accommodation2"/>
                                <label for="accommodation2">Private Villa/Finca</label>
                            </div>
                            <div class="row"></div>
                            <div class="input-field col s12 m3">
                                <input type="text" name="otherAcc" id="otherAcc" value="" class="classBaseColorLightTone" size="45"/>
                                <label for="otherAcc">Other</label>
                            </div>                                                                         
                    </div>
                    <div class="row">    
                       
                            <h5 class="red-text" for="event">Location:<span class="textRed">*</span></h5>
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox" name="location[0]" class="location" value="Town Centre" id="location0"/>
                                <label for="location0">Town Centre</label>
                            </div>
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox" name="location[1]" class="location" value="Beach" id="location1"/>
                                <label for="location1">Beach</label>
                            </div>
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox" name="location[2]" class="location" value="Rural" id="location2"/> 
                                <label for="location2">Rural</label>
                            </div>
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox" name="location[3]" class="location" value="Mountains" id="location3"/>
                                <label for="location3">Mountains</label>
                            </div>
                            <div class="row"></div>
                            <div class="input-field col s12 m4">
                                <input type="text" name="otherLoc" id="otherLoc" value="" class="classBaseColorLightTone" size="38"/>
                                <label for="otherLoc">Other</label>
                            </div>                             
                        
                    </div>
                    <div class="row">    
                        <h5 class="red-text" for="event">Number of Rooms:<span class="textRed">*</span></h5>
                        
                        <div class="col s12 m4 l3">
                            Single:
                            <input type="number" min="0" name="numberSingle" value="" class="classBaseColorLightTone" size="7"/> 
                        </div>
                        <div class="col s12 m4 l3">
                            Double:
                            <input type="number" min="0" name="numberDouble" value="" class="classBaseColorLightTone" size="7"/>
                        </div>
                        <div class="col s12 m4 l3">
                            Double for Single Use: 
                            <input type="number" min="0" name="numberDoubleSingleUse" value="" class="classBaseColorLightTone" size="6"/>
                        </div>
                        <div class="col s12 m4 l3">
                            Suites: 
                            <input type="number" min="0" name="numberSuite" value="" class="classBaseColorLightTone" size="6"/>
                        </div>
                    </div>
                    <div class="row">    
                            <h5 class="red-text" for="event">Meals:<span class="textRed">*</span></h5>
                            <div class="input-field col s12 m4 l3">
                                <input type="checkbox" name="meals[0]" class="meals" value="Bed & Breakfast" id="meals0"/>
                                <label for="meals0">Bed & Breakfast</label>
                            </div>
                            <div class="input-field col s12 m4 l3">
                                <input type="checkbox" name="meals[1]" class="meals" value="Half Board" id="meals1"/>
                                <label for="meals1">Half Board</label>
                            </div>
                            <div class="input-field col s12 m4 l3">
                                <input type="checkbox" name="meals[2]" class="meals" value="Full Board" id="meals2"/> 
                                <label for="meals2">Full Board</label>
                            </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col s12"><h4>CONFERENCE FACILITIES</h4></div>
                </div>

                <div class="control-group card-panel">
                    <div class="row">
                        
                        <h5 class="red-text" for="event">Conference / Meeting Room for:<span class="textRed">*</span></h5>
                        <div class="col s12 m4">
                            <label> persons</label>
                            <input type="number" min="0" name="confPeople" value="" class="classBaseColorLightTone" size="10"/>
                        </div>
                    </div>
                    <div class="row">
                        <h5 class="red-text" for="event">Conference Room Type:<span class="textRed">*</span></h5>
                        <div class = "checkbox-group">
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox" name="roomType[0]" class="roomType" value="Classroom" id="roomType0"/>
                                <label for="roomType0">Classroom</label>
                            </div>
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox" name="roomType[1]" class="roomType" value="Theatre" id="roomType1"/> 
                                <label for="roomType1">Theatre</label>
                            </div>
                            <div class="input-field col s12 m4 l2">
                                <input type="checkbox" name="roomType[2]" class="roomType" value="U-shape" id="roomType2"/>
                                <label for="roomType2">U-shape</label>
                            </div>
                            <div class="row"></div>
                            <div class="input-field col s12 m4">
                                <input type="text" name="otherRoomType" id="otherRoomType" value="" class="classBaseColorLightTone" size="34"/>
                                <label for="otherRoomType">Other:</label>
                            </div>                          
                        </div>
                    </div>
                    <div class="row">

                            <h5 class="red-text" for="event">Equipment:<span class="textRed">*</span></h5>
                            <div class="input-field col s12 ">
                                <input type="checkbox" name="techEquip" id="techEquip"/>
                                <label for="techEquip">Technical Equipment Needed</label>
                            </div>                            
                            <div class="row"></div>
                            <div class="input-field col s12 ">
                                <textarea name="detailsTechEquip" id="detailsTechEquip" rows="4" cols="110" class="classBaseColorLightTone"></textarea>
                                
                            </div>
                    </div>
                    <div class="row">
                            <h5 class="red-text" for="event">Food & Beverage:<span class="textRed">*</span></h5>                    
                            <div class="input-field col s12 ">
                                <input type="checkbox" name="foodBev" id="foodBev"/>
                                <label for="foodBev">Food & Beverage Service Needed</label>
                            </div>                            
                            <div class="row"></div>
                            <div class="input-field col s12 ">
                                <textarea name="detailsFoodBev" id="detailsFoodBev" rows="4" cols="110" class="classBaseColorLightTone"></textarea>
                                
                            </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col s12"><h4>ESTIMATED BUDGET</h4></div>
                </div>

                <div class="control-group card-panel">
                    <h5 class="red-text" for="event">Estimated Budget:<span class="textRed">*</span></h5>
                    <h6>
                        To ensure we present you with the most relevant offers for your particular group, it is important that we know the approximate cost you have in mind.</br>
                    </h6>
                    <div class="row">
                        <div class="input-field col s12 m6 l4">
                            <input type="checkbox" name="budget[0]" class="budget" value="Per person" id="budget0"/>
                            <label for="budget0">Per person</label>
                        </div>
                        <div class="input-field col s12 m6 l4">
                            <input type="checkbox" name="budget[1]" class="budget" value="Group Total" id="budget1"/>
                            <label for="budget1">Group Total</label>
                        </div>
                    </div>
                    <div class="row">
                            <div class="input-field col s12 m4">
                                <input type="number" min="0" name="amount" id="amount" value="" class="classBaseColorLightTone" size="10"/>
                                <label for="amount">Amount:</label>
                            </div>                      
                            <div class="input-field col s12 m4">
                                <input type="text" name="currency" id="currency" value="" class="classBaseColorLightTone number_input" size="10"/>
                                <label for="currency">Currency:</label>
                            </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="col s12"><h4>PROGRAM</h4></div>
                </div>
                <div class="control-group card-panel">
                    <div class="row">
                        <h5 class="red-text" for="event">Program:<span class="textRed">*</span></h5>
                    
                        <div class="input-field col s12 m4 l4">
                            <input type="checkbox" name="program[0]" class="program" value="None" id="program0"/>
                            <label for="program0">None</label>
                        </div>
                        <div class="input-field col s12 m4 l4">
                            <input type="checkbox" name="program[1]" class="program" value="Culture" id="program1"/>
                            <label for="program1">Culture</label>
                        </div>
                        <div class="input-field col s12 m4 l4">
                            <input type="checkbox" name="program[3]" class="program" value="Leisure" id="program3"/>
                            <label for="program3">Leisure</label>
                        </div>
                        <div class="input-field col s12 m4 l4">
                            <input type="checkbox" name="program[4]" class="program" value="Gastronomy/Wine" id="program4"/>
                            <label for="program4">Gastronomy/Wine</label>
                        </div>
                        <div class="input-field col s12 m4 l4">
                            <input type="checkbox" name="program[5]" class="program" value="Golf" id="program5"/>
                            <label for="program5">Golf</label>
                        </div>
                        <div class="input-field col s12 m4 l4">
                            <input type="checkbox" name="program[6]" class="program" value="Health & Beauty/Wellness" id="program6"/>
                            <label for="program6">Health & Beauty/Wellness</label>
                        </div>
                        <div class="row"></div>
                        <div class="col s12 m4 l3">
                            <div class="col s12">
                                <input type="checkbox" name="program[2]" class="program" value="Sport" id="program2"/>
                                <label for="program2">Sport:</label>
                            </div>
                            <div class="col s12">
                                <input type="text" name="sport" value="" class="classBaseColorLightTone" size="15" />
                            </div>
                        </div>
                        <div class="input-field col s12 m4">
                            <input type="text" name="otherProgram" id="otherProgram" value="" class="classBaseColorLightTone" size="40"/>
                            <label for="otherProgram">Other:</label>
                        </div>                         
                    </div>
                </div>

                <div class="row">
                    <div class="col s12"><h4>AIRPORT TRANSFER</h4></div>
                </div>
                <div class="control-group card-panel">
                    <div class="row">
                        <h5 class="red-text" for="event">Transfer:<span class="textRed">*</span></h5>
                        <div class="col s12 m8 l5">
                            <div class="col s12">
                                <input type="checkbox" name="airport" id="airport" />
                                <label for="airport">Airport transfer and/or excursions needed</label>
                            </div>
                            <div class="col s12">
                                <textarea name="detailsAirport" rows="4" cols="84" class="classBaseColorLightTone"></textarea>
                                <small>Please bear in mind that the more details you provide, the better we are able to identify the needs of your group and to give an as accurate quotation as possible.</small>
                            </div>
                        </div>
                    </div> 
                </div>                           
                    
            
                <div class="row">
                    <div class="col s12"><h4>OTHER QUESTIONS / REQUEST</h4></div>
                </div>

                <div class="control-group card-panel">
                    <div class="row">
                        <h5 class="red-text" for="event">Other Questions / Request: </h5>
                        <div class="col s12 m8 l5">
                            <textarea name="detailsQuestion" rows="4" cols="84" class="classBaseColorLightTone"></textarea></br>
                            <small>Should you require further information or if you have queries regarding any aspect of your planned trip/event, please do not hesitate to let us know either by e-mail or by using the field above. We shall be happy to give you a call back to discuss any details.</small>
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    <div class="checkbox-group" >
                        <input style="float: left;" id="enviaFormaGrupos" type="submit" value="Send Request" title="<?= Yii::t("global","Send"); ?>" class="btn btn-large btn-success curved misc_select_btn_green" />
                        <div class="card-panel hoverable grey darken-4 darken-1" style="float: right;">
                            <div class="card-content white-text">
                                If you prefer contact us<br/>
                                Phone Numbers: 414-921-99-(34 / 35)<br/>
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