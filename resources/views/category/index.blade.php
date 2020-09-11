@extends('layouts.theme')

@section('content')
</br>
</br>a
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h2>
                    @if($info ?? '')
                        <div class="card-header">{{ __('Edit category') }}</div>
                    @else
                        <div class="card-header">{{ __('Add category') }}</div>
                    @endif
                </h2>

                <div class="card-body">
                    <form method="POST"
                          @if(!($info ?? ''))
                          action="{{ route('/regCategory') }}"
                          @else
                          action="/Cat/{{$info->id}}"
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
                        <div class="form-group row">
                            <label for="Description"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            {{$info->description??''}}
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
                            </div>
                        </div>
                        <!--new-->

                        <label for="category_id">Select parent category:</label>
                        <select id="category_id" name="category_id">
                            <option value="">NONE</option>
                            @foreach($data as $cat)
                                <option value={{$cat->id}}
                                @if($info??'')
                                @if($cat->id==$info->category_id??'')
                                    selected='selected'
                                    @endif
                                    @endif>{{ucfirst($cat->name)}}</option>
                                @foreach($cat->children as $subCat)
                                    <option value={{$subCat->id}}
                                    @if($info??'')
                                    @if($subCat->id==$info->category_id)
                                        selected='selected'
                                        @endif
                                        @endif>--{{ucfirst($subCat->name)}}</option>
                                @endforeach
                            @endforeach
                        </select>


                        <!--new-->
                        <div class="">
                            <div class="">
                                <button type="submit" class="btn btn-default standard-button green-button">
                                    @if($info->id ?? '')
                                        {{ __('edit category') }}
                                    @else
                                        {{ __('add category') }}
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
@endsection
