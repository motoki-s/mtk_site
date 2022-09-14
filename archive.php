<?php get_header(); ?>
<section class="top-news">
    <div class="container">
        <div class="news-contain">
            <h2 class="down-to-top">NEWS</h2>
            <ul>
                <?php
                if (have_posts()) :
                    while (have_posts()) : the_post();
                ?>
                        <a class="down-to-top" href="<?php the_permalink(); ?>">
                            <li>
                                <p class="daytime"><?php the_time('Y.m.d'); ?></p>
                                <p class="news-info"><?php the_title(); ?></p>
                            </li>
                        </a>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </ul>
        </div>
    </div>
</section>

<!-- ページネーション -->
<div class="pagenation-wrapper">
    <?php
    $args = array(
        'prev_text' => '< PREV',
        'next_text' => 'NEXT >',
        'show_all' => false,
        // 'mid_size' => 3,
        'type' => 'list',
    );
    $pagination = get_the_posts_pagination($args);
    $pagination = preg_replace("/<h2[^>]*?>.*?<\/h2>/i", '', $pagination);
    $pagination = preg_replace(array("/<div[^>]*?>/i", "/<\/div>/i"), array('', ''), $pagination);
    echo $pagination;
    ?>
</div>
<?php get_footer(); ?>