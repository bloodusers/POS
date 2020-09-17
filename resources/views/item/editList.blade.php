@extends('layouts.theme')

@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{dd( session()->get('message') )}}
        </div>
    @endif
    <div class="card">
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

                                <table class="table " style="">
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
                                                <h6 class="green-text">Desctiption</h6>
                                            </th>
                                            <th style="text-align:center">
                                                <h6 class="green-text">Category</h6>
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
                                                    <td>
                                                    <img src="/storage/{{($item->image)}} " height="100px" width="100px" />
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
                                                            <li>
                                                                <a href="#" onclick="
                                                                    var result=confirm('Are you Sure you Want to remove {{ucfirst($item->name)}}');
                                                                    if(result)
                                                                    {
                                                                    event.preventDefault();
                                                                    document.getElementById({{$item->id}}).submit();
                                                                    }"

                                                                >
                                                                    <button type="submit"
                                                                            class="btn red-button"
                                                                            style="padding-right: 35px;padding-left: 35px;border-radius: 5%;border-style: none">
                                                                        {{ __('Delete') }}
                                                                    </button>
                                                                </a>
                                                                <form id="{{$item->id}}" method="post"
                                                                      action="{{route('Category.destroy',[$item->id])}}"
                                                                      style="display: none">
                                                                    @csrf
                                                                    <input type="hidden" name="_method" value="delete">
                                                                </form>
                                                            </li>
                                                        </td>
                                                    @endif

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
@endsection
