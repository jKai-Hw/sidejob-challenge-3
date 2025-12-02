# Figma → WordPress テンプレートプロジェクト

> ⚠️ **このプロジェクトについて**
>
> これは**実際の案件プロジェクトではありません**。
>
> Figma → WordPress のコーディング案件を効率的に進めるための**ルール・ワークフロー・テンプレートを作成するためのプロジェクト**です。
>
> 新しい案件では、このプロジェクトをコピーして使用します。

---

## 🚀 新規案件を始める方はこちら

👉 **[新規案件スタートガイド](docs/QUICK_START.md)**

新しい案件が来た時に、何から始めればいいかをステップバイステップで解説しています。

---

## 📦 テンプレートとしての使い方

### 1️⃣ リポジトリをコピー

```bash
# テンプレートリポジトリをクローン
git clone https://github.com/あなたのユーザー名/figma-wordpress-project.git 案件名-project

# 新しいディレクトリに移動
cd 案件名-project

# 既存のGit履歴を削除
rm -rf .git

# 新しいGitリポジトリとして初期化
git init
git add .
git commit -m "🎉 init: 案件名プロジェクト開始"
```

### 2️⃣ 案件固有ファイルを作成

以下のファイルを作成して、案件情報を記録します：

| ファイル | 用途 | テンプレートに戻す時 |
|----------|------|---------------------|
| `PROGRESS.md` | 開発進捗管理 | 🗑️ **削除** |
| `docs/DESIGN_NOTES.md` | Figma抽出情報メモ | 🗑️ **削除** |

これらのファイルには **案件固有の情報** を記録します。  
テンプレートに戻す（別案件で再利用する）際は、これらを削除すればOKです。

### 3️⃣ テーマ情報を変更

`wp-theme/style.css` を編集：

```css
/*
Theme Name: 案件名テーマ
Description: ○○株式会社コーポレートサイト
Version: 1.0.0
*/
```

---

## 📁 ファイル構成

```
figma-wordpress-project/
├── .cursor/
│   └── rules/              # Cursor Rules（AI協業ルール）
├── docs/
│   ├── PROJECT_PLAN.md     # プロジェクト計画（テンプレート）
│   ├── QUICK_START.md      # 新規案件スタートガイド ⭐
│   └── DESIGN_NOTES.md     # デザインメモ（案件固有）🗑️
├── wp-theme/               # WordPressテーマ
│   ├── assets/
│   │   ├── scss/           # SCSSファイル
│   │   ├── css/            # コンパイル後のCSS
│   │   ├── js/             # JavaScript
│   │   └── images/         # 画像
│   ├── inc/                # PHP機能ファイル
│   ├── template-parts/     # 再利用可能なパーツ
│   ├── header.php          # ヘッダー
│   ├── footer.php          # フッター
│   ├── front-page.php      # トップページ
│   ├── functions.php       # テーマ機能
│   └── style.css           # テーマ情報
├── docker-compose.yml
├── package.json
├── PROGRESS.md             # 進捗管理（案件固有）🗑️
└── README.md
```

### 案件固有ファイル（🗑️マーク）

| ファイル | 説明 |
|----------|------|
| `PROGRESS.md` | ページ・セクション別の進捗を管理 |
| `docs/DESIGN_NOTES.md` | Figmaから抽出した色・フォント・Node IDを記録 |

**テンプレートに戻す時は、これらを削除するだけでOKです。**

---

## 🎯 このプロジェクトの目的

1. **ワークフローの確立** - Figma MCPを活用した効率的な開発フローを設計
2. **Cursor Rulesの作成** - AIとの協業ルールを整備
3. **テンプレート作成** - 案件ごとに使い回せる基本構造を準備
4. **ベストプラクティスの蓄積** - 経験を元にルールを改善していく

---

## 🔧 技術スタック

| 項目 | 技術 |
|------|------|
| CMS | WordPress（クラシックテーマ） |
| CSS | SCSS（npm でコンパイル） |
| JavaScript | jQuery（WordPress同梱版） |
| 開発環境 | Docker |
| デザイン連携 | Figma MCP |
| エディタ | Cursor（AI支援） |

---

## 🛠️ セットアップ

### 必要なもの

- Docker Desktop
- Node.js (v16以上)
- Cursor IDE
- Figma Personal Access Token（MCP用）

### MCP設定

Cursorの設定 (`~/.cursor/mcp.json`) に以下を追加：

```json
{
  "mcpServers": {
    "figma": {
      "command": "npx",
      "args": ["-y", "figma-developer-mcp", "--stdio"],
      "env": {
        "FIGMA_API_KEY": "YOUR_FIGMA_API_KEY"
      }
    }
  }
}
```

### 開発環境の起動

```bash
# 依存関係インストール
npm install

# Docker起動
docker-compose up -d

# SCSS監視モード
npm run watch:css

# WordPressにアクセス
open http://localhost:8080
```

---

## 🔄 ワークフロー概要

```
デザイナー: Figmaでデザイン作成
           ↓
自分: Figma URLを受け取る → Node IDをメモ
           ↓
Phase 1: スタイルガイドから変数生成（MCP）
           ↓
Phase 2: セクションごとに実装（MCP）
           ↓
Phase 3: 動的化（ACF連携）
           ↓
Phase 4: 確認・修正・納品
```

詳細は [新規案件スタートガイド](docs/QUICK_START.md) を参照。

---

## 📋 よく使うコマンド

```bash
# 開発環境
docker-compose up -d      # 起動
docker-compose down       # 停止

# SCSS
npm run watch:css         # 監視モード（開発中）
npm run build:css         # ビルド（納品前）

# Git
git add .
git commit -m "✨ feat: 機能追加"
git push origin main
```

---

## 📝 ドキュメント一覧

| ファイル | 内容 |
|----------|------|
| [docs/QUICK_START.md](docs/QUICK_START.md) | **新規案件スタートガイド**（まずこれを読む） |
| [docs/PROJECT_PLAN.md](docs/PROJECT_PLAN.md) | プロジェクト計画、技術決定事項 |
| [docs/DESIGN_NOTES.md](docs/DESIGN_NOTES.md) | デザインメモ（Figma抽出情報） |
| [PROGRESS.md](PROGRESS.md) | 開発進捗管理 |
| `.cursor/rules/*.mdc` | Cursor用のAI協業ルール |

---

## 📄 ライセンス

GPL v2 or later
