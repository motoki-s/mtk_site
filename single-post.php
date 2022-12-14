<?php get_header(); ?>

<section class="top-news">
    <div class="container">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <h2><?php the_title(); ?></h2>
                <span><?php the_time('Y.m.d'); ?></span>
                <p><?php the_content(); ?></p>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>

<!-- 戻る -->
<div class="navigation">
    <a class="more-btn" href="javascript:history.back();"></a>
</div>
<?php get_footer(); ?>