$(document).ready(function() {


    const mediaQuery = window.matchMedia("(min-width: 1100px)");
    if (mediaQuery.matches) {
        $('.table-smartphone').slideDown();
    } else {
        $('.table-smartphone').slideUp();
    }


    // TOGGLE MOBILE MENU
    $('.cross').click(function() {
        if ($('.mobile-nav').hasClass('active')) {
            TweenMax.to('.mobile-nav', .7, { height: '0%', ease: "expo.out" });
            TweenMax.to('.a', .5, { css: { transform: "translateY(-100%) rotate(0deg)" }, ease: "back.out(1.7)" });
            TweenMax.to('.b', .5, { css: { transform: "translateY(100%) rotate(0deg)" }, ease: "back.out(1.7)" });
            $('.mobile-nav').removeClass('active');
        } else {
            TweenMax.to('.mobile-nav', 1, { height: '100%', ease: "expo.out" });
            TweenMax.from('.mobile-nav ul li', .2, { scale: 0, transformOrigin: 'top', stagger: .2 });
            TweenMax.to('.a', .5, { css: { transform: "rotate(45deg)" }, ease: "back.out(1.7)" });
            TweenMax.to('.b', .5, { css: { transform: "rotate(-45deg)" }, ease: "back.out(1.7)" });
            $('.mobile-nav').addClass('active');

            $('a').click(function() {
                TweenMax.to('.mobile-nav', .7, { height: '0%', ease: "expo.out" });
                TweenMax.to('.a', .5, { css: { transform: "translateY(-100%) rotate(0deg)" }, ease: "back.out(1.7)" });
                TweenMax.to('.b', .5, { css: { transform: "translateY(100%) rotate(0deg)" }, ease: "back.out(1.7)" });
                $('.mobile-nav').removeClass('active');
            })
        }
    });

    // TOGGLE FILTER
    $('.filter').click(function() {
        if ($('.filter').hasClass('active')) {
            TweenMax.to('.filter-ul', .7, { height: '0', ease: "expo.out" });
            $('.filter').removeClass('active');
        } else {
            TweenMax.to('.filter-ul', 1, { height: '200%', ease: "expo.out" });
            $('.filter').addClass('active');
        }
    });

    //  ADD ACTIVE CLASS ON URL CHANGE
    $(function() {
        let currentNav = $('.gestione-nav li a[href^="' + location.pathname.split("/E-commerce-tech/")[1] + '"]').addClass('active');
        console.log(currentNav)
        TweenMax.set(currentNav, { color: '#02FFE6' })
    });

})

$('.show-table').click(function() {
    console.log('CLICK')
    $('.table-smartphone').slideToggle();

})

const filter = document.querySelector('.filter');

filter.addEventListener('click', function(e) {
    console.log(e.target)
})