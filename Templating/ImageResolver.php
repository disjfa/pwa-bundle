<?php

namespace Disjfa\PwaBundle\Templating;

use GuzzleHttp\Psr7\Uri;
use Liip\ImagineBundle\Service\FilterService;
use PhpMob\Settings\Manager\SettingManager;

class ImageResolver extends \Twig_Extension
{
    /**
     * @var FilterService
     */
    private $filterService;
    /**
     * @var SettingManager
     */
    private $settingManager;

    public function __construct(FilterService $filterService, SettingManager $settingManager)
    {
        $this->filterService = $filterService;
        $this->settingManager = $settingManager;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('image_resolver', [$this, 'resolver']),
        ];
    }

    /**
     * @param string $path
     * @param string $filter
     * @return string
     */
    public function resolver(string $path, string $filter)
    {
        $url = new Uri($path);

        $runtimeConfig = [
            'background' => [
                'color' => $this->settingManager->get('pwa.background_color'),
            ],
        ];
        return $this->filterService->getUrlOfFilteredImageWithRuntimeFilters(ltrim($url->getPath(), '/'), $filter, $runtimeConfig);
    }
}
