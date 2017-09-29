<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude(['.build'])
    ->in(__DIR__);

return PhpCsFixer\Config::create()
    ->setFinder($finder)
    ->setUsingCache(true)
    ->setRules([
        '@PSR2' => true,
        'phpdoc_align' => false,
        'phpdoc_order' => true,
        'ordered_imports' => true,
        'array_syntax' => ['syntax' => 'short'],
    ]);
