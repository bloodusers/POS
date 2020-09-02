@extends('layouts.theme')

@section('content')

    <div class="container-sm step-box-left diffuse-shadow red-line-bottom white-bg wow fadeInLeft">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class=" row card-header ">
                        <h2>
                            <div class="content-area">
                                <?php
                                //echo Auth::user()->role->rolePrivileges["canView"];
                                ?>
                                {{ __('Hello ').Auth::user()->name }}
                            </div>
                        </h2>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <hr>
                    @if (Auth::user()->role->rolePrivileges["canView"] )
                        <div class="btn green-button ">
                            <div class="margin"><a
                                    href="{{ route('adminPage') }}">{{ __('Admin Panel') }}</a></div>
                        </div>
                    @endif

                    @if (Auth::user()->role->rolePrivileges["canAdd"] )
                        <hr>
                        <div class="btn green-button ">
                            <div class="margin"><a
                                    href="{{ route('addOrg') }}">{{ __('Add Organization') }}</a></div>
                        </div>
                    @endif
                    @if (Auth::user()->role->rolePrivileges["canEdit"] )
                        <hr>
                        <div class="btn green-button ">
                            <div class="margin"><a
                                    href="{{ route('adminPage') }}">{{ __('Edit Organization') }}</a></div>
                        </div>
                    @endif
                    @if (Auth::user()->role->rolePrivileges["canDelete"] )
                        <hr>
                        <div class="btn green-button ">
                            <div class="margin"><a
                                    href="{{ route('adminPage') }}">{{ __('Remove Organization') }}</a></div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection
