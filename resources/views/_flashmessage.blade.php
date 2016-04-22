@if (Session::has('flash_message'))
    <?php
    $status = Session::has('flash_message_type') ? Session::get('flash_message_type') : 'success';
    ?>
    <div class="alert alert-{{ $status }} alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {!! ($status == 'success') ? '<h4><i class="icon fa fa-check"></i> Success!</h4>' : '<h4><i class="icon fa fa-ban"></i> Alert!</h4>' !!}
        {!! Session::get('flash_message') !!}
    </div>
@endif