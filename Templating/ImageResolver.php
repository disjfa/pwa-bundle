<?php

namespace Disjfa\PwaBundle\Templating;

use Disjfa\PwaBundle\Service\ImageResolverService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class ImageResolver extends AbstractExtension
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
            new TwigFilter('image_resolver', [$this, 'resolver']),
        ];
    }

    /**
     * @return string
     */
    public function resolver(string $path, string $filter)
    {
        return $this->imageResolverService->resolver($path, $filter);
    }
}
