<?php

require_once 'scssphp/scss.inc.php';

use ScssPhp\ScssPhp\Compiler;
use ScssPhp\ScssPhp\OutputStyle;

$compiler = new Compiler();
$compiler->setImportPaths('assets/css/');
$compiler->setOutputStyle(OutputStyle::COMPRESSED);

$result = $compiler->compileString('@import "import.scss";');
file_put_contents('assets/css/style.css', $result->getCss());
