function addFields()
{
    // Number of fields
    var numberFields = $('#number_fields').val();
    // Now we generate the form

    $('#submit_fields').removeAttr('disabled');
    $('#field_dynamic_container').html('');

    for (i = 0; i < parseInt(numberFields); i++)
    {
        var field_html = '<h4>Field '+ (i+1) +'</h4><div class="form-group"><label class="col-sm-2 control-label" for="field_type">Type of the field</label><div class="col-sm-10"><select name="field_type"><option value="1">text</option><option value="2">textarea</option><option value="3">checkbox</option></select></div></div>';
        $('#field_dynamic_container').append(field_html);
    }

}