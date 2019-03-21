<?php

namespace Disjfa\PwaBundle\Service;

use Exception;
use GuzzleHttp\Psr7\Uri;
use Liip\ImagineBundle\Service\FilterService;
use PhpMob\Settings\Manager\SettingManager;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\File;

class ImageResolverService
{
    /**
     * @var FilterService
     */
    private $filterService;
    /**
     * @var SettingManager
     */
    private $settingManager;
    /**
     * @var bool|string
     */
    private $publicFolder;

    /**
     * ImageResolverService constructor.
     * @param string $publicPath
     * @param string $rootDir
     * @param FilterService $filterService
     * @param SettingManager $settingManager
     * @throws Exception
     */
    public function __construct(string $publicPath, string $rootDir, FilterService $filterService, SettingManager $settingManager)
    {
        $this->publicFolder = realpath($rootDir . $publicPath);
        if (null === $this->publicFolder) {
            throw new Exception('Path does not exists: ' . $rootDir . $publicPath);
        }

        $this->filterService = $filterService;
        $this->settingManager = $settingManager;
    }

    /**
     * @param string $path
     * @return string|null
     */
    public function getMimeType(string $path)
    {
        $url = new Uri($path);
        $file = new File($this->publicFolder . $url->getPath());

        return $file->getMimeType();
    }

    /**
     * @param string $path
     * @param string $filter
     * @return string
     */
    public function resolver(string $path, string $filter)
    {
        $url = new Uri($path);
        try {
            $file = new File($this->publicFolder . $url->getPath());
        } catch (FileNotFoundException $e) {
            return '';
        }

        if (false === in_array($file->getExtension(), ['png', 'jpg', 'jpeg'])) {
            return '';
        }

        $runtimeConfig = [
            'background' => [
                'color' => $this->settingManager->get('pwa.background_color'),
            ],
        ];
        
        return $this->filterService->getUrlOfFilteredImageWithRuntimeFilters(ltrim($url->getPath(), '/'), $filter, $runtimeConfig);
    }
}
