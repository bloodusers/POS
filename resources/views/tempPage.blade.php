@extends('layouts.theme')

@section('content')



    <section class="home fixed-bg" id="home">

        <div class="color-overlay">
            <!-- COLOR OVERLAY -->



            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1 col-md-12">

                        <!-- INTRO HEADING -->
                        <h1 class="intro white-text text-center">We design things with love and passion.</h1>

                        <!-- CALL TO ACTION -->
                        <div class="cta smooth-scroll">
                            <a id="fetchBtn" href="#section3" class="btn btn-default standard-button red-button">Our Works</a>
                            <a id ="popBtn" href="#section2" class="btn btn-default standard-button green-button">Services</a>
                        </div>

                    </div>
                </div>

                <div class="row text-center">

                    <!-- 3 FEATURES ON HOMEPAGE -->
                    <div class="home-features">

                        <!-- SINGLE FEATURE -->
                        <div class="col-md-4 col-sm-4">
                            <div class="single-feature">
                                <div class="icon green-text">
                                    <span class="icon icon-money-regular"></span>
                                    <!-- ICON -->
                                </div>
                                <h6 class="green-text uppercase">Fixed Price Projects</h6>
                            </div>
                        </div>

                        <!-- SINGLE FEATURE -->
                        <div class="col-md-4 col-sm-4">
                            <div class="single-feature">
                                <div class="icon purple-text">
                                    <span class="icon icon-clock-regular"></span>
                                    <!-- ICON -->
                                </div>
                                <h6 class="purple-text uppercase">Receive On Time</h6>
                            </div>
                        </div>

                        <!-- SINGLE FEATURE -->
                        <div class="col-md-4 col-sm-4">
                            <div class="single-feature">
                                <div class="icon yellow-text">
                                    <span class="icon icon-happy-smiley-streamline"></span>
                                    <!-- ICON -->
                                </div>
                                <h6 class="yellow-text uppercase">Satisfaction Guranteed</h6>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- END OF 3 FEATURES -->

            </div>
        </div>
        <div class="container">
            <h1>Employee list</h1>
            <ul id="list">

            </ul>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script src="js/ajax.js"></script>



@endsection
