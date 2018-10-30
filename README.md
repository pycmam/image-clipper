## Image-clipper

Thumbnail generation microservice

### Usage

1. `php -S localhost:8000 -t public/`
1. `GET http://localhost:8000/combined/hahaclassic.jpg`

URL parts:
* `combined` - thumbnail preset name
* `/hahaclassic.jpg` - relative path from source directory

### Requirements
* PHP >= 7.1
* Imagick

### Available filters

Filter           |Description
-----------------|----------
`blur`           | Blur the image
`brightness`     | Changes the brightness of the image
`fit`            | Fit image to box
`fixed`          | 
`flip`           | Flips current image using vertical or horizontal axis
`gamma`          | Apply gamma correction
`grayscale`      | Grayscale the image
`negative`       | Invert the colors of the image
`overlay`        | Paste overlay (watermark) into image
`rotate`         | Rotates an image at the given angle
`sharpen`        | Sharpens the image

#### Blur

Param|Type|Description
-----|----|-------
`sigma`| `int` or `float`|


#### Brightness

Param|Type|Description
-----|----|-------
`brightness`|`int` |The level of brightness (-100 (black) to 100 (white))


#### Fit

Param|Type|Description
-----|----|-------
`width`|`int`| Max width
`height`|`int`| Max height


#### Fixed

Param|Type|Description
-----|----|-------
`width`|`int`| Required width
`height`|`int`| Required height
`background`|`string`| Background color, default `#ffffff`. Can be used to specify the fill color of the empty area.
`alfa`|`int`|Background alfa level, default `100`

#### Flip

Param|Type|Description
-----|----|-------
`axis`|`string(1)`| Flip axis, `v` for vertical flip, `h` for horizontal

#### Gamma

Param|Type|Description
-----|----|-------
`correction`|`float`| Gamma correction

#### Overlay

Param|Type|Description
-----|----|-------
`path`|`string`| Path to overlay image

#### Rotate

Param|Type|Description
-----|----|-------
`angle`|`int`| Rotate angle
`background`|`string`| Background color, default `#ffffff`. Can be used to specify the fill color of the empty area.
`alfa`|`int`|Background alfa level, default `100`


### Thumbnails presets configuration

Sample configuration in: [config/thumbnails.yml-dist](/config/thumbnails.yaml-dist)

```yaml

parameters:
  thumbnails:

    # directories configuration
    directories:
      source: "%kernel.project_dir%/public/images"
      destination: "%kernel.project_dir%/public/thumbnails"

    # default presets config
    preset_defaults:
      quality:
        jpeg_quality: 85
        png_compression_level: 5
        flatten: true

    # presets config
    presets:

      blur:
        filters:
          - name: blur
            sigma: 2

      brightness_dark:
        filters:
          - name: brightness
            brightness: -30

      brightness_light:
        filters:
          - name: brightness
            brightness: 30

      fit:
        filters:
          - name: fit
            width: 150
            height: 150

      fixed:
        filters:
          - name: fixed
            width: 400
            height: 200

      flip_h:
        filters:
          - name: flip
            axis: h

      flip_v:
        filters:
          - name: flip
            axis: v

      gamma:
        filters:
          - name: gamma
            correction: 10

      grayscape:
        filters:
          - name: grayscale

      negative:
        filters:
          - name: negative

      overlay:
        filters:
          - name: overlay
            path: "%kernel.project_dir%/public/images/overlay.png"

      rotate:
        filters:
          - name: rotate
            angle: 45

      sharpen:
        filters:
          - name: sharpen

      combined:
        filters:
          - name: fit
            width: 150
            height: 150

          - name: blur
            sigma: 1

          - name: grayscale

          - name: overlay
            path: "%kernel.project_dir%/public/images/overlay.png"
```