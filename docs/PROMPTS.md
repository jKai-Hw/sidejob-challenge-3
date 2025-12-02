# 📋 プロンプト集

> Cursor（AI）に依頼するときにコピペして使えるプロンプト集

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
