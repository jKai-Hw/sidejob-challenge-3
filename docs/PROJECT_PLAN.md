# Figma → WordPress プロジェクト計画メモ

> 最終更新: 2024年11月30日
> ステータス: **クラシックテーマへの移行待ち** 🔄

---

## 🚨 次回やること（引き継ぎ）

### 決定事項（変更）
1. **テーマタイプ**: ブロックテーマ → **クラシックテーマに変更**
2. **SCSSコンパイル**: Cursor実行 → **npm（watch/build）で自動実行に変更**

### 次回の作業内容
1. **ルールファイルの修正**
   - `wordpress-theme.mdc` をクラシックテーマ用に書き換え
   - `figma-integration.mdc` のテンプレート記述を `.php` に修正

2. **ディレクトリ構造の変更**
   - `templates/*.html` → ルート直下の `*.php`（front-page.php, single-service.php 等）
   - `parts/*.html` → `header.php`, `footer.php`, `template-parts/*.php`
   - `patterns/` → 削除（クラシックテーマでは不要）

3. **PROJECT_PLAN.md の更新**
   - ディレクトリ構造をクラシックテーマ用に修正
   - 決定事項テーブルを更新

4. **wp-theme/内のファイル修正**
   - 既存の `.html` ファイルを `.php` に変換
   - functions.php を調整

---

## 📌 プロジェクト概要

### 目的
- **ルール・ワークフロー・テンプレートを作成するためのプロジェクト**
- Figma MCPを活用して、FigmaデザインをWordPressテーマとして効率的に構築する型を作る
- 実際の案件プロジェクトではない
- **外注やクライアントに回しやすい形を目指す**

### 対象サイト想定
| 項目 | 内容 |
|------|------|
| サイト規模 | 企業サイト 5〜10ページ |
| ページ構成 | TOP, About, Service一覧/詳細, News一覧/詳細, Contact |
| 拡張機能 | カスタム投稿タイプ（CPT）、ACF（Advanced Custom Fields） |
| 動的要素 | スライダー、絞り込み検索、お問い合わせフォーム |

### 役割分担
- **デザイナーさん**: Figmaでデザイン作成（別の方）
- **自分**: コーディング（WordPress実装）
- **AI（Cursor）**: コーディング支援、SCSS/jQueryの実装

### 技術スタック
- WordPress（**クラシックテーマ**）← 変更
- **SCSS**（CSSプリプロセッサ）→ **npm で自動コンパイル**
- **jQuery**（JavaScript）
- **ACF**（Advanced Custom Fields）
- **Swiper.js**（スライダー）
- Docker（ローカル開発環境）
- Git / GitHub

---

## 🔄 ワークフロー

```
⚠️ 重要: Figmaのページ全体・ファイル全体を一気に渡すのは絶対NG
   → トークン爆発、精度低下、コスト無駄の原因になる

Phase 0: デザイン受け取り
├── デザイナーさんからFigmaのURLを受け取る
├── デザインの意図・注意点があれば確認
├── 各セクションのNode IDを控えておく
└── 不明点があればデザイナーさんに質問

Phase 1: スタイルガイド読み込み（Node ID指定・1回だけ）
├── Figma MCP でスタイルガイドのNode IDだけを取得
├── デザイントークン抽出（カラー、フォント、余白）
├── _variables.scss を生成
└── ※ページ全体は絶対に渡さない

Phase 2: 構造把握 & ベース構築
├── ページ構成のみ確認（詳細データは取得しない）
├── セクションリストをメモに記録
├── npm install → npm run watch:css 起動
└── 共通コンポーネントのSCSS作成

Phase 3: セクション実装（Node ID指定・1つずつ）
├── セクションのNode IDを指定して取得
├── PHPテンプレート作成
├── SCSS でスタイリング（変数を使用）
├── jQuery でインタラクション（必要なら）
├── 画像は手動書き出し or プレースホルダー
├── レスポンシブ確認
└── → 次のセクションへ

Phase 4: 動的化 & テンプレート組み立て
├── ACFフィールド設計・実装
├── 全体通しで確認
├── デザイナーさんに確認依頼
└── フィードバック反映
```

---

## 📁 ディレクトリ構造（クラシックテーマ版・変更予定）

```
wp-theme/
├── assets/
│   ├── scss/
│   │   ├── _variables.scss
│   │   ├── _mixins.scss
│   │   ├── _reset.scss
│   │   ├── _base.scss
│   │   ├── _typography.scss
│   │   ├── components/
│   │   │   ├── _button.scss
│   │   │   ├── _card.scss
│   │   │   └── _navigation.scss
│   │   ├── sections/
│   │   │   ├── _header.scss
│   │   │   ├── _footer.scss
│   │   │   └── _hero.scss
│   │   └── style.scss
│   ├── css/
│   │   └── style.css          # npm run build:css で生成
│   ├── js/
│   │   ├── main.js
│   │   ├── slider.js
│   │   └── filter.js
│   └── images/
├── inc/
│   ├── custom-post-types.php
│   ├── custom-taxonomies.php
│   └── acf-fields.php
├── template-parts/            # 再利用パーツ
│   ├── card-service.php
│   ├── card-news.php
│   └── section-cta.php
├── header.php                 # ヘッダー
├── footer.php                 # フッター
├── front-page.php             # トップページ
├── page.php                   # 汎用固定ページ
├── page-about.php             # 会社概要
├── page-contact.php           # お問い合わせ
├── archive-service.php        # サービス一覧
├── single-service.php         # サービス詳細
├── archive.php                # 汎用アーカイブ（ニュース等）
├── single.php                 # 汎用投稿詳細
├── 404.php                    # 404エラー
├── index.php                  # フォールバック
├── functions.php
├── style.css                  # テーマ情報
└── screenshot.png             # テーマサムネイル
```

---

## 🎨 Figmaデータの渡し方

### ⛔ 絶対NG
- ファイル全体を一気に渡す
- ページ全体を一気に渡す

### ✅ 2段階アプローチ（推奨）

**【フェーズ1】脳を作る = スタイルガイドだけを渡す（最初に1回）**
- スタイルガイド/Typography/ColorsのNode IDを指定
- `_variables.scss` を生成

**【フェーズ2】手を作る = セクションごとに渡す（都度）**
- 各セクションのNode IDを指定
- 変数を使ってコーディング

### Node IDの取得方法
```
FigmaのURL: https://www.figma.com/design/xxxxx/FileName?node-id=123-456
                                                        ↑ これがNode ID
```

---

## ✅ 決定事項

| 項目 | 決定内容 |
|------|----------|
| テーマタイプ | **クラシックテーマ**（.php） |
| CSS | SCSS を使用 |
| CSS設計 | BEM記法（.block__element--modifier） |
| SCSSコンパイル | **npm（watch/build）で自動実行** |
| JavaScript | jQuery OK（WordPress同梱版を使用） |
| 開発環境 | Docker（ローカル） |
| Figmaの渡し方 | 2段階アプローチ（スタイルガイド→セクション） |
| スライダー | Swiper.js |
| フォーム | Contact Form 7 または MW WP Form |

---

## 📋 Cursor Rules 一覧

### 作成済みルールファイル（.cursor/rules/）

| ファイル名 | 説明 | 状態 |
|-----------|------|------|
| `general.mdc` | プロジェクト全般のルール | ✅ OK |
| `wordpress-theme.mdc` | WordPressテーマ開発ルール | ⚠️ **要修正**（クラシックテーマ用に） |
| `figma-integration.mdc` | Figma MCP連携ルール | ⚠️ **要修正**（.php記述に） |
| `coding-standards.mdc` | コーディング規約 | ✅ OK |
| `responsive-design.mdc` | レスポンシブ実装ルール | ✅ OK |
| `wordpress-advanced.mdc` | CPT、ACF、動的要素 | ✅ OK |
| `quality-checklist.mdc` | 品質チェックリスト | ✅ OK |
| `git-workflow.mdc` | Git運用ルール | ✅ OK |

---

## 🔧 セットアップ状況

### 完了 ✅
- [x] GitHubリポジトリ作成
- [x] Cursor Rules作成（8ファイル）
- [x] Docker Compose設定
- [x] SCSS基本ファイル作成
- [x] package.json作成（SCSSビルド用）
- [x] inc/フォルダ作成（CPT, タクソノミー）

### 未完了 / 次回対応
- [ ] **クラシックテーマへの移行**（ルール・ファイル構造）
- [ ] Figma MCP設定（APIトークン取得後）
- [ ] npm install

---

## 🛠️ 開発コマンド

```bash
# 依存関係インストール
npm install

# SCSS監視モード（開発中はこれを起動）
npm run watch:css

# SCSSコンパイル（本番用・圧縮）
npm run build:css

# Docker起動
docker-compose up -d

# Docker停止
docker-compose down
```

---

## 📚 参考リンク

- [Figma MCPサーバーガイド](https://developers.figma.com/docs/figma-mcp-server)
- [WordPress テーマ開発](https://developer.wordpress.org/themes/)
- [ACF ドキュメント](https://www.advancedcustomfields.com/resources/)
- [Swiper.js ドキュメント](https://swiperjs.com/get-started)

---

## 💬 メモ・備考

- Figma APIトークンは後で設定する
- Docker環境は計画段階では起動しない（実装フェーズで起動）
- デザイナーさんが作ったFigmaを変更しない（参照のみ）
- このプロジェクトは「型」を作るためのもの
- **画像アセットはFigmaから手動書き出し**
- **外注やクライアントに回しやすいクラシックテーマを採用**
