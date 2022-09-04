<?php get_header(); ?>

<section class="movie-contain">
    <div class="container">
        <h2><?php the_title(); ?></h2>
        <div class="movie-list">
            <p><?php the_content(); ?></p>
        </div>
    </div>
</section>

<!-- 戻る -->
    <div class="navigation">
        <?php
        $h = $_SERVER['HTTP_HOST'];
        if (!empty($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'], $h) !== false)) {
            echo '<a class="more-btn" href="' . $_SERVER['HTTP_REFERER'] . '">< BACK</a>';
        }
        ?>
    </div>
<?php get_footer(); ?>