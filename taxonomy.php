<?php get_header(); ?>
<section class="movie-contain">
    <div class="container">
        <div class="block-title">
            <h2 class="down-to-top">Movie</h2>
            <!-- タームメニュー SPプルダウン -->
            <div class="term-box">
                <?php get_template_part('content-term'); ?>
            </div>
        </div>

        <div class="movie-list">
            <ul>
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <a class="movie-box down-to-top" href="<?php the_permalink(); ?>">
                            <div class="movie-content" style="background:url(
                            <?php if (has_post_thumbnail()) {
                                echo the_post_thumbnail_url('movie-sp');
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
                    <?php endwhile; ?>
                <?php endif; ?>
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