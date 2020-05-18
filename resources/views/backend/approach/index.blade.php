@extends('backend.layouts.master')
@section('title')
<title>{{__('messages.dashboard_text')}}</title>
@endsection

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->

    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <!-- <span class="text-uppercase page-subtitle">Dashboard</span> -->
            {{-- <h3 class="page-title">Portal Overview</h3> --}}
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Small Stats Blocks -->
    <div class="row">
        <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
                <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">



                    </div>

                </div>
            </div>
        </div>




    </div>
</div>
@endsection