<?php
/**
 * 1.0.2 バージョン アップデートスクリプト
 * 更新ユーザ情報を追加
 */
/**
 * mail_contents テーブル変更
 */
if($this->loadSchema('1.0.2', 'RevisionControl', 'revision_controls', $filterType = 'alter')) {
    $this->setUpdateLog('rivision情報のテーブルの構造変更に成功しました。');
} else {
    $this->setUpdateLog('rivision情報のテーブルの構造変更に成功しました。', true);
}