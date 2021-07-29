jQuery(document).ready(function($) {

    $('.nuf-new-user-form').on('submit', function(e){
        e.preventDefault();
        var form = $(this);

        $.ajax({
            url: nuf_ajax.ajax_url,
            method: 'POST',
            data: form.serialize(),
            dataType: 'JSON',
            success: function(response){
                console.log(response);
            },
            error: function(xhr){
                console.log(xhr.responseText);
            }
        });
    });
    
});