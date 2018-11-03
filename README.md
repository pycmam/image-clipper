## Image-clipper

Thumbnail generation microservice

Used [Intervention Image library](http://image.intervention.io/) for image processing. 

### Usage

1. `cp config/thumbnails.yaml-dist config/thumbnails.yaml`
1. `php -S localhost:8000 -t public/`
1. `GET http://localhost:8000/index.php/combined/hahaclassic.jpg`

URL parts:
* `combined` - thumbnail preset name
* `/hahaclassic.jpg` - relative path from source directory

### Requirements
* PHP >= 7.1
* Imagick or GD

### Available filters

[`blur`](#blur),
[`brightness`](#brightness),
[`contrast`](#contrast),
[`crop`](#crop),
[`fit`](#fit),
[`fixed`](#fixed),
[`flip`](#flip),
[`gamma`](#gamma),
[`greyscale`](#greyscale),
[`negative`](#negative),
[`opacity`](#opacity),
[`overlay`](#overlay),
[`pixelate`](#pixelate),
[`rotate`](#rotate),
[`sharpen`](#sharpen),
[`text`](#text)

#### Blur

Apply a gaussian blur filter with a optional amount on the current image.

Param|Type|Description
-----|----|-------
`amount`| `int`| The amount of the blur strength. Use values between 0 and 100. Default: 1


#### Brightness

Changes the brightness of the current image by the given level. Use values between -100 for min. brightness 0 for no change and +100 for max. brightness.

Param|Type|Description
-----|----|-------
`level`|`int` | Level of brightness change applied to the current image. Use values between -100 and +100.

#### Contrast

Changes the contrast of the current image by the given level.

Param|Type|Description
-----|----|-------
`level`| `int` | Level of contrast change applied to the current image. Use values between -100 and +100.

#### Crop

Cut out a rectangular part of the current image with given width and height. Define optional x,y coordinates to move the top-left corner of the cutout to a certain position.

Param|Type|Description
-----|----|-------
`width` | `int`| Width of the rectangular cutout
`height` | `int` | Height of the rectangular cutout.
`x`| `int` | X-Coordinate of the top-left corner if the rectangular cutout. By default the rectangular part will be centered on the current image.
`y`| `int` | Y-Coordinate of the top-left corner if the rectangular cutout. By default the rectangular part will be centered on the current image.


#### Fit

Combine cropping and resizing to format image in a smart way. The filter will find the best fitting aspect ratio of your given width and height on the current image automatically, cut it out and resize it to the given dimension.


Param|Type|Description
-----|----|-------
`width`|`int`| The width the image will be resized to after cropping out the best fitting aspect ratio.
`height`|`int`| The height the image will be resized to after cropping out the best fitting aspect ratio. If no height is given, method will use same value as width.
`position` | `string` | Set a position where cutout will be positioned. By default the best fitting aspect ration is centered.

Position possible values:
* top-left
* top
* top-right
* left
* center (default)
* right
* bottom-left
* bottom
* bottom-right

#### Fixed

Param|Type|Description
-----|----|-------
`width`|`int`| Required width
`height`|`int`| Required height
`position` | `string` | Set a position where cutout will be positioned. By default the best fitting aspect ration is centered.
`background`|`string`| Background color, default `#ffffff`. Can be used to specify the fill color of the empty area.


#### Flip

Mirror the current image horizontally or vertically by specifying the mode

Param|Type|Description
-----|----|-------
`axis`|`string(1)`| Specify the mode the image will be flipped. You can set `h` for horizontal (default) or `v` for vertical flip.

#### Gamma

Performs a gamma correction operation

Param|Type|Description
-----|----|-------
`correction`|`float`| Gamma compensation value.

#### Greyscale

Turns image into a greyscale version.

#### Negative

Reverses all colors

#### Opacity

Set the opacity in percent of the current image ranging from 100% for opaque and 0% for full transparency.

Param|Type|Description
-----|----|-------
`transparency`|`int`| The new percent of transparency for the current image.

#### Overlay

Paste a given image source over the current image with an optional position and a offset coordinate

Param|Type|Description
-----|----|-------
`path`|`string`| The image source that will inserted on top of the current image.
`position` | `string` | Set a position where image will be inserted.
`x` | Optional relative offset of the new image on x-axis of the current image. Offset will be calculated relative to the position parameter.
`y` | Optional relative offset of the new image on y-axis of the current image. Offset will be calculated relative to the position parameter.


#### Pixelate

Applies a pixelation effect to the current image with a given size of pixels.

Param|Type|Description
-----|----|-------
`size`|`int`| Size of the pixels.

#### Rotate

Rotate the current image counter-clockwise by a given angle. Optionally define a background color for the uncovered zone after the rotation.

Param|Type|Description
-----|----|-------
`angle`|`float`| The rotation angle in degrees to rotate the image counter-clockwise.
`background`|`string`| A background color for the uncovered zone after the rotation. Default `#ffffff` or transparent.

#### Sharpen

Sharpen current image with an optional amount.

Param|Type|Description
-----|----|-------
`amount`|`int`| The amount of the sharpening strength. Filter accepts values between 0 and 100. Default: 10

#### Text

Write a text string to the current image at an optional x,y basepoint position

Param|Type|Description
-----|----|-------
`text`|`string`| The text string that will be written to the image.
`x`|`int`| x-ordinate defining the basepoint of the first character.
`y`|`int`| y-ordinate defining the basepoint of the first character.
`align`|`string`| Set horizontal text alignment relative to given basepoint. Possible values are `left`, `right` and `center`.
`valign`|`string`| Set vertical text alignment relative to given basepoint. Possible values are `top`, `bottom` and `middle`.
`font`|`string`| Set path to a True Type Font file
`size`|`int`| Set font size in pixels. Font sizing is only available if a font file is set and will be ignored otherwise.
`color`|`string`| Set color of the text
`angle`|`int`| Set rotation angle of text in degrees. Text will be rotated counter-clockwise around the vertical and horizontal aligned point. Rotation is only available if a font file is set and will be ignored otherwise.


### Thumbnails presets configuration

Sample configuration in: [config/thumbnails.yml-dist](/config/thumbnails.yaml-dist)
