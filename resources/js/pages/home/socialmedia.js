$('.social').owlCarousel({
    loop:true,
    margin:10,
    responsive:{
        991:{
            items:1,
            nav: false,
            dots: false,
        },
    }
})
$('.media').owlCarousel({
    loop:true,
    margin:150,
    dots: true,
    nav: true,
    navText: ["<img src='img/arrow-left.png'>", "<img src='img/arrow-right.png'>"],
    items: 1,
})
