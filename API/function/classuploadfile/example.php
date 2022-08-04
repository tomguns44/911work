<?

include_once(dirname(__FILE__)."/class.uploadfile.php");

$upload=new classUpload(dirname(__FILE__));
$upload->uploadFile($_FILES[file][name],$_FILES[file][type],$_FILES[file][tmp_name]);
$upload->save();
$upload->getFileArray();


$upload=new classUpload(dirname(__FILE__));
$upload->uploadFile($_FILES[file][name],$_FILES[file][type],$_FILES[file][tmp_name]);
$upload->setImageType();
$upload->save();
$upload->getFileArray();


$upload=new classUpload(dirname(__FILE__));
$upload->uploadFile($_FILES[file][name],$_FILES[file][type],$_FILES[file][tmp_name]);
$upload->setImageType(600,150);
$upload->save();
$upload->getFileArray();

?>
<form method="POST" enctype="multipart/form-data">
<input type="file" name="file">
<br />
<input type="submit" name="submit" value="submit">
</form>