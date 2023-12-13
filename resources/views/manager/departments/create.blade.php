@extends('layouts.app')
@section('content')

    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>Create Department</h1>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('departments.store') }}" enctype="multipart/form-data" method="post">
                @csrf
                    <div class="form-group col-md-12">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" class="form-control" value="{{ old('name') }}" id="name"
                            name="name" placeholder="Name">
                        @error('name')
                            <small class="aleart text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>

@stop
