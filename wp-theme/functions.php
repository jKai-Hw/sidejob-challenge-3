<?php
/**
 * Figma WordPress Theme functions and definitions
 * 
 * 【テンプレート】実際の案件では必要に応じてカスタマイズしてください
 *
 * @package Figma_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/**
 * テーマのセットアップ
 */
function figma_theme_setup() {
  // 翻訳サポート
  load_theme_textdomain( 'figma-theme', get_template_directory() . '/languages' );

  // HTML5サポート
  add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
    'style',
    'script',
  ) );

  // タイトルタグ
  add_theme_support( 'title-tag' );

  // アイキャッチ画像
  add_theme_support( 'post-thumbnails' );

  // カスタムロゴ
  add_theme_support( 'custom-logo', array(
    'height'      => 100,
    'width'       => 400,
    'flex-height' => true,
    'flex-width'  => true,
  ) );

  // ブロックエディタースタイル
  add_theme_support( 'editor-styles' );
  add_editor_style( 'assets/css/style.css' );

  // レスポンシブ埋め込み
  add_theme_support( 'responsive-embeds' );

  // ナビゲーションメニュー
  register_nav_menus( array(
    'primary' => __( 'メインメニュー', 'figma-theme' ),
    'footer'  => __( 'フッターメニュー', 'figma-theme' ),
  ) );
}
add_action( 'after_setup_theme', 'figma_theme_setup' );

/**
 * スタイルとスクリプトの読み込み
 */
function figma_theme_scripts() {
  $theme_version = wp_get_theme()->get( 'Version' );

  // Google Fonts - Archivo Narrow
  wp_enqueue_style(
    'figma-theme-fonts',
    'https://fonts.googleapis.com/css2?family=Archivo+Narrow:wght@400;500;600;700&display=swap',
    array(),
    null
  );

  // メインスタイル（テーマ情報用）
  wp_enqueue_style(
    'figma-theme-style',
    get_stylesheet_uri(),
    array( 'figma-theme-fonts' ),
    $theme_version
  );

  // SCSSからコンパイルしたカスタムスタイル
  if ( file_exists( get_template_directory() . '/assets/css/style.css' ) ) {
    wp_enqueue_style(
      'figma-theme-custom',
      get_template_directory_uri() . '/assets/css/style.css',
      array( 'figma-theme-style' ),
      $theme_version
    );
  }

  // jQuery（WordPress同梱版を使用）
  wp_enqueue_script( 'jquery' );

  // カスタムスクリプト（jQuery依存）
  if ( file_exists( get_template_directory() . '/assets/js/main.js' ) ) {
    wp_enqueue_script(
      'figma-theme-main',
      get_template_directory_uri() . '/assets/js/main.js',
      array( 'jquery' ),
      $theme_version,
      true
    );
  }
}
add_action( 'wp_enqueue_scripts', 'figma_theme_scripts' );

/**
 * ============================================
 * 機能ファイルの読み込み（inc/）
 * ============================================
 */

// カスタム投稿タイプ
require_once get_template_directory() . '/inc/custom-post-types.php';

// カスタムタクソノミー
require_once get_template_directory() . '/inc/custom-taxonomies.php';

/**
 * ============================================
 * ACF オプションページ（ACFプラグイン有効時のみ）
 * ============================================
 */
if ( function_exists( 'acf_add_options_page' ) ) {
  // メインオプションページ
  acf_add_options_page( array(
    'page_title'  => 'サイト設定',
    'menu_title'  => 'サイト設定',
    'menu_slug'   => 'site-settings',
    'capability'  => 'edit_posts',
    'redirect'    => false,
    'icon_url'    => 'dashicons-admin-generic',
    'position'    => 2,
  ) );

  // ヘッダー設定
  acf_add_options_sub_page( array(
    'page_title'  => 'ヘッダー設定',
    'menu_title'  => 'ヘッダー',
    'parent_slug' => 'site-settings',
  ) );

  // フッター設定
  acf_add_options_sub_page( array(
    'page_title'  => 'フッター設定',
    'menu_title'  => 'フッター',
    'parent_slug' => 'site-settings',
  ) );
}

/**
 * ============================================
 * Ajax 絞り込み検索用（サンプル）
 * ============================================
 */

/**
 * サービス絞り込みのAjaxハンドラー
 */
function theme_filter_services() {
  // Nonceチェック
  check_ajax_referer( 'theme_filter_nonce', 'nonce' );

  $category = isset( $_POST['category'] ) ? sanitize_text_field( $_POST['category'] ) : '';

  $args = array(
    'post_type'      => 'service',
    'posts_per_page' => 12,
    'post_status'    => 'publish',
  );

  if ( $category && $category !== 'all' ) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'service_category',
        'field'    => 'slug',
        'terms'    => $category,
      ),
    );
  }

  $query = new WP_Query( $args );

  if ( $query->have_posts() ) :
    while ( $query->have_posts() ) : $query->the_post();
      get_template_part( 'template-parts/card', 'service' );
    endwhile;
    wp_reset_postdata();
  else :
    echo '<p class="no-results">該当するサービスがありません。</p>';
  endif;

  wp_die();
}
add_action( 'wp_ajax_filter_services', 'theme_filter_services' );
add_action( 'wp_ajax_nopriv_filter_services', 'theme_filter_services' );

/**
 * Ajax用の変数をJSに渡す
 */
function theme_localize_ajax_scripts() {
  wp_localize_script( 'figma-theme-main', 'themeAjax', array(
    'ajaxUrl' => admin_url( 'admin-ajax.php' ),
    'nonce'   => wp_create_nonce( 'theme_filter_nonce' ),
  ) );
}
add_action( 'wp_enqueue_scripts', 'theme_localize_ajax_scripts' );

/**
 * ============================================
 * ACF JSON 自動同期設定
 * ============================================
 * フィールドグループをJSONファイルとして保存し、Git管理を可能にする
 */

/**
 * ACF JSONの保存先を設定
 */
function theme_acf_json_save_point( $path ) {
  return get_template_directory() . '/acf-json';
}
add_filter( 'acf/settings/save_json', 'theme_acf_json_save_point' );

/**
 * ACF JSONの読み込み先を設定
 */
function theme_acf_json_load_point( $paths ) {
  // デフォルトのパスを削除
  unset( $paths[0] );
  // テーマ内のacf-jsonフォルダを追加
  $paths[] = get_template_directory() . '/acf-json';
  return $paths;
}
add_filter( 'acf/settings/load_json', 'theme_acf_json_load_point' );

/**
 * ============================================
 * メタタグ・OGP設定
 * ============================================
 */

/**
 * ページ別のタイトル・ディスクリプション設定
 */
function theme_meta_tags() {
  $title = '';
  $description = '';
  $og_image = get_template_directory_uri() . '/assets/img/og-image.jpg'; // デフォルトOGP画像

  // トップページ
  if ( is_front_page() ) {
    $title = '自然の恵み農園｜自然の恵みを感じ、豊かな未来をつくる';
    $description = '自然の恵み農園は、農園運営・牧場運営・オンライン販売を通じ、自然の恵みを感じて、かな未来を想像して頂ける取り組みを行なっています。';
  }
  // お知らせ一覧（投稿アーカイブ）
  elseif ( is_home() || is_category() || is_tag() || is_archive() ) {
    $title = 'お知らせ一覧｜自然の恵み農園';
    $description = '季節の農作物のお知らせ、見学ツアーのご案内、オンライン販売セールのお知らせなど、自然の恵み農園の最新情報をお届けします。';
  }
  // お問い合わせページ
  elseif ( is_page() ) {
    $page_slug = get_post_field( 'post_name', get_the_ID() );
    if ( strpos( $page_slug, 'contact' ) !== false || strpos( $page_slug, 'お問い合わせ' ) !== false ) {
      $title = 'お問い合わせ|自然の恵み農園';
      $description = '自然の恵み農園への、お仕事のご相談、農園体験、牧場の見学、その他ご質問など、お気軽にお問い合わせください。';
    }
  }

  // タイトルが設定されていない場合はデフォルト
  if ( empty( $title ) ) {
    $title = wp_get_document_title();
  }
  if ( empty( $description ) ) {
    $description = get_bloginfo( 'description' );
  }

  // OGP画像の設定（アイキャッチ画像があれば優先）
  if ( is_singular() && has_post_thumbnail() ) {
    $og_image = get_the_post_thumbnail_url( get_the_ID(), 'large' );
  }

  // メタタグ出力
  echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
  
  // OGPタグ
  echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
  echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
  echo '<meta property="og:type" content="' . ( is_front_page() ? 'website' : 'article' ) . '">' . "\n";
  echo '<meta property="og:url" content="' . esc_url( get_permalink() ) . '">' . "\n";
  echo '<meta property="og:image" content="' . esc_url( $og_image ) . '">' . "\n";
  echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";
  
  // Twitter Card
  echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
  echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '">' . "\n";
  echo '<meta name="twitter:description" content="' . esc_attr( $description ) . '">' . "\n";
  echo '<meta name="twitter:image" content="' . esc_url( $og_image ) . '">' . "\n";
}
add_action( 'wp_head', 'theme_meta_tags', 1 );

/**
 * タイトルタグのカスタマイズ
 */
function theme_document_title( $title_parts ) {
  // トップページ
  if ( is_front_page() ) {
    $title_parts['title'] = '自然の恵み農園｜自然の恵みを感じ、豊かな未来をつくる';
    $title_parts['site'] = '';
  }
  // お知らせ一覧
  elseif ( is_home() || ( is_archive() && ! is_post_type_archive() ) ) {
    $title_parts['title'] = 'お知らせ一覧';
    $title_parts['site'] = '自然の恵み農園';
  }
  // お問い合わせページ
  elseif ( is_page() ) {
    $page_slug = get_post_field( 'post_name', get_the_ID() );
    if ( strpos( $page_slug, 'contact' ) !== false || strpos( $page_slug, 'お問い合わせ' ) !== false ) {
      $title_parts['title'] = 'お問い合わせ';
      $title_parts['site'] = '自然の恵み農園';
    }
  }
  
  return $title_parts;
}
add_filter( 'document_title_parts', 'theme_document_title' );
