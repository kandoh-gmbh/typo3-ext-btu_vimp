<?php
declare(strict_types=1);

defined('TYPO3') || die();

(static function () {
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \TYPO3\CMS\Core\Imaging\IconRegistry::class
    );
    $iconRegistry->registerIcon(
        'mimetypes-media-video-vimp',
        \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
        ['source' => 'EXT:btu_vimp/Resources/Public/Icons/mimetypes/media-video-vimp.png']
    );
    $iconRegistry->registerMimeTypeIcon(
        'video/vimp',
        'mimetypes-media-video-vimp'
    );
})();
