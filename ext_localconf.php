<?php
declare(strict_types=1);

use BTU\BtuVimp\Helpers\VimpHelper;
use BTU\BtuVimp\Rendering\VimpRenderer;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Resource\Rendering\RendererRegistry;
use TYPO3\CMS\Core\Utility\GeneralUtility;

defined('TYPO3') || die();

(static function () {
    $extConf = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('btu_vimp');

    if (isset($extConf['baseUrl']) && !empty($extConf['baseUrl'])) {
        $rendererRegistry = GeneralUtility::makeInstance(RendererRegistry::class);
        $rendererRegistry->registerRendererClass(VimpRenderer::class);
        unset($rendererRegistry);

        $GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext'] .= ',vimp';
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['FileInfo']['fileExtensionToMimeType']['vimp'] = 'video/vimp';
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['fal']['onlineMediaHelpers']['vimp'] = VimpHelper::class;
    }
})();
