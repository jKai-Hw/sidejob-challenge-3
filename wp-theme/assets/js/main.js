/**
 * メインJavaScriptファイル（テンプレート）
 *
 * jQuery を使用したカスタムスクリプト
 * 実際の案件では必要な機能を追加してください
 *
 * @package Figma_Theme
 */

(function($) {
  'use strict';

  // ==========================================================================
  // DOM Ready
  // ==========================================================================
  $(function() {
    init();
  });

  // ==========================================================================
  // 初期化
  // ==========================================================================
  function init() {
    setupMobileMenu();
    setupSmoothScroll();
    // 案件に応じて以下を有効化
    // setupAccordion();
    // setupModal();
  }

  // ==========================================================================
  // モバイルメニュー（ハンバーガーメニュー）
  // ==========================================================================
  function setupMobileMenu() {
    var $hamburger = $('.site-header__hamburger');
    var $nav = $('.site-header__nav');
    var $body = $('body');
    var $menuLinks = $('.site-header__nav a');

    // ハンバーガーボタンクリック
    $hamburger.on('click', function() {
      var isOpen = $nav.hasClass('is-open');

      $nav.toggleClass('is-open');
      $hamburger.toggleClass('is-open');
      $body.toggleClass('is-menu-open');

      // アクセシビリティ: aria-expanded を更新
      $(this).attr('aria-expanded', !isOpen);
      $(this).attr('aria-label', isOpen ? 'メニューを開く' : 'メニューを閉じる');
    });

    // メニュー内リンクをクリックしたら閉じる
    $menuLinks.on('click', function() {
      $nav.removeClass('is-open');
      $hamburger.removeClass('is-open');
      $body.removeClass('is-menu-open');
      $hamburger.attr('aria-expanded', 'false');
      $hamburger.attr('aria-label', 'メニューを開く');
    });

    // ESCキーで閉じる
    $(document).on('keydown', function(e) {
      if (e.key === 'Escape' && $nav.hasClass('is-open')) {
        $nav.removeClass('is-open');
        $hamburger.removeClass('is-open');
        $body.removeClass('is-menu-open');
        $hamburger.attr('aria-expanded', 'false');
        $hamburger.focus();
      }
    });
  }

  // ==========================================================================
  // スムーススクロール
  // ==========================================================================
  function setupSmoothScroll() {
    $('a[href^="#"]').on('click', function(e) {
      var hash = this.hash;
      if (!hash) {
        return;
      }

      var $target = $(hash);
      if ($target.length) {
        e.preventDefault();
        var headerHeight = $('.site-header').outerHeight() || 0;

        $('html, body').animate({
          scrollTop: $target.offset().top - headerHeight,
        }, 500);

        // フォーカスを移動（アクセシビリティ）
        $target.attr('tabindex', '-1').focus();
      }
    });
  }

  // ==========================================================================
  // アコーディオン（必要に応じて有効化）
  // ==========================================================================
  // function setupAccordion() {
  //   var $trigger = $('.js-accordion-trigger');
  //
  //   $trigger.on('click', function(e) {
  //     e.preventDefault();
  //     var $this = $(this);
  //     var $content = $this.next('.js-accordion-content');
  //     var isOpen = $this.hasClass('is-open');
  //
  //     $this.toggleClass('is-open');
  //     $content.slideToggle(300);
  //     $this.attr('aria-expanded', !isOpen);
  //   });
  // }

  // ==========================================================================
  // モーダル（必要に応じて有効化）
  // ==========================================================================
  // function setupModal() {
  //   var $body = $('body');
  //
  //   // 開く
  //   $('[data-modal-open]').on('click', function(e) {
  //     e.preventDefault();
  //     var modalId = $(this).data('modal-open');
  //     $('#' + modalId).addClass('is-open');
  //     $body.addClass('is-modal-open');
  //   });
  //
  //   // 閉じる
  //   $('[data-modal-close]').on('click', function(e) {
  //     e.preventDefault();
  //     $(this).closest('.js-modal').removeClass('is-open');
  //     $body.removeClass('is-modal-open');
  //   });
  //
  //   // ESCキーで閉じる
  //   $(document).on('keydown', function(e) {
  //     if (e.key === 'Escape') {
  //       $('.js-modal.is-open').removeClass('is-open');
  //       $body.removeClass('is-modal-open');
  //     }
  //   });
  // }

})(jQuery);

