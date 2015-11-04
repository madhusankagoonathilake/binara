# Usage #



## Embedding in an Application/Website ##
binara CAPTCHA can be simply embbed into an application/website by calling the `binaraHTMLHelper::renderCAPTCHADiv()` method.

```
<form method="post">
    <?php binaraHTMLHelper::instance()->renderCAPTCHADiv(); ?>
    <input type="submit" value="Check" />
</form>
```

This will embed an HTML `div` containing the following elements:
  * CAPTCHA image
  * Textbox for user input
  * Link to load another CAPTCHA image

The configurations of the rendered HTML can be set in the `binaraConfig` class at run-time as shown below:
```
<?php
binaraConfig::instance()->set(array(
    'html-helper-div-id' => 'captcha_code',
    'html-helper-reload-help-text' => 'Try Another Image',
    'html-helper-input-field-name' => 'user_input',
    'html-helper-input-label-text' => 'Enter what you see in the image',
    'html-helper-input-tip-text' => 'Capital and simple matters',
    'html-helper-input-tip-span-id' => 'tip_for_captcha',
    'html-helper-image-path' => '../../my/customer/captcha/image/path',
));
?>

<form method="post">
    <?php binaraHTMLHelper::instance()->renderCAPTCHADiv(); ?>
    <input type="submit" value="Submit" />
</form>
```

Following configurations are available:

| **Configuration** | **Description** | **Default Value** |
|:------------------|:----------------|:------------------|
| html-helper-div-id | `id` attribute of the rendered `div` tag | divCAPTCHA        |
| html-helper-reload-help-text | Text label of the link which reload the CAPTCHA image | Reload Image      |
| html-helper-input-field-name | `name` attribute of the rendered text box for user input | binaraCAPTCHATextInput |
| html-helper-input-label-text | Text label for the rendered textbox | Enter the characters shown in the image |
| html-helper-input-tip-text | Additional tip to be shown to the user | Letters are case-sensitive |
| html-helper-input-tip-span-id | `id` attribute of the `span` tag which encloses the help tip | binaraCAPTCHAInputTip |
| html-helper-image-path | Path where the `image.php` file (found in the `web` directory) located at. | ./                |

## Using the CAPTCHA Image Separately ##
To display the CAPTCHA image separately, there are two methods you can follow:
  1. Access the `image.php` file inside the `web` directory.
  1. Use the `draw()` method of an instance of `binaraCAPTCHA` class, inside your own PHP script.

_Examples:_

**Accessing `web/image.php`**
```
<img src="path/to/binara/web/image.php" alt="CAPTCHA" />
```

**Using the `draw()` Method**
```
<?php
@session_start();

require_once '../lib/binaraCAPTCHA.php';
require_once '../lib/binaraConfig.php';
require_once '../lib/binaraMathHelper.php';
require_once '../lib/binaraCryptographyHelper.php';
require_once '../lib/binaraHTTPHelper.php';
require_once '../lib/binaraImageHelper.php';

binaraCAPTCHA::instance()->draw();
```

## Comparing User Entered Value ##
The `verify()` method of `binaraCAPTCHA` class is used to verify whether user input matches with text of the CAPTCHA image shown.

_Example:_

(Assuming the name of the user input field is `binaraCAPTCHATextInput`)
```
<?php
@session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['binaraCAPTCHATextInput'])) {
        $input = htmlentities(trim($_POST['binaraCAPTCHATextInput']));
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

echo $message;
```