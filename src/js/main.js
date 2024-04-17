// ハンバーガーメニュー
$(".openbtn").click(function () {
    $(this).toggleClass('active');
    $('nav').toggleClass('open');
    // $('.zdo_drawer_bg').fadeToggle();
});

// ハンバーガーメニューからnavを選択したらハンバーガーメニューを非表示
$(function () {
    if ($(window).width()) {
        $('.menu-item>a').click(function () {
            $('nav').removeClass('open');
            $('.openbtn').removeClass('active');
            // $('.zdo_drawer_bg').fadeToggle();
        });
    }
})

//ヘッダー
// スクロールしたらヘッダー変わる
$(function () {
    var header = $('#header-change');
    var headerlogo = $('.header-logo')
    var headerText = $('.pc-nav ul li a');
    var headerHb = $('.openbtn span');
    var navAm = $('.pc-nav ul li a');

    $(window).scroll(function () {

        if ($(this).scrollTop() > 250) {
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

//ヘッダー画像レスポンシブ対応
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

//同じ日付で2回目以降ならローディング画面非表示の設定
$(function () {
    var webStorage = function () {
        if (sessionStorage.getItem('access')) {
            /*
            2回目以降アクセス時の処理
            */
            $("#loading").addClass('is-active');
        } else {
            /*
            初回アクセス時の処理
            */
            sessionStorage.setItem('access', 'true'); // sessionStorageにデータを保存
            $("#loading-animation").addClass('is-active'); // loadingアニメーションを表示
            setTimeout(function () {
                // ローディングを数秒後に非表示にする
                $("#loading").addClass('is-active');
                $("#loading-animation").removeClass('is-active');
            }, 3000); // ローディングを表示する時間
        }
    }
    webStorage();
});
