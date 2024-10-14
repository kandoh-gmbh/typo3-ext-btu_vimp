<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'ViMP Media Rendering',
    'description' => '',
    'category' => 'fe',
    'author' => 'Thomas Scholze',
    'author_email' => 'thomas.scholze@b-tu.de',
    'state' => 'stable',
    'version' => '1.1.1',
    'constraints' => [
        'depends' => [
          'typo3' => '9.5.0-12.4.99',
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
