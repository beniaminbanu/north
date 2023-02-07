
$(document).ready(function () {
  $(window).scroll(function() {
      var scroll = $(window).scrollTop();

      if (scroll > 1400 && $( window ).width() <= 991 ) {
          $(".navbar").attr('id', 'mobile-nav');
          const div = document.querySelector('.tel-info');
          div.setAttribute('style', 'border-color: black; margin-right: 20px;')
          const span = document.querySelector('#number');
          span.setAttribute('style', 'color: black;');
          const img = document.querySelector('#black');
          img.setAttribute('style', 'filter: invert(1);');
          const socials = document.querySelector('#socialss');
          socials.setAttribute('style', 'display: none;')
          const text = document.querySelector('#text');
          text.setAttribute('style', 'display: block;')
          const logo = document.querySelector('#logo-black');
          logo.setAttribute('style', 'display: block;')
      }
      else {
          $(".navbar").removeAttr("id", "mobile-nav");
          const div = document.querySelector('.tel-info');
          div.setAttribute('style', 'border-color: white');
          const span = document.querySelector('#number');
          span.setAttribute('style', 'color: white');
          const location = document.querySelector('#location');
          location.setAttribute('style', 'color: white;')
          const img = document.querySelector('#black');
          img.setAttribute('style', 'color: white');
          const text = document.querySelector('#text');
          text.setAttribute('style', 'display: block;')
          const logo = document.querySelector('#logo-black');
          logo.setAttribute('style', 'display: none;')
      }
      if (scroll > 750 && $( window ).width() > 991 ) {
          $(".navbar").attr('id', 'desktop-nav');
          const div = document.querySelector('.tel-info');
          div.setAttribute('style', 'border-color: black; margin-right: 20px;')
          const span = document.querySelector('#number');
          span.setAttribute('style', 'color: black;  border-left: 1px solid var(--black-color);');
          const location = document.querySelector('#location');
          location.setAttribute('style', 'color: black;')
          const img = document.querySelector('#black');
          img.setAttribute('style', 'filter: invert(1);');
          const socials = document.querySelector('#socialss');
          socials.setAttribute('style', 'display: flex;')
          const text = document.querySelector('#text');
          text.setAttribute('style', 'display: none;')
          const logo = document.querySelector('#logo-black');
          logo.setAttribute('style', 'display: block;')
      }
      if(scroll === 0 && $( window ).width() > 991) {
          $(".navbar").removeAttr("id", "desktop-nav");
          const div = document.querySelector('.tel-info');
          div.setAttribute('style', 'border-color: white');
          const span = document.querySelector('#number');
          span.setAttribute('style', 'color: white;     border-left: 1px solid var(--white-color);');
          const location = document.querySelector('#location');
          location.setAttribute('style', 'color: white;')
          const img = document.querySelector('#black');
          img.setAttribute('style', 'color: white');
          const socials = document.querySelector('#socialss');
          socials.setAttribute('style', 'display: none;')
          const text = document.querySelector('#text');
          text.setAttribute('style', 'display: block;')
          const logo = document.querySelector('#logo-black');
          logo.setAttribute('style', 'display: none;')
      }
  });
})
// OVERLAY BUTTON
$('.hamburger-menu').on('click', function(){
    $('.hamburger-active').addClass('open-hamburger');
});

$('.hamburger-closs').on('click', function(){
    $('.hamburger-active').removeClass('open-hamburger');
});
// buttonUP

$(document).ready(function () {
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll > 1500 && $(window).width() <= 991) {
            $("#buttonup").show();

        } else {
            $("#buttonup").hide();
        }
    });
});
