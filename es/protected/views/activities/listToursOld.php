<div class="content">



    <div class="col s12 m10 offset-m1">
        <h1 class="infoResult">Activities in <?php echo $_REQUEST["tour_destination"]; ?></h1>
        <h2 class="infoSearch">
            traveling on <?php echo Yii::app()->GenericFunctions->convertDate($tour_fecha); ?>
            - <?php echo $pax_adulto; ?> <?php echo ($pax_adulto == 1) ? "Adult" : "Adults"; ?>, <?php echo $pax_menor; ?> <?php echo ($pax_menor == 1) ? "Child" : "Children"; ?>
        </h2>
    </div>


    <div id="main_tours">
        <!-- <div id="ajaxHotelResults"></div> -->

        <!-- Lista de los Hoteles en el Destino -->
        <section id="toursLF" class="contentSide listContainer box jplist">

            <!-- PANEL DE CONTROLES -->
            <div class="jplist-panel box panel-top">

                <!-- Controles -->
                <div class="sortSearch">

                    <!-- Control de Paginacion -->
                    <div class="jplist-label" data-type="Page {current} of {pages}" data-control-type="pagination-info" data-control-name="paging" data-control-action="paging"></div>

                    <!-- Selector de elementos por pagina -->
                    <select id="jplist-select-paging" class="jplist-select" data-control-type="items-per-page-select" data-control-name="paging" data-control-action="paging">
                        <option data-number="3"> 3 per page </option>
                        <option data-number="5" data-default="true"> 5 per page </option>
                        <option data-number="10"> 10 per page </option>
                        <option data-number="all"> View All </option>
                    </select>

                    <!-- Selector de ordenacion -->
                    <select id="jplist-select-sort" class="jplist-select" data-control-type="sort-select" data-control-name="sort" data-control-action="sort">
                        <option data-path="default">Sort by</option>
                        <option data-path=".price" data-order="asc" data-type="number"> Price (low to high) </option>
                        <option data-path=".price" data-order="desc" data-type="number"> Price (high to low) </option>
                    </select>

                </div>

                <!-- Paginacion -->
                <div class="pagination">
                    <div class="jplist-pagination" data-control-type="pagination" data-control-name="paging" data-control-action="paging" data-mode="google-like" data-range="5"></div>
                </div>

            </div>


            <!-- LISTADO DE ACTIVIDADES -->
            <div id="itemContainer" class="list box text-shadow">
                <$_Tours=$tours>
                <?php foreach($_Tours as $p): ?>
                    <article class="elementList list-item">

                        <!-- Fotografia de la actividad -->
                        <div class="miniPhoto">
                            <a href="<?php echo $this->createUrl("tours/detalle",array("dest"=> $p['destino_clave'], "prod"=> $p["tour_clave"], "tour_fecha"=> $tour_fecha, "tour_adults"=> $pax_adulto, "tour_childs"=> $pax_menor)); ?>" title="<?php echo $p["tour_nombre"] ?>" class="btn_img_tour_link_a">
                                <img src="//apstatic.lomastravel.com.mx/204/<?php echo $Fotos[$p["tour_galeria"]]; ?>"  alt="<?php echo $p["foto_en_alt"] ?>" />
                            </a>
                        </div>

                        <!-- Informacion de la Actividad -->
                        <div class="elementData">
                            <div class="elementName">
                                <?php echo CHtml::link(utf8_encode($p["tour_nombre"]),array("tours/detalle","dest"=> $p['destino_clave'], "prod"=> $p["tour_clave"], "tour_fecha"=> $tour_fecha, "tour_adults"=> $pax_adulto, "tour_childs"=> $pax_menor),array("title"=>$p["tour_nombre"])); ?>
                            </div>

                            <p class="elementDesc"><?php echo utf8_encode(substr($p["descripcion_corta"],0,120)) . "..."; ?></p>
                            <span class="smallLetter">
                                <a class="misc_destination_info_home shadow" href="<?= $this->createUrl("tours/listado",array("dest"=> $p["destino_clave"])); ?>" title="<?= $p["nombre_en"] ?>">
                                    <span>Destination: </span><?= $p["nombre_en"]; ?>
                                </a>
                            </span>
                        </div>

                        <!-- Book de la actividad -->
                        <div class="elementTax">
                            <?php $tarifaGeneral = ($p["precio_adulto"] > 0 )? $p["precio_adulto"]: $p['precio_menor'] ; ?>
                            <div  style="display:none;" class="price"><?php echo number_format(Yii::app()->Currency->convert($_SESSION["config"]["currency"],$tarifaGeneral),0); ?></div>
                            <span class="bloque"><? echo Yii::t("global","desde"); ?></span>
                            <div class="elementPrice">
                                <span class='currency_code'><?php echo $_SESSION["config"]["currency"]; ?></span> $ <?php echo number_format(Yii::app()->Currency->convert($_SESSION["config"]["currency"],$tarifaGeneral),0) ?>
                            </div>

                            <div class="elementBook">
                                <? echo CHtml::link("BOOK",array("tours/detalle","dest"=> $p['destino_clave'],"prod"=> $p["tour_clave"], "tour_fecha"=> $tour_fecha, "tour_adults"=> $pax_adulto, "tour_childs"=> $pax_menor),array("title"=>"Selecionar Tour","class"=>"book curved misc_select_btn_green")); ?>
                            </div>
                        </div>

                    </article>
                <?php endforeach; ?>

            </div>

            <!-- Paginacion -->
            <div class="jplist-panel box panel-top">
                <div class="pagination">
                    <div class="jplist-pagination" data-control-type="pagination" data-control-name="paging" data-control-action="paging" data-mode="google-like" data-range="5"></div>
                </div>
            </div>

        </section>

        <!-- Banner Lateral Derecho -->
        <aside class="aSide">
            <?php echo $this->renderPartial('application.views.partials.bannerslaterales', array("_BannersLaterales"=>$_BannersLaterales)); ?>
        </aside>

    </div>
    <!-- FIN main_tours -->

</div>