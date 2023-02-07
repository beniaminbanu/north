<section id="cuisine">
    <div class="headers d-flex flex-column align-items-center">
        @include('layouts.partials.slogan',[
                                    "class" => "slogan",
                                    "text"  =>  "North cuisine & Lounge",
                                    "text2" => ""
                                    ])
        <div class="head d-none d-lg-block">
            @include('layouts.partials.main-header',[
                       "class" => "main-header",
                       "text1"  =>  "North Restaurant",
                       "text2"  =>  " Cuisine"
                       ])
        </div>
        <div class="head d-lg-none">
            @include('layouts.partials.main-header',[
                       "class" => "main-header",
                       "text1"  =>  "North Restaurant",
                       "text2"  =>  "   new menu"
                       ])
        </div>
    </div>
    <div class="container-fluid">
        <div class="row d-flex align-items-center justify-content-around m-auto">
            <div class="col-12 col-lg-6">
                <div class="cuisine-image">
                    <img class="img-fluid" src="img/burgers.jpg" alt="image">
                    <img class="d-none d-lg-block img-fluid" src="img/friends.jpg" alt="image">
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="cuisine-wrapper">
                    @include('layouts.partials.slogan',[
                                                      "class" => "slogan",
                                                      "text"  =>  "",
                                                      "text2" => "Cuisine"
                                                      ])
                    @include('layouts.partials.main-header',[
                               "class" => "main-header",
                               "text1"  =>  "North",
                               "text2"  =>  " Cuisine"
                               ])
                    <div class="cuisine-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed doLorem ipsum dolor sit
                            amet, consectetur adipiscing elit, sed doLorem ipsum dolor sit amet, consectetur
                            adipiscing elit, sed doLorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                            doLorem ipsum dolor sit amet</p>
                    </div>
                    @include('layouts.partials.buttons',[
                     "type" => "button",
                   "class" => "link",
                   "link" => "",
                   "text" => "Get in touch with us",
                   "title" => "Contact us"
                   ])
                </div>
            </div>
        </div>
        <div class="row d-lg-none m-auto">
            <div class="col-lg-12">
                <img class="img-fluid" src="img/friends.jpg" alt="image">
            </div>
        </div>
    </div>
    <div class="north-carousel">
        <div class="container-fluid">
            <div class="north-partners">
                <div class="headers">
                    @include('layouts.partials.main-header',[
                                 "class" => "main-header",
                                 "text1"  =>  "North partners",
                                 "text2"  =>  ""
                                 ])
                    <p>Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan temport
                        incidunt:</p>
                </div>
                <div class="owl-carousel cuisine owl-theme">
                    <div class="item">
                        <div class="parteners z-up">
                            <div class="img">
                                <svg>
                                    <use xlink:href="#pepejeans">
                                </svg>
                            </div>
                            <div class="img">
                                <svg>
                                    <use xlink:href="#outdoors">
                                </svg>
                            </div>
                            <div class="img">
                                <svg>
                                    <use xlink:href="#vs">
                                </svg>
                            </div>
                            <div class="img">
                                <svg>
                                    <use xlink:href="#sunshine">
                                </svg>
                            </div>
                            <div class="img">
                                <svg>
                                    <use xlink:href="#classic">
                                </svg>
                            </div>
                            <div class="img">
                                <svg>
                                    <use xlink:href="#design">
                                </svg>
                            </div>
                            <div class="img">
                                <svg>
                                    <use xlink:href="#showtime">
                                </svg>
                            </div>
                            <div class="img">
                                <svg>
                                    <use xlink:href="#brandit">
                                </svg>
                            </div>
                            <div class="img">
                                <svg>
                                    <use xlink:href="#vintage">
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        {{--                        <img src="img/background.png" alt="image">--}}

                    </div>
                    <div class="item">
                        {{--                        <img src="img/background.png" alt="image">--}}

                    </div>
                    <div class="item">
                        {{--                        <img src="img/background.png" alt="image">--}}

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


