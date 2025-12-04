<?php
/**
 * サイトヘッダー
 *
 * @package Figma_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
  <div class="site-header__inner">
    <!-- ロゴ -->
    <div class="site-header__logo">
      <?php if ( has_custom_logo() ) : ?>
        <?php the_custom_logo(); ?>
      <?php else : ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header__logo-link">
          <?php bloginfo( 'name' ); ?>
        </a>
      <?php endif; ?>
    </div>

    <!-- ナビゲーション -->
    <nav class="site-header__nav" role="navigation" aria-label="メインメニュー">
      <?php
      wp_nav_menu( array(
        'theme_location' => 'primary',
        'menu_class'     => 'site-header__menu',
        'container'      => false,
        'fallback_cb'    => false,
      ) );
      ?>
    </nav>

    <!-- ハンバーガーメニューボタン（SP用） -->
    <button class="site-header__hamburger" type="button" aria-label="メニューを開く" aria-expanded="false">
      <div class="site-header__hamburger-lines">
        <span class="site-header__hamburger-line"></span>
        <span class="site-header__hamburger-line"></span>
        <span class="site-header__hamburger-line"></span>
      </div>
      <span class="site-header__hamburger-text">MENU</span>
    </button>
  </div>
</header>
