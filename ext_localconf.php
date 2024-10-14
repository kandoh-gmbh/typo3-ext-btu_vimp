<?php
declare(strict_types=1);

defined('TYPO3') || die();

(static function () {
    $extConf = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \TYPO3\CMS\Core\Configuration\ExtensionConfiguration::class
    )->get('btu_vimp');

    if (isset($extConf['baseUrl']) && !empty($extConf['baseUrl'])) {
        $rendererRegistry = \TYPO3\CMS\Core\Resource\Rendering\RendererRegistry::getInstance();
        $rendererRegistry->registerRendererClass(\BTU\BtuVimp\Rendering\VimpRenderer::class);
        unset($rendererRegistry);

        $GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext'] .= ',vimp';
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['FileInfo']['fileExtensionToMimeType']['vimp'] = 'video/vimp';
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['fal']['onlineMediaHelpers']['vimp'] = \BTU\BtuVimp\Helpers\VimpHelper::class;
    }
})();
