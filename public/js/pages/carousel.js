/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/pages/home/carousel.js":
/*!*********************************************!*\
  !*** ./resources/js/pages/home/carousel.js ***!
  \*********************************************/
/***/ (() => {

eval("// var heroCarousel = $('.hero-carousel');\n// heroCarousel.owlCarousel({\n$(document).ready(function () {\n  $(\".hero-carousel\").children(\"owl-nav\");\n  $(\".owl-nav\").append(\".counter\");\n  $('.hero-carousel').owlCarousel({\n    items: 1,\n    nav: true,\n    navText: [\"<img src='img/arrow-left.png'>\", \"<img src='img/arrow-right.png'>\"],\n    margin: 10,\n    loop: true,\n    onInitialized: counter,\n    //When the plugin has initialized.\n    onTranslated: counter\n  });\n\n  function counter(event) {\n    var element = event.target; // DOM element, in this example .owl-carousel\n\n    var items = event.item.count; // Number of items;\n\n    var item = event.item.index + 1; // Position of the current item\n    // it loop is true then reset counter from 1\n\n    if (item > items) {\n      item = item - items;\n    }\n\n    $(element).parent().find('.counter').html(item + \" / \" + items);\n  }\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvcGFnZXMvaG9tZS9jYXJvdXNlbC5qcz9hMTM0Il0sIm5hbWVzIjpbIiQiLCJkb2N1bWVudCIsInJlYWR5IiwiY2hpbGRyZW4iLCJhcHBlbmQiLCJvd2xDYXJvdXNlbCIsIml0ZW1zIiwibmF2IiwibmF2VGV4dCIsIm1hcmdpbiIsImxvb3AiLCJvbkluaXRpYWxpemVkIiwiY291bnRlciIsIm9uVHJhbnNsYXRlZCIsImV2ZW50IiwiZWxlbWVudCIsInRhcmdldCIsIml0ZW0iLCJjb3VudCIsImluZGV4IiwicGFyZW50IiwiZmluZCIsImh0bWwiXSwibWFwcGluZ3MiOiJBQUNBO0FBQ0E7QUFDQUEsQ0FBQyxDQUFFQyxRQUFGLENBQUQsQ0FBY0MsS0FBZCxDQUFvQixZQUFXO0FBQzNCRixFQUFBQSxDQUFDLENBQUMsZ0JBQUQsQ0FBRCxDQUFvQkcsUUFBcEIsQ0FBNkIsU0FBN0I7QUFDQUgsRUFBQUEsQ0FBQyxDQUFFLFVBQUYsQ0FBRCxDQUFnQkksTUFBaEIsQ0FBd0IsVUFBeEI7QUFDSkosRUFBQUEsQ0FBQyxDQUFDLGdCQUFELENBQUQsQ0FBb0JLLFdBQXBCLENBQWdDO0FBQzVCQyxJQUFBQSxLQUFLLEVBQUUsQ0FEcUI7QUFFNUJDLElBQUFBLEdBQUcsRUFBRSxJQUZ1QjtBQUc1QkMsSUFBQUEsT0FBTyxFQUFFLENBQUMsZ0NBQUQsRUFBa0MsaUNBQWxDLENBSG1CO0FBSTVCQyxJQUFBQSxNQUFNLEVBQUUsRUFKb0I7QUFLNUJDLElBQUFBLElBQUksRUFBRSxJQUxzQjtBQU01QkMsSUFBQUEsYUFBYSxFQUFFQyxPQU5hO0FBTUo7QUFDeEJDLElBQUFBLFlBQVksRUFBRUQ7QUFQYyxHQUFoQzs7QUFVQSxXQUFTQSxPQUFULENBQWlCRSxLQUFqQixFQUF3QjtBQUNwQixRQUFJQyxPQUFPLEdBQUdELEtBQUssQ0FBQ0UsTUFBcEIsQ0FEb0IsQ0FDUTs7QUFDNUIsUUFBSVYsS0FBSyxHQUFHUSxLQUFLLENBQUNHLElBQU4sQ0FBV0MsS0FBdkIsQ0FGb0IsQ0FFVTs7QUFDOUIsUUFBSUQsSUFBSSxHQUFHSCxLQUFLLENBQUNHLElBQU4sQ0FBV0UsS0FBWCxHQUFtQixDQUE5QixDQUhvQixDQUdhO0FBQ2pDOztBQUNBLFFBQUlGLElBQUksR0FBR1gsS0FBWCxFQUFrQjtBQUNkVyxNQUFBQSxJQUFJLEdBQUdBLElBQUksR0FBR1gsS0FBZDtBQUNIOztBQUVETixJQUFBQSxDQUFDLENBQUNlLE9BQUQsQ0FBRCxDQUFXSyxNQUFYLEdBQW9CQyxJQUFwQixDQUF5QixVQUF6QixFQUFxQ0MsSUFBckMsQ0FBNENMLElBQUksR0FBRyxLQUFQLEdBQWVYLEtBQTNEO0FBQ0g7QUFDQSxDQXhCRCIsInNvdXJjZXNDb250ZW50IjpbIlxuLy8gdmFyIGhlcm9DYXJvdXNlbCA9ICQoJy5oZXJvLWNhcm91c2VsJyk7XG4vLyBoZXJvQ2Fyb3VzZWwub3dsQ2Fyb3VzZWwoe1xuJCggZG9jdW1lbnQgKS5yZWFkeShmdW5jdGlvbigpIHtcbiAgICAkKFwiLmhlcm8tY2Fyb3VzZWxcIikuY2hpbGRyZW4oXCJvd2wtbmF2XCIpXG4gICAgJCggXCIub3dsLW5hdlwiICkuYXBwZW5kKCBcIi5jb3VudGVyXCIgKTtcbiQoJy5oZXJvLWNhcm91c2VsJykub3dsQ2Fyb3VzZWwoe1xuICAgIGl0ZW1zOiAxLFxuICAgIG5hdjogdHJ1ZSxcbiAgICBuYXZUZXh0OiBbXCI8aW1nIHNyYz0naW1nL2Fycm93LWxlZnQucG5nJz5cIixcIjxpbWcgc3JjPSdpbWcvYXJyb3ctcmlnaHQucG5nJz5cIl0sXG4gICAgbWFyZ2luOiAxMCxcbiAgICBsb29wOiB0cnVlLFxuICAgIG9uSW5pdGlhbGl6ZWQ6IGNvdW50ZXIsIC8vV2hlbiB0aGUgcGx1Z2luIGhhcyBpbml0aWFsaXplZC5cbiAgICBvblRyYW5zbGF0ZWQ6IGNvdW50ZXJcbn0pO1xuXG5mdW5jdGlvbiBjb3VudGVyKGV2ZW50KSB7XG4gICAgdmFyIGVsZW1lbnQgPSBldmVudC50YXJnZXQ7IC8vIERPTSBlbGVtZW50LCBpbiB0aGlzIGV4YW1wbGUgLm93bC1jYXJvdXNlbFxuICAgIHZhciBpdGVtcyA9IGV2ZW50Lml0ZW0uY291bnQ7IC8vIE51bWJlciBvZiBpdGVtcztcbiAgICB2YXIgaXRlbSA9IGV2ZW50Lml0ZW0uaW5kZXggKyAxOyAvLyBQb3NpdGlvbiBvZiB0aGUgY3VycmVudCBpdGVtXG4gICAgLy8gaXQgbG9vcCBpcyB0cnVlIHRoZW4gcmVzZXQgY291bnRlciBmcm9tIDFcbiAgICBpZiAoaXRlbSA+IGl0ZW1zKSB7XG4gICAgICAgIGl0ZW0gPSBpdGVtIC0gaXRlbXNcbiAgICB9XG5cbiAgICAkKGVsZW1lbnQpLnBhcmVudCgpLmZpbmQoJy5jb3VudGVyJykuaHRtbCggIGl0ZW0gKyBcIiAvIFwiICsgaXRlbXMpXG59XG59KTtcbiJdLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvcGFnZXMvaG9tZS9jYXJvdXNlbC5qcy5qcyIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/pages/home/carousel.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/pages/home/carousel.js"]();
/******/ 	
/******/ })()
;