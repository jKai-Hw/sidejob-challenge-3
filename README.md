# Figma → WordPress テンプレート

> Figma → WordPress のコーディング案件を効率的に進めるためのテンプレート

## 🚀 クイックスタート

**新しい案件を始める場合 →** [docs/QUICK_START.md](docs/QUICK_START.md)

```bash
# 1. リポジトリをコピー
git clone https://github.com/your-username/figma-wordpress-project.git 案件名-project
cd 案件名-project
rm -rf .git && git init

# 2. セットアップ
npm install
docker-compose up -d
npm run watch:css

# 3. アクセス
open http://localhost:8080
```

## 📁 構成

```
├── .cursor/rules/     # AI協業ルール
├── docs/              # ドキュメント
├── figma-data/        # MCPデータ保存
├── static-preview/    # HTMLプレビュー
└── wp-theme/          # WordPressテーマ【納品対象】
```

## 📚 ドキュメント

| ファイル | 内容 |
|----------|------|
| [docs/QUICK_START.md](docs/QUICK_START.md) | 新規案件スタートガイド |
| [docs/PROMPTS.md](docs/PROMPTS.md) | プロンプト集 |
| [docs/CHECKLISTS.md](docs/CHECKLISTS.md) | 品質チェック・Git運用 |
| [docs/PROJECT_PLAN.md](docs/PROJECT_PLAN.md) | プロジェクト計画テンプレート |

## 🔧 コマンド

```bash
npm run watch:css    # SCSS監視
npm run build:css    # SCSSビルド
npm run lint:scss    # SCSSリント
npm run lint:js      # JSリント
npm run format       # コード整形
```

## 📦 技術スタック

- WordPress（クラシックテーマ）
- SCSS → CSS
- jQuery
- Docker
- Figma MCP

---

**ライセンス:** GPL v2 or later
