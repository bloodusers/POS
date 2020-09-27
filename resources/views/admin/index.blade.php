@extends('layouts.theme')

@section('content')

    <div class="card">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="card" style="">

            <div class="col-md-8">
                <div class="">
                    <h3 class="green-text">
                        Showing {{($data->currentPage()-1)* $data->perPage()+($data->total() ? 1:0)}} to
                        {{($data->currentPage()-1)*$data->perPage()+count($data)}} of
                        {{$data->total()}} Results
                    </h3>
                    <div class="row justify-content-center">
                        <div class=" row card-header offset-6">
                            <div class="content-area">

                                <table class=" card table" style="">
                                    <div class="row focuses">
                                        <thead>
                                        <strong>
                                            <th style="text-align:center">
                                                <h6 class="green-text" style="text-align:center">id</h6>
                                            </th>
                                            <th style="text-align:center">
                                                <h6 class="green-text">Name</h6>
                                            </th>
                                            <th style="text-align:center">
                                                <h6 class="green-text">Short Name</h6>
                                            </th>
                                            <th style="text-align:center">
                                                <h6 class="green-text">Contact Person</h6>
                                            </th>
                                            <th style="text-align:center">
                                                <h6 class="green-text">Contact</h6>
                                            </th>
                                            <th style="text-align:center">
                                                <h6 class="green-text">Mail</h6>
                                            </th>
                                            <th style="text-align:center">
                                                <h6 class="green-text">Registration date</h6>
                                            </th>
                                            <th style="text-align:center">
                                                <h6 class="green-text">Status</h6>
                                            </th>
                                            <th style="text-align:center">
                                                <h6 class="green-text">Change Status</h6>
                                            </th>
                                            <th style="text-align:center">
                                                <h6 class="green-text"><strong> Edit Organization</strong></h6>
                                            </th>
                                        </strong>
                                        </thead>

                                        <tbody>
                                        <div class="card-body justify-content-start">
                                            @foreach($data as $user)

                                                <tr>
                                                    <td>{{$user->id}} </td>
                                                    <div class="" style="max-width: 30px">
                                                        <td>{{$user->name}} </td>
                                                    </div>


                                                    <td>{{$user->shortName}} </td>

                                                    <td>{{$user->contactPerson}} </td>
                                                    <td>{{$user->contact}} </td>
                                                    <div class=" col-lg-1 col-sm-1 col-xs-12" style="column-gap: 20px;">
                                                        <td>{{$user->email}} </td>
                                                    </div>
                                                    <td>{{$user->regDate}} </td>
                                                    <td>
                                                        <h6 id="STATUS{{$user->id}}"
                                                            @if($user->isActive)
                                                            class="green-text">Activated
                                                            @else
                                                                class="red-text">Deactivated
                                                            @endif
                                                        </h6>
                                                    </td>
                                                    <td class="text-center w-set vertical_align : top">
                                                        <div class="form-inline">
                                                            @csrf
                                                            <button onclick="changeStatus(this,{{$user->id}});"
                                                                    class="btn green-button "
                                                                    @if($user->isActive)
                                                                    style="background-color: red">
                                                                {{ __('Deactivate') }}
                                                                @else >
                                                                    {{ __('Activate') }}
                                                                @endif
{{--                                                                <i class="fa fa-spinner fa-spin"></i> Changing status--}}
                                                            </button>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <form method="post" action="org/{{$user->id}}/edit">
                                                            @csrf
                                                            <button type="submit"
                                                                    class="btn green-button"
                                                                    style="padding-right: 35px;padding-left: 35px;border-radius: 5%;border-style: none;background-color: #17a2b8">
                                                                {{ __('Edit') }}
                                                            </button>
                                                        </form>
                                                    </td>


                                                </tr>
                                            @endforeach
                                        </div>

                                        </tbody>
                                    </div>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="" style="">
                    {{$data->links()}}
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        function changeStatus(tag, $id) {
            /*<div class="loader{{$user->id}}">
            <center>
                <img class="loading-image" >
            </center>
        </div>*/
            tag.disabled=true;
            //tag.innerHTML='<i src="fa fa-spinner fa-spin"></i> Changing status';
            tag.innerText = "Changing status";
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({

                url: "/org/" + $id + "/changeStatus",
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function (data) {
                    tag.disabled=false;
                    //console.log("success");
                    if (data) {
                        //console.log("green");
                        $(tag).css('background-color', 'red');
                        tag.innerText = "Deactivate";
                        document.getElementById("STATUS" + $id).innerText = "Activated";
                        document.getElementById("STATUS" + $id).classList = "green-text";
                    } else {
                        //console.log("red");
                        $(tag).css('background-color', '#38c695');
                        tag.innerText = "Activate";
                        document.getElementById("STATUS" + $id).innerText = "Deactivated";
                        document.getElementById("STATUS" + $id).classList = "red-text";
                    }
                }
            });
        }
    </script>
    <script type="text/javascript">
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    </script>
@endsection
