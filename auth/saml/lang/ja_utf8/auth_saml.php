<?php
global $CFG;

$string['auth_samltitle']         = 'SAML認証';
$string['auth_samldescription']   = 'SimpleSAMLを使用してSSO認証を行います。<br/> 設定ファイルの編集を忘れないでください: '.$CFG->dirroot.'/auth/saml/config.php';

$string['auth_saml_dologout'] = 'アイデンティティプロバイダからログアウトする';
$string['auth_saml_dologout_description'] = 'チェックするとMoodleからのログアウト時アイデンティティプロバイダからログアウトします。';

$string['auth_saml_duallogin'] = 'ユーザーのデュアルログインを有効';
$string['auth_saml_duallogin_description'] = 'ユーザーに割り当てられたログインモジュールかSAMLの使用を有効にします。';

$string['auth_saml_notshowusername'] = 'ユーザー名を表示しない';
$string['auth_saml_notshowusername_description'] = 'チェックするとアイデンティティプロバイダによるログイン時にMoodleはユーザー名を表示しません。';

$string['errorbadlib'] = 'SimpleSAMLPHP ライブラリディレクトリ $a は正しくありません。auth/saml/config.php ファイルを正しく編集してください。';
$string['errorbadconfig'] = 'SimpleSAMLPHPの設定ディレクトリ $a は正しくありません。auth/saml/config.php ファイルを正しく編集してください。';

$string['auth_saml_username'] = 'SAMLユーザー名マッピング';
$string['auth_saml_username_description'] = 'Moodleのユーザー名にマッピングするSAML属性を指定します。- これはデフォルトで mail です。';

$string['auth_saml_memberattribute'] = 'メンバー属性';
$string['auth_saml_memberattribute_description'] = '任意: ユーザーが属するグループ属性を上書きします. 通常 \'member\' です';

$string['auth_saml_attrcreators'] = '属性作成者';
$string['auth_saml_attrcreators_description'] = 'メンバーがグループの作成を許可されているグループまたはコンテクストのリストです。複数のグループを指定する時は \';\'(セミコロン)で区切ります。';
$string['auth_saml_unassigncreators'] = 'コース作成者権限の剥奪';
$string['auth_saml_unassigncreators_description'] = '設定した条件にマッチしない場合にコース作成者権限を剥奪します。';

$string['retriesexceeded'] = '最大リトライ回数に達しました ($a) - アイデンティティサービスに問題がある可能性があります。';
$string['pluginauthfailed'] = 'SAML 認証プラグインは失敗しました - ユーザー $a は無効かデュアルログインが無効です。';
$string['auth_saml_username_error'] = 'IdP から SAMLユーザーマッピングフィールドを含まないデータ集合が返りました。このフィールドはログインに必要です。';
?>
