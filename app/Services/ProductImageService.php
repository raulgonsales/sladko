<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ProductImageService
{
    /**
     * Gets images with thumbnails to product gallery
     *
     * @param $images
     * @return array
     */
    public function getProductImagesWithThumbnails($images) {

        if(!$images || !count($images)) {
            $imagesCollection[] = [
                'image' => Storage::url('images/not-photo.png'),
                'thumb' => Storage::url('images/not-photo_thumb.png'),
                'image_descr' => 'Not image'
            ];

            return $imagesCollection;
        }

        $imagesCollection = [];

        foreach ($images as $image) {
            if($this->isPreview($image)
                || !$this->validateImagePath($image->url)
                || !$this->imageExist($image->url)
            ) {
                continue;
            }

            $imagesCollection[] = [
                'image' => Storage::url($image->url),
                'thumb' => $this->getImageThumb($image),
                'image_descr' => $image->description
            ];
        }

        return $imagesCollection;
    }

    /**
     * Checks if image exists in storage.
     *
     * @param $url
     * @return bool
     */
    public function imageExist($url) {
        return !!Storage::disk('public')->exists($url);
    }

    /**
     * Checks if image is product preview photo.
     *
     * @param $image
     * @return bool
     */
    public function isPreview($image) {
        return !!$image->product_preview;
    }

    /**
     * Gets product photo thumbnail from base image path.
     *
     * @param $image
     * @return mixed
     */
    public function getImageThumb($image) {
        $urlWithoutExtension = $this->getImageThumbUrl($image->url);

        return $this->imageExist($urlWithoutExtension)
            ? Storage::url($urlWithoutExtension)
            : Storage::url('images/not-photo_thumb.png');
    }

    /**
     * Validates image path.
     *
     * @param $url
     * @return bool
     */
    public function validateImagePath($url) {
        return !!preg_match("#^([/\w-.]+/){0,2}[/\w-.]+\.(jpg|png|jpeg)$#", $url);
    }

    /**
     * Returns image thumbnail url from base image url.
     *
     * @param $url
     * @return string
     */
    public function getImageThumbUrl($url) {
        $pathParts = pathinfo($url);
        return $pathParts['dirname'] . '/' . $pathParts['filename'] . '_thumb' . '.' . $pathParts['extension'];
    }
}