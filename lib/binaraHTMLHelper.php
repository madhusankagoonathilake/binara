<?php

/**
 * binara ver 1.0
 * http://code.google.com/p/binara/
 * 
 * Copyright (c) 2011 Madhusanka Goonathilake
 * 
 * Licensed under the MIT licenses.
 * http://code.google.com/p/binara/wiki/License
 */
class binaraHTMLHelper {

    private static $instance;

    private function __construct() {
        
    }

    /**
     *
     * @return binaraHTMLHelper
     */
    public static function instance() {
        if (!(self::$instance instanceof binaraCAPTCHA)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     *
     * @param bool $output
     * @return string 
     */
    public function renderCAPTCHADiv($output = true) {
        $imagePath = binaraConfig::instance()->get('html-helper-image-path');

        $inputFieldName = binaraConfig::instance()->get('html-helper-input-field-name');
        $inputLabelText = binaraConfig::instance()->get('html-helper-input-label-text');
        $htmlHelperDivId = binaraConfig::instance()->get('html-helper-div-id');
        $htmlHelperReloadHelpText = binaraConfig::instance()->get('html-helper-reload-help-text');
        $inputTipSpanId = binaraConfig::instance()->get('html-helper-input-tip-span-id');
        $inputTipText = binaraConfig::instance()->get('html-helper-input-tip-text');

        $html = '';
        $html .= '<div id="' . $htmlHelperDivId . '">';
        $html .= '<img src="' . $imagePath . 'image.php" alt="binaraCAPTCHA" title="binaraCAPTCHA" id="binaraCAPTCHA" />';
        $html .= '<br />';
        $html .= '<label for="' . $inputFieldName . '">' . $inputLabelText . '</label>';
        $html .= '<input type="text" id="' . $inputFieldName . '" name="' . $inputFieldName . '" />';
        $html .= '<br />';
        $html .= '<span id="' . $inputTipSpanId . '">' . $inputTipText . '</span>';
        $html .= '<br />';
        $html .= '<a href="javascript: binara_reloadImage();">';
        $html .= $htmlHelperReloadHelpText;
        $html .= '</a>';
        $html .= '<script type="text/javascript">';
        $html .= 'function binara_reloadImage() { document.getElementById(\'binaraCAPTCHA\').src = \'' . $imagePath . 'image.php?seed=\' + Math.random(); }';
        $html .= '</script>';
        $html .='</div>';

        if ($output) {
            echo $html;
        }

        return $html;
    }

}
