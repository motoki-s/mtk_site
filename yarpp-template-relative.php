<h3>関連ページasssssss</h3>
<?php if (have_posts()) : ?>
    <div class="related-entry-list">
        <?php
        $blog_pages = get_specific_posts('blog', 'blog_category', '', '');
        if ($blog_pages->have_posts()) :
            while ($blog_pages->have_posts()) : $blog_pages->the_post();
        ?>

                <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" class="related-entry">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail(
                            array(125, 125),
                            array('alt' => $title, 'title' => $title)
                        );
                        ?>
                    <?php else : ?>
                        <img src="<?php echo plugins_url() . '/' . 'yet-another-related-posts-plugin/images/default.png' ?>" alt="no thumbnail" title="no thumbnail" />
                    <?php endif; ?>
                    <?php the_title(); ?>
                </a>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
<?php else : ?>
    <p>関連するページはありません。ccccc</p>
<?php endif; ?>