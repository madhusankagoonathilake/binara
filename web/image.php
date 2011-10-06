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
@session_start();

require_once '../lib/binaraCAPTCHA.php';
require_once '../lib/binaraConfig.php';
require_once '../lib/binaraImageHelper.php';

binaraCAPTCHA::instance()->draw();