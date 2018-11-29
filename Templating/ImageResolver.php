<?php

namespace Disjfa\PwaBundle\Templating;

use Disjfa\PwaBundle\Service\ImageResolverService;

class ImageResolver extends \Twig_Extension
{

    /**
     * @var ImageResolverService
     */
    private $imageResolverService;

    public function __construct(ImageResolverService $imageResolverService)
    {
        $this->imageResolverService = $imageResolverService;
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
        return $this->imageResolverService->resolver($path, $filter);
    }
}
