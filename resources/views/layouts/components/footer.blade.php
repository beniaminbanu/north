<section id="footer">
    <div class="newsletter">
        <div class="headers d-flex flex-column align-items-center">
            @include('layouts.partials.main-header',[
                              "class" => "main-header",
                              "text1"  =>  "North restaurant",
                              "text2"  =>  " newsletter"
                              ])
            <div class="subscribe">
                <input class="email" type="search" name="email" placeholder="Your email address">
                <button class="button">Subscribe now</button>
            </div>
        </div>
    </div>
    <div class="subfooter">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center align-items-center d-block d-lg-none g-0">
                <div class="col-6 d-flex justify-content-center align-items-center">
                    <svg id="img">
                        <use xlink:href="#logo-footer1">
                    </svg>
                </div>
            </div>
            <div class="row d-flex align-items-center right g-0">
                <div class="col-3 d-none d-lg-block">
                    <svg id="img">
                        <use xlink:href="#logo-footer">
                    </svg>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="info-box">
                        <span>PHONE</span>
                        <p>+(40) 720 000 000</p>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="info-box">
                        <span>E-mail</span>
                        <p>contact@northrestaurant.ro</p>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="info-box">
                        <span>address</span>
                        <p>Bulevardul Constantin B. Nr. 50, Bucharest</p>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <div class="info-box">
                        <span>schedule</span>
                        <p>L-V: 09:00 - 18:00</p>
                        <p>S - D: Closed</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <ul class="menu">
                <li><a href="#" title="page">Home</a></li>
                <li><a href="#" title="page">About north</a></li>
                <li><a href="#" title="page">menu</a></li>
                <li><a href="#" title="page">events</a></li>
                <li><a href="#" title="page">blog</a></li>
                <li><a href="#" title="page">contact</a></li>
            </ul>
        </div>
        <div class="copyright">
            <div class="text">
                <p>Coyright 2021 <strong>NORTH.</strong> Developed by <span>Expert Vision Agency.</span></p>
                <p>Crafted by - <span>Alin Raileanu</span>.</p>
            </div>
        </div>
    </div>
</section>
