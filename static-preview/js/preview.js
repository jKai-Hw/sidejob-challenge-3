/**
 * Preview用JavaScript
 * 
 * プレビュー時に必要なインタラクションを記述します。
 * PHP化後は wp-theme/assets/js/main.js に移行してください。
 */

$(function() {
  'use strict';

  // ========================================
  // ハンバーガーメニュー
  // ========================================
  $('.js-hamburger').on('click', function() {
    $(this).toggleClass('is-active');
    $('.header__nav').toggleClass('is-open');
    $('body').toggleClass('is-menu-open');
  });

  // ========================================
  // スムーススクロール
  // ========================================
  $('a[href^="#"]').on('click', function(e) {
    var href = $(this).attr('href');
    if (href === '#') return;
    
    e.preventDefault();
    var target = $(href);
    if (target.length) {
      var offset = target.offset().top - 80; // ヘッダー高さ分調整
      $('html, body').animate({ scrollTop: offset }, 500);
    }
  });

  // ========================================
  // Worksセクション: タブ切り替え
  // ========================================
  const worksData = {
    farm: "私たちは、「持続可能な農業」を掲げて、自然の恵みに感謝しながら、農作物を育てています。<br>無農薬で、体にも環境にも優しく、季節ごとに異なる品種を育て、提供しています。<br>ぜひ一度、農園にお越し頂き、自分の手で収穫した新鮮な野菜、果物をお召し上がりください。",
    ranch: "私たちの牧場は、自然と動物との共存を尊重し、持続可能な農業の原則に基づいて運営されています。<br>広々とした環境で、動物たちとのふれ合いを通じて、自然の恵みと動物の尊さを感じ、<br>心温まるひとときを過ごしていただけます。",
    online: "自然の恵み農園から直接お届けする、新鮮で美味しい農産物と手作りのジャムやバターなどの加工品を提供しています。<br>自然の恩恵をご自宅でお楽しみいただけます。"
  };

  $('.works__tab').on('click', function() {
    const target = $(this).data('target');
    
    // タブのアクティブ切り替え
    $('.works__tab').removeClass('is-active');
    $(this).addClass('is-active');

    // テキストの切り替え（フェード効果）
    const $text = $('#works-text');
    $text.addClass('is-hidden');
    
    setTimeout(() => {
      if (worksData[target]) {
        $text.html(worksData[target]);
      }
      $text.removeClass('is-hidden');
    }, 300); // CSSのtransitionに合わせる

    // スライダーの切り替え
    $('.works__slider').hide().attr('aria-hidden', 'true');
    const $targetSlider = $(`.works__slider[data-target="${target}"]`);
    $targetSlider.fadeIn(300).attr('aria-hidden', 'false');
    
    // display:none から復帰した際にアニメーションがずれる場合があるので再設定などを考慮
    // 必要であればアニメーションのリセット処理を入れる
  });

  // 初期表示のテキスト設定（HTML側で設定済みだが念のため）
  if ($('.works__tab.is-active').length) {
    const initialTarget = $('.works__tab.is-active').data('target');
    // $('#works-text').html(worksData[initialTarget]); // HTML初期値を使用するためコメントアウト
  }

  // ========================================
  // FAQセクション: アコーディオン
  // ========================================
  $('.js-accordion-trigger').on('click', function() {
    const $currentItem = $(this).closest('.faq__item');
    const $currentAnswer = $currentItem.find('.faq__answer');
    const isOpen = $currentItem.hasClass('is-open');

    // 他の開いているアイテムを閉じる
    $('.faq__item.is-open').not($currentItem).each(function() {
      const $otherItem = $(this);
      const $otherAnswer = $otherItem.find('.faq__answer');
      
      $otherAnswer.slideUp(300, function() {
        $otherItem.removeClass('is-open');
        $(this).attr('aria-hidden', 'true');
        $otherItem.find('.js-accordion-trigger').attr('aria-expanded', 'false');
      });
    });

    if (isOpen) {
      // Close current
      $currentAnswer.slideUp(300, function() {
        $currentItem.removeClass('is-open');
        $(this).attr('aria-hidden', 'true');
        $currentItem.find('.js-accordion-trigger').attr('aria-expanded', 'false');
      });
    } else {
      // Open current
      $currentItem.addClass('is-open');
      $currentItem.find('.js-accordion-trigger').attr('aria-expanded', 'true');
      $currentAnswer.attr('aria-hidden', 'false').slideDown(300);
    }
  });

  // ========================================
  // Hero: Newsエリアのスクロール処理
  // ========================================
  const $hero = $('#hero');
  const $heroNews = $('#hero-news');
  
  if ($hero.length && $heroNews.length) {
    const heroHeight = $hero.outerHeight();

    $(window).on('scroll', function() {
      const scrollPos = $(this).scrollTop();
      
      // FVを過ぎたらNewsを非表示にする
      // 少し余裕を持って非表示にする（heroHeight * 0.8 くらいでフェードアウト開始）
      if (scrollPos > heroHeight * 0.8) {
        $heroNews.addClass('is-hidden');
      } else {
        $heroNews.removeClass('is-hidden');
      }
    });
  }

  // ========================================
  // About: 画像のフェードインアニメーション
  // ========================================
  const $aboutSection = $('#about');
  const $aboutImages = $('.about__image');
  
  if ($aboutSection.length && $aboutImages.length) {
    let hasAnimated = false; // 一度だけアニメーション実行
    
    function checkAboutAnimation() {
      if (hasAnimated) return;
      
      const scrollPos = $(window).scrollTop() + $(window).height();
      const aboutTop = $aboutSection.offset().top;
      const triggerPoint = aboutTop + 200; // セクションから200px程度でトリガー
      
      if (scrollPos > triggerPoint) {
        // 時間差で1枚ずつis-visibleクラスを追加
        $aboutImages.each(function(index) {
          const $img = $(this);
          setTimeout(function() {
            $img.addClass('is-visible');
          }, index * 200); // 200ms間隔で順番に表示
        });
        hasAnimated = true;
      }
    }
    
    // 初期チェック（ページ読み込み時に既に画面内にある場合）
    checkAboutAnimation();
    
    // スクロール時にチェック
    $(window).on('scroll', checkAboutAnimation);
  }

  // ========================================
  // 追加のインタラクションはここに
  // ========================================

  console.log('Preview JS loaded');
});




