<?php get_header(); ?>

<section class="blog">
    <div class="blog-contain container">
        <h2 class="down-to-top">BLOG</h2>
        <ul>
            <?php
            $blog_pages = get_specific_posts('blog', 'blog_category', '', 5);
            if ($blog_pages->have_posts()) :
                while ($blog_pages->have_posts()) : $blog_pages->the_post();
            ?>
                    <li class="down-to-top">
                        <p class="blog-date"><?php echo get_post_time('Y.n.j(D)'); ?></p>
                        <a href="<?php the_permalink(); ?>">
                            <div class="blog-content">
                                <div class="blog-image" style="background:url(
                            <?php if (has_post_thumbnail()) {
                                echo the_post_thumbnail_url('blog');
                            } else {
                                echo 'https://placehold.jp/30/ccc/ffffff/400x200.png?text=blog+image';
                            }
                            ?>) center center / cover no-repeat;"></div>

                                <div class="blog-text">
                                    <h3><?php the_title(); ?></h3>
                                    <p><?php echo get_the_excerpt(); ?></p>
                                </div>
                            </div>
                        </a>
                    </li>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </ul>
    </div>
</section>

<?php
if (function_exists('wp_pagenavi')) {
    echo '<div class="pagenation">';
    echo wp_pagenavi(array('query'=>$blog_pages, 'echo'=>false));
    echo '</div>';
}
?>

<?php get_footer(); ?>