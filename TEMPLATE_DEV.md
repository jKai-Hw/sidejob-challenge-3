# 🛠️ テンプレート開発メモ

> **このファイルについて**
>
> このファイルは**テンプレート開発用**のメモです。
> **developブランチにのみ存在**し、mainにはマージしません。
> 案件でコピーした時には含まれません。

---

## 📋 テンプレートの目的

- Figma → WordPress のコーディング案件を効率化するためのテンプレート
- Cursor（AI）との協業ルールを整備
- 外注やクライアントに回しやすい形を目指す

---

## 📜 開発履歴

### 2024年11月〜12月

| 日付 | 作業内容 |
|------|----------|
| 11月 | 初期構築開始、Cursor Rules作成 |
| 11月 | ブロックテーマ（FSE）で構築開始 |
| 11月 | クラシックテーマに変更（外注しやすさ重視） |
| 11月 | Figma MCP連携ルール追加 |
| 11月 | ワークフロードキュメント整備 |
| 12月 | テンプレート構造の整理（PROGRESS.md, DESIGN_NOTES.md追加） |
| 12月 | developブランチ作成、TEMPLATE_DEV.md追加 |

---

## ✅ 完了した整備

- [x] Cursor Rules 8ファイル作成
  - general.mdc
  - wordpress-theme.mdc
  - figma-integration.mdc
  - coding-standards.mdc
  - responsive-design.mdc
  - wordpress-advanced.mdc
  - quality-checklist.mdc
  - git-workflow.mdc
- [x] クラシックテーマへの移行
- [x] SCSS構造の整備（_variables.scss, _mixins.scss）
- [x] ワークフロードキュメント（QUICK_START.md, PROJECT_PLAN.md）
- [x] Docker Compose設定
- [x] 納品用ZIPスクリプト（create-delivery.sh）
- [x] 進捗管理テンプレート（PROGRESS.md）
- [x] デザインメモテンプレート（DESIGN_NOTES.md）
- [x] Figma MCP接続
- [x] ACF JSON自動同期設定（2024-12）
- [x] ハンバーガーメニューJS実装（2024-12）
- [x] SCSSディレクトリ構造（components/, sections/）（2024-12）
- [x] 基本SCSSファイル作成（2024-12）
  - _base.scss（リセット + 基本スタイル）
  - components/_button.scss
  - components/_card.scss
  - sections/_header.scss
  - sections/_footer.scss
- [x] Cursor最適化（2024-12）
  - general.mdc 更新（AIの役割明確化）
  - SCSSファイルにAI向けコメント追加
  - docs/PROMPTS.md 作成（コピペ用プロンプト集）

---

## 🔄 今後の改善TODO

### 優先度：高

- [ ] 実際の案件で使ってみて、足りないルールを追加
- [ ] 使いにくい部分があれば改善

### 優先度：中

- [ ] SCSS基礎ファイルのサンプルを充実させるか検討
- [ ] ACFフィールドのエクスポート/インポート手順を追加
- [ ] よくある実装パターンのスニペット集を作成

### 優先度：低

- [ ] 複数案件での使用実績を元にベストプラクティスを更新
- [ ] Figma MCPの新機能があれば対応

---

## 🔍 テンプレート改善のための調査項目

> 実案件で使う前・使った後に、「どこを見直すか」を整理するためのメモ。

### 1. ワークフロー / ドキュメント

- [ ] `README.md` / `docs/QUICK_START.md` / `docs/PROJECT_PLAN.md` の役割分担が分かりやすいか
- [ ] 実際の作業フローとドキュメントの順番・粒度がズレていないか
- [ ] Figma MCP の使い方（Node ID取得〜依頼プロンプト）が十分具体的か / 冗長すぎないか
- [ ] 外注さん / 未来の自分が読んだときに「最初に何をすればいいか」がすぐ分かるか

### 2. テーマ構造（PHP / WordPress）

- [ ] `header.php` / `footer.php` / `front-page.php` / `page.php` などの役割が明確か
- [ ] `functions.php` と `inc/` 配下の責務分担（CPT, Taxonomy, ACF など）が整理されているか
- [ ] ループ処理・テンプレート階層・`get_template_part()` の使い方がサンプルとして適切か
- [ ] ACF 前提の書き方が「多すぎないか / 足りなすぎないか」（テンプレートとしてちょうど良いか）

### 3. SCSS設計 / レスポンシブ

- [ ] `_variables.scss` の構成（カラー・タイポグラフィ・スペーシング等）がFigmaのスタイルガイドと対応しやすいか
- [ ] `components/` と `sections/` の分け方・命名が直感的か
- [ ] レスポンシブルール（ブレークポイント・モバイルファースト方針）が `.cursor/rules/responsive-design.mdc` と矛盾していないか
- [ ] BEM記法のサンプルが十分かつ、複雑すぎて真似しづらくなっていないか

### 4. JavaScript / インタラクション

- [ ] `assets/js/main.js` の役割が明確か（ハンバーガーメニュー等の最低限のサンプルとして適切か）
- [ ] jQuery 前提で困るケースがないか、バニラJSにした方がテンプレートとして汎用的か
- [ ] Swiper.js など外部ライブラリを使う場合のサンプルコードや導入手順がどこまで必要か

### 5. Cursor Rules / AI連携

- [ ] `.cursor/rules/*.mdc` の内容と実際のテーマ構造がきちんと対応しているか
- [ ] AI に任せたい範囲・任せたくない範囲（要確認ポイント）が明確に書かれているか
- [ ] Figma MCP 利用ルール（「ファイル全体を渡さない」など）が重複しすぎていないか / 逆に埋もれていないか

### 6. 開発DX / 自動化

- [ ] `package.json` の npm script がシンプルかつ十分か（lint, format など追加した方がよいか）
- [ ] `docker-compose.yml` の設定が他案件でも流用しやすいか（DB名・ボリューム名など）
- [ ] `create-delivery.sh` の挙動が想定どおりか、案件ごとに変更しなくて良い設計になっているか

### 7. テンプレートとしての「空っぽ具合」

- [ ] サンプルのマークアップ / スタイル / CPT が「学習用の例」として役立ちつつ、案件ごとに邪魔になりすぎないか
- [ ] main ブランチに残すべき最低限のサンプルと、develop 専用にしておくべきものの切り分けが適切か
- [ ] 実案件コピー時に「消すべきもの」「残すべきもの」が README やコメントから一目で分かるか

---

## 💡 設計思想・判断メモ

### なぜクラシックテーマ？

- ブロックテーマ（FSE）より外注しやすい
- PHPの知識があれば誰でも編集できる
- ACFとの相性が良い

### なぜSCSS？

- 変数・mixin・ネストで効率的に書ける
- Figmaのデザイントークンと相性が良い
- npmでコンパイルできる（追加ツール不要）

### なぜjQuery？

- WordPress同梱版を使える
- 簡単なインタラクションには十分
- 外注先が理解しやすい

### Figma MCPの運用方針

- **絶対にファイル全体を渡さない**（トークン爆発防止）
- Node ID指定で必要な部分だけ取得
- スタイルガイド → セクションの2段階アプローチ

---

## 🗂️ ブランチ運用

```
main ─────────────────────────────
  │         ↑
  │         │ 整備完了後マージ
  │         │
  └── develop（テンプレート整備用）
            │
            └── このファイル（TEMPLATE_DEV.md）はここだけ
```

### mainブランチ

- コピーしてすぐ使える状態
- 空のテンプレートファイルを含む
- TEMPLATE_DEV.mdは含まない

### developブランチ

- テンプレート整備用
- 開発メモ（このファイル）を含む
- 整備が終わったらmainにマージ

---

## 📝 メモ

<!-- 自由にメモを書く場所 -->

