<section id="about-us">
    <div class="container">
        <div class="headers">
            @include('layouts.partials.slogan',[
                                    "class" => "slogan",
                                    "text"  =>  "About north",
                                    "text2" => ""
                                    ])
            @include('layouts.partials.main-header',[
                                   "class" => "main-header",
                                   "text1"  =>  "andouille tri-tip burgdoggen strip steak",
                                   "text2"  =>  " since 2021"
                                   ])
        </div>
    </div>
    <div class="container-fluid">
        <div class="about-us-description">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-lg-5">
                    <div class="food-image">
                        <img src="img/img.jpg" alt="food">
{{--                        <span class="rotate">North - It’s all about the taste</span>--}}
                    </div>
                </div>
                <div class="col-lg-6 d-flex">
                    <div class="food-wrapper">
                        @include('layouts.partials.slogan',[
                                                          "class" => "slogan",
                                                          "text"  =>  "North Cuisine & Lounge",
                                                          "text2" => ""
                                                          ])
                        @include('layouts.partials.main-header',[
                                   "class" => "main-header",
                                   "text1"  =>  "",
                                   "text2"  =>  "About us"
                                   ])
                        <div class="about-us-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed doLorem ipsum dolor sit
                                amet, consectetur adipiscing elit, sed doLorem ipsum dolor sit amet, consectetur
                                adipiscing elit, sed doLorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                doLorem ipsum dolor sit amet</p>
                            <p>Quis ipsum suspendisse ultrices gravida. Risus commodo viverra Quis ipsum suspendisse
                                ultrices gravida. Risus commodo viverraQuis ipsum suspendisse ultrices gravida. Risus
                                commodo viverra</p>
                        </div>
                        <p class="founder">Owner Founder  <span>Gabriel Tunescu</span></p>
                        @include('layouts.partials.buttons',[
                        "type" => "button",
                       "class" => "link",
                       "link" => "",
                       "text" => "Get in touch with us",
                       "title" => "Contact us"
                       ])
{{--                        <span class="rotate">North - It’s all about the taste</span>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="new-menu">
        <div class="container">
            <div class="headers">
                @include('layouts.partials.slogan',[
                                        "class" => "slogan",
                                        "text"  =>  "North Cuisine & Lounge",
                                        "text2" => ""
                                        ])
                @include('layouts.partials.main-header',[
                                       "class" => "main-header",
                                       "text1"  =>  "North restaurant",
                                       "text2"  =>  " new menu"
                                       ])
            </div>
            <div class="menu">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 d-flex justify-content-center" >
                        <div class="product">
                            <a href="#" title="product"><img src="img/burger.jpg" alt="image">
                            <div class="product-name">
                                <span>North Cuisine & Lounge</span>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 d-flex justify-content-center">
                        <div class="product">
                            <a href="#" title="product"><img src="img/lasagna.jpg" alt="image">
                            <div class="product-name">
                                <span>North Cuisine & Lounge</span>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 d-flex justify-content-center">
                        <div class="product">
                            <a href="#" title="product"><img src="img/steak.jpg" alt="image">
                            <div class="product-name">
                                <span>North Cuisine  & Lounge</span>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 d-flex justify-content-center">
                        <div class="product">
                            <a href="#" title="product"><img src="img/lasagna.jpg" alt="image">
                            <div class="product-name">
                                <span>North Cuisine & Lounge</span>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 d-flex justify-content-center">
                        <div class="product">
                            <a href="#" title="product"><img src="img/steak.jpg" alt="image">
                            <div class="product-name">
                                <span>North Cuisine & Lounge</span>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 d-flex justify-content-center">
                        <div class="product">
                            <a href="#" title="product"><img src="img/condiments.jpg" alt="image">
                            <div class="product-name">
                                <span>North Cuisine & Lounge</span>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="info-product">
                <p>Quis ipsum suspendisse ultrices gravida. Risus commodo viverra Quis ipsum suspendisse ultrices gravida. Risus commodo viverra Quis ipsum suspendisse ultrices gravida. Risus commodo viverra Quis ipsum suspendisse ultrices gravida.</p>
                @include('layouts.partials.buttons',[
                     "type" => "button",
                     "class" => "link",
                     "link" => "",
                     "text" => "See our full menu",
                     "title" => "menu"
                     ])
            </div>
        </div>
    </div>
</section>
