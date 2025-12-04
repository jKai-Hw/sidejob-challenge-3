<?php
/**
 * お知らせセクションテンプレートパーツ
 *
 * @package Figma_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

// お知らせの取得（カスタム投稿タイプ「news」または標準の「投稿」）
$news_query = new WP_Query(
  array(
    'post_type'      => 'news',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
  )
);
?>
<section class="section-news">
  <div class="section-news__inner">
    <div class="section-news__content">
      <h2 class="section-news__title">
        <?php echo esc_html( 'お知らせ' ); ?>
      </h2>

      <?php if ( $news_query->have_posts() ) : ?>
        <ul class="section-news__list">
          <?php
          while ( $news_query->have_posts() ) :
            $news_query->the_post();
            ?>
            <li class="section-news__item">
              <time class="section-news__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
                <?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?>
              </time>
              <a href="<?php echo esc_url( get_permalink() ); ?>" class="section-news__link">
                <?php echo esc_html( get_the_title() ); ?>
              </a>
            </li>
            <?php
          endwhile;
          wp_reset_postdata();
          ?>
        </ul>
      <?php else : ?>
        <p class="section-news__empty">お知らせはありません</p>
      <?php endif; ?>

      <div class="section-news__more">
        <a href="<?php echo esc_url( get_post_type_archive_link( 'news' ) ?: home_url( '/news' ) ); ?>" class="section-news__more-link">
          一覧を見る →
        </a>
      </div>
    </div>

    <div class="section-news__card">
      <?php get_template_part( 'template-parts/card', 'post' ); ?>
    </div>
  </div>
</section>
