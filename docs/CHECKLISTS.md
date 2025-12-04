# チェックリスト・Git運用

> 品質確認とGit運用のためのリファレンス

---

## 📋 品質チェックリスト

### 🎨 デザイン・見た目

#### Figmaデザインとの一致
- [ ] カラーがデザイン通りか
- [ ] フォントファミリー・サイズ・ウェイトが一致しているか
- [ ] 行間（line-height）が一致しているか
- [ ] 余白・マージンがデザイン通りか
- [ ] 角丸・シャドウが一致しているか

#### レスポンシブ対応
- [ ] SP表示（375px〜）で崩れていないか
- [ ] タブレット表示（768px〜）で崩れていないか
- [ ] PC表示（1024px〜）で崩れていないか
- [ ] 横スクロールが発生していないか
- [ ] タップ領域が十分か（最小44x44px）

#### ブラウザ対応
- [ ] Chrome（最新版）
- [ ] Safari（最新版）
- [ ] Firefox（最新版）
- [ ] Edge（最新版）
- [ ] iOS Safari
- [ ] Android Chrome

---

### ⚙️ 機能・動作

#### リンク・ナビゲーション
- [ ] すべてのリンクが正しい遷移先に飛ぶか
- [ ] 外部リンクは新しいタブで開くか（target="_blank" rel="noopener"）
- [ ] 電話リンク（tel:）が動作するか
- [ ] 404ページが正しく表示されるか

#### フォーム
- [ ] 必須項目のバリデーションが動作するか
- [ ] エラーメッセージが適切に表示されるか
- [ ] 送信完了後の動作が正しいか
- [ ] 管理者への通知メールが届くか

#### 動的要素
- [ ] スライダーが正しく動作するか
- [ ] 絞り込み検索が正しくフィルタリングするか
- [ ] モーダル/アコーディオンが正しく動作するか

---

### ♿ アクセシビリティ

- [ ] alt属性がすべての画像に設定されているか
- [ ] 見出しの階層（h1→h2→h3）が正しいか
- [ ] フォーカス状態が視認できるか
- [ ] キーボードのみで操作できるか
- [ ] 色のコントラスト比が十分か（4.5:1以上）

---

### 🔒 セキュリティ

- [ ] PHPの出力はすべてエスケープしているか
  - esc_html() / esc_attr() / esc_url()
- [ ] フォームにnonceチェックがあるか
- [ ] 入力値をサニタイズしているか
- [ ] デバッグモードがOFFか（WP_DEBUG = false）

---

### 📝 納品前最終確認

- [ ] console.log / var_dump は削除したか
- [ ] コメントアウトしたコードは整理したか
- [ ] SCSSをビルドしたか（npm run build:css）
- [ ] 不要なサンプル投稿/ページは削除したか

---

## 🌿 Git運用

### ブランチ種類

| ブランチ名 | 用途 | 例 |
|------------|------|-----|
| `main` | 本番環境用 | - |
| `develop` | 開発統合用 | - |
| `feature/xxx` | 新機能開発 | `feature/hero-section` |
| `fix/xxx` | バグ修正 | `fix/header-responsive` |
| `hotfix/xxx` | 緊急修正 | `hotfix/form-error` |

### ブランチ命名規則

```bash
# 形式: {種類}/{内容}（ケバブケース）
feature/hero-section
feature/service-archive
fix/navigation-mobile
hotfix/form-validation
```

---

### コミットメッセージ

#### 形式
```
{絵文字} {種類}: {変更内容}
```

#### 種類と絵文字
| 絵文字 | 種類 | 説明 |
|--------|------|------|
| ✨ | feat | 新機能 |
| 🐛 | fix | バグ修正 |
| 🎨 | style | スタイル調整 |
| ♻️ | refactor | リファクタリング |
| 📝 | docs | ドキュメント |
| 🔧 | chore | 設定・雑務 |
| 🚀 | perf | パフォーマンス改善 |
| 🔥 | remove | 削除 |
| 🚧 | wip | 作業中 |

#### 例
```bash
✨ feat: トップページのヒーローセクションを実装
🐛 fix: SP時にハンバーガーメニューが動作しない問題を修正
🎨 style: カードコンポーネントの余白を調整
♻️ refactor: メディアクエリのmixinを統一
```

---

### よく使うGitコマンド

```bash
# ブランチ作成 & 切り替え
git checkout -b feature/hero-section

# ステージング & コミット
git add .
git commit -m "✨ feat: 〇〇を実装"

# プッシュ
git push origin feature/hero-section

# 直前のコミットメッセージ修正
git commit --amend -m "新しいメッセージ"

# ログ確認
git log --oneline --graph
```

---

### ⚠️ develop専用ファイル

以下のファイルは **developブランチ専用** です。
mainへのマージ時は除外してください：

```
TEMPLATE_DEV.md
```

### mainマージ時の手順

```bash
git checkout main
git merge develop --no-commit
git reset HEAD TEMPLATE_DEV.md
git checkout -- TEMPLATE_DEV.md
git commit -m "🔀 merge: developからマージ"
```

---

### ⚠️ 注意事項

- mainブランチに直接pushしない
- force pushは基本的にしない
- 機密情報（パスワード、APIキー）をコミットしない

