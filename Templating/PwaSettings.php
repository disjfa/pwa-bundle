<?php

namespace Disjfa\PwaBundle\Templating;

use Disjfa\PwaBundle\Service\ImageResolverService;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class PwaSettings extends AbstractExtension
{
    /**
     * @var ParameterBagInterface
     */
    public $parameterBag;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('pwa_settings', [$this, 'setting']),
        ];
    }

    /**
     * @return string
     */
    public function setting(string $path)
    {
        if ($this->parameterBag->has('disjfa_pwa.' . $path)) {
            return $this->parameterBag->get('disjfa_pwa.' . $path);
        }
        return null;
    }
}
