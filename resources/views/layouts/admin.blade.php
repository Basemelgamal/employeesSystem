@include('admin.includes.header')
@include('admin.includes.sidebar')
<div class="content-wrapper" style="min-height: 226px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                @yield('content')
            </div>
        </div>
    </div>
</div>



@include('admin.includes.footer')
