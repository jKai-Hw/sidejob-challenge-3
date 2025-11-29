<?php
/**
 * カスタムタクソノミーの登録
 *
 * @package ThemeName
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/**
 * サービスカテゴリータクソノミーを登録
 */
function theme_register_service_category() {
  $labels = array(
    'name'                       => 'サービスカテゴリー',
    'singular_name'              => 'サービスカテゴリー',
    'menu_name'                  => 'カテゴリー',
    'all_items'                  => 'すべてのカテゴリー',
    'parent_item'                => '親カテゴリー',
    'parent_item_colon'          => '親カテゴリー:',
    'new_item_name'              => '新規カテゴリー名',
    'add_new_item'               => '新規カテゴリーを追加',
    'edit_item'                  => 'カテゴリーを編集',
    'update_item'                => 'カテゴリーを更新',
    'view_item'                  => 'カテゴリーを表示',
    'search_items'               => 'カテゴリーを検索',
    'not_found'                  => '見つかりません',
    'no_terms'                   => 'カテゴリーがありません',
  );

  $args = array(
    'labels'            => $labels,
    'hierarchical'      => true,  // true = カテゴリー形式, false = タグ形式
    'public'            => true,
    'show_ui'           => true,
    'show_admin_column' => true,
    'show_in_nav_menus' => true,
    'show_in_rest'      => true,  // ブロックエディタ対応
    'rewrite'           => array( 'slug' => 'service-category', 'with_front' => false ),
  );

  register_taxonomy( 'service_category', array( 'service' ), $args );
}
add_action( 'init', 'theme_register_service_category' );

/**
 * お知らせカテゴリータクソノミーを登録
 *
 * 注意: 標準の「投稿」を使う場合は、標準のカテゴリーを使えばOK。
 * カスタム投稿タイプ「news」を使う場合のみ有効。
 */
function theme_register_news_category() {
  $labels = array(
    'name'                       => 'お知らせカテゴリー',
    'singular_name'              => 'お知らせカテゴリー',
    'menu_name'                  => 'カテゴリー',
    'all_items'                  => 'すべてのカテゴリー',
    'new_item_name'              => '新規カテゴリー名',
    'add_new_item'               => '新規カテゴリーを追加',
    'edit_item'                  => 'カテゴリーを編集',
    'search_items'               => 'カテゴリーを検索',
  );

  $args = array(
    'labels'            => $labels,
    'hierarchical'      => true,
    'public'            => true,
    'show_ui'           => true,
    'show_admin_column' => true,
    'show_in_nav_menus' => true,
    'show_in_rest'      => true,
    'rewrite'           => array( 'slug' => 'news-category', 'with_front' => false ),
  );

  register_taxonomy( 'news_category', array( 'news' ), $args );
}
add_action( 'init', 'theme_register_news_category' );
