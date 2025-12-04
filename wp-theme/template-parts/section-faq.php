<?php
/**
 * よくあるご質問セクションテンプレートパーツ
 *
 * @package Figma_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

// ACFフィールドの例（ACF使用時）
// $faq_title = get_field( 'faq_title', 'option' );
// $faq_items = get_field( 'faq_items', 'option' );
?>
<section class="section-faq">
  <div class="section-faq__inner">
    <h2 class="section-faq__title">
      <?php
      // echo esc_html( $faq_title );
      echo 'よくあるご質問';
      ?>
    </h2>

    <div class="section-faq__list">
      <?php
      // ACFリピーターフィールドの例
      // if ( $faq_items ) :
      //   foreach ( $faq_items as $item ) :
      //     $question = $item['question'];
      //     $answer = $item['answer'];
      ?>
      <div class="section-faq__item">
        <div class="section-faq__question">
          <span class="section-faq__question-text">質問内容がここに入ります</span>
          <span class="section-faq__question-icon">+</span>
        </div>
        <div class="section-faq__answer">
          <p>回答内容がここに入ります。回答内容がここに入ります。回答内容がここに入ります。</p>
        </div>
      </div>
      <?php
      //   endforeach;
      // endif;
      ?>
    </div>
  </div>
</section>
