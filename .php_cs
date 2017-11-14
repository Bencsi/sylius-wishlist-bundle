<?php
return PhpCsFixer\Config::create()
    ->setRules([
        '@Symfony'               => true,
        'ordered_imports'        => true,
        'psr0'                   => false,
        'yoda_style'             => false,
        'phpdoc_order'           => true,
        'array_syntax'           => [
            'syntax' => 'short',
        ],
        'binary_operator_spaces' => [
            'align_equals'       => true,
            'align_double_arrow' => true,
        ]
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()->in([
            __DIR__,
        ]
    ));
