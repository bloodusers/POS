@extends('layouts.theme')

@section('content')

    <div class="container-md step-box-left diffuse-shadow red-line-bottom white-bg wow fadeInLeft">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class=" row card-header offset-8">
                        <div class="content-area">

                            <h2> {{ __('Admin Page') }}</h2>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class=" container-md step-box-right diffuse-shadow red-line-bottom white-bg wow fadeInLeft">
        <div class="row ">
            <div class="col-md-8">
                <div class="card">
                    <div class=" row card-header offset-8">
                        <div class="content-area">

                            <table class="table table-hover">

                                <thead>
                                <th>id</th>
                                <th>Name</th>
                                <th>Short Name</th>
                                <th>Contact Person</th>
                                <th>Contact</th>
                                <th>Mail</th>
                                <th>registration date</th>
                                <th>Status</th>

                                </thead>

                                <tbody>
                                <div class="card-body">
                                    @foreach(App\User::all() as $user)

                                        asl msla ye he k mein fron end wala nai hu bnda aur front end krtey huey hi time lag jata bra

                                        <tr>
                                            <td>{{$user->id}} </td>
                                            <td>{{$user->name}} </td>

                                            <td>{{$user->shortName}} </td>

                                            <td>{{$user->contactPerson}} </td>
                                            <td>{{$user->contact}} </td>
                                            <td>{{$user->email}} </td>
                                            <td>{{$user->regDate}} </td>
                                            <td>
                                                @if($user->isActive)
                                                    <h6 class="green-text">Activated</h6>
                                                @else
                                                    <h6 class="red-text">Deactivated</h6>
                                                @endif
                                            </td>
                                            <td>
                                                <form method="post" action="changeStatus/{{$user->id}}">
                                                    @csrf
                                                    <button type="submit"
                                                            @if($user->isActive==1)
                                                            class="btn  red-button rad">
                                                        {{ __('Deactivate') }}
                                                        @else
                                                            class="btn green-button">
                                                            {{ __('  Ativate  ') }}
                                                        @endif
                                                    </button>
                                                </form>

                                            </td>


                                        </tr>
                                    @endforeach
                                </div>
                                </tbody>

                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>
@endsection
