# Figma → WordPress プロジェクト計画メモ

> 最終更新: 2024年11月30日
> ステータス: ルール作成完了 ✅

---

## 📌 プロジェクト概要

### 目的
- **ルール・ワークフロー・テンプレートを作成するためのプロジェクト**
- Figma MCPを活用して、FigmaデザインをWordPressブロックテーマとして効率的に構築する型を作る
- 実際の案件プロジェクトではない

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
- **AI（Cursor）**: コーディング支援、SCSS/jQueryの実装、コンパイル実行

### 技術スタック
- WordPress（ブロックテーマ / FSE）
- **SCSS**（CSSプリプロセッサ）
- **jQuery**（JavaScript）
- **ACF**（Advanced Custom Fields）
- **Swiper.js**（スライダー）
- Docker（ローカル開発環境）
- Git / GitHub

---

## 🔄 ワークフロー（決定済み）

```
Phase 0: デザイン受け取り
├── デザイナーさんからFigmaのURLを受け取る
├── デザインの意図・注意点があれば確認
└── 不明点があればデザイナーさんに質問

Phase 1: 全体構造の把握（ページ全体をMCPで取得）
├── Figma MCP でページ全体の情報を取得
├── セクション構成をリストアップ
├── デザイントークン抽出（カラー、フォント、余白）
└── 共通コンポーネントの洗い出し

Phase 2: ベース構築
├── SCSS変数ファイル作成（_variables.scss）
├── theme.json にWordPress用設定
├── 共通コンポーネントのSCSS作成
└── ビルド環境セットアップ（npm）

Phase 3: セクション実装（1つずつ）
├── セクションのFigma URLを渡す
├── HTMLマークアップ作成（patterns/）
├── SCSS でスタイリング
├── jQuery でインタラクション（必要なら）
├── レスポンシブ確認
└── → 次のセクションへ

Phase 4: テンプレート組み立て & 確認
├── セクションを組み合わせてテンプレート作成
├── 全体通しで確認
├── デザイナーさんに確認依頼
└── フィードバック反映
```

---

## 📁 ディレクトリ構造（決定済み）

```
wp-theme/
├── assets/
│   ├── scss/
│   │   ├── _variables.scss      # カラー、フォント、スペーシング変数
│   │   ├── _mixins.scss         # ミックスイン（メディアクエリ等）
│   │   ├── _reset.scss          # リセットCSS
│   │   ├── _base.scss           # ベーススタイル
│   │   ├── _typography.scss     # タイポグラフィ
│   │   ├── components/          # 共通コンポーネント
│   │   │   ├── _button.scss
│   │   │   ├── _card.scss
│   │   │   └── _navigation.scss
│   │   ├── sections/            # セクション別スタイル
│   │   │   ├── _header.scss
│   │   │   ├── _footer.scss
│   │   │   └── _hero.scss
│   │   └── style.scss           # メインファイル（@use で読み込み）
│   ├── css/
│   │   └── style.css            # コンパイル後のCSS（Git管理）
│   ├── js/
│   │   ├── main.js              # カスタムJS（jQuery使用）
│   │   ├── slider.js            # スライダー初期化
│   │   └── filter.js            # 絞り込み検索
│   └── images/
├── inc/                         # PHP機能ファイル
│   ├── custom-post-types.php    # カスタム投稿タイプ登録
│   ├── custom-taxonomies.php    # カスタムタクソノミー登録
│   └── acf-fields.php           # ACF設定（任意）
├── parts/                       # テンプレートパーツ
├── patterns/                    # ブロックパターン
├── templates/                   # ページテンプレート
│   ├── front-page.html
│   ├── page-about.html
│   ├── page-contact.html
│   ├── archive-service.html
│   ├── single-service.html
│   ├── archive-news.html
│   └── single-news.html
├── functions.php
├── style.css
└── theme.json
```

---

## 🎨 Figmaデータの渡し方（決定済み）

### ハイブリッドアプローチ
1. **最初にページ全体を渡す**（構造把握用）
   - 全体構造を把握
   - デザイントークン抽出
   - セクションリスト作成

2. **実装はセクションごと**（精度重視）
   - 1つずつ確認しながら進める
   - 品質を保つ

---

## ✅ 決定事項

| 項目 | 決定内容 |
|------|----------|
| CSS | SCSS を使用 |
| JavaScript | jQuery OK（WordPress同梱版を使用） |
| 開発環境 | Docker（ローカル） |
| SCSSコンパイル | AI（Cursor）が実行 |
| Figmaの渡し方 | ハイブリッド（全体→セクション） |
| スライダー | Swiper.js |
| フォーム | Contact Form 7 または MW WP Form |

---

## 📋 Cursor Rules 一覧

### 作成済みルールファイル（.cursor/rules/）

| ファイル名 | 説明 | 適用範囲 |
|-----------|------|---------|
| `general.mdc` | プロジェクト全般のルール | 全ファイル |
| `wordpress-theme.mdc` | WordPressブロックテーマ開発ルール | wp-theme/ |
| `figma-integration.mdc` | Figma MCP連携ルール | 全ファイル |
| `coding-standards.mdc` | コーディング規約（命名、インデント、コメント） | .php, .scss, .js, .html |
| `responsive-design.mdc` | レスポンシブデザイン実装ルール | .scss, .css, .html |
| `wordpress-advanced.mdc` | CPT、ACF、動的要素の実装ルール | wp-theme/ |
| `quality-checklist.mdc` | 品質チェックリスト（納品前確認） | 全ファイル |
| `git-workflow.mdc` | Git運用ルール（ブランチ、コミット） | 全ファイル |

### ルールの主な内容

#### コーディング規約
- インデント: スペース2つ
- 命名: BEM記法（CSS）、snake_case（PHP）、camelCase（JS）
- コメント: 日本語OK、JSDoc/PHPDocスタイル

#### レスポンシブ
- モバイルファースト
- ブレークポイント: sm(640px), md(768px), lg(1024px), xl(1280px)
- Mixinで管理: `@include sp`, `@include tablet-up`, `@include pc`

#### Git運用
- ブランチ: feature/xxx, fix/xxx, hotfix/xxx
- コミット: 絵文字 + 種類 + 内容（例: `✨ feat: ヒーロー実装`）
- 日本語コミットメッセージOK

---

## 🔧 セットアップ状況

### 完了 ✅
- [x] GitHubリポジトリ作成: https://github.com/jKai-Hw/figma-wordpress-project
- [x] プロジェクト基本構造作成
- [x] Cursor Rules作成（8ファイル）
  - [x] general.mdc
  - [x] wordpress-theme.mdc
  - [x] figma-integration.mdc
  - [x] coding-standards.mdc（NEW）
  - [x] responsive-design.mdc（NEW）
  - [x] wordpress-advanced.mdc（NEW）
  - [x] quality-checklist.mdc（NEW）
  - [x] git-workflow.mdc（NEW）
- [x] Docker Compose設定ファイル作成
- [x] SCSS基本ファイル作成（_variables, _mixins, style.scss）
- [x] package.json作成（SCSSビルド用）
- [x] main.js作成（jQueryテンプレート）

### 未完了
- [ ] Figma MCP設定（APIトークン取得後）
- [ ] npm install（実際の開発開始時）
- [x] inc/フォルダ作成（CPT, タクソノミー登録ファイル）

---

## 🛠️ 開発コマンド

```bash
# 依存関係インストール
npm install

# SCSSコンパイル（本番用・圧縮）
npm run build:css

# SCSS監視モード（開発用）
npm run watch:css

# Docker起動
docker-compose up -d

# Docker停止
docker-compose down
```

---

## 📚 参考リンク

- [Figma MCPサーバーガイド](https://help.figma.com/hc/ja/articles/32132100833559)
- [WordPress ブロックテーマ開発](https://developer.wordpress.org/block-editor/)
- [Cursor Rules ドキュメント](https://learn-cursor.com/ja/rules)
- [ACF ドキュメント](https://www.advancedcustomfields.com/resources/)
- [Swiper.js ドキュメント](https://swiperjs.com/get-started)

---

## 💬 メモ・備考

- Figma APIトークンは後で設定する
- Docker環境は計画段階では起動しない（実装フェーズで起動）
- デザイナーさんが作ったFigmaを変更しない（参照のみ）
- このプロジェクトは「型」を作るためのもの。実際の案件ではこれをベースにする

---

## 📝 次回やること

### 優先度高
1. Figma MCP設定（APIトークン取得）
2. テストデザインでワークフロー検証
3. inc/フォルダのPHPファイル作成（CPT, タクソノミー）

### 必要に応じて
- 実際のデザインを使った実装練習
- ルールの微調整・追加
