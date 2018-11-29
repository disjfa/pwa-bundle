# Pwa bundle

Add favicons, startup icons, launcher icons and a manifest.json to your website.
To check out how to set it up see [glynn-admin-symfony4](https://github.com/disjfa/glynn-admin-symfony4)

## Instalation

```
composer req disjfa/pwa-bundle
```

## Configuration

Setup the PWA_PUBLIC_PATH in your .env file. See the api unsplash api on details how to get these.

For the initial setup i have setup an icons in the public folder named `pwa-icon.png`. 
For a simple setup copy the icon from the bundle public folder to check it out.

```
cp vendor/disjfa/pwa-bundle/Resources/public/pwa-icon.png public/
```

## Manual setup

This is an example using symfony 4, for symfony 3 add the routes to the `router.yml` and add the settings to the `config.yml`.

Add routes in the router (`config/routes/disjfa_pwa.yaml`)

```
disjfa_pwa:
    resource: '@DisjfaPwaBundle/Controller/'
    type:     annotation
```

Setup the phpmob settings bundle, (`config/packages/phpmob_settings.yaml`)

```
# use with doctrine orm
doctrine:
    orm:
        mappings:
            PhpMobSettings:
                type: xml
                is_bundle: false
                prefix: PhpMob\Settings\Model
                dir: '%kernel.project_dir%/vendor/phpmob/settings-bundle/src/Resources/config/doctrine/model'
```

Settings, (`config/packages/disjfa_pwa.yaml`)

```
phpmob_settings:
    schemas:
        pwa:
            label: Pwa settings
            settings:
                name:
                    label: Name
                    value: Your website name
                    blueprint:
                        options:
                            required: true
                short_name:
                    label: Short name
                    value: Short name
                    blueprint:
                        options:
                            required: true
                start_url:
                    label: Start url
                    value: /
                    blueprint:
                        options:
                            required: true
                display:
                    label: Display
                    value: standalone
                    blueprint:
                        type: Symfony\Component\Form\Extension\Core\Type\ChoiceType
                        options:
                            required: true
                            expanded: true
                            choices:
                                standalone: standalone
                                fullscreen: fullscreen
                                browser: browser
                orientation:
                    label: Orientation
                    value: any
                    blueprint:
                        type: Symfony\Component\Form\Extension\Core\Type\ChoiceType
                        options:
                            required: true
                            expanded: true
                            choices:
                                any: any
                                natural: natural
                                landscape: landscape
                                portrait: portrait
                background_color:
                    label: Background color
                    value: '#2ecc71'
                    blueprint:
                        type: Symfony\Component\Form\Extension\Core\Type\ColorType
                theme_color:
                    label: Theme color
                    value: '#2980b9'
                    blueprint:
                        type: Symfony\Component\Form\Extension\Core\Type\ColorType
                favicon:
                    label: Icon
                    value: '/pwa-icon.png'
                    blueprint:
                        type: Disjfa\MediaBundle\Form\Type\MediaType

liip_imagine:
    filter_sets:
        pwa_16x16:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [16, 16]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [16, 16]
                    position: center
                    color: '#aaa'
        pwa_32x32:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [32, 32]
                    mode: inset
                background:
                    size: [32, 32]
                    position: center
                    color: '#aaa'
        pwa_36x36:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [36, 36]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [36, 36]
                    position: center
                    color: '#aaa'
        pwa_48x48:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [48, 48]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [48, 48]
                    position: center
                    color: '#aaa'
        pwa_57x57:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [57, 57]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [57, 57]
                    position: center
                    color: '#aaa'
        pwa_60x60:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [60, 60]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [60, 60]
                    position: center
                    color: '#aaa'
        pwa_72x72:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [72, 72]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [72, 72]
                    position: center
                    color: '#aaa'
        pwa_76x76:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [76, 76]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [76, 76]
                    position: center
                    color: '#aaa'
        pwa_96x96:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [96, 96]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [96, 96]
                    position: center
                    color: '#aaa'
        pwa_114x114:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [114, 114]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [114, 114]
                    position: center
                    color: '#aaa'
        pwa_120x120:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [120, 120]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [120, 120]
                    position: center
                    color: '#aaa'
        pwa_128x128:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [128, 128]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [128, 128]
                    position: center
                    color: '#aaa'
        pwa_144x144:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [144, 144]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [144, 144]
                    position: center
                    color: '#aaa'
        pwa_152x152:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [152, 152]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [152, 152]
                    position: center
                    color: '#aaa'
        pwa_180x180:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [180, 180]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [180, 180]
                    position: center
                    color: '#aaa'
        pwa_192x192:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [192, 192]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [192, 192]
                    position: center
                    color: '#aaa'
        pwa_256x256:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [256, 256]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [256, 256]
                    position: center
                    color: '#aaa'
        pwa_228x228:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [228, 228]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [228, 228]
                    position: center
                    color: '#aaa'
        pwa_384x384:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [384, 384]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [384, 384]
                    position: center
                    color: '#aaa'
        pwa_512x512:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [512, 512]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [512, 512]
                    position: center
                    color: '#aaa'
        pwa_1024x1024:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [1024, 1024]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [1024, 1024]
                    position: center
                    color: '#aaa'
        pwa_320x460:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [320, 460]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [320, 460]
                    position: center
                    color: '#aaa'
        pwa_640x920:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [640, 920]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [640, 920]
                    position: center
                    color: '#aaa'
        pwa_640x1096:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [640, 1096]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [640, 1096]
                    position: center
                    color: '#aaa'
        pwa_750x1294:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [750, 1294]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [750, 1294]
                    position: center
                    color: '#aaa'
        pwa_748x1024_landscape:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                rotate:
                    angle: 90
                thumbnail:
                    size: [748, 1024]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [748, 1024]
                    position: center
                    color: '#aaa'
        pwa_768x1004_portrait:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [768, 1004]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [768, 1004]
                    position: center
                    color: '#aaa'
        pwa_1182x2208_landscape:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                rotate:
                    angle: 90
                thumbnail:
                    size: [1182, 2208]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [1182, 2208]
                    position: center
                    color: '#aaa'
        pwa_1242x2148_landscape:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                rotate:
                    angle: 90
                thumbnail:
                    size: [1242, 2148]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [1242, 2148]
                    position: center
                    color: '#aaa'
        pwa_1242x2148_portrait:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [1242, 2148]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [1242, 2148]
                    position: center
                    color: '#aaa'
        pwa_1496x2048_landscape:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                rotate:
                    angle: 90
                thumbnail:
                    size: [1496, 2048]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [1496, 2048]
                    position: center
                    color: '#aaa'
        pwa_1536x2008_portrait:
            jpeg_quality: 85
            png_compression_level: 8
            filters:
                thumbnail:
                    size: [1536, 2008]
                    mode: inset
                    allow_upscale: true
                background:
                    size: [1536, 2008]
                    position: center
                    color: '#aaa'

```
