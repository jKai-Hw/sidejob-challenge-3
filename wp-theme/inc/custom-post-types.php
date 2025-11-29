<?php
/**
 * カスタム投稿タイプの登録
 *
 * @package ThemeName
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/**
 * サービス投稿タイプを登録
 */
function theme_register_service_post_type() {
  $labels = array(
    'name'                  => 'サービス',
    'singular_name'         => 'サービス',
    'menu_name'             => 'サービス',
    'name_admin_bar'        => 'サービス',
    'add_new'               => '新規追加',
    'add_new_item'          => '新規サービスを追加',
    'new_item'              => '新規サービス',
    'edit_item'             => 'サービスを編集',
    'view_item'             => 'サービスを表示',
    'all_items'             => 'すべてのサービス',
    'search_items'          => 'サービスを検索',
    'not_found'             => 'サービスが見つかりません',
    'not_found_in_trash'    => 'ゴミ箱にサービスはありません',
    'archives'              => 'サービス一覧',
  );

  $args = array(
    'labels'              => $labels,
    'public'              => true,
    'publicly_queryable'  => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_rest'        => true,  // ブロックエディタ対応（必須）
    'query_var'           => true,
    'rewrite'             => array( 'slug' => 'service', 'with_front' => false ),
    'capability_type'     => 'post',
    'has_archive'         => true,
    'hierarchical'        => false,
    'menu_position'       => 5,
    'menu_icon'           => 'dashicons-portfolio',
    'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
  );

  register_post_type( 'service', $args );
}
add_action( 'init', 'theme_register_service_post_type' );

/**
 * お知らせ（ニュース）投稿タイプを登録
 *
 * 注意: 標準の「投稿」をお知らせとして使う場合は、この関数は不要です。
 * カスタム投稿タイプとして分けたい場合のみ有効化してください。
 */
function theme_register_news_post_type() {
  $labels = array(
    'name'                  => 'お知らせ',
    'singular_name'         => 'お知らせ',
    'menu_name'             => 'お知らせ',
    'name_admin_bar'        => 'お知らせ',
    'add_new'               => '新規追加',
    'add_new_item'          => '新規お知らせを追加',
    'new_item'              => '新規お知らせ',
    'edit_item'             => 'お知らせを編集',
    'view_item'             => 'お知らせを表示',
    'all_items'             => 'すべてのお知らせ',
    'search_items'          => 'お知らせを検索',
    'not_found'             => 'お知らせが見つかりません',
    'not_found_in_trash'    => 'ゴミ箱にお知らせはありません',
    'archives'              => 'お知らせ一覧',
  );

  $args = array(
    'labels'              => $labels,
    'public'              => true,
    'publicly_queryable'  => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_rest'        => true,
    'query_var'           => true,
    'rewrite'             => array( 'slug' => 'news', 'with_front' => false ),
    'capability_type'     => 'post',
    'has_archive'         => true,
    'hierarchical'        => false,
    'menu_position'       => 6,
    'menu_icon'           => 'dashicons-megaphone',
    'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
  );

  register_post_type( 'news', $args );
}
add_action( 'init', 'theme_register_news_post_type' );

/**
 * カスタム投稿タイプのパーマリンクをフラッシュ
 *
 * テーマ有効化時にパーマリンクを再構築します。
 * 通常は管理画面の「設定」→「パーマリンク設定」で「変更を保存」でも可。
 */
function theme_rewrite_flush() {
  theme_register_service_post_type();
  theme_register_news_post_type();
  flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'theme_rewrite_flush' );
