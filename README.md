## Image-clipper

Thumbnail generation microservice

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

`config/thumbnails.yaml`

