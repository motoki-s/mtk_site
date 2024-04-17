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

// 送信ローダーの調整
const submitElement = document.getElementsByClassName('wpcf7-submit');
const submitValue = submitElement[0].value;

submitElement[0].addEventListener('click', (ev) => {
    submitElement[0].classList.add('wpcf7-active'); // 指定のクラスを付与する
    submitElement[0].value = '送信中…'; // 送信中の文言(*1)
});

document.addEventListener('wpcf7submit', (ev) => { // Ajaxのフォーム送信が完了した場合（成功・失敗問わず）
    submitElement[0].classList.remove('wpcf7-active'); // 指定のクラスを外す
    submitElement[0].value = submitValue;
});

// 送信完了後に表示するテキスト(*1)
const submitText = 'ありがとうございます。送信が完了しました。';

// 送信完了後に表示するリンク(*1)
const submitLink = '/';

// モーダル要素を作成する
const modalElement = document.createElement('div');
modalElement.id = 'wpcf7-modal';
const modalBg = document.createElement('div');
modalBg.id = 'wpcf7-modal__bg';
const modalWrap = document.createElement('div');
modalWrap.id = 'wpcf7-modal__wrap'
const modalText = document.createElement('p');
modalText.appendChild(document.createTextNode(submitText));
const modalLink = document.createElement('a');
modalLink.href = submitLink;
modalLink.appendChild(document.createTextNode('戻る'))

// モーダル要素をDOMツリーに追加する
modalElement.appendChild(modalBg);
modalElement.appendChild(modalWrap);
modalWrap.appendChild(modalText);
modalWrap.appendChild(modalLink);

// モーダルをbody直下に追加する(*2)
const bodyElement = document.getElementsByTagName('body');
bodyElement[0].appendChild(modalElement);

// 送信完了時にモーダルを表示する(*3)
document.addEventListener('wpcf7mailsent', function(e) {
    modalElement.style.display = 'flex';
});