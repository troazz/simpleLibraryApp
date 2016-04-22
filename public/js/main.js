$(function(){
    $(document).on('click', '.ajax-modal', function(e){
        e.preventDefault();
        var obj = $(this);

        $.ajax({
            url: obj.data('url'),
            success: function(data){
                $('#ajax-modal .modal-title').html(obj.data('title'));
                $('#ajax-modal .modal-body').html(data);
                $('#ajax-modal').modal();
            }
        });
    });
})