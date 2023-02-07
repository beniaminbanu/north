<section id="reservation">
    <span class="location">Bulevardul Cantacuzino nr. 14, Bucharest</span>
{{--    <div class="hero-area">--}}
        <div class="container-fluid">
            <div class="row d-flex justify-content-around align-items-baseline g-0">
                <div class="col-lg-6">
                    <div class="hero-content">
                        @include('layouts.partials.slogan',[
                                                           "class" => "slogan",
                                                           "text"  =>  "North Cuisine ",
                                                           "text2" => " & Lounge"
                                                           ])
                        @include('layouts.partials.main-header',[
                                          "class" => "main-header",
                                          "text1"  =>  "Bacon ipsum dolor amet bufallo",
                                          "text2"  =>  " Beef sausage leberkas."
                                          ])
                        <div class="text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed doLorem ipsum dolor sit
                                amet, consectetur adipiscing elit, sed doLorem ipsum dolor sit amet, consectetur
                                adipiscing elit, sed doLorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                do</p>
                            @include('layouts.partials.buttons',[
                        "type" => "button",
                       "class" => "link",
                       "link" => "",
                       "text" => "See more",
                       "title" => "See more"
                       ])
                        </div>
                    </div>

                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <form>
                        <div class="formular">
                            <div class="top-form">
                                @include('layouts.partials.main-header',[
                                          "class" => "main-header",
                                          "text1"  =>  "north",
                                          "text2"  =>  " reservation"
                                          ])
                                <p>Quis ipsum vsuspendisse ultrices gravida. Risus commodo viverra</p>
                            </div>
                            <div class="body-form">
                                <input type="text" id="fname" name="fullname" class="input input-check" placeholder="Full Name" min="" max="" onkeypress="return (event.charCode > 64 &amp;&amp; event.charCode < 91) || (event.charCode > 96 &amp;&amp; event.charCode < 123) || (event.charCode==32)">
                                <input type="email" name="email" placeholder="Email">
                                <input type="tel" name="tel" placeholder="Phone">
                                <div class="inputs">
                                    <input type="time" name="time" placeholder="Choose hour">
                                    <input type="number" name="number" placeholder="Grup number">
                                </div>
                                <textarea class="textarea" placeholder="Other details" cols="30" rows="5"></textarea>
                                <input type="button" value="Send your request">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row d-lg-none g-0">
                <div class="col-lg-12">
                    <form>
                        <div class="formular">
                            <div class="top-form">
                                @include('layouts.partials.main-header',[
                                          "class" => "main-header",
                                          "text1"  =>  "north",
                                          "text2"  =>  " reservation"
                                          ])
                                <p>Quis ipsum vsuspendisse ultrices gravida. Risus commodo viverra</p>
                            </div>
                            <div class="body-form">
                                <input type="text" id="fname" name="fullname" class="input input-check" placeholder="Full Name" min="" max="" onkeypress="return (event.charCode > 64 &amp;&amp; event.charCode < 91) || (event.charCode > 96 &amp;&amp; event.charCode < 123) || (event.charCode==32)">
                                <input type="email" name="email" placeholder="Email">
                                <input type="tel" name="tel" placeholder="Phone">
                                <div class="inputs">
                                    <input type="time" name="time" placeholder="Choose hour">
                                    <input type="number" name="number" placeholder="Grup number">
                                </div>
                                <textarea class="textarea" placeholder="Other details" cols="30" rows="5"></textarea>
                                <input type="button" value="Send your request">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="socials">
            <a class="faceb" href="#" title="facebook">
                <svg>
                    <use xlink:href="#facebook">
                </svg>
            </a>
            <a class="twitter" href="#" title="twitter">
                <svg>
                    <use xlink:href="#twitter">
                </svg>
            </a>
            <a class="insta" href="#" title="instagram">
                <svg>
                    <use xlink:href="#instagram">
                </svg>
            </a>
        </div>
        <span class="contact">contact@northrestaurant.ro</span>
        <span class="support">Schildersbedrijf & Technical supporrt</span>
{{--    </div>--}}
</section>

