<?php

require_once 'Uploader.php';

$file;
$result;
if( isset( $_FILES['upfile'] ) ) {
	$uploader = new Uploader();
	$uploader->setTmpDir( __DIR__ . '/tmp');
	$uploader->setWriteDir( __DIR__ . '/file');
	$uploader->setMinSize('10');
	$uploader->setMaxSize('1000000');
	$file = $uploader->prepare('upfile');
	$uploader->execute();
	//$uploader->setNewName(mt_rand(10,200));
	$result = $uploader->commit();
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
	<title>ファイルアップロードサンプル</title>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<body>
<section class="jumbotron">
	<h2>ファイルアップロード - サンプル</h2>

	<article>
		<p>このファイルアップロードライブラリーではファイルをアップロード時に、最初に一時領域に格納し内容の確認後名前を付けてファイルを最終保存場所にアプロード(コミット)する事ができます。</p>
		<p>もしファイルに問題があった場合、その情報を巻き戻す(rollBack)する事も可能です</p>
	</article>
<?php if( $result === false ) { ?>
	<div class="alert alert-danger" role="alert">
		<p><span class="label label-danger">失敗</span></p>
		<span>ファイルアップロード失敗</span>
	</div>
<?php } else if( gettype($result) == 'object' ) {  ?>
	<div class="alert alert-success" role="alert">
		<p><span class="label label-success">成功</span></p>
		<span>書き込み前情報</span>
		<pre>
<?php print_r($file); ?>
		</pre>
		<span>書き込み結果</span>
		<pre>
<?php print_r($result); ?>
		</pre>
	</div>
<?php } ?>

	<div class="inner">
		<form action="sample.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="upfile">ファイル選択</label><input id="upfile" type="file" name="upfile" class="form-control"/>
			</div>
			<button type="reset"  class="btn btn-default">リセット</button>
			<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-send" aria-hidden="true"></span>&nbsp;&nbsp;送信</button>
		</form>
	</div>
</section>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>
