# これはなに？
baserCMSのプラグインです。

## 利用方法
PluginフォルダにRevisionControlというフォルダ名にて設置し、管理画面より有効化することで利用可能です。
有効化後は、データ保存時に保存データを履歴として保存します。

## 動作baserCMS
baserCMS3.0.12  
baserCMS4.0.1  
baserCMS4.0.2   
baserCMS4.0.10.1  

## 保存データについて
固定ページ・ブログ記事の履歴が管理できます。
固定ページは本文、固定ページテンプレート、コードのみが履歴管理され、基本設定・オプション・関連コンテンツ・その他情報などの内容は履歴管理されません。
ブログ記事のアイキャッチをリビジョン毎に保存するため利用するデータ容量が大きくなる場合があります。
データ容量に余裕が無い場合は世代数に制限を設けて利用してください。

## 履歴の世代制限について
Config/setting.phpのlimitの値を変更することで世代制限をかけることが可能です。
デフォルトは0に設定されており、無制限で保存されます。

## その他
### 対象履歴の追加について（製作者向け情報）
Config/setting.php のmodels、viewsの設定値を変更すると履歴対象のデータを追加することが可能です。
マーケットに配布されているPuttiCustomeFieldプラグインなどのデータについても対応することが可能です。
