@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('_flashmessage')
        <div class="col-lg-12">
            {!! Form::model($book, ['url' => ['book/save'], 'role' => 'form', 'files' => true, 'class' => 'form-horizontal']) !!}
            {!! Form::hidden('id') !!}
            {!! Form::hidden('referer', $referer) !!}
            <div class="form-group {{ ($errors->first('title')) ? 'has-error' : '' }}">
                {!! Form::label('title', null, ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Book Title','autofocus' => 'autofocus']) !!}
                    @if ($errors->first('title'))
                        <label class="control-label" for="inputError">
                            <i class="fa fa-times-circle-o"></i> {{ $errors->first('title') }}
                        </label>
                    @endif
                </div>
            </div>
            <div class="form-group {{ ($errors->first('synopsis')) ? 'has-error' : '' }}">
                {!! Form::label('synopsis', null, ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::textarea('synopsis', null, ['rows' => 2, 'class' => 'form-control', 'placeholder' => 'Book Synopsis']) !!}
                    @if ($errors->first('synopsis'))
                        <label class="control-label" for="inputError">
                            <i class="fa fa-times-circle-o"></i> {{ $errors->first('synopsis') }}
                        </label>
                    @endif
                </div>
            </div>
            <div class="form-group {{ ($errors->first('category')) ? 'has-error' : '' }}">
                {!! Form::label('category', null, ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::select('category', $categories, null, ['class' => 'form-control']) !!}
                    @if ($errors->first('category'))
                        <label class="control-label" for="inputError">
                            <i class="fa fa-times-circle-o"></i> {{ $errors->first('category') }}
                        </label>
                    @endif
                </div>
            </div>
            <div class="form-group {{ ($errors->first('publisher')) ? 'has-error' : '' }}">
                {!! Form::label('publisher', null, ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::select('publisher', $publishers, null, ['class' => 'form-control']) !!}
                    @if ($errors->first('publisher'))
                        <label class="control-label" for="inputError">
                            <i class="fa fa-times-circle-o"></i> {{ $errors->first('publisher') }}
                        </label>
                    @endif
                </div>
            </div>
            <div class="form-group {{ ($errors->first('writer')) ? 'has-error' : '' }}">
                {!! Form::label('writer', 'Writers', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('writer_cont', null, ['class' => 'form-control', 'placeholder' => 'Writers', 'name' => 'writer', 'id' => 'writer']) !!}
                    @if ($errors->first('writers'))
                        <label class="control-label" for="inputError">
                            <i class="fa fa-times-circle-o"></i> {{ $errors->first('writer') }}
                        </label>
                    @endif
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('keyword', 'Keywords', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::text('keyword_cont', null, ['class' => 'form-control', 'placeholder' => 'Keywords', 'name' => 'keyword', 'id' => 'keyword']) !!}
                </div>
            </div>
            <div class="form-group {{ $errors->first('photo') ? 'has-error' : '' }}">
                {!! Form::label('photo', null, ['class' => 'col-sm-2 control-label']) !!}

                <div class="col-sm-10">
                    @if (!empty($book->photo) && is_file(public_path().'/uploads/book/'.$book->photo))
                        <br />
                        {!! Html::image('uploads/book/'.$book->photo, $book->name, ['class' => 'img-rectangle', 'width' => '150']) !!}
                        <br />
                        <br />
                    @endif
                    {!! Form::file('photo') !!}
                    @if ($errors->first('photo'))
                        <label class="control-label" for="inputError">
                            <i class="fa fa-times-circle-o"></i> {{ $errors->first('photo') }}
                        </label>
                    @endif
                </div>
            </div>
            <div class="form-group {{ ($errors->first('description')) ? 'has-error' : '' }}">
                {!! Form::label('description', null, ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::textarea('description', null, ['rows' => 5, 'class' => 'form-control', 'placeholder' => 'Full Description']) !!}
                    @if ($errors->first('description'))
                        <label class="control-label" for="inputError">
                            <i class="fa fa-times-circle-o"></i> {{ $errors->first('description') }}
                        </label>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn  btn-primary"><i class="fa fa-save"></i>&nbsp; Save</button>
                    <a class="btn btn-default" href="{{ $referer }}">Cancel</a>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        var ms_writer = $('#writer').magicSuggest({
            data: '{{ url('book/remote/writer') }}',
            valueField: 'id',
            displayField: 'name',
            value: {!! json_encode($writers) !!},
            allowFreeEntries: false,
            dataUrlParams: { "_token": $('input[name="_token"]').val() },
            mode: 'remote',
            resultAsString: true
        });
        var ms_keyword = $('#keyword').magicSuggest({
            data: '{{ url('book/remote/keyword') }}',
            valueField: 'id',
            value: {!! json_encode($keywords) !!},
            dataUrlParams: { "_token": $('input[name="_token"]').val() },
            displayField: 'name',
            mode: 'remote',
            resultAsString: true
        });
    })
</script>
@endsection
