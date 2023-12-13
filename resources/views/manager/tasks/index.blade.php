@extends('layouts.app')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    <h1>{{ $employee->name.' Tasks' }}</h1>
                </div>
                @can('publish tasks')
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ $routeCreate }}">Add Task</a></li>
                        </ol>
                    </div>
                @endcan
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 col-md-6"></div>
                    <div class="col-sm-12 col-md-6"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="kt_datatable" class="table dt-responsive table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                            <thead>
                                <tr>
                                    <th class="sorting" tab index="1" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">#</th>
                                    <th class="sorting" tabindex="2" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">title</th>
                                    <th class="sorting" tabindex="2" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">subject</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr class="odd">
                                    <td>{{ $task->id }}</td>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->subject }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>
<!-- /.col -->
@endsection
