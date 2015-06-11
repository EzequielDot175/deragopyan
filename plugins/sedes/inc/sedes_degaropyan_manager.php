<?php function sedes_degaropyan_manager(){
    global $wpdb;
    $sql = "SELECT * FROM ".$wpdb->prefix."sedes_degaropyan ";
    $rows = $wpdb->get_results( $sql , ARRAY_A);
    $count = count($rows);
    $dir = wp_upload_dir();
    $dir = $dir["baseurl"]."/sedes/";
    if ($count > 0) {

?>
<script>
    jQuery(document).ready(function($) {
        $('.controls .delete').click(function(event) {
            if (!confirm("¿Esta seguro de eliminar esta sede?")) {
                event.preventDefault();
            };
        });
    });
</script>
                <div class="jw_admin_wrap">
                    <?php foreach($rows as $key => $val){ ?>
                    <?php (!empty($val["mediosdecontacto"]) ? $medios = unserialize($val["mediosdecontacto"]) : $medios = ""); ?>
                    <div class="sedes-degaropyan-box">
                        <h4><?php echo($val["name"]) ?></h4>
                        <img src="<?php echo($dir.$val["image"]) ?>" >
                        <div class="medios">
                            <?php 
                            if ($medios != ""):
                            foreach ($medios as $mdk => $mdv) : ?>
                                <p>
                                    <span><?php echo($mdk); ?>:</span>
                                    <br>
                                    <?php foreach ($mdv as $smdk => $smdv): 
                                        echo($smdv."<br>");
                                    
                                    endforeach;
                                 endforeach;
                            endif;
                            ?>
                            </p>
                        </div>
                        <div class="controls">
                            <a href="admin.php?page=sedes_degaropyan_edit&edit_sede=<?php echo($val["id"]) ?>" class="edit">Editar</a>
                            <a href="admin.php?page=remove_sedes_degaropyan_manager&find=<?php echo($val["id"]) ?>" class="delete">Borrar</a>
                            <input type="hidden" value="">
                        </div>
                    </div>
                   <?php } ?>

                    <h2>Agregar una nueva sede</h2>
                    <a href="admin.php?page=sedes_degaropyan_manager_create"><button class="button primary-button">Crear Sede</button></a>
                </div>

    <?php }else{ ?>    

                <div class="jw_admin_wrap">
                    <h2>Agregar una nueva sede</h2>
                    <a href="admin.php?page=sedes_degaropyan_manager_create"><button class="button primary-button">Crear Sede</button></a>
                </div>
        
<?php        
}}?>


