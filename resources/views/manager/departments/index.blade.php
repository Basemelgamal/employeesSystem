@extends('layouts.app')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Departments</h1>
                </div>
                @can('publish departments')
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ $routeCreate }}">Add</a></li>
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
                                    <th class="sorting" tabindex="2" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">name</th>
                                    <th class="sorting" tabindex="2" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Count</th>
                                    <th class="sorting" tabindex="2" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Salaries</th>
                                    <th class="sorting" tabindex="5" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($departments as $department)
                                <tr class="odd">
                                    <td>{{ $department->id }}</td>
                                    <td>{{ $department->name }}</td>
                                    <td>{{ $department->employees?->count() ?? 0 }}</td>
                                    <td>{{ $department->totalSalaries }}</td>
                                    <td>{{ $department->created_at }}</td>
                                    <td>
                                        @can('edit departments')
                                            <a class="btn btn-primary waves-effect btn-sm waves-info fa fa-edit" href="{{ route('departments.edit', ['department' => $department->id]) }}"> </a>
                                        @endcan
                                        @can('delete departments')
                                            <form method="POST" action="{{ route("departments.destroy", $department->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger waves-effect fa fa-trash-alt btn-sm waves-danger"></button>
                                            </form>
                                        @endcan
                                    </td>
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
