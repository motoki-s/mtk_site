<?php get_header(); ?>
<section class="blog-content container">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <div class="blog-inner">
                <span><?php echo get_post_time('Y.m.j'); ?></span>
                <h2><?php the_title(); ?></h2>
                <p><?php the_content(); ?></p>
            </div>
            <!-- プロフィール情報 -->
            <div class="profile-info">
                <div class="profile-image">
                    <img src="<?php echo get_template_directory_uri() . '/img/blog-profile-image.jpg'; ?>" alt="ブログ用プロフィール写真">
                </div>
                <div class="profile-text">
                    <h3>佐久間元樹<span class="name-en"> /Motoki Sakuma</span></h3>
                    <p>フィンガースタイルギタリスト<br>
                        ギター一本で叙情感ある世界を作る。<br>
                        詳しいプロフィールは<span class="profile-link"><a href="<?php echo esc_url(home_url()) . '/profile'; ?>">こちら</a></span>
                    </p>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>

    <!-- ページネーション -->
    <div class="wp-pagenavi navigation">
        <?php
        $next_post = get_next_post();
        $prev_post = get_previous_post();

        ?>
        <?php if ($next_post) : ?>
            <div class="next">
                <a class="nextpostslink" href="<?php echo get_permalink($next_post->ID); ?>">NEXT</a>
            </div>
        <?php endif; ?>


        <?php if ($prev_post) : ?>
            <div class="prev">
                <a class="previouspostslink" href="<?php echo get_permalink($prev_post->ID); ?>">PREV</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- 関連記事 ---------------------------------------------------------------------------------->
    <?php
    //表示中の投稿に登録されているカテゴリID（term_id）を全て取得
    $categories = get_the_category();
    $cat_term_ids = array();
    foreach ($categories as $category) {
        $cat_term_ids[] = $category->term_id; //cat_ID でも同じ
    }
    //関連記事取得用クエリパラメーター
    $args = array(
        'post_type' => 'blog',    //投稿を指定 （固定ページの場合は 'page'）
        'posts_per_page' => '3',    //取得する件数
        'ignore_sticky_posts' => true,    //「トップに固定」した投稿は除く
        'post__not_in' => array($post->ID),    //除外する投稿（本記事）
        'category__in' => $cat_term_ids,    //対象となるカテゴリID（配列）
        'orderby' => 'desc'
    );
    $the_query = new WP_Query($args);    //クエリ実行
    ?>

    <?php if ($the_query->post_count > 0) : ?>
        <!-- 該当する投稿が１件以上あったら下記出力  -->
        <aside class="rel-article">
            <h5>その他の記事</h5>
            <!-- sp -->
            <ul class="blog-slider">
                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <li>
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
                                <span class="post_date"><?php echo get_post_time('Y.m.d'); ?></span>
                                <h3><?php echo wp_trim_words(get_the_title(), 48, "…", "UTF-8"); ?></h3>
                                <p><?php echo get_the_excerpt(); ?></p>
                            </div>
                        </a>
                    </li>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </ul>
            <!-- pc -->
            <ul class="blog-list">
                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <li>
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
                                <span class="post_date"><?php echo get_post_time('Y.m.d'); ?></span>
                                <h3><?php echo wp_trim_words(get_the_title(), 48, "…", "UTF-8"); ?></h3>
                                <p><?php echo get_the_excerpt(); ?></p>
                            </div>
                        </a>
                    </li>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </ul>
            <span><a href="<?php echo esc_url(home_url('blog')); ?>">View more</a></span>
        </aside>
    <?php endif; ?>
</section>
<?php get_footer(); ?>