@extends('backend.layouts.master')
@section('title')
<title>{{__('messages.manage_users')}}</title>
@endsection

@section('content')

@include('backend.flash_message.flash_message')
@can('retrieve_users')
<div id="user_main_message"></div>
<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <!-- <span class="text-uppercase page-subtitle">Overview</span> -->
            <h3 class="page-title">{{$title}}</h3>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Default Light Table -->
    @can('users_view')
    <div class="row" id="div">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">{{$title}}</h6>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                    <table id="user_list_tbl" class="table mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>{{__('messages.name')}}</th>
                                <th>{{__('messages.email')}}</th>
                                <th>
                                    <!-- <a href="" class="btn btn-primary float-right"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Create New </span></a> -->
                                    @can('user_create')
                                    <button type="button" name='view' class="btn btn-primary float-righ"
                                        id="create_new">
                                        <i class="fas fa-plus-square"></i>
                                        <span class="hide-menu"> {{__('messages.create_new')}} </span>
                                    </button>
                                    @endcan
                                </th>
                            </tr>
                            </thead>
                            <?php

					$i = 1;
					?>
                        <tbody>
                            @foreach($users as $user)

                            <tr>
                                <td><?= $i; ?></td>
                                <td>{{$user->name}}
                                    <input type="hidden" name="uuu<?= $i; ?>" id="user_name{{$user->id}}" value="{{$user->name}} ">
                                </td>

                                <td>{{$user->email}}</td>
                                <td>
                                    @can('user_profile_view')
                                    <a href="<?php echo(\Config::get('app.url').'/user_update/'.$user->id)?>"
                                        class="btn btn-info" id="update_user"><i class="fas fa-eye"></i> {{__('messages.view')}}</a>
                                    @endcan
                                    @can('user_permission_view')
                                    <button type="button" class="btn btn-info permission_view" id="{{$user->id}}"><i
                                            class="fas fa-edit"></i> {{__('messages.permission_view')}}</button>
                                    @endcan
                                    @can('user_password_change')
                                    <button type="button" class="btn btn-warning password_change" id="{{$user->id}}"><i
                                            class="fas fa-edit"></i> {{__('messages.change_password')}}</button>
                                    @endcan
                                    @can('user_delete')
                                    <button type="button" class="btn btn-danger user_delete" id="{{$user->id}}">
                                        <i class="fas fa-trash-alt"></i> {{__('messages.delete')}} </button>
                                    @endcan
                                </td>
                            </tr>
                            <?php $i++ ?>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    @endcan
    <!-- End Default Light Table -->

</div>
@endcan



@endsection