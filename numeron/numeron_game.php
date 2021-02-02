<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
<title>NUMERON</title>
</head>
<body>
<h1>NUMERON</h1>
<?php
date_default_timezone_set('Asia/Tokyo');
//ランキングに二重登録防止
session_start();
if(!empty($_SESSION['game']) && $_SESSION['game']==true){
    $level=$_POST['level'];
    $name=$_POST['name'];
    $_SESSION['history'][]=$_POST['kaitou'];
    $kaitou=str_split($_POST['kaitou']);
    $a=0;
    $b=0;
//回答が正しく入力されているか確認
    if(preg_match('/^[0-9]{'.$level.'}$/',$_POST['kaitou']) && count(array_unique($kaitou))==$level){
        $_SESSION['count']++;

        //回答の正誤を確認
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
        $_SESSION['history_a'][]=$a;
        $_SESSION['history_b'][]=$b;

        //正解した時の表示
        if($a==$level){
            try{
                $cleared_at=date("Y-m-d H:i:s");

                $dsn='mysql:dbname=himatubushi;host=localhost;charset=utf8';
                $user='root';
                $password='';
                $dbh=new PDO($dsn,$user,$password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                $sql='INSERT INTO numeron (name,level,kaisuu,cleared_at) VALUES (?,?,?,?)';
                $stmt=$dbh->prepare($sql);
                $data[]=$name;
                $data[]=$level;
                $data[]=$_SESSION['count'];
                $data[]=$cleared_at;
                $stmt->execute($data);

                $dbh=null;

                print '<div class="text" style="font-size: 30px;color: #rgb(128, 128, 128);">';
                print '<h3>正解！</h3>';
                print 'チャレンジ回数'.$_SESSION['count'].'回でクリアしました。<br /><br />';
                print '</div>';

                print '<div id="choice">';
                print '<a class="button" href="numeron_top.php">トップに戻る</a>';
                print '<a class="button" href="numeron_rank.php?cleared_at='.$cleared_at.'&level='.$level.'">ランキングを確認する</a>';
                print '</div>';
                session_destroy();
                exit();
            }catch(Exception $e){
                print 'ただいま障害により大変ご迷惑をお掛けしております。';
                exit();
            }
        }

        print '<div class="text">';
        print '数字と位置が同じ数字：'.$a.'個　';
        print '位置は違うが数字が同じ：'.$b.'個';
        print '</div>';
    }else{
        print '<div class="text">';
        print '入力が正しくありません。０〜９のそれぞれ異なる数字を'.$level.'つ入力してください。<br />';
        print '正しい入力例：';
        for($k=0;$k<$level;$k++){
            print $k;
        }
        print '</div>';
    }


?>
    <div class="text">
        <h4>チャレンジ回数：<?php print $_SESSION['count']; ?>回</h4>
        <form method="post" action="numeron_game.php">
            <input type="text" name="kaitou" value="<?php print $_POST['kaitou']; ?>">
            <input type="hidden" name="level" value="<? print $level; ?>">
            <input type="hidden" name="name" value="<? print $name; ?>">
            <input type="submit" value="回答する">
        </form>
        <br />
        <br />
        【 過去の回答 】
    </div>

    <table>
    <tr>
        <th>あなたの回答</th>
        <th>数字と位置が同じ</th>
        <th>数字だけが同じ</th>
    </tr>
<?php
    for($k=0;$k<count($_SESSION['history']);$k++){
        print '<tr>';
        print '<td>'.$_SESSION['history'][$k].'</td>';
        print '<td>'.$_SESSION['history_a'][$k].'</td>';
        print '<td>'.$_SESSION['history_b'][$k].'</td>';
        print '</tr>';
    }
?>
    </table>

<?php
}else{
    print '<div class="text" style="font-size: 20px">';
    print 'エラーが発生しました。<br />';
    print '<a class="button" href="numeron_top.php">トップへ戻る</a>';
    print '</div>';
}
?>


</body>
</html>
