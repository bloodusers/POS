@extends('layouts.theme')

@section('content')
</br>
</br>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h2>
                    @if($info ?? '')
                        <div class="card-header">{{ __('Edit Item') }}</div>
                    @else
                        <div class="card-header">{{ __('Add Item') }}</div>
                    @endif
                </h2>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data"
                          @if($info ?? '')
                          action="/item/{{$info->id}}"
                          @else
                          action="/regItem"
                        @endif>
                        @if($info ??'')
                            @method('PATCH')
                        @endif
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name') ??$info->name??''}}" required
                                       autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!--description-->
                        <div>
                            <label for="name"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <textarea name="description" id="desc"
                                      rows="5" cols="52">{{$info->description??''}}</textarea>
                        </div>
                        <!--code-->
                        <div class="form-group row">
                            <label for="item_code"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Item Code') }}</label>

                            <div class="col-md-6">
                                <input id="item_code" type="text"
                                       class="form-control @error('item_code') is-invalid @enderror"
                                       name="item_code" value="{{ old('item_code') ??$info->item_code??''}}" required
                                       autocomplete="name" autofocus>

                                @error('item_code')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!--price-->
                        <div class="form-group row">
                            <label for="price"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="number"
                                       class="form-control @error('price') is-invalid @enderror"
                                       name="price" value="{{ old('price') ??$info->price??''}}" required
                                       autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!--img-->
                        <div>
                            <strong><label for="image"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Add an Image') }}</label></strong>
                            <input type="file" accept="image/*"
                                   @if($info??'')
                                   value="/storage/{{($info->image??'')}}"
                                   @endif
                                   class="form-control-file" id="image" name="image">
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <!--dropDown-->

                        <label for="category_id" style="margin-top: 20px">Select category:</label>
                        <select id="category_id" name="category_id">
                            <option value="">NONE</option>
                            @foreach($data as $cat)
                                @foreach($cat->children as $subCat)
                                    @foreach($subCat->children as$gChild)
                                        <option value={{$gChild->id}}
                                        @if($info??'')
                                        @if($gChild->id==$info->category_id)
                                            selected='selected'
                                            @endif
                                            @endif>----{{ucfirst($gChild->name)}}</option>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </select>
                </div>


                <!--new-->
                <div class="">
                    <div class="">
                        <button type="submit" class="btn btn-default standard-button green-button">
                            @if($info->id ?? '')
                                {{ __('edit item') }}
                            @else
                                {{ __('add item') }}
                            @endif
                        </button>
                    </div>
                </div>

                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    function setVal() {
        document.getElementById("desc").value = "{{$info->description??''}}";
    }
</script>
@endsection
<!--<div class="form-group row">
                            <label for="Description"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="shortName" type="text"
                                          class="form-control @error('description') is-invalid @enderror"
                                          name="description"
                                          value="{{ old('description')??$info->description??'' }}"
                                          rows="5" cols="100">

                                @error('description')
    <span class="invalid-feedback red-text" role="alert">
            <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
    </textarea>
</div>-->
