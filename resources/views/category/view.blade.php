@extends('layouts.theme')


@section('content')

<br/>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse btn-group-vertical" id="navbarNav">
        <ul class="navbar-nav">

            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
        </ul>
    </div>
</nav>
    <!--new-->
    <div class="row">
        <div class="col-4">
            <div class="list-group" id="list-tab" role="tablist">

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
            </div>
        </div>
        @endforeach
    </div>
    <!--new-->


@endsection

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
