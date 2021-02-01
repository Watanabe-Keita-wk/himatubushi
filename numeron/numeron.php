<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>NUMERON</title>
</head>
<body>
<h1>NUMERON</h1>
<?php
if(0 < mb_strlen($_POST['name'],'utf-8') && mb_strlen($_POST['name'],'utf-8') <= 30){
    session_start();
    $name=$_POST['name'];
    $_SESSION['count']=0;
    $_SESSION['game']=true;
    for($i=2;$i<=5;$i++){
        if(isset($_POST['level'.$i])==true){
            $level=$i;
        }
    }

    $_SESSION['answer']=[];
    while(true){
        $_SESSION['answer'][]=rand(0,9);
        $_SESSION['answer']=array_unique($_SESSION['answer']);
        if(count($_SESSION['answer'])==$level){
            break;
        }
    }



?>
    <h3>０〜９のそれぞれ異なる数字を<?php print $level ?>つ入力してください。</h3>

    <form method="post" action="numeron_game.php">
    <input type="text" name="kaitou">
    <input type="hidden" name="name" value="<?php print $name; ?>">
    <input type="hidden" name="level" value="<?php print $level; ?>">
    <br />
    <input type="submit" value="回答する">
    </form>
<?php
}else{
    header('Location: numeron_top.php');
    exit();
}
?>
</body>
</html>
