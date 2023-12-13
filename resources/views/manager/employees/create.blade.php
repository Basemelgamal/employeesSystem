@extends('layouts.app')
@section('content')

<!-- left column -->
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Create Employee</h1>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <div class="col-12">
            <form action="{{ route('employees.store') }}" enctype="multipart/form-data" method="post">
                @csrf
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" value="{{ old('first_name') }}" id="first_name"
                            name="first_name" placeholder="First Name">
                        @error('first_name')
                            <small class="aleart text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" value="{{ old('last_name') }}" id="last_name"
                            name="last_name" placeholder="Last Name">
                        @error('last_name')
                            <small class="aleart text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" class="form-control" value="{{ old('phone') }}" id="phone"
                            name="phone" placeholder="Phone Number">
                        @error('phone')
                            <small class="aleart text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="email">E-Mail</label>
                        <input type="email" class="form-control" value="{{ old('email') }}" id="email"
                            name="email" placeholder="E-Mail">
                        @error('email')
                            <small class="aleart text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="salary">Salary</label>
                        <input type="text" class="form-control" value="{{ old('salary') }}" id="salary"
                            name="salary" placeholder="Salary">
                        @error('salary')
                            <small class="aleart text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="manager">Manager</label>
                        <select name="manager_id" class="form-select">
                            <option disabled selected>Open this select menu</option>
                            @foreach($managers as $key => $manager)
                                <option value="{{ $manager->id }}" {{ !is_null(old('manager_id')) ? ($manager->id == old('manager_id') ? 'selected' : '') : '' }}>{{ $manager->name }}</option>
                            @endforeach
                        </select>
                        @error('manager_id')
                            <small class="aleart text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="department">Department</label>
                        <select name="department_id" class="form-select">
                            <option disabled selected>Open this select menu</option>
                            @foreach($departments as $key => $department)
                                <option value="{{ $department->id }}" {{ !is_null(old('department_id')) ? ($department->id == old('department_id') ? 'selected' : '') : '' }}>{{ $department->name }}</option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <small class="aleart text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" value="{{ old('image') }}" class="form-control" id="image"
                            name="image" placeholder="Image">
                        @error('image')
                            <small class="aleart text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                            placeholder="">
                        @error('password')
                            <small class="aleart text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.card -->

</div>
@stop
