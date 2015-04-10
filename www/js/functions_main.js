/*
* Add fields to the "new form" form
* TODO: get types from BD in the Slim controller and pass them as a JSON to this function, so changing them
* in the database changes them here
*/

function addFields()
{
    // Number of fields
    var numberFields = parseInt($('#number_fields').val());

    if (numberFields > 100)
    {
        alert("The number of fields is too high");
        return; 
    }

    // Now we generate the form

    $('#submit_fields').removeAttr('disabled');
    $('#field_dynamic_container').html('');

    for (i = 0; i < numberFields; i++)
    {
        var field_html = '<h4>Field '+ (i+1) +'</h4><div class="form-group"><label class="col-sm-2 control-label" for="field_type_'+ (i+1) +'">Type of the field</label><div class="col-sm-10"><select name="field_type_'+ (i+1) +'"><option value="1">text</option><option value="2">textarea</option><option value="3">checkbox</option><option value="4">email</option></select></div>';
        field_html += '<label class="col-sm-2 control-label" for="field_length_'+ (i+1) +'">Length of the field (only if text)</label><div class="col-sm-10"><input type="text" name="field_length_'+ (i+1) +'" value="150" /></div></div>';
        
        $('#field_dynamic_container').append(field_html);
    }

}

/*
* Show the snippet panel in the listing page
*/

function showSnippet(id, title)
{


    var include_html = '<p>Paste this code in a PHP file:</p>';
    include_html += '<p>&lt;?php</p>';
    include_html += '<p>$_hf_form_id = '+ id +';</p>';
    include_html += '<p>include(\'<strong>directory_of_hfforms</strong>/render_form.php\');</p>';
    include_html += '<p>?&gt;</p>';
    // We set up the content
    $('#snippet_title').html('Include the form <strong>' + title + '</strong> in your project');
    $('#snippet_body').html(include_html);
    $('#snippet').fadeIn('fast');
}



// Make snippet clickable
$(function(){
$('.clickable').on('click',function(){
    var effect = $(this).data('effect');
        $(this).closest('.panel')[effect]();
    })
})
