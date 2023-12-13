@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if ($is_employee)
            @foreach($tasks as $key => $task)
                <div class="col-md-4">
                    <div class="card">
                    <div class="card-header">{{ __('Tasks') }}</div>

                    <div class="card-body">
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <strong for="">
                                            Title:
                                        </strong>
                                        <p>{{ $task->title }}</p>
                                    </div>
                                    <div class="col-12">
                                        <strong> subject: </strong>
                                        <p>
                                            {{ $task->subject }}
                                        </p>
                                    </div>
                                </div>
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    {{ __('You are logged in!') }}
                                </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-md-9 col-lg-10 table-container">
                <div class="col-md-8">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
            @endif
    </div>
</div>
@endsection
