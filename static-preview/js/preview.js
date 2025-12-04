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
  // 追加のインタラクションはここに
  // ========================================

  console.log('Preview JS loaded');
});

