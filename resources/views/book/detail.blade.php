
@if (!empty($book->photo) && is_file(public_path().'/uploads/book/'.$book->photo))
    <center>
    {!! Html::image('uploads/book/'.$book->photo, $book->name, ['class' => 'img-rectangle', 'width' => '150']) !!}
    </center>
    <br />
@endif
<dl class="dl-horizontal">
<dt>Synopsis</dt>
<dd>{{ $book->synopsis }}</dd>
<dt>Category</dt>
<dd>{{ $book->category->name }}</dd>
<dt>Publisher</dt>
<dd>{{ $book->publisher->name }}</dd>
<dt>Writers</dt>
<dd>
    <?php
    $writer = [];
    foreach($book->writers as $v){
        $writer[] = '<a href="#" data-url="'.url('writer/detail/'.$v->id).'" data-title="'.$v->name.'" class="ajax-modal">'.$v->name.'</a>';
    }

    echo (empty($writer)) ? '-' : implode(', ', $writer);
    ?>
</dd>
<dt>Keywords</dt>
<dd>
    @foreach($book->keywords as $v)
        <label class="label label-default">{{ $v->name }}</label>
    @endforeach
</dd>
<dt>Description</dt>
<dd>{!! nl2br($book->description) !!}</dd>
</dl>