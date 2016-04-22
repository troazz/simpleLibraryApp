@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('_flashmessage')
        <div class="col-md-8">
            <div class="clearfix">
                <h4 class="pull-left">List Category</h4>
                <span class="pull-right">
                    <div class="input-group" style="display: inline-block">
                        <form class="form-inline" action="{{ url('category') }}" method="get">
                            <div class="input-group input-group-sm">
                                <input placeholder="Search" name="q" value="{{ $request->input('q') }}" type="text" class="form-control">
                                <span class="input-group-btn">
                                  <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i>
                                  </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </span>
            </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th style="width:150px;text-align: center;">Action</th>
                </tr>
                </thead>
                <tbody>
                @if (count($categories))
                    <?php
                    $i = 0;
                    ?>
                    @foreach($categories as $row)
                        <?php
                        $i++;
                        $act_param = $param;
                        $act_param['id'] = $row->id;
                        ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $row->name }}</td>
                            <td>
                                <center>
                                    {!! Form::open(['url' => ['category/delete/'.$row->id], 'role' => 'form', 'method' => 'delete']) !!}
                                        <div class="btn-group" role="group">
                                            <a class="btn btn-sm btn-default" title="Update Category" href="{{ route('category-edit', $act_param) }}">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete Category" onclick='return confirm("Are you sure want to delete this data?")'>
                                                <i class="fa fa-remove"></i>
                                            </button>
                                        </div>
                                    {!! Form::close() !!}
                                </center>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">There's no record to display</td>
                    </tr>
                @endif
                </tbody>
            </table>
            {!! $categories->render() !!}
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">{{ empty($category->id) ? 'Add New' : 'Update Category' }}</div>

                <div class="panel-body">
                    {!! Form::model($category, ['url' => ['category'], 'role' => 'form']) !!}
                    {!! Form::hidden('id') !!}
                    <div class="box-body">
                        <div class="form-group {{ ($errors->first('name')) ? 'has-error' : '' }}">
                            {!! Form::label('name') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Category Name','autofocus' => 'autofocus']) !!}
                            @if ($errors->first('name'))
                                <label class="control-label" for="inputError">
                                    <i class="fa fa-times-circle-o"></i> {{ $errors->first('name') }}
                                </label>
                            @endif
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-sm  btn-primary"><i class="fa fa-save"></i>&nbsp; Save</button>
                        @if($category->id)
                            <a class="btn btn-sm btn-default" href="{{ route('category', $param) }}">
                                Cancel
                            </a>
                        @endif
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
