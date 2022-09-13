<?php get_header(); ?>

<section class="wrapper-404">
    <div class="container">
        <h1>404 Page Not Found</h1>
        <p>アクセス頂いたURLに該当するページが見つかりませんでした。<br>
            該当のページはアドレスが変更されたか、削除された可能性がございます。<br>
            URLが正しく入力されているか確認してください。</p>
            <p class="home-btn"><a href="<?php echo home_url();?>">TOP</a></p>
    </div>
</section>

<!-- 戻る -->
<?php get_footer(); ?>