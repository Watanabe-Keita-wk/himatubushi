<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>NUMERON</title>
</head>
<body>
<h1>NUMERON</h1>
<?php
session_start();
$_SESSION['count']=0;

$level=$_GET['level'];

$_SESSION['answer']=[];
for($i=0;$i<$level;$i++){
    if($i==0){
        $_SESSION['answer'][]=rand(1,9);
    }else{
        $_SESSION['answer'][]=rand(0,9);
    }
}

var_dump($_SESSION['answer']);
?>
<h3><?php print $level ?>つのそれぞれ異なる数字を入力してください。</h3>

<form method="post" action="numeron_game.php">
<input type="text" name="kaitou">
<input type="hidden" name="level" value="<?php print $level; ?>">
<br />
<input type="submit" value="回答する">
</form>
</body>
</html>