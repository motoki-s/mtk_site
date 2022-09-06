<!-- 1. onChangeでvalue属性に指定したURLに遷移する -->
<div class="term-list-sp down-to-top">
    <?php $terms = get_terms('genre'); ?>
    <select name="select" onChange="location.href=value;">
        <option value="<?php echo home_url(); ?>/movie/">ALL</option>
        <?php
        foreach ($terms as $term) {
            $terms = get_the_terms($post->ID, 'genre');
            $slug = $terms[0]->slug;
            // echo esc_html($term->name);
            // 3. if文でタクソノミーページの場合 & 現在表示されているページと同じカテゴリーの場合「selected」属性を付与する
            if (is_tax() && $slug == $term->slug) {
                echo '<option value="' . get_term_link($term->slug, 'genre') . '" selected>' . $term->name . '</option>';
            } else {
                echo '<option value="' . get_term_link($term->slug, 'genre') . '">' . $term->name . '</option>';
            }
        }
        ?>
    </select>
</div>

<!-- PC term -->
<ul class="term-list-pc down-to-top">
    <li>
        <a href="<?php echo home_url(); ?>/movie/"<?= is_page('movie') ? ' class="term-current"' : ''; ?>>ALL</a>
    </li>
    <?php $terms = get_terms('genre'); ?>
    <?php foreach ($terms as $term) : ?>
        <?php
        $terms = get_the_terms($post->ID, 'genre');
        // $slug = $terms[0]->slug;
        // echo esc_html($term->name);
        ?>
        <li><a href="<?php echo get_term_link($term->slug, 'genre'); ?>" <?= is_tax() && $slug == $term->slug ? ' class="term-current"' : ''; ?>><?php echo esc_html($term->name); ?></a></li>
    <?php endforeach; ?>
</ul>


