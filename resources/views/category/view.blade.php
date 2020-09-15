@extends('layouts.theme')


@section('content')


    <!--
    <div class="container-md step-box-left diffuse-shadow red-line-bottom white-bg wow fadeInLeft">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class=" row card-header offset-8">
                        <div class="content-area">

                            <h2 class="green-text"> {{ __('Categories') }}</h2>
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
-->

    <!--new-->

    <div class="sidenav " style="margin-top: 70px;;font-size: smaller">

        @foreach($data as $cat)

            <button class="dropdown-btn">{{ucfirst($cat->name)}}
                <i class="fa fa-caret-down">
                </i>
            </button>
            <div class="dropdown-container">
                @foreach($cat->children as $subCat)
                    <button class="dropdown-btn">--{{ucfirst($subCat->name)}}

                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-container">
                        @foreach($subCat->children as $mod)
                            <button class="dropdown-btn">---{{ucfirst($mod->name)}}
                                <i class="fa fa-caret-down"></i>
                            </button>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
    <!--new-->
    <script>
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function () {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }
    </script>
@endsection

<!--
@foreach($data as $cat)
    <button class="dropdown-btn"style="margin-top: 200px ;padding-right: 20px">{{$cat->name}}
        <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-container">
        @foreach($cat->children as $subCat)
        <button class="dropdown-btn"style="margin-top: 200px ;padding-right: 20px">{{$subCat->name}}
            <i class="fa fa-caret-down"></i>
        </button>
@endforeach
        </div>
@endforeach


    -->
<!--
 @if($canEdit??'')
    <button type="submit"
            class="dropdown-btn"
            style="padding-top: 0.5px;padding-bottom: 0.5px;padding-right: 2px;padding-left: 2px;border-radius: 5%;border-style: none;margin-left: 0px;
            background-color: #17a2b8";>
{{ __('Edit') }}
        </button>
@endif
    -->
