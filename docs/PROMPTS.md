# 📋 プロンプト集

> Cursor（AI）に依頼するときにコピペして使えるプロンプト集

---

## 🆕 新フロー: 2段階アプローチ（HTML → PHP）

> Figma MCP → PHP 直接生成ではなく、HTML経由で実装するフロー
>
> **ポイント:** 全セクションをHTML化してから、まとめてPHP化する

### 📋 全体の流れ

```
【Phase 1】スタイルガイド → _variables.scss

【Phase 2】全セクションHTML化（セクションごとに繰り返し）
  Step 0: 品質チェック & データ保存
  Step 1: MD整理 or 数値抽出
  Step 2: SCSS作成
  Step 3: HTML作成
  → 全セクション完了後、ブラウザで全体確認

【Phase 3】全セクションPHP化（まとめて実行）
  Step 4: HTML → PHP変換

【Phase 4】ACF動的化
```

---

### Step 0: 品質チェック & データ保存（最初に実行）

```
@Figma
Node ID: [NODE_ID] のデータを取得して、
figma-data/[セクション名].json に保存してください。

保存後、以下を報告してください：

1. Figmaの品質評価（良い/悪い）
   - Auto Layoutの有無
   - レイヤー名の意味（「Rectangle 1」等はNG）
   - 構造の整理度

2. 推奨アプローチ
   - 良い場合: 「MCPデータから構造・数値を使ってHTML生成できます」
   - 悪い場合: 「画像ベース + MCP数値のハイブリッドがおすすめです」

※コード生成はまだしないでください。報告だけお願いします。
```

---

### Step 1a: MD整理（良いFigmaの場合）

```
figma-data/[セクション名].json を読み込んで、
figma-data/[セクション名].md に人間が読みやすい形式で整理してください。

含める情報:
- 構造（親子関係）
- サイズ（width, height）
- 色（fill, stroke）→ _variables.scss の変数名も併記
- テキスト内容
- フォント情報
- 余白・ギャップ

不要な情報:
- 内部ID
- 絶対座標（x, y）
```

### Step 1b: 数値抽出（悪いFigmaの場合）

```
figma-data/[セクション名].json から、
以下の数値情報だけ抽出して figma-data/[セクション名]-values.md に保存してください。

抽出する情報:
- 色（fills の色コード）→ _variables.scss の変数名も併記
- フォント（fontSize, fontFamily, fontWeight）
- テキスト内容（characters）
- 余白・ギャップ（paddingLeft, paddingTop, itemSpacing 等）

構造やレイアウト情報は不要です（画像から判断するため）。

※画像は figma-data/images/[セクション名].png として
  Figmaから手動で書き出して保存してください。
```

---

### Step 2: SCSS作成

```
[セクション名] のSCSSを作成してください。

ファイル: wp-theme/assets/scss/sections/_[セクション名].scss

参照データ:
- figma-data/[セクション名].md（または -values.md）

要件:
- _variables.scss の変数を使用（ハードコード禁止）
- BEM記法
- レスポンシブ対応（モバイルファースト）
- style.scss に @use を追加

作成後、npm run build:css でビルドしてください。
```

---

### Step 3: HTML作成

#### 良いFigmaの場合

```
[セクション名] のHTMLを作成してください。

ファイル: static-preview/sections/[セクション名].html

参照データ:
- figma-data/[セクション名].md

要件:
- BEM記法のクラス名
- ../css/style.css を読み込み（ビルド済み）
- 画像はプレースホルダー使用（https://placehold.co/）
- jQuery読み込み（必要な場合）

テンプレート: static-preview/sections/_template.html を参考に。
```

#### 悪いFigmaの場合（画像 + 数値）

```
[セクション名] のHTMLを作成してください。

ファイル: static-preview/sections/[セクション名].html

参照データ:
- figma-data/images/[セクション名].png（レイアウト参考）
- figma-data/[セクション名]-values.md（色・フォント・余白）

要件:
- 画像の見た目を再現
- 数値（色、フォント、余白）は values.md を使用
- BEM記法のクラス名
- ../css/style.css を読み込み（ビルド済み）
- 画像はプレースホルダー使用

テンプレート: static-preview/sections/_template.html を参考に。
```

---

### Step 4: ブラウザ確認

```
static-preview/sections/[セクション名].html をブラウザで開いて、
以下を確認してください：

- [ ] デスクトップ表示OK
- [ ] スマホ表示OK（レスポンシブ）
- [ ] デザインとの大きなズレがないか

問題があれば報告してください。
```

---

### Step 5: PHP化

```
static-preview/sections/[セクション名].html を
WordPressのテンプレートパーツに変換してください。

ファイル: wp-theme/template-parts/section-[セクション名].php

変換内容:
- 画像パス → <?php echo esc_url(get_template_directory_uri()); ?>/assets/images/
- 固定テキストはそのまま（ACF化は後で）
- リンク → # または home_url()

SCSSは変更不要（そのまま使用）。
```

---

## 🎨 Phase 1: スタイルガイド → 変数抽出

### 1-1. _variables.scss を生成

```
@Figma
Node ID: [ここにスタイルガイドのNode IDを入れる] のデータを取得して、
wp-theme/assets/scss/_variables.scss を更新してください。

抽出項目:
- カラーパレット
- フォントファミリー
- フォントサイズ
- スペーシング（余白）

既存の変数名・構造は維持して、値だけ置き換えてください。
```

---

## 🏗️ Phase 2: セクション実装

### 2-1. ヘッダー

```
@Figma
Node ID: [ヘッダーのNode ID] のデータを取得して実装してください。

対象ファイル:
- wp-theme/header.php
- wp-theme/assets/scss/sections/_header.scss

要件:
- _variables.scss の変数を使用
- ハンバーガーメニューはmain.jsと連携済み
- レスポンシブ対応（SP/PC）
```

### 2-2. フッター

```
@Figma
Node ID: [フッターのNode ID] のデータを取得して実装してください。

対象ファイル:
- wp-theme/footer.php
- wp-theme/assets/scss/sections/_footer.scss

要件:
- _variables.scss の変数を使用
- レスポンシブ対応（SP/PC）
```

### 2-3. 新しいセクション

```
@Figma
Node ID: [セクションのNode ID] のデータを取得して実装してください。

セクション名: [hero / about / service 等]

作成するファイル:
- wp-theme/template-parts/section-[セクション名].php
- wp-theme/assets/scss/sections/_[セクション名].scss

要件:
- _variables.scss の変数を使用
- BEM記法
- レスポンシブ対応（SP/PC）
- 画像はプレースホルダー使用
- style.scss に @use を追加
```

---

## 🔄 Phase 3: 動的化（ACF）

### 3-1. ACFフィールド設計

```
[セクション名] を動的化したいです。

以下を出力してください:
1. ACFフィールド設計（フィールド名、タイプ）
2. PHPコード（get_field使用、エスケープ処理込み）

フィールド名は英語スネークケースで。
```

### 3-2. 既存PHPをACF化

```
wp-theme/template-parts/section-[セクション名].php を
ACFで動的に変更できるようにしてください。

- テキスト → get_field()
- 画像 → get_field() で配列取得
- 繰り返し → have_rows()
- 必ずエスケープ処理
```

---

## 📄 ページテンプレート

### トップページ

```
wp-theme/front-page.php を作成してください。

セクション構成:
1. Hero
2. About
3. Service
4. News
5. CTA

各セクションは get_template_part() で読み込む。
```

### 下層ページ

```
[ページ名] 用のテンプレートを作成してください。

ファイル: wp-theme/page-[スラッグ].php

内容:
- ページヘッダー（タイトル + パンくず）
- メインコンテンツ
```

---

## 🐛 修正・調整

### デザインとのズレ修正

```
@Figma
Node ID: [セクションのNode ID] と現在の実装を比較して、
ズレている部分を修正してください。

対象ファイル:
- wp-theme/assets/scss/sections/_[セクション名].scss
```

### レスポンシブ調整

```
[セクション名] のSP表示を調整してください。

問題:
- [具体的な問題を記述]

対象: wp-theme/assets/scss/sections/_[セクション名].scss
```

---

## ✅ 品質チェック

### コードレビュー

```
今回作成したファイルをチェックしてください:

- [ ] BEM命名規則
- [ ] 変数使用（ハードコードなし）
- [ ] レスポンシブ対応
- [ ] エスケープ処理
- [ ] SCSSビルドエラーなし
```

### 最終確認

```
wp-theme/ 全体をチェックして、以下を確認してください:

- console.log / var_dump が残っていないか
- 未使用のコードがないか
- SCSSビルドが通るか
```

---

## 💡 Tips

### Node ID の確認方法

1. Figmaで対象フレームを選択
2. 右クリック → 「リンクをコピー」
3. URLの `node-id=XXX-XXX` の部分がNode ID

### プロンプトのコツ

- **具体的に**: 「いい感じに」ではなく「余白を24pxに」
- **ファイル指定**: 対象ファイルを明示する
- **Node ID必須**: Figma参照時は必ず指定
