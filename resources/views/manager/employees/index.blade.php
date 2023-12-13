@extends('layouts.app')
@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    <h1> Employees </h1>
                    <div class="col-12 mt-3">
                        <div class="col-12">
                            <form method="GET" action="{{ route('employees.index') }}">
                                @csrf
                                @method('GET')
                                <div class="row">
                                    <div class="form-group">
                                        <input type="text" name="search" id="search" class="form-control" value="">
                                    </div>
                                    <div class="form-group col-2">
                                        <label for="search">
                                            <strong>
                                                <button type="submit" class="btn btn-primary waves-effect btn-sm waves-danger">Search</button>
                                            </strong>
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @can('publish employees')
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{ $routeCreate }}">
                                    Add
                                </a>
                            </li>
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
                    <div class="col-12">
                        <table id="kt_datatable" class="table dt-responsive table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                            <thead>
                                <tr>
                                    <th class="sorting" tab index="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">ID</th>
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">name</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Contacts</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Manager</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Department</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Salary</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Image</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Created At</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                                <tr class="odd">
                                    <td>{{ $employee->id }}</td>
                                    <td class="dtr-control sorting_1" tabindex="0">{{$employee->name}}</td>
                                    <td>
                                        <small>
                                            Mobile:
                                            <strong>
                                                {{ ' '.$employee->phone }}
                                            </strong>
                                        </small>
                                        <br>
                                        <small>
                                            E-Mail:
                                            <strong>
                                                {{ ''.$employee->email }}
                                            </strong>
                                        </small>
                                    </td>
                                    <td>{{ $employee->managerName }}</td>
                                    <td>{{ $employee->departmentName }}</td>
                                    <td>{{ $employee->salary }}</td>
                                    <td>
                                        @if(!is_null($employee->image))
                                            <img src="{{ $employee->image }}" alt="employee_picture" style="width:150px; height:100px">
                                        @endif
                                    </td>
                                    <td>{{ $employee->created_at }}</td>
                                    <td>
                                        <div class="col-md-12">

                                            <div class="row">
                                                @can('edit employees')
                                                <div class="col-4">
                                                    <a class="btn btn-primary waves-effect btn-sm waves-info fa fa-edit" href="{{ route('employees.edit', $employee->id) }}"> </a>
                                                </div>
                                                @endcan
                                                @can('delete employees')
                                                <div class="col-4">
                                                    <form method="POST" action="{{ route('employees.destroy', $employee->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger waves-effect fa fa-trash-alt btn-sm waves-danger"></button>
                                                    </form>
                                                </div>
                                            @endcan
                                            @can('publish tasks')
                                                <div class="col-4">
                                                    <a class="btn btn-light" href="{{ route('tasks.index', $employee->id) }}">
                                                        Tasks
                                                    </a>
                                                </div>
                                                @endcan
                                            </div>
                                        </div>
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

