@extends('layouts.app')
@section('content')
<!-- left column -->
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">

        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('employees.update', $employee->id) }}" enctype="multipart/form-data" method="post">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" value="{{ $employee->first_name }}" id="first_name"
                        name="first_name" placeholder="First Name">
                    @error('first_name')
                        <small class="aleart text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" value="{{ $employee->last_name }}" id="last_name"
                        name="last_name" placeholder="Last Name">
                    @error('last_name')
                        <small class="aleart text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" class="form-control" value="{{ $employee->phone }}" id="phone"
                        name="phone" placeholder="Phone Number">
                    @error('phone')
                        <small class="aleart text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="email" class="form-control" value="{{ $employee->email }}" id="email"
                        name="email" placeholder="E-Mail">
                    @error('email')
                        <small class="aleart text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="salary">Salary</label>
                    <input type="text" class="form-control" value="{{ $employee->salary }}" id="salary"
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
                            <option value="{{ $manager->id }}" {{ $manager->id == $employee->manager?->id ? 'selected' : '' }}>
                                {{ $manager->name }}
                            </option>
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
                            <option value="{{ $department->id }}" {{ $department->id == $employee->department?->id ? 'selected' : '' }}>
                                {{ $department->name }}
                            </option>
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
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                    @error('password')
                        <small class="aleart text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    Edit
                </button>
            </div>
        </form>
    </div>
    <!-- /.card -->

</div>
@stop
