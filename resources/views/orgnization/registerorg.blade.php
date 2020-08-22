<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

        @error('name')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>
<!--shortName-->
<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Short Name') }}</label>

    <div class="col-md-6">
        <input id="shortName" type="text" class="form-control @error('name') is-invalid @enderror" name="shortName" value="{{ old('shortName') }}" required autocomplete="name" autofocus>

        @error('name')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>
<!--contactPerson-->
<div class="form-group row">
    <label for="contactPerson" class="col-md-4 col-form-label text-md-right">{{ __('Contact Person') }}</label>

    <div class="col-md-6">
        <input id="contactPerson" type="name" class="form-control @error('name') is-invalid @enderror" name="contactPerson" value="{{ old('contactPerson') }}" required autocomplete="name" autofocus>

        @error('contactPerson')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>
<!--contact-->
<div class="form-group row">
    <label for="contact" class="col-md-4 col-form-label text-md-right">{{ __('Contact') }}</label>

    <div class="col-md-6">
        <input id="contact" type="tel" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required autocomplete="contact" autofocus>

        @error('contact')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

    <div class="col-md-6">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

        @error('email')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>
<!--regDate-->
<div class="form-group row">
    <label for="regDate" class="col-md-4 col-form-label text-md-right">{{ __('Registration Date') }}</label>

    <div class="col-md-6">
        <input id="regDate" type="date" class="form-control @error('date') is-invalid @enderror" name="regDate" value="{{ old('regDate') }}" required autocomplete="regDate" autofocus>

        @error('regDate')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

    <div class="col-md-6">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

        @error('password')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

    <div class="col-md-6">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
    </div>
</div>

<div class="">
    <div class="">
        <button type="submit" class="btn btn-default standard-button green-button">
            {{ __('Register') }}
        </button>
    </div>
</div>






<!--- NAVIGATION -->
<nav class="navbar navbar-expand-md navbar-left bg-white shadow-sm ">
    <div class="  navbar-inverse bs-docs-nav navbar-fixed-top sticky-navigation" role="navigation">
        <div class="container">
            <div class="navbar-header">

                <!--- NAVBAR EXPAND COLLAPSE ON MOBILE -->
                <button type="button" class="navbar-toggle " data-toggle="collapse" data-target="#posNav">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon icon-menu"></span>
                </button>

                <!--- LOGO -->
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('images/newLog.png') }}"width="50" height="50" alt="LOGO">
                </a>

            </div>

            <div class="navbar-collapse collapse" id="posNav">
                <!--- NAVIGATION LINK -->
                <ul class="nav navbar-nav navbar-right main-navigation mr-auto " id="internal-scroll">
                    <li class="nav-item "><a href="#home">Home</a>
                    </li>
                    <li class="nav-item"><a href="#section1">About</a>
                    </li>
                    <li class="nav-item"><a href="#section2">Services</a>
                    </li>
                    <li class="nav-item"><a href="#section4">Team</a>
                    </li>
                    <li class="nav-item"><a href="#section10">Contact</a>
                    </li>
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item"> <a href="{{ url('/home') }}">Home</a></li>
                        @else
                            <li class="nav-item"><a href="{{ route('login') }}">Login</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item"><a href='{!! url('/regOrg/create')!!}'>Register</a>
                                </li>
                        @endif
                    @endauth
                @endif

                <!--- <li><a href="http://example.com" class="external">External Link Example</a></li> -->
                </ul>
            </div>

        </div>
        <!--- /END CONTAINER -->
    </div>

</nav>>
<!--- /END NAIVATION -->
