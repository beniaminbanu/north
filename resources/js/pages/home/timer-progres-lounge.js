$(document).ready(function () {
    initSlider();

    function initSlider() {
        $('.lounge').on('initialized.owl.carousel', function(e){
            $('#lounge #timer').text('.0'+e.item.index );
            setTimeout(function(){
                $('#lounge .owl-nav .owl-prev .counter-prev').html('<span>'+(e.item.index - 1)+ '</span><span>/ '+ $('.lounge .owl-item:not(".cloned")').length+'</span>');
                $('#lounge .owl-nav .owl-next .counter-next').html('<span>'+(e.item.index + 1)+ ' / '+$('.lounge .owl-item:not(".cloned")').length+'</span>');
            }, 1000);
        }).on('changed.owl.carousel', function(e){
            var next = e.item.index + 1;
            var prev = e.item.index - 1;
            var c = e.item.index;
            if(next > $('.lounge .owl-item:not(".cloned")').length ){
                next = 1;
            }
            if( prev == 0 ){
                prev = $('.lounge .owl-item:not(".cloned")').length;
            }
            if(c > $('.lounge .owl-item:not(".cloned")').length){
                c = 1;
            }
            $('#lounge #timer').text('.0'+c);
            $('#lounge .owl-nav .owl-prev .counter-prev').html('<span>'+ prev + '</span><span>/ '+$('.lounge .owl-item:not(".cloned")').length+'</span>');
            $('#lounge .owl-nav .owl-next .counter-next').html('<span>'+ next + ' / '+$('.lounge .owl-item:not(".cloned")').length+'</span>');
        }).owlCarousel({
            startPosition: 1,
            loop: true,
            margin: 45,
            center: true,
            autoplay: true,
            nav: true,
            navText: ["<img src='img/arrow-left.png'><div class='counter-prev'></div>", "<img src='img/arrow-right.png'><div class='counter-next'></div>"],
            responsiveClass: true,
            autoplayTimeout: 6000,
            onInitialized: startProgressBar,
            onTranslate: resetProgressBar,
            onTranslated: startProgressBar,
            responsive: {
                0: {
                    items: 1
                },
                991: {
                    items: 2,
                }
            },

        });
    }

    function getProgressBar() {
        return $("#sample-progress-bar").clone().removeAttr('id');
    }

    function startProgressBar() {
        const mainContainer = $('.lounge');
        const centerItem = mainContainer.find('.owl-item.center');
        const items = mainContainer.find('.owl-item').not('.center');
        centerItem.find('.north-location').addClass("north-visible");
        centerItem.find('.north-location').removeClass("north-hidden");
        items.find('.north-location').addClass("north-hidden");
        items.find('.north-location').removeClass("north-visible");

        if (!(centerItem.find(".slide-progress").length)) {
            centerItem.append(getProgressBar());
        }


        centerItem.find('.bar').css({
            width: "100%",
            transition: "width 10000ms"
        });


    }

    function resetProgressBar() {
        const mainContainer = $('.lounge');
        const centerItem = mainContainer.find('.owl-item.center');

        centerItem.find('.bar').css({
            width: 0,
            transition: "width 0s"
        });
        mainContainer.find(".slide-progress").css({
            // background: 'transparent',
        });
    }

});
$(document).ready(function () {
    $('.blog').owlCarousel({
        loop: true,
        nav: true,
        items: 1,
        margin: 10,
        responsiveClass: true,
        navText: ["<img src='img/arrow-left.png'>", "<img src='img/arrow-right.png'>"],
        onInitialized: counter, //When the plugin has initialized.
        onTranslated: counter,
    });
    $('.blog .owl-nav').append($(".counterr"));

    function counter(event) {
        var element = event.target; // DOM element, in this example .owl-carousel
        var items = event.item.count; // Number of items;
        var item = event.item.index - 1; // Position of the current item
        // it loop is true then reset counter from 1
        if (item > items) {
            item = item - items
        }

        $(element).parent().find('.counterr').html(item + " / " + items)
        $(element).parent().find('#time').html(" .0" + item)
    }
});


