
// banner movie slider
$('.slider').slick({
    autoplay: false,//自動的に動き出すか。初期値はfalse。
    infinite: false,//スライドをループさせるかどうか。初期値はtrue。
    slidesToShow: 1,//スライドを画面に3枚見せる
    slidesToScroll: 1,//1回のスクロールで3枚の写真を移動して見せる
    prevArrow: '<div class="slick-prev"></div>',//矢印部分PreviewのHTMLを変更
    nextArrow: '<div class="slick-next"></div>',//矢印部分NextのHTMLを変更
    dots: false,//下部ドットナビゲーションの表示
    responsive: [
        {
            breakpoint: 768,//モニターの横幅が769px以下の見せ方
            settings: {
                slidesToShow: 1,//スライドを画面に2枚見せる
                slidesToScroll: 1,//1回のスクロールで2枚の写真を移動して見せる
            }
        }
    ]
});


// blog-slider
$('.blog-slider').slick({

    prevArrow: '<div class="slick-prev"></div>',//矢印部分PreviewのHTMLを変更
    nextArrow: '<div class="slick-next"></div>',//矢印部分NextのHTMLを変更
    dots: false,//下部ドットナビゲーションの表示
    responsive: [

        {
            breakpoint: 768,//モニターの横幅が426px以下の見せ方
            settings: {
                autoplay: false,//自動的に動き出すか。初期値はfalse。
                infinite: false,//スライドをループさせるかどうか。初期値はtrue。
                slidesToShow: 1.1,//スライドを画面に1枚見せる
                slidesToScroll: 1,//1回のスクロールで1枚の写真を移動して見せる
            }
        }
    ]


});