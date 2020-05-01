<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'ViMP Media Rendering',
    'description' => '',
    'category' => 'fe',
    'author' => 'Thomas Scholze',
    'author_email' => 'thomas.scholze@b-tu.de',
    'state' => 'stable',
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
          'typo3' => '8.7.13-9.5.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'clearCacheOnLoad' => true,
    'uploadfolder' => false,
    'autoload' => [
        'psr-4' => [
            'BTU\\BtuVimp\\' => 'Classes'
        ]
    ],
];
