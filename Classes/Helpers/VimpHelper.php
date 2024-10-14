<?php
declare(strict_types=1);

namespace BTU\BtuVimp\Helpers;

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

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\Folder;
use TYPO3\CMS\Core\Resource\OnlineMedia\Helpers\AbstractOnlineMediaHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\StringUtility;

/**
 * Vimp helper class
 */
class VimpHelper extends AbstractOnlineMediaHelper
{
    /**
     * Base URL for the ViMP instance
     *
     * @var string
     */
    protected $baseUrl;

    /**
     * Constructor
     *
     * @param string $extension file extension bind to the OnlineMedia helper
     */
    public function __construct($extension)
    {
        parent::__construct($extension);
        if (empty($this->baseUrl)) {
            $this->baseUrl = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('btu_vimp', 'baseUrl');
        }
    }


    /**
     * Try to transform given URL to a File
     * Link examples:
     *   Permalink: https://www.b-tu.de/media/video/36434-Statistische-Methoden-des-Qualitaetsmanagements-SoSe-18-12042018-Teil-2/918ac7e719577d8f0e5545572eb0d79a
     *   Embed: https://www.b-tu.de/media/media/embed?key=918ac7e719577d8f0e5545572eb0d79a&width=720&height=405&autoplay=false&autolightsoff=false&loop=false&chapters=false&related=false&responsive=false&t=0
     *
     * @param string $url
     * @param Folder $targetFolder
     * @return File|null
     */
    public function transformUrlToFile($url, Folder $targetFolder)
    {
        $mediaId = null;

        if (isset($this->baseUrl)
            && !empty($this->baseUrl)
            && StringUtility::beginsWith($url, $this->baseUrl)
        ) {
            if (preg_match('/\/(?:video)\/([0-9a-z\-]+)\/([0-9a-z]+)/i', $url, $matches)) {
                $mediaTitle = $matches[1];
                $mediaId = $matches[2];
            }
        }
        if (empty($mediaId)) {
            return null;
        }
        return $this->transformMediaIdToFile($mediaId, $mediaTitle, $targetFolder, $this->extension);
    }

    /**
     * Transform mediaId to File
     *
     * @param string $mediaId
     * @param string $mediaTitle
     * @param Folder $targetFolder
     * @param string $fileExtension
     * @return File
     */
    protected function transformMediaIdToFile($mediaId, $mediaTitle, Folder $targetFolder, $fileExtension)
    {
        $file = $this->findExistingFileByOnlineMediaId($mediaId, $targetFolder, $fileExtension);

        if ($file === null) {
            if (!empty($mediaTitle)) {
                $fileName = $mediaTitle . '.' . $fileExtension;
            } else {
                $fileName = $mediaId . '.' . $fileExtension;
            }
            $file = $this->createNewFile($targetFolder, $fileName, $mediaId);
        }

        return $file;
    }

    /**
     * Get public url
     * Return NULL if you want to use core default behaviour
     *
     * @param File $file
     * @param bool $relativeToCurrentScript
     * @return string|null
     */
    public function getPublicUrl(File $file, $relativeToCurrentScript = false)
    {
        return null;
    }

    public function getPreviewImage(File $file)
    {
        $videoId = $this->getOnlineMediaId($file);
        $temporaryFileName = $this->getTempFolderPath() . 'vimp_' . md5($videoId) . '.jpg';
        if (!file_exists($temporaryFileName)) {
            $thumbnailUrl = $this->baseUrl . '/api/getPicture?type=medium&key=' . $videoId;
            $previewImage = GeneralUtility::getUrl($thumbnailUrl);
            if ($previewImage !== false) {
                file_put_contents($temporaryFileName, $previewImage);
                GeneralUtility::fixPermissions($temporaryFileName);
            }
        }
        return $temporaryFileName;
    }

    public function getMetaData(File $file)
    {
        //TODO currently not possible
        return [];
    }
}
