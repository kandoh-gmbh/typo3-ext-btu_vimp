<?php
declare(strict_types=1);

namespace BTU\BtuVimp\Configuration;

use BTU\BtuVimp\Exception\InvalidConfigurationException;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationPathDoesNotExistException;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration as CoreExtensionConfiguration;
use TYPO3\CMS\Core\SingletonInterface;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * ExtensionConfiguration class
 */
class ExtensionConfiguration implements SingletonInterface
{
    protected string $baseUrl;

    /**
     * @throws ExtensionConfigurationExtensionNotConfiguredException
     * @throws ExtensionConfigurationPathDoesNotExistException
     * @throws InvalidConfigurationException
     */
    public function __construct(
        protected CoreExtensionConfiguration $extConf
    ) {
        $baseUrl = $extConf->get('btu_vimp', 'baseUrl');
        if (! is_string($baseUrl)) {
            throw new InvalidConfigurationException('Configuration "baseUrl" must be a string', 1728910000);
        }
        $this->baseUrl = $baseUrl;
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }
}
