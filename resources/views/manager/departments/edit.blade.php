@extends('layouts.app')
@section('content')
    <div class="col-sm-6">
        <h1>Update Department</h1>
    </div>
    </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('departments.update', $deparmtent->id) }}" enctype="multipart/form-data" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" value="{{ $department->name }}" id="name"
                                        name="name" placeholder="Name">
                                    @error('name')
                                        <small class="aleart text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
@stop

