<?php get_header(); ?>

movie.php
<section class="news-content">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>

            <h2><?php the_title(); ?></h2>
            <p><?php the_category(); ?></p>
            <p><?php the_content(); ?></p>
        <?php endwhile; ?>
    <?php endif; ?>
</section>

<?php get_footer(); ?>