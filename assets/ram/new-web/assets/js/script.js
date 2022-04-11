$(document).ready(function () {
  $('.owl-one').owlCarousel({
    loop: true,
    margin: 0,
    nav: false,
    responsiveClass: true,
    autoplay: false,
    autoplayTimeout: 5000,
    autoplaySpeed: 1000,
    autoplayHoverPause: false,
    responsive: {
      0: {
        items: 1,
        nav: false
      },
      480: {
        items: 1,
        nav: false
      },
      667: {
        items: 1,
        nav: true
      },
      1000: {
        items: 1,
        nav: true
      }
    }
  });
});


// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
  scrollFunction()
};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("movetop").style.display = "block";
  } else {
    document.getElementById("movetop").style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}