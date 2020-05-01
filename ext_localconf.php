<?php
defined('TYPO3_MODE') || die();

(static function () {
    $extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['btu_vimp'], ['allowed_classes' => false]);

    if (isset($extConf['baseUrl']) && !empty($extConf['baseUrl'])) {
        $rendererRegistry = \TYPO3\CMS\Core\Resource\Rendering\RendererRegistry::getInstance();
        $rendererRegistry->registerRendererClass(\BTU\BtuVimp\Rendering\VimpRenderer::class);
    }
})();
