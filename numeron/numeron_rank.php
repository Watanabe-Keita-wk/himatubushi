<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>NUMERON</title>
</head>
<body>
<h1>NUMERON</h1>
<?php
try{
    $cleared_at=$_GET['cleared_at'];
    $level=$_GET['level'];

    $dsn='mysql:dbname=himatubushi;host=localhost;charset=utf8';
    $user='root';
    $password='';
    $dbh=new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql='SELECT * FROM numeron WHERE level=?';
    $stmt=$dbh->prepare($sql);
    $data[]=$level;
    $stmt->execute($data);
    $rec=$stmt->fetchAll();

    $dbh=null;

    foreach($rec as $key => $row){
        $row_kaisuu[$key]=$row['kaisuu'];
        $row_date[$key]=$row['cleared_at'];
    }

    array_multisort($row_kaisuu,SORT_ASC,$row_date,SORT_DESC,$rec);
}catch(Exception $e){
    print 'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
}
?>

<table>
<colgroup span="4"></colgroup>
<tr>
    <th>順位</th>
    <th>名前</th>
    <th>クリア回数</th>
    <th>クリア時期</th>
</tr>

<?php
for($i=0;$i<10;$i++){
    if(isset($rec[$i])==true){
        print '<tr>';
        print '<td>'.($i+1).'</td>';
        print '<td>'.$rec[$i]['name'].'</td>';
        print '<td>'.$rec[$i]['kaisuu'].'</td>';
        print '<td>'.$rec[$i]['cleared_at'].'</td>';
        print '</tr>';
    }
}
?>
</tr>
</table>
<br />
<a href="numeron_top.php">トップへ戻る</a>
</form>
</body>
</html>
