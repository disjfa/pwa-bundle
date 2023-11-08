<?php

namespace Disjfa\PwaBundle\Service;

use Exception;
use Liip\ImagineBundle\Service\FilterService;
use Nyholm\Psr7\Uri;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\File;

class ImageResolverService
{
    /**
     * @var FilterService
     */
    private $filterService;
    /**
     * @var ParameterBagInterface
     */
    private $parameterBag;
    /**
     * @var bool|string
     */
    private $publicFolder;

    /**
     * ImageResolverService constructor.
     *
     * @throws Exception
     */
    public function __construct(string $publicPath, string $rootDir, FilterService $filterService, ParameterBagInterface $parameterBag)
    {
        $this->publicFolder = realpath($rootDir . $publicPath);
        if (null === $this->publicFolder) {
            throw new Exception('Path does not exists: ' . $rootDir . $publicPath);
        }

        $this->filterService = $filterService;
        $this->parameterBag = $parameterBag;
    }

    /**
     * @return string|null
     */
    public function getMimeType(string $path)
    {
        $url = new Uri($path);
        $file = new File($this->publicFolder . $url->getPath());

        return $file->getMimeType();
    }

    /**
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

        $runtimeConfig = [];
        if ($this->parameterBag->has('disjfa_pwa.background_color')) {
            $runtimeConfig['background'] = [
                'color' => $this->parameterBag->get('disjfa_pwa.background_color'),
            ];
        }

        return $this->filterService->getUrlOfFilteredImageWithRuntimeFilters(ltrim($url->getPath(), '/'), $filter, $runtimeConfig);
    }
}
