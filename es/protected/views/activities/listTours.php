
<script type="text/javascript">
 var data=<?print_r($tours)?>;
 var urlBase="<? echo Yii::app()->params['baseUrl']; ?>";
 var dataUrl="<?=$dataUrl?>";
</script>
<?

$pax_adulto=$_REQUEST['tour_adults'];
$pax_menor=$_REQUEST['tour_child'];
?>
<div class="row">
    <section id="toursLF" class="contentSide listContainer box jplist">
        <div class="col s12 m10 offset-m1">
            <h1 class="infoResult">Actividades en <?php echo $_REQUEST["tour_destination"]; ?></h1>
            <h2 class="infoSearch">
                Viajando el <?php echo Yii::app()->GenericFunctions->convertDate($tour_fecha); ?>
                - <?php echo $pax_adulto; ?> <?php echo ($pax_adulto == 1) ? "Adulto" : "Adultos"; ?>, <?php echo $pax_menor; ?> <?php echo ($pax_menor == 1) ? "Niño" : "Niños"; ?>
            </h2>
        </div>
        <!-- PANEL DE CONTROLES -->
        <div class="jplist-panel box panel-top col s12 m10 offset-m1 grey lighten-2">
            <!-- Controles -->
            <div class="sortSearch">
                <!-- Control de Paginacion -->
                <div class="jplist-label" data-type="Page {current} of {pages}" data-control-type="pagination-info" data-control-name="paging" data-control-action="paging"></div>

                <!-- Selector de elementos por pagina -->
                <select id="jplist-select-paging" class="jplist-select browser-default" data-control-type="items-per-page-select" data-control-name="paging" data-control-action="paging">
                    <option data-number="3"> 3 por página </option>
                    <option data-number="5" data-default="true"> 5 por página </option>
                    <option data-number="10"> 10 por página </option>
                    <option data-number="all"> Ver Todos </option>
                </select>

                <!-- Selector de ordenacion -->
                <select id="jplist-select-sort" class="jplist-select browser-default" data-control-type="sort-select" data-control-name="sort" data-control-action="sort">
                    <option data-path="default">Ordenar por</option>
                    <option data-path=".price" data-order="asc" data-type="number"> Precio (Menor a Mayor) </option>
                    <option data-path=".price" data-order="desc" data-type="number"> Precio (Mayor a Menor) </option>
                </select>
            </div>

            <!-- Paginacion -->
            <div class="pagination">
                <div class="jplist-pagination" data-control-type="pagination" data-control-name="paging" data-control-action="paging" data-mode="google-like" data-range="5"></div>
            </div>

        </div>



        <div class="col s12 m10 offset-m1 grey lighten-2">
            <div id="listaTours">

            </div>
        </div>
        <!-- Paginacion -->
        <div class="jplist-panel box panel-top col s12 m10 offset-m1">
            <div class="pagination">
                <div class="jplist-pagination" data-control-type="pagination" data-control-name="paging" data-control-action="paging" data-mode="google-like" data-range="5"></div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        console.log("entro ");
        $("#toursLF").jplist({itemsBox:".list",itemPath:".list-item",panelPath:".jplist-panel",effect:"fade"})
    });
</script>