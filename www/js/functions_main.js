/*
* Add fields to the "new form" form
* TODO: get types from BD in the Slim controller and pass them as a JSON to this function, so changing them
* in the database changes them here
*/

function addFields()
{
    // Number of fields
    var numberFields = $('#number_fields').val();
    // Now we generate the form

    $('#submit_fields').removeAttr('disabled');
    $('#field_dynamic_container').html('');

    for (i = 0; i < parseInt(numberFields); i++)
    {
        var field_html = '<h4>Field '+ (i+1) +'</h4><div class="form-group"><label class="col-sm-2 control-label" for="field_type_'+ (i+1) +'">Type of the field</label><div class="col-sm-10"><select name="field_type_'+ (i+1) +'"><option value="1">text</option><option value="2">textarea</option><option value="3">checkbox</option><option value="4">email</option></select></div>';
        field_html += '<label class="col-sm-2 control-label" for="field_length_'+ (i+1) +'">Length of the field (only if text)</label><div class="col-sm-10"><input type="text" name="field_length_'+ (i+1) +'" value="150" /></div></div>';
        
        $('#field_dynamic_container').append(field_html);
    }

}