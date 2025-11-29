#!/bin/bash

# ============================================
# 納品用ZIP作成スクリプト
# ============================================
# 
# 使い方:
#   chmod +x create-delivery.sh  # 初回のみ
#   ./create-delivery.sh
#
# 出力:
#   delivery/テーマ名_theme_YYYYMMDD.zip
#
# ============================================

# 色付きメッセージ用
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# ============================================
# 設定（必要に応じて変更）
# ============================================

# テーマフォルダ名
THEME_DIR="wp-theme"

# 出力フォルダ
OUTPUT_DIR="delivery"

# SCSSソースを含めるか（true/false）
# false の場合、.scss ファイルは除外される
INCLUDE_SCSS_SOURCE=false

# ============================================
# メイン処理
# ============================================

echo ""
echo "============================================"
echo "  納品用ZIP作成スクリプト"
echo "============================================"
echo ""

# テーマフォルダの存在確認
if [ ! -d "$THEME_DIR" ]; then
  echo -e "${RED}エラー: $THEME_DIR フォルダが見つかりません${NC}"
  exit 1
fi

# style.css からテーマ名を取得
THEME_NAME=$(grep -m1 "Theme Name:" "$THEME_DIR/style.css" | sed 's/.*Theme Name: *//' | sed 's/ *$//' | tr ' ' '-')

if [ -z "$THEME_NAME" ]; then
  THEME_NAME="wordpress-theme"
fi

# 日付
DATE=$(date +%Y%m%d)

# ZIPファイル名
ZIP_NAME="${THEME_NAME}_${DATE}.zip"

echo "テーマ名: $THEME_NAME"
echo "出力先: $OUTPUT_DIR/$ZIP_NAME"
echo ""

# 出力フォルダ作成
mkdir -p "$OUTPUT_DIR"

# 既存のZIPがあれば削除
if [ -f "$OUTPUT_DIR/$ZIP_NAME" ]; then
  echo -e "${YELLOW}既存のZIPを削除します...${NC}"
  rm "$OUTPUT_DIR/$ZIP_NAME"
fi

# SCSSビルド確認
echo "SCSSをビルドしますか？ (y/N)"
read -r BUILD_SCSS

if [ "$BUILD_SCSS" = "y" ] || [ "$BUILD_SCSS" = "Y" ]; then
  echo ""
  echo "SCSSをビルド中..."
  npm run build:css
  echo ""
fi

# 除外パターン
EXCLUDE_PATTERNS=(
  "*.DS_Store"
  "*__MACOSX*"
  "*.map"
)

# SCSSソースを除外する場合
if [ "$INCLUDE_SCSS_SOURCE" = false ]; then
  EXCLUDE_PATTERNS+=("*.scss")
fi

# 除外オプションを構築
EXCLUDE_OPTS=""
for pattern in "${EXCLUDE_PATTERNS[@]}"; do
  EXCLUDE_OPTS="$EXCLUDE_OPTS -x \"$pattern\""
done

# ZIP作成
echo "ZIPファイルを作成中..."
eval "zip -r \"$OUTPUT_DIR/$ZIP_NAME\" \"$THEME_DIR\" $EXCLUDE_OPTS"

# 結果確認
if [ -f "$OUTPUT_DIR/$ZIP_NAME" ]; then
  echo ""
  echo -e "${GREEN}============================================${NC}"
  echo -e "${GREEN}  ZIP作成完了！${NC}"
  echo -e "${GREEN}============================================${NC}"
  echo ""
  echo "ファイル: $OUTPUT_DIR/$ZIP_NAME"
  echo "サイズ: $(du -h "$OUTPUT_DIR/$ZIP_NAME" | cut -f1)"
  echo ""
  echo "次のステップ:"
  echo "  1. ZIPの中身を確認"
  echo "  2. ギガファイル便にアップロード"
  echo "  3. URLをクライアントに送付"
  echo ""
  
  # ZIPの中身を表示するか確認
  echo "ZIPの中身を確認しますか？ (y/N)"
  read -r SHOW_CONTENTS
  
  if [ "$SHOW_CONTENTS" = "y" ] || [ "$SHOW_CONTENTS" = "Y" ]; then
    echo ""
    echo "--- ZIPの中身 ---"
    unzip -l "$OUTPUT_DIR/$ZIP_NAME"
  fi
else
  echo -e "${RED}エラー: ZIPの作成に失敗しました${NC}"
  exit 1
fi

echo ""
echo "お疲れさまでした！"

