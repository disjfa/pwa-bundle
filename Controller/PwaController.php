<?php

namespace Disjfa\PwaBundle\Controller;

use Disjfa\PwaBundle\Service\ImageResolverService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

class PwaController extends AbstractController
{
    /**
     * @var SettingHelper
     */
    private $settingHelper;
    /**
     * @var ImageResolverService
     */
    private $imageResolverService;
    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(ImageResolverService $imageResolverService, RouterInterface $router)
    {
        $this->imageResolverService = $imageResolverService;
        $this->router = $router;
    }

    /**
     * @Route("/manifest.json", name="disjfa_pwa_manifest")
     */
    public function manifestAction()
    {
        $favicon = $this->settingHelper->get('pwa.favicon');
        $mimeType = $this->imageResolverService->getMimeType($favicon);
        $manifestIcons = [
            '36x36',
            '48x48',
            '72x72',
            '96x96',
            '144x144',
            '192x192',
            '256x256',
            '384x384',
            '512x512',
            '1024x1024',
        ];

        $icons = [];
        foreach ($manifestIcons as $iconSize) {
            $icons[] = [
                'src' => $this->imageResolverService->resolver($favicon, 'pwa_' . $iconSize),
                'sizes' => $iconSize,
                'type' => $mimeType,
            ];
        }
        $relatedApplications = [];
        $relatedApplications[] = [
            'platform' => 'webapp',
            'url' => $this->router->generate('disjfa_pwa_manifest', [], RouterInterface::ABSOLUTE_URL),
        ];

        return new JsonResponse([
            'name' => $this->settingHelper->get('pwa.name'),
            'short_name' => $this->settingHelper->get('pwa.short_name'),
            'start_url' => $this->settingHelper->get('pwa.start_url'),
            'display' => $this->settingHelper->get('pwa.display'),
            'background_color' => $this->settingHelper->get('pwa.background_color'),
            'theme_color' => $this->settingHelper->get('pwa.theme_color'),
            'related_applications' => $relatedApplications,
            'icons' => $icons,
        ]);
    }

    /**
     * @Route("/pwa-icons", name="disjfa_pwa_icons")
     */
    public function iconsAction()
    {
        $icons = [];
        foreach (array_keys($this->getParameter('liip_imagine.filter_sets')) as $item) {
            if (!preg_match('/^pwa/', $item)) {
                continue;
            }
            $icons[] = $item;
        }

        return $this->render('@DisjfaPwa/Pwa/icons.html', [
            'icons' => $icons,
        ]);
    }
}
