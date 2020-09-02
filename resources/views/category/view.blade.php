@extends('layouts.theme')

@section('content')

    <div class="container-md step-box-left diffuse-shadow red-line-bottom white-bg wow fadeInLeft">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class=" row card-header offset-8">
                        <div class="content-area">

                            <h2 class="green-text"> {{ __('Admin Page') }}</h2>
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

        <div class="col-md-8">
            <div class="card">
                <div class="row justify-content-center">
                    <div class=" row card-header offset-6">
                        <div class="content-area">

                            <table class="table table-hover content-area ">

                                <thead>
                                <th>
                                    <h6 class="green-text">id</h6>
                                </th>
                                <th>
                                    <h6 class="green-text">Name</h6>
                                </th>
                                <th>
                                    <h6 class="green-text">Description</h6>
                                </th>

                                </thead>

                                <tbody>

                                <div class="card-body border-left-20">
                                    @foreach(App\Category::all()->where('organization_id', '=',Auth::user()->organization_id) as $data)
                                        <tr>
                                            <td>{{$data->id}} </td>
                                            <td>{{$data->name}} </td>

                                            <td>{{$data->description}} </td>

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
