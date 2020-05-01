<?php
defined('TYPO3_MODE') || die();

(static function () {
    $extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['btu_vimp'], ['allowed_classes' => false]);

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

    if (isset($extConf['baseUrl']) && !empty($extConf['baseUrl'])) {
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['fal']['onlineMediaHelpers']['vimp'] = \BTU\BtuVimp\Helpers\VimpHelper::class;
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['FileInfo']['fileExtensionToMimeType']['vimp'] = 'video/vimp';

        $GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext'] .= ',vimp';
    }
})();
