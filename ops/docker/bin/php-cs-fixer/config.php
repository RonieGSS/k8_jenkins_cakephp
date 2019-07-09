<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
;

return PhpCsFixer\Config::create()
    ->setRules(array(
        '@PSR2' => true,
        'encoding' => true,
        'phpdoc_indent' => true,
        'phpdoc_inline_tag' => true,
        'phpdoc_no_access' => true,
        'phpdoc_scalar' => true,
        'phpdoc_order' => true,
        'array_syntax' => array('syntax' => 'short'),
    ))
    ->setFinder($finder);
