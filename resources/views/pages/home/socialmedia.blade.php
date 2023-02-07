<section id="socialmedia">
    <div class="headers d-flex flex-column align-items-center">
        @include('layouts.partials.slogan',[
                                    "class" => "slogan",
                                    "text"  =>  "North cuisine & Lounge",
                                    "text2" => ""
                                    ])
        @include('layouts.partials.main-header',[
                               "class" => "main-header",
                               "text1"  =>  "North restaurant",
                               "text2"  =>  " on social media"
                               ])
        <p>Quis ipsum suspendisse ultrices gravida. Risus commodo viverra Quis ipsum suspendisse ultrices gravida. Risus
            commodo viverra Quis ipsum suspendisse ultrices gravida. Risus commodo viverra </p>
    </div>
    <div class="container-fluid">
        <div class="owl-carousel social owl-theme d-none d-lg-block ">
            <div class="item">
                <div class="products">
                    <div class="image">
                        <img class="img-fluid" src="img/american.jpg" alt="food">
                    </div>
                    <div class="image">
                        <img class="img-fluid" src="img/burg.jpg" alt="food">
                    </div>
                    <div class="image">
                        <img class="img-fluid" id="grill" src="img/grill.jpg" alt="food">
                    </div>
                    <div class="image">
                        <img class="img-fluid" src="img/tasty.jpg" alt="food">
                    </div>
                    <div class="image">
                        <img class="img-fluid" src="img/burgerss.jpg" alt="food">
                    </div>
                </div>
            </div>
        </div>
        <div class="owl-carousel media owl-theme d-block d-lg-none">
            <div class="item">
                <div class="products">
                    <img class="img-fluid" src="img/america.jpg" alt="food">
                    <img class="img-fluid" src="img/america1.jpg" alt="food">
                </div>
            </div>
            <div class="item">
                <div class="products">
                    <img class="img-fluid" src="img/grill1.jpg" alt="food">
                    <img class="img-fluid" src="img/tasty1.jpg" alt="food">
                </div>
            </div>
            <div class="item">
                <div class="products">
                    <img class="img-fluid" src="img/burg1.jpg" alt="food">
                    <img class="img-fluid" src="img/america1.jpg" alt="food">
                </div>
            </div>
            <div class="item">
                <div class="products">
                    <img class="img-fluid" src="img/america1.jpg" alt="food">
                    <img class="img-fluid" src="img/grill1.jpg" alt="food">
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="social-links">
                @include('layouts.partials.buttons',[
                 "type" => "click",
                "class" => "click",
                "link" => "",
                "text" => "on facebook",
                "title" => "facebook"
                ])
                @include('layouts.partials.buttons',[
                "type" => "click",
               "class" => "click",
               "link" => "",
               "text" => "on twitter",
               "title" => "twitter"
               ])
                @include('layouts.partials.buttons',[
                "type" => "click",
               "class" => "click",
               "link" => "",
               "text" => "on instagram",
               "title" => "instagram"
               ])
        </div>
        <div class="text">
        <p>Quis ipsum suspendisse ultrices gravida. Risus commodo viverra Quis ipsum suspendisse ultrices gravida. Risus
            commodo viverra Quis ipsum suspendisse ultrices gravida. Risus commodo viverra Quis ipsum suspendisse ultrices gravida. Risus
            commodo viverra</p>
        </div>
    </div>
    </div>
    </div>
</section>
