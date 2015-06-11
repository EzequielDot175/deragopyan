jQuery(document).ready(function($) {
        var dataForm;
        $('#filtro-personal').submit(function(event) {
            event.preventDefault();
            dataForm = $(this).serializeArray();
            var newData = [];
            $.each(dataForm, function(index, val) {
                if(val.value !== ""){
                    newData.push(val);
                }
            });
            dataForm = newData;
        });
        $(document).on('change', '.getSearch', function(event) {
            event.preventDefault();
            var id_request = $(this).val();
            var selected = $(this).children('option[value="'+id_request+'"]');
            var img = $(this).parent().children('img');
            var div = $(this).parent().children('.bg-img');
            $(this).children('option').removeAttr('selected');
            selected.attr('selected','');
            $(this).val(id_request);
            $(this).parent().children('h3').text(selected.text());
            $.post(ajaxurl,{action: "ajaxfilterpersonal", searchFromDirectory: id_request}, function(data) {
                img.attr('style', "background:url("+data.trim()+")");
            });
        });
        $(document).on('click','.boxorgani button.search',function() {
            $('#filtro-personal').trigger('submit');
            var select = $(this).parent().children('.getSearch');
            if (dataForm.length == 0) {dataForm = ""};
                $.post(ajaxurl, {action: "ajaxfilterpersonal", search: dataForm}, function(data) {
                    select.empty();
                    select.append('<option value="">Seleccione empleado</option>');
                    select.append(data.trim());
                });
            
        });




            

    });

