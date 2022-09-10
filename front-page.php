<?php get_header(); ?>

<!-- news -->
<section class="top-news">
    <div class="container">
        <?php $term_obj = get_term_by('slug', 'news', 'category'); ?>
        <div class="news-contain">
            <h2 class="down-to-top">NEWS</h2>
            <ul>
                <?php
                $args = [
                    'post_type' => 'post',
                    'category_name' => 'news',
                    'posts_per_page' => 3,
                ];
                $news_posts = new WP_Query($args);
                if ($news_posts->have_posts()) :
                    while ($news_posts->have_posts()) : $news_posts->the_post();
                ?>
                        <a  class="down-to-top" href="<?php the_permalink(); ?>">
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
        <span><a href="<?php echo esc_url(get_term_link($term_obj)); ?>">View more</a></span>
    </div>
</section>

<!-- movie -->
<section class="movie bg-fix-img">
    <?php
    $movie_obj = get_page_by_path('movie');
    $post = $movie_obj;
    setup_postdata($post);
    ?>
    <h2 class="down-to-top">MOVIE</h2>
    <div class="movie-contain down-to-top">
        <!--/slider-->
        <ul class="slider pc-list">
            <?php
            $movie_pages = get_child_pages(3, $movie_obj->ID);
            if ($movie_pages->have_posts()) :
                while ($movie_pages->have_posts()) : $movie_pages->the_post();
            ?>
                    <a href="<?php the_permalink(); ?>">
                        <div class="movie-content" style="background:url(
                            <?php if (has_post_thumbnail()) {
                                echo the_post_thumbnail_url('movie-pc');
                            } else {
                                echo 'https://placehold.jp/30/ccc/ffffff/400x200.png?text=movie+image';
                            }
                            ?>) center center / cover no-repeat;">
                            <li>
                                <div class="play-wrapper">
                                    <p class="play-btn">
                                        <span></span>
                                    </p>
                                </div>
                                <p class="movie-title"><?php the_title(); ?></p>
                            </li>
                        </div>
                    </a>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </ul>
    </div>
    <span><a href="<?php echo esc_url(home_url('movie')); ?>">View more</a></span>
</section>

<!-- live -->
<section class="live">
    <div class="live-contain container">
        <h2 class="down-to-top">LIVE</h2>
        <ul>
            <?php
            $live_pages = get_specific_posts('live', 'kind', '', '', 'datetime', 'meta_value_num', 'meta_query');
            if ($live_pages->have_posts()) :
                while ($live_pages->have_posts()) : $live_pages->the_post();
                    $date = get_field('datetime', false, false);
                    $date = new DateTime($date);
                    $week = ['(Sun)', '(Mon)', '(Tue)', '(Wed)', '(Thu)', '(Fri)', '(Sat)'];
            ?>
                    <li class="down-to-top">
                        <p class="live-date"><?php echo $date->format('Y.m.d') . $week[$date->format('w')]; ?></p>
                        <a href="<?php the_permalink(); ?>">

                            <div class="live-content">
                                <div class="live-image" style="background:url(
                            <?php if (has_post_thumbnail()) {
                                echo the_post_thumbnail_url('live');
                            } else {
                                echo 'https://placehold.jp/30/ccc/ffffff/400x200.png?text=live+image';
                            }
                            ?>) center center / cover no-repeat;"></div>
                                <div class="live-text">
                                    <h3><?php the_title(); ?></h3>
                                    <p class="live-place"><?php echo get_field('place'); ?></p>
                                    <p class="live-time"><?php echo 'open ' . get_field('open') . '/ start ' . get_field('start'); ?></p>
                                </div>
                            </div>
                        </a>
                    </li>
                <?php
                endwhile;
                wp_reset_postdata();
                ?>
            <?php else : ?>
                <p class="no-live-message">現在ライブの予定はございません。</p>
            <?php endif; ?>
        </ul>
    </div>
</section>

<!-- blog -->
<section class="blog-wrapper">
    <h2 class="down-to-top">BLOG</h2>
    <!-- sp -->
    <ul class="blog-slider">
        <?php
        $blog_pages = get_specific_posts('blog', 'blog_category', '', 3);
        if ($blog_pages->have_posts()) :
            while ($blog_pages->have_posts()) : $blog_pages->the_post();
        ?>
                <li class="down-to-top">
                    <a href="<?php the_permalink(); ?>">
                        <div>
                            <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('blog');
                            } else {
                                echo '<img src="' . 'https://placehold.jp/30/ccc/ffffff/320x240.png?text=blog+image' . '" alt="<?php the_title(); ?>">';
                            }
                            ?>
                        </div>
                        <div class="blog-text">
                            <span><?php the_time('Y.m.d'); ?></span>
                            <h3><?php the_title(); ?></h3>
                            <p><?php echo get_the_excerpt(); ?></p>
                        </div>
                    </a>
                </li>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </ul>
    <!-- pc -->
    <ul class="blog-list">
        <?php
        $blog_pages = get_specific_posts('blog', 'blog_category', '', 3);
        if ($blog_pages->have_posts()) :
            while ($blog_pages->have_posts()) : $blog_pages->the_post();
        ?>
                <li class="down-to-top">
                    <a href="<?php the_permalink(); ?>">
                        <div>
                            <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('blog');
                            } else {
                                echo '<img src="' . 'https://placehold.jp/30/ccc/ffffff/320x240.png?text=blog+image' . '" alt="<?php the_title(); ?>">';
                            }
                            ?>
                        </div>
                        <div class="blog-text">
                            <span><?php the_time('Y.m.d'); ?></span>
                            <h3><?php the_title(); ?></h3>
                            <p><?php echo get_the_excerpt(); ?></p>
                        </div>
                    </a>
                </li>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </ul>
    <span><a href="<?php echo esc_url(home_url('blog')); ?>">View more</a></span>
</section>
<?php get_footer(); ?>