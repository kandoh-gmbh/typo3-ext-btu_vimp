<?php
declare(strict_types=1);

use TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') || die();

(static function () {
    $iconRegistry = GeneralUtility::makeInstance(
        \TYPO3\CMS\Core\Imaging\IconRegistry::class
    );
    $iconRegistry->registerIcon(
        'mimetypes-media-video-vimp',
        BitmapIconProvider::class,
        ['source' => 'EXT:btu_vimp/Resources/Public/Icons/mimetypes/media-video-vimp.png']
    );
    $iconRegistry->registerMimeTypeIcon(
        'video/vimp',
        'mimetypes-media-video-vimp'
    );
})();
