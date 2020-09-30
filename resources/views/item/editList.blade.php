@extends('layouts.theme')

@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{dd( session()->get('message') )}}
        </div>
    @endif

    <h3 class="justify-content-center">
        Showing {{($data->currentPage()-1)* $data->perPage()+($data->total() ? 1:0)}} to
        {{($data->currentPage()-1)*$data->perPage()+count($data)}} of
        {{$data->total()}} Results
    </h3>
    <table class="table table-hover text-center">
        <div class="row focuses">
            <thead class="thead-dark font-weight-bold">
            <thead class="thead-dark">
            <strong>
                <th style="text-align:center">
                    <h6 class="green-text" style="text-align:center">id</h6>
                </th>
                <th style="text-align:center">
                    <h6 class="green-text">Name</h6>
                </th>
                <th style="text-align:center">
                    <h6 class="green-text">Desctiption</h6>
                </th>
                <th style="text-align:center">
                    <h6 class="green-text">Category</h6>
                </th>
                <th style="text-align:center">
                    <h6 class="green-text">Price</h6>
                </th>
                <th style="text-align:center">
                    <h6 class="green-text">Image</h6>
                </th>
                <th style="text-align:center">
                    <h6 class="green-text">Update</h6>
                </th>
                @if(Auth::user()->role->rolePrivileges['canDelete'])
                    <th style="text-align:center">
                        <h6 class="red-text">Delete</h6>
                    </th>
                @endif
            </strong>
            </thead>

            <tbody>
            <div class="card-body justify-content-start dropdown-btn">
                @foreach($data as $item)

                    <tr>
                        <td>{{$item->id}} </td>
                        <div class="" style="max-width: 30px">
                            <td>{{ucfirst($item->name)}} </td>
                        </div>
                        <td>{{ucfirst($item->description)}} </td>
                        <td>{{ucfirst(\App\Category::find($item->category_id)->name??'NA')}} </td>
                        <td>{{$item->price}} </td>
                        <td>
                            <img src="/storage/{{($item->image)}} " height="100px" width="100px"/>
                        </td>
                        <td>
                            <form method="post" action="item/{{$item->id}}/edit">
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
                                    var result=confirm('Are you Sure you Want to remove {{ucfirst($item->name)}}');
                                    if(result)
                                    {
                                    event.preventDefault();
                                    document.getElementById({{$item->id}}).submit();
                                    }"

                                >
                                    {{ __('Delete') }}
                                </button>
                                <form id="{{$item->id}}" method="post"
                                      action="{{route('Category.destroy',[$item->id])}}"
                                      style="display: none">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete">
                                </form>
                            </td>
                        @endif

                    </tr>
                @endforeach
            </div>

            </tbody>
        </div>
    </table>
    <div class="justify-content-center" >
        {{$data->links()}}
    </div>
@endsection
