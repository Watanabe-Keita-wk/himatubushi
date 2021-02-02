<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
<title>NUMERON</title>
</head>
<body>
<h1>NUMERON</h1>
<div class="text">
    <h3>名前（30文字以内）を入力し、レベルを選択してください。</h3>
    <form method="post" action="numeron.php">
    <input type="text" name="name">
    <br />
    <br />
    <input class="button" type="submit" name="level2" value="かんたん【２桁】">
    <input class="button" type="submit" name="level3" value="ふつう【３桁】">
    <input class="button" type="submit" name="level4" value="むずかしい【４桁】">
    <input class="button" type="submit" name="level5" value="激ムズ【５桁】">
    </form>
</div>
</body>
</html>