<?php $languaje=strtoupper(Yii::app()->language); ?>
<div class="content contentPage">

    <div class="bloque normal_right" style="float: left;">
        <div class='checkout_header'>
            <label class="background_green">Your Reservation</label>
            <label class="background_white">Payment</label>
        </div>
        <?	$totalReservation = 0;
        foreach($Productos as $tipo){
            foreach ($tipo as $_p) {
                $totalReservation = $totalReservation + $_p->descripcion_total;
            }
        }
        ?>
        <div class = "div_white">
            <label class="total_tablet">
                Total  <?=  $_SESSION["config"]["currency"] ." $". number_format($totalReservation,0); ?>
            </label>
        </div>

        <form method="post" action="<?= $this->createUrl("checkout/detalle"); ?>">
            <div>
                <div class="contentProductos">
                    <?php
                    $temp_HotelCheckIn  ="";
                    $temp_HotelCheckOut ="";
                    $temp_Adults        = 0;
                    $temp_Childs        = 0;
                    $temp_Hotel         = 'false';
                    $temp_Transfer      = 'false';
                    ?>

                    <?php if(sizeof($Productos[1]) > 0): // If productos ?>
                        <!-- Si hay Hoteles -->
                        <?php $temp_HotelTranfer=$Productos[1]; ?>
                        <?php foreach($Productos[1] as $_p): ?>
                            <?php
                            $temp_Hotel = 'true';
                            $checkInDate = date_create($_p->descripcion_fecha1);
                            $checkOutDate = date_create($_p->descripcion_fecha2);

                            $temp_InDate = date("m/d/Y",strtotime($_p->descripcion_fecha1."+1 day"));
                            $temp_InDate = date_create($temp_InDate);
                            $temp_Adults = $_p['descripcion_adultos'];
                            $temp_Childs = $_p['descripcion_menores'];
                            ?>
                            <div class="checkoutProducto borderGray">
                                <img src='<?= $_p->descripcion_thumb ?>' alt='Hotel' />

                                <div class="div_misc_info_producto">
                                    <label><?= $_p->descripcion_producto ?></label>
											<span  >
												<?= Yii::app()->GenericFunctions->makeStars($ProductoStarsLevel[$_p->descripcion_producto_id]); ?>
											</span>
                                    <table>
                                        <tr>
                                            <td>Check-In:  <?= date_format($checkInDate, 'l M/d/Y'); ?></td>
                                            <td class="hide_mobil"><?= $_p->descripcion_tarifa ?></td>
                                        </tr>
                                        <tr>
                                            <td>Check-Out:  <?= date_format($checkOutDate, 'l M/d/Y'); ?></td>
                                            <td class="hide_mobil"><?= $_p->descripcion_add_val_1 ?></td>
                                        </tr>
                                        <tr>
                                            <td><?= Yii::app()->GenericFunctions->difDays($_p->descripcion_fecha1,$_p->descripcion_fecha2) ?> Nights</td>
                                            <td class="hide_mobil">
                                                <?= $_p->descripcion_adultos ?> Adult(s)
                                                <? if($_p->descripcion_menores > 0) : ?>
                                                    <?= $_p->descripcion_menores ?> Children
                                                <? endif ?>
                                            </td>
                                        </tr>
                                    </table>

                                </div>
										<span class = "shopping_continue_tablet">
											<label> <?= $_SESSION["config"]["currency"]. " $". number_format($_p->descripcion_total,0); ?> </label>
                                            <?= CHtml::link(Yii::t("global","Pagar"),array("checkout/detalle"),array("title"=>"Pagar","class"=>"")); ?>
										</span>
                                <div class="clear"></div>
                            </div>

                        <? endforeach ?>

                    <? endif // // If productos ?>

                    <? if(sizeof($Productos[2]) > 0){ ?>
                        <!--  Si hay Tours -->


                        <? foreach($Productos[2] as $_p){ ?>
                            <?
                            $dateTour = date_create($_p->descripcion_fecha1);

                            $temp_Adults = $_p['descripcion_adultos'];
                            $temp_Childs = $_p['descripcion_menores'];
                            $temp_InDate = date("m/d/Y",strtotime($_p->descripcion_fecha1."+1 day"));
                            $temp_InDate = date_create($temp_InDate);
                            ?>
                            <div class='checkoutProducto borderGray'>

                                <img src='<?= $_p->descripcion_thumb ?>' alt='Tour' />

                                <div class='div_misc_info_producto' >
                                    <label ><?= $_p->descripcion_producto ?></label>

                                    <table >
                                        <tr>
                                            <? if($_p->descripcion_id_cupon==1){?>
                                                <td>Valid to:  <?= date_format($dateTour, 'l M/d/Y') ?></td>
                                            <?}else{?>
                                                <td>Date:  <?= date_format($dateTour, 'l M/d/Y') ?></td>
                                            <?}?>
                                        </tr>
                                        <tr>
                                            <td><?= $_p->descripcion_tarifa ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?= $_p->descripcion_adultos ?> Adult(s)
                                                <? if($_p->descripcion_menores > 0) : ?>
                                                    <?= $_p->descripcion_menores ?> Children
                                                <? endif ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
									<span class = "shopping_continue_tablet">
										<label> <?= $_SESSION["config"]["currency"]. " $". number_format($_p->descripcion_total,0); ?> </label>
                                        <?= CHtml::link(Yii::t("global","Pagar"),array("checkout/detalle"),array("title"=>"Pagar","class"=>"")); ?>
									</span>
                                <div class="clear"></div>
                            </div>
                        <? } ?>

                    <? } ?>

                    <? if(sizeof($Productos[3]) > 0){ ?>
                        <!-- Si hay Transfers -->

                        <? foreach($Productos[3] as $_p){ ?>

                            <?
                            $temp_Transfer = 'true';
                            $temp_Adults = $_p['descripcion_adultos'];
                            $temp_Childs = $_p['descripcion_menores'];
                            $temp_InDate = date("m/d/Y",strtotime($_p->descripcion_fecha1."+1 day"));
                            $temp_InDate = date_create($temp_InDate);
                            $transferId[$_p->descripcion_producto_id] =  Yii::app()->GenericFunctions->ProtectVar($_p->descripcion_id);
                            ?>
                            <div class='checkoutProducto borderGray'>
                                <img src='<?= $_p->descripcion_thumb ?>' alt='Tour' />

                                <div class='div_misc_info_producto'>
                                    <label ><?= $_p->descripcion_tarifa  ?></label>
											<span  >

											</span>
                                    <table >
                                        <tr>
                                            <td>
                                                Transfer: <?= $_p->descripcion_adultos ?> Adult(s)
                                                <? if($_p->descripcion_menores > 0) : ?>
                                                    , <?= $_p->descripcion_menores ?> Children
                                                <? endif ?>
                                            </td>
                                        <tr>
                                            <td>
                                                Destination: <?= $_p->descripcion_hotel1 . " - " . $_p->descripcion_hotel2; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Arriving:  <?= Yii::app()->GenericFunctions->convertPresentableDates($_p->descripcion_fecha1); ?>
                                                <? if($_p->tipo_translado == 1 || $_p->tipo_translado == 5){?>
                                                    - Returning: <?= Yii::app()->GenericFunctions->convertPresentableDates($_p->descripcion_fecha2); ?>
                                                <? } ?>
                                            </td>
                                        </tr>

                                    </table>
                                </div>
										<span class = "shopping_continue_tablet">
											<label> <?= $_SESSION["config"]["currency"]. " $". number_format($_p->descripcion_total,0); ?> </label>
                                            <?= CHtml::link(Yii::t("global","Pagar"),array("checkout/detalle"),array("title"=>"Pagar","class"=>"")); ?>
										</span>
                                <div class="clear"></div>
                            </div>

                        <? } ?>
                    <? } ?>

                    <?
                    $extras_folio= array();
                    if(sizeof($Productos[4]) > 0){ ?>
                        <!-- Si hay Extras -->
                        <? foreach($Productos[4] as $_p){ ?>

                            <?
                            $extras_folio[] = $_p->descripcion_tarifa_id;
                            $dateTour = date_create($_p->descripcion_fecha1);
                            $dateTour2 = date_create($_p->descripcion_fecha2);

                            $temp_Adults = $_p['descripcion_adultos'];
                            $temp_Childs = $_p['descripcion_menores'];
                            ?>
                            <div class='checkoutProducto borderGray'>

                                <img src='<?= $_p->descripcion_thumb ?>' alt='Extra' />

                                <div class='div_misc_info_producto' >
                                    <label ><?= $_p->descripcion_producto ?></label>

                                    <table >
                                        <tr>
                                            <td>Date :  <?=  Yii::app()->GenericFunctions->convertPresentableDates(date_format($dateTour, 'm/d/Y'),2,1); ?></td>
                                            <td>to     <?=  Yii::app()->GenericFunctions->convertPresentableDates(date_format($dateTour2, 'm/d/Y'),2,1); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?= $_p->descripcion_tarifa ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?= $_p->descripcion_adultos ?> Adult(s)
                                                <? if($_p->descripcion_menores > 0) : ?>
                                                    <?= $_p->descripcion_menores ?> Children
                                                <? endif ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
									<span class = "shopping_continue_tablet">
										<label> <?= $_SESSION["config"]["currency"]. " $". number_format($_p->descripcion_total,0); ?> </label>
                                        <?= CHtml::link(Yii::t("global","Pagar"),array("checkout/detalle"),array("title"=>"Pagar","class"=>"")); ?>
									</span>
                                <div class="clear"></div>
                            </div>

                        <?}?>
                    <?}?>
                </div>
                <div class="clear"></div>
            </div>
        </form>

        <div style="padding-top:20px;"></div>


        <!--<label class="suplement_your_trip">Making your trip better</label>-->

        <? if( $temp_Hotel == true && (isset($infotTransfer[16]) || isset($infotTransfer[6]))) {?>
            <? $transfer = $infotTransfer[2]; ?>
            <label class="title_product_recomendation borderGray ">Enhance your travel experience <span style = "font-size:1rem;"> ( <?=  $transfer->descripcion_hotel1 ?> - <?= $transfer->descripcion_hotel2 ?> )</span></label>

            <div class="bloque prod_detail_contained borderGray checkout_box_prod_transfer" >
                <ul>

                    <? if (isset($infotTransfer[2]) ) { ?>
                        <? $transfer = $infotTransfer[2]; ?>
                        <li>
                            <label class="nameZona transfer_radio">
                                <input type="radio" <?= (isset($transferId[2]))? "checked" : "" ; ?> name="transfer_radio"  value="van" >
                                <?= $transfer->descripcion_tarifa ?>
                            </label>

                            <label class="linkInformation">More Information</label>

                            <label class="price">
                                <?=  $_SESSION["config"]["currency"] ." $". number_format($transfer->descripcion_total,0); ?>
                                <? if ($transfer->numVehiculo > 1) { ?>
                                    <span style = "display:block"> ( <?= $transfer->numVehiculo ?> Vehicles ) </span> <span style = "display:block"> <?= $transfer->tarifa_cap_fin ?> Passengers per vehicle  </span>

                                <? } ?>
                            </label>
                            <a class="hide" href="<?= $transfer->urladd; ?>&chekoutTransfer=1 ">add</a>
                            <div class="moreInformation hide">
                                <img src="/img/traslados/<?= $transfer->tipo_imagen ?>.jpg" class="moreinformationImg">
                                <p class="elementDesc">
                                    <?php echo $transfer->descripcion_tipo; ?>
                                    </br>
                                    From <?= $transfer->tarifa_cap_ini ?> to <?= $transfer->tarifa_cap_fin ?> Passenger(s)
                                    </br>
                                    Rate per vehicle
                                </p>
                            </div>
                        </li>
                    <? } ?>

                    <? if (isset($infotTransfer[4]) ) { ?>
                        <? $transfer = $infotTransfer[4]; ?>
                        <li>
                            <label class="nameZona transfer_radio">
                                <input type="radio" <?= (isset($transferId[4]))? "checked" : "" ; ?> name="transfer_radio"  value="van" >
                                <?= $transfer->descripcion_tarifa ?>
                            </label>

                            <label class="linkInformation">More Information</label>

                            <label class="price">
                                <?=  $_SESSION["config"]["currency"] ." $". number_format($transfer->descripcion_total,0); ?>
                                <? if ($transfer->numVehiculo > 1) { ?>
                                    <span style = "display:block"> ( <?= $transfer->numVehiculo ?> Vehicles ) </span> <span style = "display:block"> <?= $transfer->tarifa_cap_fin ?> Passengers per vehicle  </span>

                                <? } ?>
                            </label>
                            <a class="hide" href="<?= $transfer->urladd; ?>&chekoutTransfer=1 ">add</a>
                            <div class="moreInformation hide">
                                <img src="/img/traslados/<?= $transfer->tipo_imagen ?>.jpg" class="moreinformationImg">
                                <p class="elementDesc">
                                    <?php echo $transfer->descripcion_tipo; ?>
                                    </br>
                                    From <?= $transfer->tarifa_cap_ini ?> to <?= $transfer->tarifa_cap_fin ?> Passenger(s)
                                    </br>
                                    Rate per vehicle
                                </p>
                            </div>
                        </li>
                    <? } ?>

                    <? if (isset($infotTransfer[6]) ) { ?>
                        <? $transfer = $infotTransfer[6]; ?>
                        <li>
                            <label class="nameZona transfer_radio"><input type="radio" <?= (isset($transferId[6]))? "checked" : "" ; ?> name="transfer_radio"  value="van" >
                                <?= $transfer->descripcion_tarifa ?>
                            </label>

                            <label class="linkInformation">More Information</label>

                            <label class="price">
                                <?=  $_SESSION["config"]["currency"] ." $". number_format($transfer->descripcion_total,0); ?>
                                <? if ($transfer->numVehiculo > 1) { ?>
                                    <span style = "display:block"> ( <?= $transfer->numVehiculo ?> Vehicles ) </span> <span style = "display:block"> <?= $transfer->tarifa_cap_fin ?> Passengers per vehicle </span>

                                <? } ?>
                            </label>
                            <a class="hide" href="<?= $transfer->urladd; ?>&chekoutTransfer=1 ">add</a>
                            <div class="moreInformation hide">
                                <img src="/img/traslados/<?= $transfer->tipo_imagen ?>.jpg" class="moreinformationImg">
                                <p class="elementDesc">
                                    <?php echo $transfer->descripcion_tipo; ?>
                                    </br>
                                    From <?= $transfer->tarifa_cap_ini ?> to <?= $transfer->tarifa_cap_fin ?> Passenger(s)
                                    </br>
                                    Rate per vehicle
                                </p>
                            </div>
                        </li>
                    <? } ?>

                    <? if (isset($infotTransfer[16])) { ?>
                        <? $transfer = $infotTransfer[16]; ?>
                        <li class="upscale">
                            The upscale comfort you deserve
                        </li>
                        <li>
                            <label class="nameZona transfer_radio"  ><input type="radio" <?= (isset($transferId[16]))? "checked" : "" ; ?> name="transfer_radio"  value="lincon"  >
                                <?= $transfer->descripcion_tarifa ?>
                            </label>
                            <label class="linkInformation" >More Information</label>

                            <label class="price" >
                                <?=  $_SESSION["config"]["currency"] ." $". number_format($transfer->descripcion_total,0); ?>
                                <? if ($transfer->numVehiculo > 1) { ?>
                                    <span style = "display:block" > ( <?= $transfer->numVehiculo ?> Vehicles ) </span> <span style = "display:block"> <?= $transfer->tarifa_cap_fin ?> Passengers per vehicle  </span>

                                <? } ?>
                            </label>

                            <a class="hide" href="<?= $transfer->urladd; ?>&chekoutTransfer=1">add</a>

                            <div class="moreInformation hide">
                                <img src="/img/traslados/<?= $transfer->tipo_imagen ?>.jpg" class="moreinformationImg">
                                <p class="elementDesc">
                                    <?php echo $transfer->descripcion_tipo; ?>
                                    </br>
                                    From <?= $transfer->tarifa_cap_ini ?> to <?= $transfer->tarifa_cap_fin ?> Passenger(s)
                                    </br>
                                    Rate per vehicle
                                </p>
                            </div>
                        </li>
                    <? } ?>
                </ul>
            </div>
        <? } ?>

        <div class="bloque prod_detail_contained borderGray checkout_box_prod_transfer" >
            <ul>
                <li class="upscale">
                    Assistance for your trip
                </li>
                <? foreach($serv_ex as $_se){?>
                    <li>

                        <label class="nameZona servicio_radio"  ><input type="radio" <? if(in_array($_se['folio'],$extras_folio)) echo "checked" ?> name="servicio_radio"  value="lincon"  >
                            <?=$_se['nombre']?>
                        </label>
                        <label class="linkInformation" >More information</label>

                        <label class="price" >
                            <?=  $_SESSION["config"]["currency"] ." $". number_format($_se['precio_total'],0); ?>
                        </label>

                        <a class="hide" href="<?= $_se['urladd']; ?>&chekoutExtra=1">add</a>

                        <div class="moreInformation hide">
                            <img width="150" src="/img/servicio_extra/<?= $_se['foto'] ?>" class="moreinformationImg">
                            <p class="elementDesc">
                                <?php echo $_se['descripcion']; ?>
                            </p>
                        </div>
                    </li>
                <? }?>
            </ul>
        </div>

        <?php if(sizeof($_Htls->Hotel) > 0 && !empty($_Htls->Hotel)){?>
            <label class="title_product_recomendation borderGray ">Hotels</label>

            <div class="bloque prod_detail_contained borderGray" id="checkout_box_prod">

                <div class="bloque prod_home_displayer_option_visualizer" id="option_visualizer_selected_tours" style="display: block;">
                    <div class="main_enc_blue_gray curved">
                        <div class="clear"></div>
                    </div>

                    <div class="clear" style="padding:0px;"></div>

                    <div class="bloque"id="main_hotels">

                        <div class="bloque prod_pagination" id="pagination_1">
                            <?php
                            $howManyProds = 0;
                            $howManyPages = 1;
                            $Trs          = array();
                            if(sizeof($_Htls->Hotel) > 0){
                                foreach($_Htls->Hotel as $p){
                                    $urlHotel = $p->attributes()->hotel_keyword;
                                    //Agrego el Hotel a un Array para el Filtro
                                    $_Tr = array("Price"=>$p["tarifa_precio_adulto"],"Id"=>$p["tour_id"],"Name"=>((Yii::app()->language == "en") ? $p["tour_nombre"] : $p["tour_nombre_es"] ),"Category"=>"");


                                    if($howManyProds == 10){
                                        $howManyProds = 0;
                                        $howManyPages++;
                                        echo "</div>";
                                        echo '<div class="bloque prod_pagination" id="pagination_'. $howManyPages . '" style="display: none;">';
                                    }


                                    $d = $p["tour_destino"];
                                    $preciosaB = "$" . number_format(Yii::app()->Currency->convert($_SESSION["config"]["currency"],$p["tarifa_precio_adulto"],0)) . "<span class='currency_code'>" . $_SESSION["config"]["currency"] . "</span>";

                                    if($p["tarifa_precio_adulto"] == 0){
                                        $preciosaB = "871". "<span class='currency_code'>" . $_SESSION["config"]["currency"] . "</span>";
                                    }?>
                                    <div class="promotion_home_info_displayer checkout">
                                        <a href="/hotel/<?php echo $urlHotel; ?>.html" title="<?= $p->attributes()->name; ?>" class="btn_img_tour_link curved">
                                            <img class="full-width" src='<?php echo $p->attributes()->thumb; ?>' alt='<?php echo utf8_decode($p->attributes()->name); ?>' />
                                        </a>
                                        <h1 class="misc_book_info_txt_home nametur_mobile ">
                                            <?php
                                            echo utf8_decode($p->attributes()->name);
                                            ?>
                                        </h1>

                                        <div class="div_misc_info_producto">
                                            <div class="fontsize_mobil">
                                                <h1 class="misc_book_info_txt_home nametour_desk">
                                                    <?php if((float)$p->attributes()->minAverPrice == 99999999 || (float)$p->attributes()->minAverPrice == 0){ ?>
                                                        <a  href='/hotel/<?php echo $urlHotel; ?>.html' title='<?php echo Yii::app()->GenericFunctions->makeSinAcento(utf8_decode($p->attributes()->name)); ?>'><span class="titleHotel"><div style="display:none">z</div><?php echo Yii::app()->GenericFunctions->makeSinAcento(utf8_decode($p->attributes()->name)); ?><span></a>
                                                    <?}else{?>
                                                        <a  href='/hotel/<?php echo $urlHotel; ?>.html' title='<?php echo Yii::app()->GenericFunctions->makeSinAcento(utf8_decode($p->attributes()->name)); ?>'><span class="titleHotel"><?php echo Yii::app()->GenericFunctions->makeSinAcento(utf8_decode($p->attributes()->name)); ?><span></a>
                                                    <?}?>
                                                </h1>
                                                <label >Location: <?= Yii::app()->GenericFunctions->makeSinAcento(utf8_decode($p->Location->attributes()->city)); ?></label>
                                                <label>
                                                    <?php
                                                    echo substr($p->attributes()->desc,0,190);
                                                    ?>
                                                </label>
                                                <a class = 'checkut_moredetails' href="/hotel/<?php echo $urlHotel; ?>.html">More Details</a>
                                            </div>
                                            <div class="checkout_div_price">
                                                <span class="elementCategory"><?php echo Yii::app()->GenericFunctions->makeStars((float)$p->attributes()->starsLevel); ?></span>
                                                <label class="description_price">
                                                    From :
                                                </label>
                                                <label class="label_price">
                                                    <?php if((float)$p->attributes()->minAverPrice == 99999999 || (float)$p->attributes()->minAverPrice == 0){ ?>
                                                        <article class="elementPrice">
                                                            <span><?php echo Yii::t("global","Agotado"); ?>	</span>
                                                        </article>
                                                    <?php }else{ ?>
                                                        <article class="elementPrice">
                                                            <span class='currency_code'><?php echo $_SESSION["config"]["currency"]; ?></span> $ <?php echo number_format((float)$p->attributes()->minAverPrice,0); ?>
                                                        </article>
                                                    <?php } ?>
                                                </label>
                                                <a class="fontsize_mobil a_selectDatesHotel" href="/hotel/<?php echo $urlHotel; ?>.html" >BOOK</a>
                                            </div>
                                        </div>
                                        <div class="hide div_hotelExtra">
                                            <form class="cotiza_hotel_extra" action="<?= $this->createUrl('tours/buscar') ?>">
                                                <input type="hidden" name="dest"			 value="<?= $p["destino_clave"] ?>"/>
                                                <input type="hidden" name="prod"			 value="<?= $p["tour_clave"] ?>"/>
                                                <input type="hidden" name="isTourCategory"	 value="0"/>
                                                <input type="hidden" name="tour_destination" value="<?=  $p["tour_nombre"] ?>"/>
                                                <input type="hidden" name="TourId"			 value="<?= $p['tour_id'] ?>"/>
                                                <input type="hidden" name="ProveedorId"		 value="0"/>
                                                <input type="hidden" name="checkout_tour" 	value="ajax"/>
                                                <div>
                                                    <label>Dates: </label>
                                                    <input type="text" name="fecha" value="<?= date_format($temp_InDate, 'm/d/Y')?>" class="dateInput"/>

                                                </div>
                                                <div>
                                                    <label>Adults: </label>
                                                    <input type="number" name="tour_adults" value="<?= $temp_Adults ?>" class="num_adults" />
                                                </div>
                                                <div>
                                                    <label>Children: </label>
                                                    <input type= "number" name="tour_childs" value="<?= $temp_Childs ?>" class="num_childs"/>
                                                </div>
                                                <input type="submit" value="Update Rates" class="submitForm"/>
                                            </form>
                                            <div class="rate_hotel_extra">

                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    array_push($Trs,$_Tr);
                                    $howManyProds++;
                                    $i_real = $p["tour_id"];

                                }
                                $_SESSION["TourSearch"][$_Cr]["Tours"] = $Trs;
                            }else{
                                //-> No hubo resultados
                            }
                            ?>
                        </div>

                        <div class="bloque" id="pagination_product">
                            <div class="bloque" id="misc_pagination_show_howmany">
                                <?= Yii::t("global","Mostrar"); ?>:
                                &nbsp;&nbsp;
                                <span class="howmany_show_counter curved">10</span>
                            </div>
                            <div class="bloque" id="misc_controls_pages_show" style="margin-top: -11px;">
                                <a href="#" title="Anterior" class="curved btn_nav_prev_pagination">&laquo; <?= Yii::t("global","Anterior"); ?></a>

                                <? for($i=1;$i<=$howManyPages;$i++){?>
                                    <a href="#" title="Pagina <?= $i; ?>" rel="<?= $i; ?>" class="misc_pagination_page_selector_option curved <?= (($i == 1) ? "active" : ""); ?>"><?= $i; ?></a>

                                <? }?>

                                <a href="#" title="Siguiente" class="curved btn_nav_next_pagination"><?= Yii::t("global","Siguiente"); ?> &raquo;</a>
                                <a href="#" title="Arriba" class="curved">&uarr; <?= Yii::t("global","Ir arriba"); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?} if(sizeof($_Tours) > 0){?>

            <label class="title_product_recomendation borderGray ">Activities</label>

            <div class="bloque prod_detail_contained borderGray" id="checkout_box_prod">

                <div class="bloque prod_home_displayer_option_visualizer" id="option_visualizer_selected_tours" style="display: block;">
                    <div class="main_enc_blue_gray curved">
                        <div class="clear"></div>
                    </div>

                    <div class="clear" style="padding:0px;"></div>

                    <div class="bloque"id="main_tours">

                        <div class="bloque prod_pagination" id="pagination_1">
                            <?php
                            $MaxPrice     = 0;
                            $_MealsPlan   = array();
                            $_Categories  = array();
                            $howManyProds = 0;
                            $howManyPages = 1;
                            $Trs          = array();

                            foreach($Categorias as $h=>$v){
                                foreach($v as $z){
                                    if(!in_array($z["cnombre"],$_Categories)){
                                        array_push($_Categories,$z["cnombre"]);
                                    }
                                }
                            }


                            $i_real  = 0;
                            if(sizeof($_Tours) > 0){
                                foreach($_Tours as $p){
                                    //Agrego el Hotel a un Array para el Filtro
                                    $_Tr = array("Price"=>$p["tarifa_precio_adulto"],"Id"=>$p["tour_id"],"Name"=>((Yii::app()->language == "en") ? $p["tour_nombre"] : $p["tour_nombre_es"] ),"Category"=>"");

                                    if( Yii::app()->language != "es"){
                                        $tParams = array(
                                            "tours/detalle",
                                            "pax_adulto"       => $temp_Adults,
                                            "pax_menor"        => $temp_Childs,
                                            "fecha"            => date_format($temp_InDate,'m/d/Y'),
                                            "dest"             => $p["destino_clave"],
                                            "prod"             => $p["tour_clave"],
                                            "isTourCategory"   => 0,
                                            "tour_destination" =>  $p["tour_nombre"],
                                            "TourId"           => $p['tour_id'],
                                            "ProveedorId"      => 0,
                                            "tour_fecha"       => date_format($temp_InDate,'m/d/Y'),
                                            "tour_adults"      => $temp_Adults,
                                            "tour_childs"      => $temp_Childs
                                        );
                                        $link_tourDetalle = $this->createUrl("tours/detalle",$tParams);

                                    }

                                    if($howManyProds == 10){
                                        $howManyProds = 0;
                                        $howManyPages++;
                                        echo "</div>";
                                        echo '<div class="bloque prod_pagination" id="pagination_'. $howManyPages . '" style="display: none;">';
                                    }

                                    if($p["tarifa_precio_adulto"] > $MaxPrice)
                                    {
                                        $MaxPrice = $p["tarifa_precio_adulto"];
                                    }

                                    if($i_real != $p["tour_id"]){
                                        $d = $p["tour_destino"];
                                        $preciosaB = "$" . number_format(Yii::app()->Currency->convert($_SESSION["config"]["currency"],$p["tarifa_precio_adulto"],0)) . "<span class='currency_code'>" . $_SESSION["config"]["currency"] . "</span>";

                                        if($p["tarifa_precio_adulto"] == 0){
                                            $preciosaB = "871". "<span class='currency_code'>" . $_SESSION["config"]["currency"] . "</span>";
                                        }?>
                                        <div class="promotion_home_info_displayer checkout">
                                            <a href="<?= $link_tourDetalle ?>" title="<?= $p["tour_nombre_es"]; ?>" class="btn_img_tour_link curved">
                                                <div class="img_container_display curved" style="background-image: url(//apstatic.lomastravel.com.mx/300/<?= $Fotos[$p["tour_galeria"]]; ?>);"></div>
                                            </a>
                                            <h1 class="misc_book_info_txt_home nametur_mobile ">
                                                <?php
                                                echo CHtml::link($p["tour_nombre"],$tParams,array("title"=>$p["tour_nombre"]));
                                                ?>
                                            </h1>

                                            <div class="div_misc_info_producto">
                                                <div class="fontsize_mobil">
                                                    <h1 class="misc_book_info_txt_home nametour_desk">
                                                        <?php
                                                        echo CHtml::link(Yii::app()->GenericFunctions->makeSinAcento($p["tour_nombre"]),$tParams,array("title"=>$p["tour_nombre"]));
                                                        ?>
                                                    </h1>
                                                    <label >Location: <?= utf8_decode($p["nombre_" . Yii::app()->language]); ?></label>
                                                    <label>Duration: <?= utf8_decode($p['tour_duracion'])  ?></label>
                                                    <label>
                                                        Categories:
                                                        <?php
                                                        $_cats = "";
                                                        if(isset($Categorias[$p["tour_id"]])){
                                                            foreach($Categorias[$p["tour_id"]] as $_c){
                                                                $_cats .= ", " . $_c["cnombre"];
                                                            }
                                                        }
                                                        echo substr($_cats,1);
                                                        ?>
                                                    </label>
                                                    <a class = 'checkut_moredetails' href="<?= $link_tourDetalle ?>">More Details</a>
                                                </div>
                                                <div class="checkout_div_price">
                                                    <label class="description_price">
                                                        From :
                                                    </label>
                                                    <label class="label_price">
                                                        <? $tarifaGeneral = ($p["tarifa_precio_adulto"] > 0 )? $p["tarifa_precio_adulto"]: $p['tarifa_precio_menor'] ; ?>
                                                        <?= $_SESSION["config"]["currency"] . " $" . number_format(Yii::app()->Currency->convert($_SESSION["config"]["currency"],$tarifaGeneral),0) ?>
                                                    </label>
                                                    <a class="fontsize_mobil a_selectDatesTour" href="<?= $link_tourDetalle ?>">Select Dates</a>
                                                </div>
                                            </div>
                                            <div class="hide div_tourExtra">
                                                <form class="cotiza_tour_extra" action="<?= $this->createUrl('tours/buscar') ?>">
                                                    <input type="hidden" name="dest"			 value="<?= $p["destino_clave"] ?>"/>
                                                    <input type="hidden" name="prod"			 value="<?= $p["tour_clave"] ?>"/>
                                                    <input type="hidden" name="isTourCategory"	 value="0"/>
                                                    <input type="hidden" name="tour_destination" value="<?=  $p["tour_nombre"] ?>"/>
                                                    <input type="hidden" name="TourId"			 value="<?= $p['tour_id'] ?>"/>
                                                    <input type="hidden" name="ProveedorId"		 value="0"/>
                                                    <input type="hidden" name="checkout_tour" 	value="ajax"/>
                                                    <div>
                                                        <label>Dates: </label>
                                                        <input type="text" name="fecha" value="<?= date_format($temp_InDate, 'm/d/Y')?>" class="dateInput"/>
                                                    </div>
                                                    <div>
                                                        <label>Adults: </label>
                                                        <input type="number" name="tour_adults" value="<?= $temp_Adults ?>" class="num_adults" />
                                                    </div>
                                                    <div>
                                                        <label>Children: </label>
                                                        <input type= "number" name="tour_childs" value="<?= $temp_Childs ?>" class="num_childs"/>
                                                    </div>
                                                    <input type="submit" value="Update Rates" class="submitForm"/>
                                                </form>
                                                <div class="rate_tour_extra">

                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        array_push($Trs,$_Tr);
                                        $howManyProds++;
                                        $i_real = $p["tour_id"];
                                    }
                                }
                                $_SESSION["TourSearch"][$_Cr]["Tours"] = $Trs;
                            }else{
                                //-> No hubo resultados
                            }
                            ?>
                        </div>

                        <div class="bloque" id="pagination_product">
                            <div class="bloque" id="misc_pagination_show_howmany">
                                <?= Yii::t("global","Mostrar"); ?>:
                                &nbsp;&nbsp;
                                <span class="howmany_show_counter curved">10</span>
                            </div>
                            <div class="bloque" id="misc_controls_pages_show" style="margin-top: -11px;">
                                <a href="#" title="Anterior" class="curved btn_nav_prev_pagination">&laquo; <?= Yii::t("global","Anterior"); ?></a>

                                <? for($i=1;$i<=$howManyPages;$i++){?>
                                    <a href="#" title="Pagina <?= $i; ?>" rel="<?= $i; ?>" class="misc_pagination_page_selector_option curved <?= (($i == 1) ? "active" : ""); ?>"><?= $i; ?></a>

                                <? }?>

                                <a href="#" title="Siguiente" class="curved btn_nav_next_pagination"><?= Yii::t("global","Siguiente"); ?> &raquo;</a>
                                <a href="#" title="Arriba" class="curved">&uarr; <?= Yii::t("global","Ir arriba"); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <? } ?>
        <br/><br/>
    </div>


    <div class="bloque normal_left shopping_cart" style="float: right;">
        <div class="prod_service_resume bloque curved">
            <label class="enc_prod_resume bloque" >
                Your Reservation
            </label>
            <? $Total = 0; ?>
            <? foreach($_Productos as $_p){ ?>
                <? $Total = $Total + $_p->descripcion_total; ?>
                <div>
                    <label> <?= $_p->descripcion_producto ?> </label>
                    <label class="shopping_moreDetails">More Details</label>
                    <? echo CHtml::link("x|Remove",array("checkout/index","query"=> Yii::app()->GenericFunctions->ProtectVar($_p->descripcion_id)),array("title"=>"Remove Item","class"=>"remove_link_checkout_prod"))," "; ?>

                    <div class="shopping_moreInformation hide">
                        <? if($_p->descripcion_id_cupon==1){?>
                            Valid to:
                        <?}else{?>
                            Date:
                        <?}?>
                        <?= Yii::app()->GenericFunctions->convertPresentableDates($_p->descripcion_fecha1); ?>

                        <? if($_p->descripcion_tipo_producto == 3){ ?>
                            <? if($_p->tipo_translado == 1 || $_p->tipo_translado == 5){ ?>
                                - <?= Yii::app()->GenericFunctions->convertPresentableDates($_p->descripcion_fecha2); ?>
                            <? } ?>
                        <? } ?>

                        <? if($_p->descripcion_tipo_producto == 1){ ?>
                            - <?= Yii::app()->GenericFunctions->convertPresentableDates($_p->descripcion_fecha2); ?>
                        <? } ?>

                        <br />

                        <?= $_p->descripcion_adultos; ?>
                        <?= Yii::t("global","Adulto|Adultos",$_p->descripcion_adultos); ?>

                        <? if($_p->descripcion_menores > 0){ ?>
                            -
                            <?= $_p->descripcion_menores; ?>
                            <?= Yii::t("global","Menor|Menores",$_p->descripcion_menores); ?>
                        <? } ?>

                        <br />

                        <? if($_p->descripcion_tipo_producto == 1){ ?>
                            <strong><?= Yii::t("global","Habitación") ?>:</strong>
                        <? }else{ ?>
                            <strong><?= Yii::t("global","Servicio") ?>:</strong>
                        <? } ?>

                        <?= $_p->descripcion_tarifa; ?>

                        <br />

                        <? if($_p->descripcion_tipo_producto == 1){ ?>
                            <? if($_p->valor_agregado!= "") {?>
                                <br /><strong><?= Yii::t("global","Valores Agregados") ?>:</strong>
                                <br /><?= $_p->valor_agregado; ?>
                            <? } ?>
                            <? if($_p->descripcion_promo_name != "") { ?>
                                <br /><strong><?= Yii::t("global","Promocion") ?>:</strong>
                                <br /><?= $_p->descripcion_promo_name; ?>
                            <? } ?>
                        <? } ?>

                    </div>

                    <label class="shopping_Price">
                        <?=  $_SESSION["config"]["currency"] ." $". number_format($_p->descripcion_total,0); ?>
                    </label>
                </div>
            <? } ?>
            <div class="prod_service_resume_total">
                <table class="shopping_table" >
                    <tr>
                        <td>TOTAL </td>
                        <td><?= $_SESSION["config"]["currency"]. " $". number_format($Total,0); ?></td>
                    </tr>
                </table>
            </div>
        </div>

		<span class = "shopping_continue">
			<?= CHtml::link(Yii::t("global","Pagar"),array("checkout/detalle"),array("title"=>"Pagar","class"=>"curved misc_select_btn_green")); ?>
		</span>

    </div>
</div>
<script type="text/javascript">
    needRedirect = true;
</script>
<script>
    $(document).ready(function(e) {
        messageAjax="<?= Yii::t("global","Se ha agregado el producto"); ?>";
        loadDateTransfers();

        $(".shopping_moreDetails").click(function () {
            element = $(this).closest('div').find('.shopping_moreInformation');
            if (element.hasClass( "hide" )) {
                element.removeClass('hide');
            }else{
                element.addClass('hide');
            };
            console.log(element);
        });

        var dateFormat="mm/dd/yy";
        $( ".dateInput").datepicker({
            defaultDate: 1,
            changeMonth: false,
            dateFormat: dateFormat,
            minDate: 2,
            numberOfMonths: 1
        });

        $('.a_selectDatesTour').on('click',function (event) {
            event.preventDefault();
            element = $(this).closest('.promotion_home_info_displayer').find('.div_tourExtra');
            if (element.hasClass('hide')) {
                element.slideDown();
                element.removeClass('hide');
            }else{
                element.slideUp();
                element.addClass('hide');
            };
        });
        //Hotel
        /*$('.a_selectDatesHotel').on('click',function (event) {
         event.preventDefault();
         element = $(this).closest('.promotion_home_info_displayer').find('.div_hotelExtra');
         if (element.hasClass('hide')) {
         element.slideDown();
         element.removeClass('hide');
         }else{
         element.slideUp();
         element.addClass('hide');
         };
         });*/

        $('.linkInformation').on('click',function () {
            element = $(this).closest('li').find('.moreInformation');
            if (element.hasClass('hide')) {
                element.slideDown();
                element.removeClass('hide');
            }else{
                element.slideUp();
                element.addClass('hide');
            };
        })
        $('.cotiza_tour_extra').on('submit',function (event) {
            event.preventDefault();
            console.log($(this));
            divRates = $(this).closest('.div_tourExtra');
            data = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                type: "GET",
                data : data,
                success : function (data) {
                    console.log(data);
                    divRates.find('.rate_tour_extra').html(data);
                },
                beforeSend : function () {
                    divRates.find('.rate_tour_extra').html('<img src="img/ajax-loader.gif">');
                }
            });
        });

        $('.cotiza_hotel_extra').on('submit',function (event) {
            event.preventDefault();
            console.log($(this));
            divRates = $(this).closest('.div_hotelExtra');
            data = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                type: "GET",
                data : data,
                success : function (data) {
                    console.log(data);
                    divRates.find('.rate_hotel_extra').html(data);
                },
                beforeSend : function () {
                    divRates.find('.rate_hotel_extra').html('<img src="img/ajax-loader.gif">');
                }
            });
        });

        $('.transfer_radio').on('click',function () {
            var url = $(this).closest('li').find('a').attr('href');
            location.href=url;

            console.log(url);
        })

        $('.servicio_radio').on('click',function () {
            var url = $(this).closest('li').find('a').attr('href');
            location.href=url;
            console.log(url);
        });
    });

    function loadDateTransfers(){
        $("#transfer_arrival2").val("<?=$temp_HotelCheckIn?>");
        $("#transfer_return2").val("<?=$temp_HotelCheckOut?>");
    }


</script>
