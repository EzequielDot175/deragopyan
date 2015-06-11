<style>
    .cursor{
        cursor: pointer;
    }
    .boxorgani .name{
        display: none;
    }
    .boxorgani button.search{
          display: block;
          width: 100%;
          margin: 0 auto;
    }
    .bg-img{
        width: 100px!important;
        background-size: cover!important;
        border: 0!important;
        padding: 0!important;
    }
</style>
<div class="organi-panel-admin">
    <h1>Crear organigrama</h1>
    
    <div class="organi-controls">
        <label for="organi-name">
        Nombre del organigrama
        </label><br>
        <input type="text" placeholder="Nombre del organigrama" id="organigrama-nombre">
        <br>
        
        <div class="controls-organichart">
            <div class="filtro">
                <form action="" id="filtro-personal">
                    <h3>Filtro de personal</h3>
                    <div class="cell">
                        <label for="">Sede</label>
                        <select name="dir_sede" id="">
                            <option value="">Seleccionar</option>
                            <?php sedes_deragopyan_options_fetch(); ?>
                        </select>
                    </div>
                    <div class="cell">
                        <label for="">Puesto</label>
                        <select name="dir_puesto" id="">
                            <option value="">Seleccionar</option>
                            <?php D_Puestos::getOptions() ?>
                        </select>
                    </div>
                    <div class="cell">
                        <label for="">Grupo de trabajo</label>
                        <select name="dir_grupo" id="">
                            <option value="">Seleccionar</option>
                            <?php D_Grupos::getOptions() ?>
                        </select>
                    </div>
                    <div class="cell">
                        <label for="">Gerencia/grupo de trabajo</label>
                        <select name="dir_gerencia" id="">
                            <option value="">Seleccionar</option>
                            <?php D_Gerencia::getOptions() ?>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="displayControls" style="display:none;">
        <input type="text">
    </div>
    <input type="hidden" id='tmp-organi-data'>
    <div id="chart_div"></div>
    <button onclick="saveOrgani();">Guardar organigrama</button>
</div>

<script>

     

      function _(a){return document.getElementById(a)}
      function _s(a){return document.querySelectorAll(a)}
      function _c(a){return document.getElementsByClassName(a)}
     google.load("visualization", "1", {packages:["orgchart"]});
     google.setOnLoadCallback(drawChart);
     var html = '<div class="boxorgani">\
                    <select class="getSearch"></select>\
                    <button class="search">Buscar</button>\
                    <img alt="" style="" class="bg-img" height="100" />\
                    <h3 class="name"></h3>\
                    <input type="hidden" value="%parent%" />\
                    <input type="hidden" value="%id%" />\
                    <span class="dashicons dashicons-plus-alt cursor" onclick="addEmployer(this);"></span>\
                    <span class="dashicons dashicons-no cursor" onclick="deleteThis(this);" style="display:none;"></span>\
                </div>';
    var iniData = [{v:"1",f:html.replace(/%parent%/, 0).replace(/%id%/,1)},"",""];
    var organiData = [iniData];
    var ids = Math.random();
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');
        data.addRows(organiData);
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        chart.draw(data, {allowHtml:true});
      }
      function addEmployer(element){
        ids++;
        // actualizar empleado
        actualizar();
        // agregar empleado
        var thisId = element.parentNode.childNodes[11].value;
        var newId = ids.toString();
        var parentValue = thisId.toString();
        var newEmployer = [{v:newId,f:html.replace(/%parent%/, parentValue).replace(/%id%/,newId).replace(/style="display:none;"/, '')},parentValue,""];
        organiData.push(newEmployer);
        drawChart();
      }
      function actualizar(){
            var boxs = _c("boxorgani");
            for (var i = 0; i < boxs.length; i++) {
                currentId = boxs[i].childNodes[11].value;
                for (var z = 0; z < organiData.length; z++) {
                    if (organiData[z][0].v == currentId) {
                        organiData[z][0].f = boxs[i].outerHTML;
                    };
                };
            };
      }
      function deleteThis(element){
        var ThisId = element.parentNode.childNodes[11].value;
        for (var z = 0; z < organiData.length; z++) {
            if (organiData[z][0].v == ThisId) {
                organiData.splice(z, 1);
            };
        };
        drawChart();
      }
      function toFrontData(){
        var frontOrganiData = [];
        for (var i = 0; i < organiData.length; i++) {
            newData = [
                {
                    f: organiData[i][0]
                    .f
                    .replace(/<select*(.*)select>/, '')
                    .replace(/<button*(.*)button>/, '')
                    .replace(/<span*(.*)span>/, ''),
                    v: organiData[i][0].v
                },
                    organiData[i][1]
                ,
                    organiData[i][2]
            ]
            frontOrganiData.push(newData);
        };
        return frontOrganiData;
      }
      function saveOrgani(){
        var frontOrganiData = toFrontData();
        actualizar();
        sendAjax(frontOrganiData,organiData);
      }
      function sendAjax(front,back){
        var name_organi = document.getElementById("organigrama-nombre").value;
        if (name_organi != "") {
            var data = {frontOrgani: front, backOrgani:  back,action:"ajaxfilterpersonal", name_organi: name_organi};
            jQuery(document).ready(function($) {
                    $.post(ajaxurl, data, function(data) {
                        var result = parseInt(data.trim());
                        if (result == 1) {window.location.href = "?page=organigrama-deragopyan"}else{alert("Error al intentar crear organigrama.")}
                    });
            });
        }else{
            alert("Nombre del organigrama vacio, por favor escriba uno.");
        }
      }
     
</script>


<!-- /<select*(.*)select>/igm -->