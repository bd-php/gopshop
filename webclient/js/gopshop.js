/* STACK is for saving page display sequence so that user can back to this page */
var STACK = [];

/**
 * Function that start the game.
 *
 * @param
 * @return Void
 */
function startGame() {
    console.log("startGame enter");

    console.log("USER_FB_ID : " + USER_FB_ID);
    console.log("USER_FB_NAME : " + USER_FB_NAME);
    console.log("USER_FB_PROPIC : " + USER_FB_PROPIC);

    go_to_index('init');

    // $.ajax({
    //     async: true,
    //     crossDomain: true,
    //     url: 'https://gopshopadmin.dotlines.com.sg/images/cash.png',
    //     cache: false,
    //     xhrFields: {
    //         responseType: 'blob'
    //     },
    //     success: function (data) {
    //         var img = document.getElementById('page_img');
    //         var url = window.URL || window.webkitURL;
    //         img.src = url.createObjectURL(data);
    //     },
    //     error: function (e) {
    //         console.log(e);
    //     }
    // });

}

/**
 * Function that start the game.
 *
 * @param
 * @return Void
 */
function showPage(page, pageaction) {
    console.log('showPage(): ' + page);
    STACK.push({page: page, pageaction: pageaction});

    var settings = {
        "async": true,
        "crossDomain": true,
        //"url": "https://codeimpact.dotlines.com.sg/test/gopshoptest.php",
        "url": UI_SERVER_URL + page,
        "method": "POST",
        // "headers": {
        //     "Apiname": "story_cat_list"
        // }
    };

    $.ajax(settings).done(function (response) {
        //console.log(response);
        if (response.hasOwnProperty('code') && response.code == "900") {

            $("#page_body").html(response.data);
            if (pageaction != null && pageaction != '') {
                pageaction();
            }
        } else {
            console.log(response.code);
            alert('error');
        }
    });
}

/**
 * Display The previous page.
 *
 * @param string clickpoint the button of place where clicked to view this page
 * @return Void
 */
function go_to_back(clickpoint) {
    console.log('go_to_back(): ' + clickpoint);
    /*this pop is to remove current page from stack*/
    STACK.pop();
    var lastpage = STACK.pop();
    if (lastpage.hasOwnProperty('page') && lastpage.hasOwnProperty('pageaction')) {
        console.log('going to back page : ' + lastpage.page);
        showPage(lastpage.page, lastpage.pageaction)
    }
}

/**
 * Display modal.
 *
 * @param string id modal id
 * @return Void
 */
function showModal(id) {
    $("#" + id).fadeIn(200);
    $('body').toggleClass('no-scroll');
}

function hideModal(id) {
    $("#" + id).fadeOut(400);
    $('body').toggleClass('no-scroll');
}

/**
 * Display index page.
 *
 * @param string clickpoint the button of place where clicked to view this page
 * @return Void
 */
function go_to_index(clickpoint) {
    console.log('go_to_index(): ' + clickpoint);
    showPage('index', index_scripts);
}

/**
 * Index page javascript that need to execute after page load.
 *
 * @param
 * @return Void
 */
function index_scripts() {
    console.log('index_scripts()');
    var swiper = new Swiper('.home-category .swiper-container,.popular-slider .swiper-container', {
        slidesPerView: 1.5,
        spaceBetween: 15,
        freeMode: true
    });

    var $round = $('.circle-round'),
        roundRadius = $round.find('circle').attr('r'),
        roundPercent = $round.data('percent'),
        roundCircum = 2 * roundRadius * Math.PI,
        roundDraw = roundPercent * roundCircum / 100;
    $round.css('stroke-dasharray', roundDraw + ' 999');

    var swiper = new Swiper('.home-carousel .swiper-container', {
        loop: true,
        autoplay: {
            delay: 3000
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        }
    });
}

/**
 * Display Category page.
 *
 * @param string clickpoint the button of place where clicked to view this page
 * @return Void
 */
function go_to_category(clickpoint) {
    console.log('go_to_category(): ' + clickpoint);
    showPage('category', category_scripts);
}

/**
 * Category page javascript that need to execute after page load.
 *
 * @param
 * @return Void
 */
function category_scripts() {
    console.log('category_scripts()');

    var $round = $('.circle-round'),
        roundRadius = $round.find('circle').attr('r'),
        roundPercent = $round.data('percent'),
        roundCircum = 2 * roundRadius * Math.PI,
        roundDraw = roundPercent * roundCircum / 100;
    $round.css('stroke-dasharray', roundDraw + ' 999');
}

/**
 * Display Favourite page.
 *
 * @param string clickpoint the button of place where clicked to view this page
 * @return Void
 */
function go_to_favourite(clickpoint) {
    console.log('go_to_favourite(): ' + clickpoint);
    showPage('favourite', favourate_scripts);
}

/**
 * Favourate page javascript that need to execute after page load.
 *
 * @param
 * @return Void
 */
function favourate_scripts() {
    console.log('favourate_scripts()');

    var $round = $('.circle-round'),
        roundRadius = $round.find('circle').attr('r'),
        roundPercent = $round.data('percent'),
        roundCircum = 2 * roundRadius * Math.PI,
        roundDraw = roundPercent * roundCircum / 100;
    $round.css('stroke-dasharray', roundDraw + ' 999');
}

/**
 * Display Profile page.
 *
 * @param string clickpoint the button of place where clicked to view this page
 * @return Void
 */
function go_to_profile(clickpoint) {
    console.log('go_to_profile(): ' + clickpoint);
    showPage('profile', null);
}

/**
 * Display Notification page.
 *
 * @param string clickpoint the button of place where clicked to view this page
 * @return Void
 */
function go_to_notification(clickpoint) {
    console.log('go_to_notification(): ' + clickpoint);
    showPage('notification', null);
}