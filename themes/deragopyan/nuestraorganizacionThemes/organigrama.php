<?php 
/**
*
* Template Name: Nuestra Organizacion - Organigrama
*
 *
 * @package Deragopyan
 */
?>

<?php //OrgranigramaDeragopyan::getMenuOrgani(); ?>

<?php require get_template_directory()."/subheader.php"; ?>

<div class="sectionName ">
  <h2><div class="cont-center">NUESTRA ORGANIZACIÓN</div></h2>
  <!--busqueda avanzada-->
  <?php //include 'searchAdvanced.php'; ?>
  <!--busqueda avanzada-->
  <div class="menu-options"></div>
</div>

<div class="background-sections deragopyan-container beneficios nuestra-organizacion">
  <div class="cont-center">
    
    <div class="column2 mr full">
      <div class="content-title-triangle">
        <div class="box-title"><?php echo $wp_query->post->post_title; ?></div>
      </div>
      <div id="organi"></div>
    
      
    </div>
    <div class="column1 panel-buttons sidebarRightFixed">
      <div class="filter-btn">
        <a href="/nuestra-organizacion/">MISIÓN, VISIÓN Y VALORES</a>
      </div>
      <div class="filter-btn">
        <a href="/nuestra-organizacion/sedes">NUESTRA SEDE</a>
      </div>
      <div class="filter-btn">
        <a href="/nuestra-organizacion/nuestra-historia">NUESTRA HISTORIA</a>
      </div>
      <div class="filter-btn">
        <a href="/nuestra-organizacion/organigrama">ORGANIGRAMA</a>
      </div>
    </div>
  </div>
</div>

<script>
google.load("visualization", "1", {packages:["orgchart"]});
  $(document).on('click', '.getAjaxOrgani', function(event) {
      event.preventDefault();
      var id = parseInt($(this)[0].hash.replace(/#/g,""));
      console.log(id);
      $.post('/wp-admin/admin-ajax.php', {action:"getfrontorgani",getOrganiId: id}, function(data) {
          var dataOrgani = JSON.parse(data);
          drawChart(dataOrgani);
      });
   });
 $(document).ready(function() {
    $.post('/wp-admin/admin-ajax.php', {action:"getfrontorgani",getOrganiDefault: ""}, function(data) {
          var defaultDataOrgani = JSON.parse(data);
          drawChart(defaultDataOrgani);
          $('tr,td').attr('title', '');
      });
  });
  function drawChart(a) {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');
        data.addRows(a);
        var chart = new google.visualization.OrgChart(document.getElementById('organi'));
        chart.draw(data, {allowHtml:true, nodeClass:"box-organi-deragopyan", selectedNodeClass: "box-organi-deragopyan-selected"});
      }
</script>

<?php require get_template_directory()."/pageFooter.php"; ?>
