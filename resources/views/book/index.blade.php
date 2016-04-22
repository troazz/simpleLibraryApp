@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('_flashmessage')
        <div class="col-lg-12">
            <div class="clearfix">
                <h4 class="pull-left">List Book</h4>
                <span class="pull-right">
                    <div class="input-group" style="display: inline-block">
                        <form class="form-inline" action="{{ url('book') }}" method="get">
                            <div class="input-group input-group-sm">
                                <input placeholder="Search" name="q" value="{{ $request->input('q') }}" type="text" class="form-control">
                                <span class="input-group-btn">
                                  <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i>
                                  </button>
                                </span>
                            </div>
                            <a href="{{ url('book/add') }}" class="btn btn-sm btn-success"><i class="fa fa-plus-square"></i> &nbsp; Add New Book</a>
                        </form>
                    </div>
                </span>
            </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th style="width:100px;">Category</th>
                    <th style="width:100px;">Publisher</th>
                    <th style="width:150px;">Keywords</th>
                    <th style="width:150px;text-align: center;">Action</th>
                </tr>
                </thead>
                <tbody>
                @if (count($books))
                    <?php
                    $i = 0;
                    ?>
                    @foreach($books as $row)
                        <?php
                        $i++;
                        ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $row->title }}<br /><small class="text-muted">{{ $row->synopsis }}</small></td>
                            <td>{{ $row->category->name }}</td>
                            <td>{{ $row->publisher->name }}</td>
                            <td>
                                @foreach($row->keywords as $v)
                                    <label class="label label-default">{{ $v->name }}</label>
                                @endforeach
                            </td>
                            <td>
                                <center>
                                    {!! Form::open(['url' => ['book/delete/'.$row->id], 'role' => 'form', 'method' => 'delete']) !!}
                                        <div class="btn-group" role="group">
                                            <a class="btn btn-sm btn-default" title="Update Book" href="{{ url('book/edit/'.$row->id) }}">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a class="ajax-modal btn btn-sm btn-info" title="Detail Book" data-title="{{ $row->title }}" href="#" data-url="{{ url('book/detail/'.$row->id) }}">
                                                <i class="fa fa-tasks"></i>
                                            </a>
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete Book" onclick='return confirm("Are you sure want to delete this data?")'>
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
                        <td colspan="6">There's no record to display</td>
                    </tr>
                @endif
                </tbody>
            </table>
            {!! $books->render() !!}
        </div>
    </div>
</div>
@endsection
