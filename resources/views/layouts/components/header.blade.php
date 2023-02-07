<header id="header" class="header">
    <div class="container-fluid">

        <div class="navbar">
            <div class="info">
                <div class="languages">
                    <div class="text" id="text">
                        <span> RO /</span><span>EN</span>
                    </div>
                    <div class="socials" id="socialss">
                        <a class="faceb" href="#" title="facebook">
                            <svg>
                                <use xlink:href="#facebook1">
                            </svg>
                        </a>
                        <a class="twitter" href="#" title="twitter">
                            <svg>
                                <use xlink:href="#twitter1">
                            </svg>
                        </a>
                        <a class="insta" href="#" title="instagram">
                            <svg>
                                <use xlink:href="#instagram1">
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="location">
                    <span id="location">Bulevardul Cantacuzino nr. 14, Bucharest</span>
                </div>
            </div>
            <div class=" logo d-lg-none" id="logo-white">
                @include("layouts.includes.logo-svg",[
                'type' => 'logo'
                ])
            </div>
            <svg id="logo-black">
                <use xlink:href="#black-logo">
            </svg>
            <div class="info-text">
                <div class="tel-info">
                    <svg id="black">
                        <use xlink:href="#phone">
                    </svg>
                    <span id="number">(+40) 720 10 00 00</span>
                </div>
                <div class="hamburger-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>

    <div class="container">
        <div class="menu">
            <div class="left-navbar">
                <li> <a href="#" title="Home">Home</a></li>
                <li> <a href="#" title="About North">About North</a></li>
                <li> <a href="#" title="Menu">Menu</a></li>
            </div>
            <div class="logo d-sm-none d-lg-block">
                @include("layouts.includes.logo-svg", [
                'type' => 'logo'
                ])
            </div>
            <div class="right-navbar">
                <li> <a href="#" title="Events">Events</a></li>
                <li> <a href="#" title="Blog">Blog</a></li>
                <li> <a href="#" title="Contacts">Contacts</a></li>
            </div>
        </div>
    </div>

    <div class="hamburger-active">
        <div class="hamburger-closs">
            <span> </span>
            <span></span>
         </div>
        <div class="overlay-open">
            <div class="logo">
                @include("layouts.includes.logo-svg", [
                    'type' => 'logo'
                    ])
            </div>
            <ul class="menu-open">
                <li><a href="#" title="Home">Home</a></li>
                <li><a href="#" title="Home">About North</a></li>
                <li><a href="#" title="Home">Events</a></li>
                <li><a href="#" title="Home">Menu</a></li>
                <li><a href="#" title="Home">Blog</a></li>
                <li><a href="#" title="Home">Contact</a></li>
            </ul>
            <div class="button">
                    @include('layouts.partials.buttons',[
                    "type" => "button",
                    "class" => "link",
                    "link" => "",
                    "text" => "Get a Reservation",
                    "title" => "Reserve now"
                    ])
                </div>
            <div class="info-north">
                <a href="#" title="">contact@northrestaurant.ro</a>
                <a href="#" title="">+0720 000 000</a>
                <a href="#" title="">Bulevardul Constantin B. Nr. 50,Bucharest</a>
            </div>
            <div class="socials">

                <a  href="#" title="facebook">
                    <svg>
                        <use xlink:href="#facebook1">
                    </svg>
                </a>
                <a  href="#" title="twitter">
                    <svg>
                        <use xlink:href="#twitter1">
                    </svg>
                </a>
                <a  href="#" title="instagram">
                    <svg>
                        <use xlink:href="#instagram1">
                    </svg>
                </a>
            </div>
            <div class="info-location">
                <p class="adress">Address service <span class="adress">: Bulevardul Constantin B. Nr. 50,Bucharest
                MONDAY - FRIDAY: 09:00 - 17:00, SATURDAY & SUNDAY: CLOSED</span></p>
            </div>
            <div class="copyright">
                <span>© 2021 North Restaurant. All Right Reserved.</span>
            </div>
        </div>
    </div>
</header>
@push('scripts')
<script src="{{ asset('js/pages/header.js') }}"></script>
@endpush
