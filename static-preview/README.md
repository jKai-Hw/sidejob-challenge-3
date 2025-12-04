# 📄 Static Preview

> HTMLプレビュー用フォルダ（PHP化前の確認用）

---

## 🎯 このフォルダの目的

Figmaデータから生成したHTML + CSSを**ブラウザで確認**するためのフォルダです。

**メリット:**
- PHPに変換する前に見た目を確認できる
- 修正・調整がしやすい
- クライアント確認にも使える（静的HTMLなので）

---

## 🔄 ワークフロー

```
1. figma-data/ のデータを元にSCSSを作成
   → wp-theme/assets/scss/sections/_[name].scss

2. SCSSビルド
   → npm run build:css

3. HTMLを作成
   → static-preview/sections/[name].html

4. ブラウザで確認
   → 直接HTMLファイルを開く or ローカルサーバー

5. 問題なければPHP化
   → wp-theme/template-parts/section-[name].php
```

---

## 📁 ディレクトリ構造

```
static-preview/
├── README.md           # このファイル
├── index.html          # トップページ全体のプレビュー
├── sections/           # セクション別HTML
│   ├── header.html
│   ├── hero.html
│   ├── about.html
│   └── ...
├── css/                # スタイルシート
│   └── style.css       # wp-theme/assets/css/style.css のコピー or リンク
├── js/                 # JavaScript（必要に応じて）
│   └── preview.js
└── images/             # プレビュー用画像（プレースホルダー等）
    └── .gitkeep
```

---

## 📝 HTML作成のポイント

### 1. CSSの読み込み

ビルド済みのCSSを参照します：

```html
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>セクション名 - Preview</title>
  <!-- ビルド済みCSSを読み込み -->
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <!-- セクションのHTML -->
</body>
</html>
```

### 2. クラス命名

PHP化後も使うので、BEM記法で書きます：

```html
<section class="hero">
  <div class="hero__inner">
    <h1 class="hero__title">タイトル</h1>
    <p class="hero__text">説明文</p>
    <a href="#" class="hero__button button button--primary">ボタン</a>
  </div>
</section>
```

### 3. 画像

プレースホルダーを使用：

```html
<!-- プレースホルダーサービスを使用 -->
<img src="https://placehold.co/600x400" alt="画像の説明">

<!-- または static-preview/images/ にダミー画像を置く -->
<img src="../images/hero-bg.jpg" alt="画像の説明">
```

### 4. jQuery（必要な場合）

```html
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="../js/preview.js"></script>
```

---

## 🔧 ローカルサーバーで確認する場合

HTMLファイルを直接開くと、一部の機能（フォント読み込み等）が動かない場合があります。

### 方法1: VS Code Live Server

1. VS Code拡張「Live Server」をインストール
2. HTMLファイルを右クリック → 「Open with Live Server」

### 方法2: Python（簡易サーバー）

```bash
cd static-preview
python -m http.server 8000
# http://localhost:8000 でアクセス
```

### 方法3: Node.js

```bash
npx serve static-preview
```

---

## 📋 チェックリスト

HTMLをPHP化する前に確認：

- [ ] デスクトップ表示OK
- [ ] スマホ表示OK（レスポンシブ）
- [ ] BEM命名になっている
- [ ] 画像はプレースホルダー or alt属性あり
- [ ] リンクは `#` or 仮URL

---

## ⚠️ 注意

- このフォルダは**案件固有のHTML**が入ります
- テンプレートに戻す際は中身を削除してください（README, サンプルHTMLは残す）
- CSSファイルは `wp-theme/assets/css/` からコピーするか、シンボリックリンクを貼ってください



