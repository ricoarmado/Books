<?php
/**
 * @author stanislavtyrsa
 */

define('ROOT_PATH', __DIR__);
require 'src/loader.php';

use books\App;

App::getInstance()->run();