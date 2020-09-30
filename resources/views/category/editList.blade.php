@extends('layouts.theme')

@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{dd( session()->get('message') )}}
        </div>
    @endif

    <h3 class="green-text">
        Showing {{($data->currentPage()-1)* $data->perPage()+($data->total() ? 1:0)}} to
        {{($data->currentPage()-1)*$data->perPage()+count($data)}} of
        {{$data->total()}} Results
    </h3>
    <table class="table table-hover text-center">
        <div class="row focuses">
            <thead class="thead-dark font-weight-bold">
            <th style="text-align:center">
                <h6 class="green-text" style="text-align:center">id</h6>
            </th>
            <th style="text-align:center">
                <h6 class="green-text">Name</h6>
            </th>
            <th style="text-align:center">
                <h6 class="green-text">Parent</h6>
            </th>
            <th style="text-align:center">
                <h6 class="green-text">Update</h6>
            </th>
            @if(Auth::user()->role->rolePrivileges['canDelete'])
                <th style="text-align:center">
                    <h6 class="red-text">Delete</h6>
                </th>
            @endif
            </thead>

            <tbody>
                @foreach($data as $cat)
                    <tr>
                        <td>{{$cat->id}} </td>
                        <div class="" style="max-width: 30px">
                            <td>{{ucfirst($cat->name)}} </td>
                        </div>
                        <td>{{ucfirst(\App\Category::find($cat->category_id)->name??'NA')}} </td>
                        <td>
                            <form method="post" action="Cat/{{$cat->id}}/edit">
                                @csrf
                                <button type="submit"
                                        class="btn green-button"
                                        style="padding-right: 35px;padding-left: 35px;border-radius: 5%;border-style: none;background-color: #17a2b8">
                                    {{ __('Update') }}
                                </button>
                            </form>
                        </td>
                        @if(Auth::user()->role->rolePrivileges['canDelete'])
                            <td>
                                    <button class="btn btn-danger" href="#" onclick="
                                        var result=confirm('Are you Sure you Want to remove {{ucfirst($cat->name)}}');
                                        if(result)
                                        {
                                        event.preventDefault();
                                        document.getElementById('delete-form').action ='{{route('Category.destroy',[$cat->id])}}';
                                        document.getElementById('delete-form').submit();
                                        }">
                                        {{ __('Delete') }}
                                    </button>
                                    <form id="delete-form" method="post"
                                          style="display: none">
                                        @csrf
                                        <input type="hidden" name="_method" value="delete">
                                    </form>
                            </td>
                        @endif

                    </tr>
                @endforeach
            </tbody>
        </div>
    </table>
    <div class="" style="">
        {{$data->links()}}
    </div>
    </div>
    </div>
    </div>
@endsection
<!--

                                                            <form method="post" action="Cat/{{$cat->id}}/delete">
                                                                @csrf
@method("Patch")
    <button type="submit"
            class="btn red-button"
            style="padding-right: 35px;padding-left: 35px;border-radius: 5%;border-style: none">
{{ __('Delete') }}
    </button>
</form>
-->


{{--<form id="{{$cat->id}}" method="post"
      action="{{route('Category.destroy',[$cat->id])}}"
      style="display: none">
    @csrf
    <input type="hidden" name="_method" value="delete">
</form>--}}
