<?php
@session_start();

require_once '../lib/binaraCAPTCHA.php';
require_once '../lib/binaraConfig.php';
require_once '../lib/binaraImageHelper.php';

binaraCAPTCHA::instance()->draw();