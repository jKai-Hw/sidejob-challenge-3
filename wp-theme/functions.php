<?php
/**
 * Figma WordPress Theme functions and definitions
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
    add_editor_style( 'assets/css/editor-style.css' );

    // レスポンシブ埋め込み
    add_theme_support( 'responsive-embeds' );

    // ブロックスタイル
    add_theme_support( 'wp-block-styles' );
}
add_action( 'after_setup_theme', 'figma_theme_setup' );

/**
 * スタイルとスクリプトの読み込み
 */
function figma_theme_scripts() {
    // Google Fonts - Noto Sans JP
    wp_enqueue_style(
        'figma-theme-fonts',
        'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    // メインスタイル
    wp_enqueue_style(
        'figma-theme-style',
        get_stylesheet_uri(),
        array( 'figma-theme-fonts' ),
        wp_get_theme()->get( 'Version' )
    );

    // カスタムスタイル
    if ( file_exists( get_template_directory() . '/assets/css/custom.css' ) ) {
        wp_enqueue_style(
            'figma-theme-custom',
            get_template_directory_uri() . '/assets/css/custom.css',
            array( 'figma-theme-style' ),
            wp_get_theme()->get( 'Version' )
        );
    }

    // カスタムスクリプト
    if ( file_exists( get_template_directory() . '/assets/js/custom.js' ) ) {
        wp_enqueue_script(
            'figma-theme-custom',
            get_template_directory_uri() . '/assets/js/custom.js',
            array(),
            wp_get_theme()->get( 'Version' ),
            true
        );
    }
}
add_action( 'wp_enqueue_scripts', 'figma_theme_scripts' );

/**
 * ブロックパターンカテゴリの登録
 */
function figma_theme_register_pattern_categories() {
    register_block_pattern_category(
        'figma-theme-hero',
        array( 'label' => __( 'Hero Sections', 'figma-theme' ) )
    );

    register_block_pattern_category(
        'figma-theme-features',
        array( 'label' => __( 'Features', 'figma-theme' ) )
    );

    register_block_pattern_category(
        'figma-theme-cta',
        array( 'label' => __( 'Call to Action', 'figma-theme' ) )
    );
}
add_action( 'init', 'figma_theme_register_pattern_categories' );

