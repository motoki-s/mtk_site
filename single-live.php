<?php get_header(); ?>
<section class="live-content container">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <?php
            $date = get_field('datetime', false, false);
            $date = new DateTime($date);
            $week = ['(Sun)', '(Mon)', '(Tue)', '(Wed)', '(Thu)', '(Fri)', '(Sat)'];
            $attachment_id = get_field('image');
            $post_id = get_the_id();

            ?>
            <span><?php echo $date->format('Y.n.j') . $week[$date->format('w')]; ?></span>
            <h2><?php the_title(); ?></h2>
            <div class="live-wrapper">
                <div class="live-place">
                    <div class="live-image"><?php echo the_post_thumbnail('live'); ?></div>
                    <a href="<?php echo get_field('livehouse_hp')['url']; ?>" target="_blank" rel="noopener noreferrer"><?php echo get_field('livehouse_hp')['title']; ?></a>
                </div>
                <div class="live-access">
                    <div class="livehouse-info">
                        <h3><?php echo get_field('place'); ?></h3>
                        <p><?php echo get_field('access'); ?> </p>
                        <p><?php echo 'open ' . get_field('open') . '/ start ' . get_field('start'); ?></p>
                    </div>
                    <div class="ticket-info">
                        <h3>Ticket</h3>
                        <p><?php echo get_field('ticket'); ?></p>
                    </div>
                    <div class="reserve-btn">
                        <a href="<?php echo add_query_arg([
                                        'date' => $date->format('Y.n.j'),
                                        'title' => get_the_title()
                                    ], esc_url(home_url()) . '/reservation'); ?>">予約する</a>
                    </div>
                    <div class="act-info">
                        <h3>Act</h3>
                        <p><?php echo get_field('act'); ?></p>
                    </div>
                </div>
            </div>
            <p><?php echo get_field('other'); ?></p>
        <?php endwhile; ?>
    <?php endif; ?>
</section>

<!-- 戻る -->
<div class="navigation">
    <a class="more-btn" href="javascript:history.back();"></a>
</div>
<?php get_footer(); ?>