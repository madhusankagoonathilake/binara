<?php
@session_start();

require_once '../lib/binaraHTMLHelper.php';
require_once '../lib/binaraCAPTCHA.php';
require_once '../lib/binaraConfig.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['binaraCAPTCHATextInput'])) {
        $input = htmlentities(trim($_POST['binaraCAPTCHATextInput'])) ;
      if (binaraCAPTCHA::instance()->verify($input)) {
          $message = 'You have entered the correct value';
      } else {
          $message = 'You have entered a wrong value. You are probably a bot!';
      }
    } else {
        $message = 'This is very unlikely, but CAPTCHA text is missing in POST data!';
    }
} else {
    $message = 'Enter the text in the image and press [Check]';
}
?>
<!DOCTYPE html>
<html> 
    <head> 
        <meta charset="utf-8" /> 
        <title>binara CAPTCHA Tester</title>
    </head>

    <body>
        <div><?php echo $message; ?></div>
        <form method="post">
            <?php binaraHTMLHelper::instance()->renderCAPTCHADiv(); ?>
            <input type="submit" value="Check" />
        </form>
    </body>
</html>
