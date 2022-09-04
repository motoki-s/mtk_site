// ハンバーガーメニュー
$(".openbtn").click(function () {
    $(this).toggleClass('active');
    $('nav').toggleClass('open');
    // $('.zdo_drawer_bg').fadeToggle();
});


//ヘッダー

// スクロールしたらヘッダー変わる
$(function () {
    var header = $('#header-change');
    var headerlogo = $('.header-logo')
    var headerText = $('.pc-nav ul li a');
    var headerHb = $('.openbtn span');
    var navAm = $('.pc-nav ul li a');

    $(window).scroll(function () {

        if ($(this).scrollTop()) {
            header.addClass('change');
            headerlogo.addClass('change');
            headerText.addClass('change');
            headerHb.addClass('change');
            navAm.addClass('change');

        } else {
            header.removeClass('change');
            headerlogo.removeClass('change');
            headerText.removeClass('change');
            headerHb.removeClass('change');
            navAm.removeClass('change');
        }
    });

})




//したから上へ表示
window.onload = function () {
    scroll_effect();

    $(window).scroll(function () {
        scroll_effect();
    });

    function scroll_effect() {
        $('.down-to-top, .left-to-right').each(function () {
            var elemPos = $(this).offset().top;
            var scroll = $(window).scrollTop();
            var windowHeight = $(window).height();
            if (scroll > elemPos - windowHeight + 50) {
                $(this).addClass('scrollin');
            }
        });
    }
};












$(window).on('load', function () {
    $("#splash-logo").delay(1200).fadeOut('slow');//ロゴを1.2秒でフェードアウトする記述

    //=====ここからローディングエリア（splashエリア）を1.5秒でフェードアウトした後に動かしたいJSをまとめる
    $("#splash").delay(1500).fadeOut('slow', function () {//ローディングエリア（splashエリア）を1.5秒でフェードアウトする記述

        $('body').addClass('appear');//フェードアウト後bodyにappearクラス付与

    });
    //=====ここまでローディングエリア（splashエリア）を1.5秒でフェードアウトした後に動かしたいJSをまとめる

    //=====ここから背景が伸びた後に動かしたいJSをまとめたい場合は
    $('.splashbg').on('animationend', function () {
        //この中に動かしたいJSを記載
    });
    //=====ここまで背景が伸びた後に動かしたいJSをまとめる

});










$(function () {
    var $elem = $('.responsive_img');
    var sp = '_sp.';
    var pc = '_pc.';
    var replaceWidth = 768;
    function imageSwitch() {
        var windowWidth = parseInt($(window).width());
        $elem.each(function () {
            var $this = $(this);
            if (windowWidth >= replaceWidth) {
                $this.attr('src', $this.attr('src').replace(sp, pc));
            } else {
                $this.attr('src', $this.attr('src').replace(pc, sp));
            }
        });
    }
    imageSwitch();
    var resizeTimer;
    $(window).on('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
            imageSwitch();
        });
    });
});