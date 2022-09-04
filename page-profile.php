<?php get_header(); ?>

<section class="profile-contain">
    <div class="container">
        <h2 class="down-to-top"><?php the_title(); ?></h2>
        <div class="profile-inner">
            <div class="profile-image down-to-top">
                <?php
                if (has_post_thumbnail()) {
                    the_post_thumbnail('profile');
                } else {
                    echo '<img src="' . 'https://placehold.jp/30/ccc/ffffff/600x400.png?text=profile+image' . '" alt="<?php the_title(); ?>">';
                } ?>
            </div>
            <div class="profile-text down-to-top">
                <h3>佐久間元樹 / Motoki Sakuma</h3>
                <p><?php the_content(); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- 戻る -->
<div class="pagenation">
    <?php
    $h = $_SERVER['HTTP_HOST'];
    if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'], $h) !== false)) {
        echo '<a class="more-btn" href="' . $_SERVER['HTTP_REFERER'] . '">< BACK</a>';
    }
    ?>
</div>

<?php get_footer(); ?>