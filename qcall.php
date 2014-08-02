<?php
$text = "ขอเชินหมายเลข   $_POST[seq]   ที่ช่องบริการ   $_POST[ch]";

$text = substr($text, 0, 100);
$lang = "th";
$file = md5($lang . "?" . urlencode($text));
$file = "audio/" . $file . ".mp3";

if (!is_dir("audio/"))
    mkdir("audio/");
else
if (substr(sprintf('%o', fileperms('audio/')), -4) != "0777")
    chmod("audio/", 0777);


if (!file_exists($file)) {
    $mp3 = file_get_contents(
            'http://translate.google.com/translate_tts?ie=UTF-8&q=' . urlencode($text) . '&tl=' . $lang . '&total=1&idx=0&textlen=5&prev=input');
    file_put_contents($file, $mp3);
}
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="en-US">
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html lang="en-US">
    <!--<![endif]-->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    <body>
        <div align="center">
            <form method="POST">
                <input type="text"  name="seq" style="width: 200px">
                
                <input type="radio" value="1" name="ch">ช่องบริการ 1
                <input type="radio" value="2" name="ch">ช่องบริการ 2
                <input type="radio" value="3" name="ch">ช่องบริการ 3
                
                <input type="submit" value="ประกาศ">
            </form>
            <br>
            <div style="border: solid #29d; width: 350px; height: 250px;vertical-align: central">
                <h1>หมายเลข <?php echo $_POST[seq]; ?> <br><br>
                    เชิญช่อง <?php echo $_POST[ch]; ?></h1>
            </div>
            <br>
            <br>
            <?php if(!empty($_POST[seq]) and !empty($_POST[ch])):?>
            <audio controls="controls" autoplay="autoplay">
                <source src="<?php echo $file; ?>" type="audio/mp3" />
            </audio>
            <?php endif; ?>
        </div>

    </body>
</html>