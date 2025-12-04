# 新規案件スタートガイド

> 新しいWordPress案件が来た時に、このテンプレートをどう使うか

---

## 📋 このガイドの目的

このドキュメントは、新しいコーディング案件が来た時に：
- 何から始めればいいか
- どの作業を自分でやるか
- どこをAI（Cursor）に任せるか

を明確にするためのガイドです。

---

## 🚀 クイックスタート（全体の流れ）

```
【事前準備】テンプレートをコピー → 新規プロジェクト作成
    ↓
【STEP 1】案件情報の整理（自分）
    ↓
【STEP 2】Figmaの確認とNode ID取得（自分）
    ↓
【STEP 3】開発環境の起動（自分）
    ↓
【STEP 4】スタイルガイドからSCSS変数生成（AI支援）
    ↓
【STEP 5】セクションごとの実装（AI支援）
    ↓
【STEP 6】動的化・ACF設定（AI支援）
    ↓
【STEP 7】確認・修正・納品（自分）
```

---

## 📦 事前準備：テンプレートから新規プロジェクト作成

### 方法1: GitHubからクローン（推奨）

```bash
# 1. テンプレートリポジトリをクローン
git clone https://github.com/あなたのユーザー名/figma-wordpress-project.git 案件名-project

# 2. 新しいディレクトリに移動
cd 案件名-project

# 3. 既存のGit履歴を削除（新しいプロジェクトとして始める）
rm -rf .git

# 4. 新しいGitリポジトリとして初期化
git init
git add .
git commit -m "🎉 init: 案件名プロジェクト開始"

# 5. 新しいリモートリポジトリを作成して紐付け（GitHubで新規リポジトリ作成後）
git remote add origin https://github.com/あなたのユーザー名/案件名-project.git
git push -u origin main
```

### 方法2: フォルダをコピー

```bash
# 1. テンプレートフォルダをコピー
cp -r figma-wordpress-project 案件名-project

# 2. 新しいディレクトリに移動
cd 案件名-project

# 3. 既存のGit履歴を削除
rm -rf .git

# 4. 新しいGitリポジトリとして初期化
git init
git add .
git commit -m "🎉 init: 案件名プロジェクト開始"
```

### コピー後にやること

1. **`wp-theme/style.css`** を編集してテーマ名を変更

```css
/*
Theme Name: 案件名テーマ
Description: ○○株式会社コーポレートサイト
Version: 1.0.0
*/
```

2. **`README.md`** を案件用に書き換え（または削除して新規作成）

3. **`docs/PROJECT_PLAN.md`** を案件用にリセット

---

## 📝 STEP 1: 案件情報の整理（自分でやる）

### やること

新しい案件が来たら、まず以下の情報を整理します。

| 項目 | 記入欄 |
|------|--------|
| クライアント名 | |
| サイト名 | |
| FigmaのURL | |
| 納期 | |
| ページ数 | |
| 特別な機能 | |
| 備考 | |

### 確認すべきこと

- [ ] FigmaのURLを受け取ったか
- [ ] デザインの意図・注意点を確認したか
- [ ] レスポンシブ（SP/タブレット/PC）のデザインはあるか
- [ ] ホバー状態のデザインはあるか
- [ ] 動的に変更する箇所（ACF入稿部分）は明確か
- [ ] 納期は現実的か

### ⚠️ 不明点があれば必ず確認！

デザインに曖昧な部分があったら、**想定で進めずに**デザイナーさんに確認してください。

---

## 🔍 STEP 2: Figmaの確認とNode ID取得（自分でやる）

### Node IDとは？

FigmaのURLに含まれる識別子です。

```
https://www.figma.com/design/xxxxx/FileName?node-id=123-456
                                                    ↑ これがNode ID
```

### Node IDの取得方法

1. Figmaでデザインを開く
2. 取得したいフレーム（セクション）をクリックして選択
3. 右クリック → 「リンクをコピー」
4. URLの `node-id=xxx-xxx` の部分がNode ID

### 取得すべきNode ID一覧

以下のNode IDを事前にメモしておきます：

```markdown
## Node IDメモ

### スタイルガイド
- Typography: 
- Colors: 
- Spacing（あれば）: 

### ページ
- TOP: 

### セクション（TOPページ）
- ヘッダー: 
- メインビジュアル: 
- About: 
- Service: 
- News: 
- Contact CTA: 
- フッター: 

### その他ページ
- Aboutページ: 
- Serviceページ: 
- Newsページ: 
- Contactページ: 
```

### ⛔ 重要：全体を一気に渡さない！

```
❌ NG: 「このFigmaファイル全体を見てコーディングして」
❌ NG: 「このページ全体を読み込んで」

✅ OK: 「このスタイルガイド（Node ID: xxx）から変数を抽出して」
✅ OK: 「このヘッダーセクション（Node ID: yyy）を実装して」
```

---

## 💻 STEP 3: 開発環境の起動（自分でやる）

### 3-1. 依存関係のインストール

```bash
# プロジェクトフォルダで実行
npm install
```

### 3-2. Docker環境の起動

```bash
# WordPress環境を起動
docker-compose up -d

# ブラウザでアクセス
# → http://localhost:8080
```

### 3-3. WordPress初期設定

1. `http://localhost:8080` にアクセス
2. WordPress初期設定を完了
3. 「外観」→「テーマ」→ 自分のテーマを有効化
4. パーマリンク設定（「設定」→「パーマリンク」→「投稿名」を選択 → 保存）

### 3-4. SCSS監視モードの起動

```bash
# 別のターミナルで実行
npm run watch:css
```

これで `assets/scss/` のファイルを編集すると、自動で `assets/css/style.css` が生成されます。

---

## 🎨 STEP 4: スタイルガイドからSCSS変数生成（AI支援）

### 自分でやること

1. Figmaでスタイルガイド（Typography, Colors）のNode IDを取得
2. Cursorで以下のプロンプトを実行

### Cursorに依頼するプロンプト

```markdown
@Figma
ツール `get_figma_data` を使用して、Node ID: [スタイルガイドのID] のデータを取得してください。

このデータから以下を抽出し、`wp-theme/assets/scss/_variables.scss` を更新してください：

**抽出項目:**
- カラーパレット（$color-primary, $color-secondary, $color-text 等）
- フォントファミリー
- フォントサイズ（$font-size-base, $font-size-lg 等）
- 基本スペーシング（$spacing-sm, $spacing-md 等）

**命名規則:**
- 色: $color-{用途}
- フォント: $font-{プロパティ}-{サイズ}
- 余白: $spacing-{サイズ}

出力はコードのみでお願いします。
```

### 確認すること

- [ ] `_variables.scss` が更新されたか
- [ ] 変数名が命名規則に従っているか
- [ ] Figmaのデザインと値が合っているか

---

## 🔨 STEP 5: 全セクションHTML化（AI支援）

### 実装順序（推奨）

1. **ヘッダー** → 全ページで使うから最初に
2. **フッター** → 同上
3. **メインビジュアル（ヒーロー）** → 目立つ部分
4. **各セクション** → 上から順に
5. **下層ページ** → 共通部分ができてから

### 2段階アプローチ（HTML → PHP）

**ポイント:** 全セクションをHTML化してから、まとめてPHP化します。

```
【Phase 2】全セクションHTML化
  ├─ ヘッダー: MCP → SCSS → HTML
  ├─ ヒーロー: MCP → SCSS → HTML
  ├─ About:   MCP → SCSS → HTML
  ├─ ...
  └─ フッター: MCP → SCSS → HTML
  
  → ブラウザで全体確認・調整

【Phase 3】全セクションPHP化（まとめて）
  ├─ ヘッダー → PHP
  ├─ ヒーロー → PHP
  └─ ...
```

### メリット

- 同じ作業に集中できる（HTML作成 → PHP変換）
- 全体の統一感を確認しやすい
- クライアントにHTMLで確認してもらえる

---

### 各セクションで繰り返すステップ（Step 0〜3）

以下を **各セクションごとに** 繰り返します。

#### Step 0: 品質チェック & データ保存

```markdown
@Figma
Node ID: [NODE_ID] のデータを取得して、
figma-data/[セクション名].json に保存してください。

保存後、以下を報告してください：
1. Figmaの品質評価（良い/悪い）
2. 推奨アプローチ

※コード生成はまだしないでください。
```

AIが「良いFigma」「悪いFigma」を判断して報告します。

#### Step 1: データ整理

**良いFigmaの場合:**
```markdown
figma-data/[セクション名].json を読み込んで、
figma-data/[セクション名].md に整理してください。
```

**悪いFigmaの場合:**
```markdown
figma-data/[セクション名].json から数値だけ抽出して、
figma-data/[セクション名]-values.md に保存してください。

※画像は figma-data/images/ に手動で保存してください。
```

#### Step 2: SCSS作成

```markdown
[セクション名] のSCSSを作成してください。

ファイル: wp-theme/assets/scss/sections/_[セクション名].scss

要件:
- _variables.scss の変数を使用
- BEM記法
- レスポンシブ対応

作成後、npm run build:css でビルドしてください。
```

#### Step 3: HTML作成

```markdown
[セクション名] のHTMLを作成してください。

ファイル: static-preview/sections/[セクション名].html

要件:
- BEM記法のクラス名
- ../css/style.css を読み込み
- 画像はプレースホルダー使用
```

→ ブラウザで `static-preview/sections/[セクション名].html` を開いて確認

---

### 🔁 全セクション完了後：全体確認

```markdown
static-preview/index.html に全セクションを組み込んで、
ブラウザで全体を確認してください。

チェック項目:
- [ ] 全体の統一感（色、フォント、余白）
- [ ] セクション間のつながり
- [ ] レスポンシブ（SP/PC）
```

---

## 🔧 STEP 6: 全セクションPHP化（AI支援）

**全セクションのHTMLが完成したら**、まとめてPHP化します。

### 各セクションのPHP化

```markdown
static-preview/sections/[セクション名].html を
wp-theme/template-parts/section-[セクション名].php に変換してください。

変換内容:
- 画像パス → get_template_directory_uri()
- 必要に応じてWordPress関数を使用
```

### 一括PHP化（複数セクション）

```markdown
以下のHTMLファイルをすべてPHPに変換してください：

- static-preview/sections/hero.html → wp-theme/template-parts/section-hero.php
- static-preview/sections/about.html → wp-theme/template-parts/section-about.php
- static-preview/sections/service.html → wp-theme/template-parts/section-service.php
- ...

変換内容:
- 画像パス → get_template_directory_uri()
- 必要に応じてWordPress関数を使用
```

---

### 確認すること

- [ ] `figma-data/[name].json` が保存されたか
- [ ] SCSSファイルが生成されたか
- [ ] `style.scss` に `@use` で読み込みが追加されたか
- [ ] HTMLがブラウザで正しく表示されるか
- [ ] SP/タブレット/PCで確認したか
- [ ] PHPファイルが生成されたか
- [ ] WordPressで表示が崩れていないか

### 画像について

**MCPは画像をダウンロードできません。** 以下のいずれかで対応：

1. **プレースホルダーを使う**（開発中）
   ```html
   <img src="https://placehold.co/800x600" alt="">
   ```

2. **Figmaから手動で書き出し**（最終的には必要）
   - Figmaで画像を選択
   - 右パネル「Export」から書き出し
   - `wp-theme/assets/images/` に配置

3. **悪いFigmaの場合**（レイアウト参考用）
   - セクションのスクリーンショットを撮る
   - `figma-data/images/[セクション名].png` に保存

---

## 🔄 STEP 6: 動的化・ACF設定（AI支援）

### ACF（Advanced Custom Fields）とは

WordPressの管理画面から、テキストや画像を簡単に変更できるようにするプラグインです。

### 自分でやること

1. WordPressにACFプラグインをインストール・有効化
2. 動的に変更したい箇所を洗い出す
3. Cursorに依頼してフィールド設計・PHP修正

### Cursorに依頼するプロンプト

```markdown
この [セクション名] セクションを動的化したいです。

動的に変更すべき箇所を特定し、以下を出力してください：
1. ACFフィールドグループ設計（フィールド名、タイプ、用途）
2. PHPでの出力コード（get_field使用、エスケープ処理込み）

**要件:**
- フィールド名は英語スネークケース（hero_title, about_description 等）
- 出力時は必ず esc_html(), esc_url(), esc_attr() を使用
- 繰り返し要素は have_rows() を使用
```

### 確認すること

- [ ] ACFのフィールドグループを作成したか
- [ ] PHPにget_field()が追加されたか
- [ ] 管理画面から入力できるか
- [ ] フロントに反映されるか

---

## ✅ STEP 7: 確認・修正・納品（自分でやる）

### 最終確認チェックリスト

#### 表示確認
- [ ] 全ページがエラーなく表示されるか
- [ ] Figmaデザインと見比べて大きなズレがないか
- [ ] リンク先は正しいか

#### レスポンシブ確認
- [ ] SP（375px）で崩れていないか
- [ ] タブレット（768px）で崩れていないか
- [ ] PC（1280px以上）で崩れていないか

#### 機能確認
- [ ] ナビゲーションは動作するか
- [ ] スライダーは動作するか
- [ ] フォームは送信できるか
- [ ] ACFから入力した内容が反映されるか

#### コード品質
- [ ] console.log / var_dump は削除したか
- [ ] 不要なコメントアウトは削除したか
- [ ] SCSSをビルドしたか（`npm run build:css`）

#### ブラウザテスト
- [ ] Chrome（Windows/Mac）
- [ ] Safari（Mac）
- [ ] Edge
- [ ] iOS Safari
- [ ] Android Chrome

---

## 🛠️ よく使うコマンドまとめ

```bash
# 開発環境起動
docker-compose up -d

# 開発環境停止
docker-compose down

# SCSS監視（開発中）
npm run watch:css

# SCSSビルド（納品前）
npm run build:css

# Git: 変更をコミット
git add .
git commit -m "✨ feat: ヘッダーセクションを実装"

# Git: リモートにプッシュ
git push origin main
```

---

## 🆘 困ったときは

### よくある問題と解決方法

| 問題 | 解決方法 |
|------|----------|
| CSSが反映されない | `npm run watch:css` が動いているか確認。ブラウザのキャッシュをクリア |
| PHPエラーが出る | `wp-config.php` で `WP_DEBUG` を `true` にしてエラー内容を確認 |
| テーマが表示されない | `style.css` のテーマヘッダーが正しいか確認 |
| 画像が表示されない | パスが正しいか確認。`get_template_directory_uri()` を使う |
| ACFが動かない | プラグインがインストール・有効化されているか確認 |

### Cursorに質問するときのコツ

```markdown
✅ 良い質問
「wp-theme/header.php でナビゲーションが表示されません。
 エラーメッセージは〇〇です。コードを確認して修正してください。」

❌ 悪い質問
「動きません」
「なんかエラー出てます」
```

---

## 📦 STEP 8: 納品（自分でやる）

### 納品に含めるもの / 含めないもの

| フォルダ・ファイル | 納品に含める？ | 理由 |
|-------------------|---------------|------|
| `wp-theme/` | ✅ 含める | WordPressテーマ本体 |
| `.cursor/` | ❌ 含めない | 開発ツールの設定 |
| `.git/` | ❌ 含めない | バージョン管理履歴 |
| `node_modules/` | ❌ 含めない | 開発用パッケージ |
| `docs/` | ❌ 含めない | 自分用ドキュメント |
| `docker-compose.yml` | ❌ 含めない | ローカル開発環境用 |
| `package.json` | ❌ 含めない | npm設定 |
| `README.md` | ❌ 含めない | 自分用 |

### 納品前の最終準備

```bash
# 1. SCSSを本番用にビルド（圧縮）
npm run build:css

# 2. 不要ファイルの確認
#    - console.log が残っていないか
#    - var_dump が残っていないか
#    - コメントアウトしたコードが残っていないか
```

### 納品用ZIPの作成

#### 方法1: スクリプトを使う（推奨）

プロジェクトルートに `create-delivery.sh` があります。

```bash
# 実行権限を付与（初回のみ）
chmod +x create-delivery.sh

# 納品用ZIPを作成
./create-delivery.sh
```

実行すると `delivery/案件名_theme_YYYYMMDD.zip` が作成されます。

#### 方法2: 手動でZIP作成

```bash
# wp-themeフォルダだけをZIP化
zip -r テーマ名_theme.zip wp-theme -x "*.DS_Store" -x "*__MACOSX*" -x "*.scss" -x "*node_modules*"
```

### 納品物の確認

ZIPを作成したら、中身を確認しましょう：

- [ ] `wp-theme/` フォルダが含まれているか
- [ ] `.cursor/` が含まれていないか
- [ ] `node_modules/` が含まれていないか
- [ ] `.git/` が含まれていないか
- [ ] SCSSソースファイルが含まれていないか（必要に応じて）

### 納品方法

1. **ギガファイル便**で共有
   - https://gigafile.nu/
   - ZIPファイルをアップロード
   - ダウンロードURLをクライアントに送付

2. **その他の方法**
   - Google Drive
   - Dropbox
   - 直接サーバーにアップロード

### 納品時の連絡テンプレート

```
お疲れ様です。○○です。

WordPressテーマの納品ファイルをお送りします。

■ ダウンロードURL
[ギガファイル便のURL]

■ ファイル内容
- wp-theme/ : WordPressテーマ一式

■ 設置方法
1. ZIPを解凍
2. wp-theme フォルダを wp-content/themes/ にアップロード
3. WordPress管理画面「外観」→「テーマ」から有効化

■ 必要なプラグイン
- Advanced Custom Fields（ACF）

ご確認よろしくお願いいたします。
```

---

## 📚 参考資料

- [WordPress テーマ開発ハンドブック](https://developer.wordpress.org/themes/)
- [ACF ドキュメント](https://www.advancedcustomfields.com/resources/)
- [Swiper.js ドキュメント](https://swiperjs.com/get-started)
- [BEM命名規則](https://getbem.com/)

---

## 📝 このドキュメントの更新

案件を進める中で気づいたことがあれば、このガイドを更新していきましょう。
経験を蓄積することで、次の案件がもっとスムーズになります。
