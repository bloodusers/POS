@extends('layouts.theme')

@section('content')
</br>
</br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h2>
                    <div class="card-header">{{ __('Register your Organization') }}</div>
                </h2>

                <div class="card-body">
                    <form method="POST" action="{{ route('/registerOrg') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!--shortName-->
                        <div class="form-group row">
                            <label for="name"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Short Name') }}</label>

                            <div class="col-md-6">
                                <input id="shortName" type="text"
                                       class="form-control @error('name') is-invalid @enderror" name="shortName"
                                       value="{{ old('shortName') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!--contactPerson-->
                        <div class="form-group row">
                            <label for="contactPerson"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Contact Person') }}</label>

                            <div class="col-md-6">
                                <input id="contactPerson" type="name"
                                       class="form-control @error('name') is-invalid @enderror" name="contactPerson"
                                       value="{{ old('contactPerson') }}" required autocomplete="name" autofocus>

                                @error('contactPerson')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!--contact-->
                        <div class="form-group row">
                            <label for="contact"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Contact') }}</label>

                            <div class="col-md-6">
                                <input id="contact" type="tel"
                                       class="form-control @error('contact') is-invalid @enderror" name="contact"
                                       value="{{ old('contact') }}" required autocomplete="contact" autofocus>

                                @error('contact')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email"
                                   class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="">
                            <div class="">
                                <button type="submit" class="btn btn-default standard-button green-button">
                                    {{ __('Register') }}
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
