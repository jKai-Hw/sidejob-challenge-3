# Figma WordPress Project

FigmaデザインをMCPで取り込み、WordPressブロックテーマとして構築するプロジェクトです。

## 🚀 セットアップ

### 必要なもの

- Docker Desktop
- Node.js (16以上)
- Cursor IDE
- Figma Personal Access Token
- GitHub Personal Access Token

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

### WordPress環境の起動

```bash
# Docker Composeで起動
docker-compose up -d

# WordPressにアクセス
open http://localhost:8080
```

### テーマの有効化

1. WordPress管理画面 (`http://localhost:8080/wp-admin`) にアクセス
2. 外観 → テーマ から「Figma WordPress Theme」を有効化

## 📁 ディレクトリ構造

```
figma-wordpress-project/
├── .cursor/
│   └── rules/              # Cursor Rules
├── wp-theme/               # WordPressテーマ
│   ├── parts/              # テンプレートパーツ
│   ├── patterns/           # ブロックパターン
│   ├── templates/          # ページテンプレート
│   ├── assets/             # CSS/JS/画像
│   ├── functions.php
│   ├── style.css
│   └── theme.json
├── docker-compose.yml
└── README.md
```

## 🎨 Figmaデザインの実装方法

1. FigmaでデザインのURLを取得（フレームを選択 → 右クリック → 選択範囲へのリンクをコピー）
2. Cursorのチャットで以下のように指示：

```
このFigmaデザインをWordPressブロックテーマとして実装してください：
https://www.figma.com/file/xxxxx/...
```

## 🔧 開発コマンド

```bash
# WordPress起動
docker-compose up -d

# WordPress停止
docker-compose down

# ログ確認
docker-compose logs -f wordpress

# WordPressコンテナに入る
docker-compose exec wordpress bash
```

## 📝 Cursor Rules

`.cursor/rules/` ディレクトリに以下のルールファイルがあります：

- `general.mdc` - プロジェクト全般のルール
- `wordpress-theme.mdc` - WordPressテーマ開発ルール
- `figma-integration.mdc` - Figma MCP連携ルール

## 🌐 デプロイ

本番環境へのデプロイ時は、`wp-theme/` ディレクトリをWordPressの `wp-content/themes/` にアップロードしてください。

## 📄 ライセンス

GPL v2 or later

