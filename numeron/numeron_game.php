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
$_SESSION['count']++;
$level=$_POST['level'];
$kaitou=$_POST['kaitou'];
$a=0;
$b=0;

for($j=0;$j<$level;$j++){
    if($_SESSION['answer'][$j]==){
        $a++;
    }else{
        for($k=0;$k<$level;$k++){
            if(==$_SESSION['answer'][$k]){
                $b++;
            }
        }
    }
}

echo $a;
echo $b;
?>

<h3><?php print $level ?>桁の数字を入力してください。</h3>
<form method="post" action="numeron_game.php">
<input type="text" name="kaitou">
<input type="hidden" name="level" value="<? print $level ?>">
<input type="submit" value="回答する">
</form>
</body>
</html>
