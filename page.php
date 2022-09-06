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
    <a class="more-btn" href="javascript:history.back();"></a>
</div>
<?php get_footer(); ?>