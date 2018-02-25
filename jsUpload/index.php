<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
<script type="text/javascript">
    function checkUpload(fileobj){
      var fileArr = fileobj.value.split("."); //对文件名进行处理
      var ext = fileArr[fileArr.length-1]; //得到文件扩展名
      if(ext!='gif') //验证扩展名
      {
        alert("Only upload GIF images.");
        fileobj.value = ""; //清除数据
      }
    }
</script>
</head>
<body>
    <form action="index.php" method="post" enctype="multipart/form-data" >
        <input type="file" name="fupload" onchange="checkUpload(this)" id="file" />
        <input type="submit" name="submit" value="upload!" />
    </form>
    Only upload GIF images.<br />
<?php
if(isset($_POST["submit"])){
    // 基本参数
    $file_name = $_FILES['fupload']['name']; // 文件名
    $file_ext  = substr($file_name, strrpos($file_name,'.') + 1); //文件后缀
    $file_tmp  = $_FILES['fupload']['tmp_name']; //临时文件
    $target_path = "uploads/".md5(uniqid(rand())).".".$file_ext; //存储路径与名称
    // 移动临时文件
    if(move_uploaded_file($file_tmp, $target_path)){
        echo "<pre>{$target_path} succesfully uploaded!</pre>";
    }
    else{
        echo '<pre>upload error</pre>';
    }
}
 ?>
</body>

</html>