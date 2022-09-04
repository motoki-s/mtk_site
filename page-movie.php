<?php get_header(); ?>
<section class="movie-contain">
    <div class="container">
        <div class="block-title">
            <h2 class="down-to-top"><?php the_title(); ?></h2>
            <!-- タームメニュー SPプルダウン -->
            <div class="term-box">
                <?php get_template_part('content-term'); ?>
            </div>
        </div>
        <div class="movie-list">
            <ul>
                <?php $the_query = get_child_pages(10); ?>
                <?php if ($the_query->have_posts()) : ?>
                    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
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
<div class="pagenation">
    <?php
    if ($the_query->max_num_pages > 0) {
        echo paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => 'page/%#%/',
            'current' => max(1, $paged),
            'total' => $the_query->max_num_pages,
            'prev_text' => '< PREV', //次への表示指定
            'next_text' => 'NEXT >' //前への表示指定
        ));
    }
    wp_reset_postdata();
    ?>
</div>

<?php get_footer(); ?>


