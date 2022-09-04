<?php get_header(); ?>
<section class="live">
    <div class="live-contain container">
        <h2 class="down-to-top">LIVE</h2>
        <ul>
            <?php
            $live_pages = get_specific_posts('live', 'kind', '', 2, 'datetime', 'meta_value_num', '');
            if ($live_pages->have_posts()) :
                while ($live_pages->have_posts()) : $live_pages->the_post();
                    $date = get_field('datetime', false, false);
                    $date = new DateTime($date);
                    $week = ['(Sun)', '(Mon)', '(Tue)', '(Wed)', '(Thu)', '(Fri)', '(Sat)'];
            ?>
                    <li class="down-to-top">
                        <p class="live-date"><?php echo $date->format('Y.n.j') . $week[$date->format('w')]; ?></p>
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
            endif;
            ?>
        </ul>
    </div>
</section>

<?php
if (function_exists('wp_pagenavi')) {
    echo '<div class="pagenation">';
    echo wp_pagenavi(array('query'=>$live_pages, 'echo'=>false));
    echo '</div>';
}


?>

<?php get_footer(); ?>