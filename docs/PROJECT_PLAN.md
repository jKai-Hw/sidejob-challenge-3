# Figma → WordPress プロジェクト計画メモ

> 最終更新: 2024年11月29日
> ステータス: 計画段階（ルール作成中）

---

## 📌 プロジェクト概要

### 目的
- Figma MCPを活用して、FigmaデザインをWordPressブロックテーマとして効率的に構築する
- 仕事を始めるにあたって、しっかりしたルール・型を最初に作る

### 役割分担
- **デザイナーさん**: Figmaでデザイン作成
- **自分**: コーディング（WordPress実装）
- **AI（Cursor）**: コーディング支援、SCSS/jQueryの実装

### 技術スタック
- WordPress（ブロックテーマ / FSE）
- **SCSS**（CSSプリプロセッサ）
- **jQuery**（JavaScript）
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
│   │   └── style.scss           # メインファイル（import）
│   ├── css/
│   │   └── style.css            # コンパイル後のCSS
│   ├── js/
│   │   └── main.js              # カスタムJS（jQuery使用）
│   └── images/
├── parts/                       # テンプレートパーツ
├── patterns/                    # ブロックパターン
├── templates/                   # ページテンプレート
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
| JavaScript | jQuery OK |
| 開発環境 | Docker（ローカル） |
| SCSSコンパイル | AI（Cursor）が実行 |
| jQueryの読み込み | AIにお任せ（WordPress同梱推奨） |
| Figmaの渡し方 | ハイブリッド（全体→セクション） |

---

## 📝 次回やること（TODO）

### ルール作成（未完了）
以下のルールを詳細に詰める必要あり：

- [ ] **1. ワークフロー詳細** - 案件の進め方、フェーズ分け
- [ ] **2. Figma連携ルール** - デザインの受け取り方、確認ポイント
- [ ] **3. WordPress開発ルール** - テーマ構造、ファイル命名規則
- [ ] **4. SCSS設計ルール** - ディレクトリ構成、命名規則、変数管理
- [ ] **5. JavaScript/jQueryルール** - 書き方、ファイル構成
- [ ] **6. コーディング規約** - インデント、命名、コメントなど
- [ ] **7. レスポンシブ対応ルール** - ブレークポイント、アプローチ
- [ ] **8. 品質チェックリスト** - 納品前の確認リスト
- [ ] **9. Git運用ルール** - コミット、ブランチルール

### 確認したい質問（次回回答）
1. 対象案件のイメージ（コーポレート？LP？EC？規模感は？）
2. こだわりポイント（大事にしたいこと）
3. 苦手・避けたいこと
4. 既存の経験で継続したいルール

---

## 🔧 セットアップ状況

### 完了
- [x] GitHubリポジトリ作成: https://github.com/jKai-Hw/figma-wordpress-project
- [x] プロジェクト基本構造作成
- [x] Cursor Rules（基本版）作成
- [x] Docker Compose設定ファイル作成

### 未完了
- [ ] Figma MCP設定（APIトークン取得後）
- [ ] ビルド環境設定（package.json など）
- [ ] SCSS基本ファイル作成

---

## 📚 参考リンク

- [Figma MCPサーバーガイド](https://help.figma.com/hc/ja/articles/32132100833559)
- [WordPress ブロックテーマ開発](https://developer.wordpress.org/block-editor/)
- [Cursor Rules ドキュメント](https://learn-cursor.com/ja/rules)

---

## 💬 メモ・備考

- Figma APIトークンは後で設定する
- Docker環境は計画段階では起動しない（実装フェーズで起動）
- デザイナーさんが作ったFigmaを変更しない（参照のみ）

