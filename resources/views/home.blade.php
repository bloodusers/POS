@extends('layouts.theme')

@section('content')

    <div class="container-sm step-box-left diffuse-shadow red-line-bottom white-bg wow fadeInLeft">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class=" row card-header offset-8">
                        <div class="content-area">
                            <?php
                           //echo Auth::user()->role->rolePrivileges[0]["canView"];
                            ?>
                            {{ __('Dashboard') }}

                            @if (Auth::user()->role->rolePrivileges[0]["canView"] )
                                <div class="btn green-button ">
                                    <div class="margin"><a
                                            href="{{ route('adminPage') }}">{{ __('Admin Panel') }}</a></div>

                                    @endif
                                </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <hr>
                        {{ __('You are logged in!') }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
