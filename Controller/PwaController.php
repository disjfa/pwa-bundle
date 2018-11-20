<?php

namespace Disjfa\PwaBundle\Controller;

use PhpMob\SettingsBundle\Twig\Helper\SettingHelper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PwaController extends Controller
{
    /**
     * @var SettingHelper
     */
    private $settingHelper;

    /**
     * @param SettingHelper $settingHelper
     */
    public function __construct(SettingHelper $settingHelper)
    {
        $this->settingHelper = $settingHelper;
    }

    /**
     * @Route("/manifest.json", name="disjfa_pwa_manifest")
     */
    public function manifestAction()
    {
        return new JsonResponse([
            'name' => $this->settingHelper->get('pwa.name'),
            'short_name' => $this->settingHelper->get('pwa.short_name'),
            'start_url' => $this->settingHelper->get('pwa.start_url'),
            'display' => $this->settingHelper->get('pwa.display'),
            'background_color' => $this->settingHelper->get('pwa.background_color'),
            'theme_color' => $this->settingHelper->get('pwa.theme_color'),
            'icons' => [
                [
                    "src" => "icons/icon-128x128.png",
                    "sizes" => "128x128",
                    "type" => "image/png",
                ]
            ],
        ]);
    }

    /**
     * @Route("/pwa-icons", name="disjfa_pwa_icons")
     */
    public function iconsAction()
    {
        $icons = [];
        foreach (array_keys($this->getParameter('liip_imagine.filter_sets')) as $item) {
            $icons[] = $item;
        }

        return $this->render('pwa/icons.html', [
            'icons' => $icons,
        ]);
    }
}
