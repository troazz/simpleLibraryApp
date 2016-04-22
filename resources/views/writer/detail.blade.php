
@if (!empty($writer->photo) && is_file(public_path().'/uploads/photo/'.$writer->photo))
    <center>
    {!! Html::image('uploads/photo/'.$writer->photo, $writer->name, ['class' => 'img-circle', 'width' => '150']) !!}
    </center>
    <br />
@endif
<dl class="dl-horizontal">
<dt>Address</dt>
<dd>{{ $writer->address }}</dd>
<dt>Phone Number</dt>
<dd>{{ $writer->phone }}</dd>
<dt>Notes</dt>
<dd>{!! nl2br($writer->notes) !!}</dd>
</dl>