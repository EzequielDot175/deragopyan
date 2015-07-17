<?php 
/**
*
* Template Name: Nuestra Organizacion - Organigrama
*
 *
 * @package Deragopyan
 */



 ?>
<?php include $_SERVER["DOCUMENT_ROOT"]."/wp-content/themes/deragopyan/subheader.php"; ?>

<?php OrgranigramaDeragopyan::getMenuOrgani(); ?>

<div id="organi"></div>
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
      });
  });
  function drawChart(a) {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');
        data.addRows(a);
        var chart = new google.visualization.OrgChart(document.getElementById('organi'));
        chart.draw(data, {allowHtml:true});
      }
</script>

<?php include $_SERVER["DOCUMENT_ROOT"]."/wp-content/themes/deragopyan/pageFooter.php"; ?>
