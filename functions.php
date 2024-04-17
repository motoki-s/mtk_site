<?php
function my_enqueue_script()
{
    // js
    wp_enqueue_script('cdn_jquery', 'https://code.jquery.com/jquery-3.4.1.min.js', array(), '3.4.1', true);
    wp_enqueue_script('slick_jquery', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), '', true);
    wp_enqueue_script('script', get_template_directory_uri() . '/src/js/slick.js', array(), '', true);
    wp_enqueue_script('main_script', get_template_directory_uri() . '/src/js/main.js', array(), '', true);
    wp_enqueue_script('icon_script', 'https://kit.fontawesome.com/9d959752d8.js', array(), '', true);

    // css
    wp_enqueue_style('slick_style', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array());
    wp_enqueue_style('base_style', get_template_directory_uri() . '/src/css/style.css', array());
}
add_action('wp_enqueue_scripts', 'my_enqueue_script');


//ヘッダー、フッターのカスタムメニュー化
register_nav_menus([
    'place_global' => 'グローバル',
]);

//カスタムヘッダー
add_theme_support('custom-header');


//固定ページの子ページを取得する関数
function get_child_pages($number = -1, $specified_id = null)
{
    if (isset($specified_id)) {
        $parent_id = $specified_id;
    } else {
        $parent_id = get_the_ID();
    }

    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $args = array(

        'paged' => $paged,           //ページネーション用
        'post_type' => 'page',       //投稿タイプ（記事ループと条件にする）
        'posts_per_page' => $number,     //表示投稿数（記事ループと条件にする）
        'orderby' => 'menu_order',    //表示順条件（記事ループと条件にする）
        'order' => 'DESC',           //降順（記事ループと条件にする）
        'post_status' => 'publish',   //公開済みのみ表示（記事ループと条件にする）
        'paged' => $paged,
        'post_parent' => $parent_id,
    );
    $child_pages = new WP_Query($args);
    return $child_pages;
}

//特定の記事を抽出する関数
function get_specific_posts($post_type, $taxonomy = null, $term = null, $number = -1, $custom = null, $orderby = null, $meta_query = null)
{
    $today = date("Y/m/d");
    $paged = get_query_var('paged') ? get_query_var('paged') : 1; //現在のページ番号を取得 ない場合は1

    if (!$term) {
        $terms_obj = get_terms();
        $term = wp_list_pluck($terms_obj, 'slug');
    }

    $args = [
        'post_type' => $post_type,
        'paged' => $paged,
        'tax_query' => [
            [
                'taxonomy' => $taxonomy,
                'field' => 'slug',
                'terms' => $term,
            ],
        ],
        $meta_query => [  //過去日を非表示
            [
                'key' => 'datetime',
                'value' => $today,
                'compare' => '>=',
                'type' => 'DATE',
            ],
        ],
        'posts_per_page' => $number,
        'meta_key' => $custom,  //カスタムフィールドの日付
        'orderby' => $orderby,  //降順
        'post_status' => 'publish'
    ];
    $specific_posts = new WP_Query($args);
    return $specific_posts;
}


//抜粋のデフォルト文字数を定義
function cms_excerpt_more()
{
    return '...';
}
add_filter('excerpt_more', 'cms_excerpt_more');

function cms_excerpt_length()
{
    return 40;
}
add_filter('excerpt_mblength', 'cms_excerpt_length');


// アイキャッチ画像の設定
add_theme_support('post-thumbnails');

//トップページのメイン画像用のサイズ設定
// add_image_size('top', 1077, 622, true);

//各ページのメイン画像用のサイズ設定
add_image_size('detail', 1100, 330, true);
add_image_size('movie-sp', 400, 250, true);
add_image_size('movie-pc', 640, 300, true);
add_image_size('live', 320, 240, true);
//add_image_size('profile', 600, 400, true);
add_image_size('blog', 420, 340, true);


//各テンプレートごとのメイン画像を表示
function get_main_image()
{
    if (is_page() || is_tax('genre')) {
        $attachment_id = get_field('main-image'); //カスタムフィールドで指定した名前を指定し画像のIDを取得

        if (empty($attachment_id)) {
            return '<img src="https://placehold.jp/30/ccc/ffffff/1400x700.png?text=header+image" />';
        } else {
            return wp_get_attachment_image(
                $attachment_id,
                '',
                false,
                [
                    'class' => 'responsive_img',
                ]
            ); //トップページ
        }
    } elseif (is_archive() || is_singular('post') || is_404()) {
        return '<img src="' . get_template_directory_uri() . '/img/news-fv-pc.jpg" />';
    } elseif (is_singular('live')) {
        return '<img src="' . get_template_directory_uri() . '/img/live-fv.jpg" />';
    } elseif (empty(the_post_thumbnail('detail'))) { //アイキャッチ画像がない場合
        return '<img src="https://placehold.jp/30/ccc/ffffff/1400x700.png?text=header+image" />';
    }
}

//srcset属性を削除
add_filter('wp_calculate_image_srcset_meta', '__return_null');

add_filter("big_image_size_threshold", "__return_false");


function image_tag_delete($html)
{
    $html = preg_replace('/(width|height)="\d*"\s/', '', $html);
    return $html;
}
add_filter('image_send_to_editor', 'image_tag_delete', 10);
add_filter('post_thumbnail_html', 'image_tag_delete', 10);


//メイン画像上にテンプレートごとの文字列(タイトル)を表示
function get_main_title_sp()
{
    global $post;
    if (is_singular('post')) {  //個別の投稿ページであるか news
        $category_obj = get_the_category(); //投稿カテゴリーを配列で取得
        return $category_obj[0]->name;
    } elseif ((is_page() && $post->post_parent)) { //固定ページの子ページ movie
        $parent_id = $post->post_parent;
        $parent_slug = get_post($parent_id)->post_name;
        return ucfirst($parent_slug); //先頭大文字
    } elseif (is_singular(['live', 'blog'])) {   //live,blog ページ
        $post_title = $post->post_type; //カスタム投稿タイプ名
        return ucfirst($post_title); //先頭大文字
    } elseif (is_page('profile') || is_404() || is_front_page()) {  //ロゴ表示
        return '<img src="' . get_template_directory_uri() . '/img/fv-logo-sp.png" alt="motoki sakuma sp-logo">';
    } else {
        return '<img src="' . get_template_directory_uri() . '/img/fv-logo-sp-white.png" alt="motoki sakuma sp-logo-white">';
    }
}


function get_main_title_pc()
{
    global $post;
    if (is_singular('post')) {  //個別の投稿ページであるか news
        $category_obj = get_the_category(); //投稿カテゴリーを配列で取得
        return $category_obj[0]->name;
    } elseif ((is_page() && $post->post_parent)) { //固定ページの子ページ movie
        $parent_id = $post->post_parent;
        $parent_slug = get_post($parent_id)->post_name;
        return ucfirst($parent_slug); //先頭大文字
    } elseif (is_singular(['live', 'blog'])) {   //live,blog ページ
        $post_title = $post->post_type; //カスタム投稿タイプ名
        return ucfirst($post_title); //先頭大文字
    } elseif (is_page('profile') || is_404()) {  //ロゴ表示
        return '<img src="' . get_template_directory_uri() . '/img/fv-logo-pc.png" alt="motoki sakuma sp-logo">';
    } else {
        return '<img src="' . get_template_directory_uri() . '/img/fv-logo-pc-white.png" alt="motoki sakuma sp-logo-white">';
    }
}


//yotube埋め込みレスポンシブ化
function iframe_in_div($the_content)
{
    if (is_page() || is_single()) {
        $the_content = preg_replace('/<iframe/i', '<div class="youtube"><iframe', $the_content);
        $the_content = preg_replace('/<\/iframe>/i', '</iframe></div>', $the_content);
    }
    return $the_content;
}
add_filter('the_content', 'iframe_in_div');


//カスタム固定ページ送り出来るように　パーマリンクは/%category%/%postname%
add_filter('rewrite_rules_array', 'wp_insertMyRewriteRules');
add_filter('query_vars', 'wp_insertMyRewriteQueryVars');
add_filter('init', 'flushRules');

function flushRules()
{
    global $wp_rewrite;
    $wp_rewrite->flush_rules();    // リライトルールを再生成
}
function wp_insertMyRewriteRules($rules)
{
    $newrules = array();
    $newrules['(live)/page/?([0-9]{1,})/?$'] = 'index.php?pagename=$matches[1]&paged=$matches[2]';  //liveカスタム投稿のリンク
    $newrules['(blog)/page/?([0-9]{1,})/?$'] = 'index.php?pagename=$matches[1]&paged=$matches[2]';  //blogカスタム投稿のリンク

    return $newrules + $rules;    // 新しいルールを追加
}
function wp_insertMyRewriteQueryVars($vars)
{
    array_push($vars, 'id');    // 変数idを追加
    return $vars;
}


//管理画面カスタム
//ライブ情報
function add_posts_columns($columns)
{
    $columns['live_date'] = 'ライブ日程'; //追加するカラム
    return $columns;
}
function custom_posts_column($column_name, $post_id)
{
    if ($column_name == 'live_date') {
        $cf_live_date = get_post_meta($post_id, 'datetime', true); //カスタムフィールド
        echo ($cf_live_date) ? $cf_live_date : '－';
    }
}
//カスタム投稿 live
add_filter('manage_live_posts_columns', 'add_posts_columns');
add_action('manage_live_posts_custom_column', 'custom_posts_column', 10, 2);


//ソート機能
function posts_sortable_columns($sortable_column)
{
    $sortable_column['live_date'] = 'live_date';  //上記で追加したカラム
    return $sortable_column;
}
add_filter('manage_edit-live_sortable_columns', 'posts_sortable_columns'); //カスタム投稿名 live

//カスタムフィールドでソートする際のパラメータ
function posts_columns_sort_param($vars)
{
    if (isset($vars['orderby']) && 'live_date' === $vars['orderby']) {
        $vars = array_merge(
            $vars,
            array(
                'meta_key' => 'datetime', //カスタムフィールド
                'orderby' => 'meta_value_num', //対象が文字列の場合は「meta_value」を指定
            )
        );
    }
    return $vars;
}
add_filter('request', 'posts_columns_sort_param');


//URLスラッグの自動生成
function auto_post_slug($slug, $post_ID, $post_status, $post_type)
{
    if (preg_match('/(%[0-9a-f]{2})+/', $slug)) {
        $slug = utf8_uri_encode($post_type) . '-' . $post_ID;
    }
    return $slug;
}
add_filter('wp_unique_post_slug', 'auto_post_slug', 10, 4);


/* -------------------------------------------------
Contact Form 7で自動挿入されるPタグ、brタグを削除
-------------------------------------------------- */
add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');
function wpcf7_autop_return_false()
{
    return false;
}
