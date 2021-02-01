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
if(!empty($_SESSION['game']) && $_SESSION['game']==true){
    $level=$_POST['level'];
    $kaitou=str_split($_POST['kaitou']);
    $a=0;
    $b=0;

    if(preg_match('/^[0-9]{'.$level.'}$/',$_POST['kaitou']) && count(array_unique($kaitou))==$level){
        $_SESSION['count']++;

        for($i=0;$i<$level;$i++){
            if(intval($kaitou[$i]==$_SESSION['answer'][$i])){
                $a++;
            }else{
                for($j=0;$j<$level;$j++){
                    if(intval($kaitou[$i])==$_SESSION['answer'][$j]){
                        $b++;
                    }
                }
            }
        }

        if($a==$level){
            print '<h3>正解！</h3>';
            print 'チャレンジ回数'.$_SESSION['count'].'回でクリアしました。<br />';
            print '<a href="numeron_top.php">トップへ戻る</a>';
            session_destroy();
            exit();
        }

        print '数字と位置が同じ数字：'.$a.'個　';
        print '位置は違うが数字が同じ：'.$b.'個';
    }else{
        print '入力が正しくありません。０〜９のそれぞれ異なる数字を'.$level.'つ入力してください。<br />';
        print '正しい入力例：';
        for($k=0;$k<$level;$k++){
            print $k;
        }
    }

    //var_dump($kaitou);
?>

    <h3><?php print $level ?>桁の数字を入力してください。</h3>
    <form method="post" action="numeron_game.php">
    <input type="text" name="kaitou" value="<?php print $_POST['kaitou']; ?>">
    <input type="hidden" name="level" value="<? print $level; ?>">
    <input type="submit" value="回答する">
<?php
}else{
    print 'エラーが発生しました。<br />';
    print '<a href="numeron_top.php">トップへ戻る</a>';
}
?>

</form>
</body>
</html>
