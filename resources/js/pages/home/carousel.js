
$( document ).ready(function() {
    $('.hero-carousel').owlCarousel({
        items: 1,
        nav: true,
        navText: ["<img src='img/arrow-left.png'>","<img src='img/arrow-right.png'>"],
        margin: 10,
        loop: true,
        onInitialized: counter, //When the plugin has initialized.
        onTranslated: counter
    });
    $('.hero-carousel .owl-nav').append($(".counter"));
function counter(event) {
    var element = event.target; // DOM element, in this example .owl-carousel
    var items = event.item.count; // Number of items;
    var item = event.item.index + 1; // Position of the current item
    // it loop is true then reset counter from 1
    if (item > items) {
        item = item - items
    }

    $(element).parent().find('.counter').html(  item + " / " + items)
}
});
