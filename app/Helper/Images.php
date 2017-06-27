<?php
    /**
     * Created by PhpStorm.
     * User: Admin
     * Date: 6/18/2017
     * Time: 11:00 PM
     */

    namespace App\Helper;
    use Intervention\Image\ImageManager;
    use Symfony\Component\HttpFoundation\File\File as SymfonyFile;

    class Images
    {
        use StaticHelperTrait;
        /**
         * @var $config
         */
        private $config;

        /**
         * @var Intervention\Image\ImageManager
         */
        private $imageManager;

        /**
         * @var $outputDir
         */
        private $outputDir;

        /**
         * @var $baseDir
         */
        private $baseDir;

        /**
         * @var $noPhoto
         */
        private $noPhoto;

        /**
         * @var $imageQuality
         */
        private $imageQuality;

        /**
         * @var $watermark
         */
        private $watermark;
        /**
         * @var $method
         */
        private $method;
        /**
         * @var $fdNameOriginal
         */
        private $fdNameOriginal;
        /**
         * @var $newNameImg
         */
        private $newNameImg;

        public function __construct($method, $moduleName, $newNameImg, $pathGet, $pathSet, $watermark = ['image' => 'images/logo.png', 'position' => 'center'], $imageQuality = 100)
        {
            $this->config           = app()['config'];

            $this->imageManager     = new ImageManager([
                'driver' => 'gd'
            ]);

            $this->baseDir          = $pathGet;
            $this->outputDir        = $pathSet;
            $this->noPhoto          = 'images/no-image-small.png';
            $this->imageQuality     = $imageQuality;
            $this->watermark        = $watermark;
            $this->method           = $method;
            $this->fdNameOriginal   = $moduleName;
            $this->newNameImg       = $newNameImg;
        }

        /**
         * Resize image
         *
         * @param  int $width Thumbnail width
         * @param  int $height Thumbnail height
         * @param  string $fileName Source file name
         * @return \Response Image content
         */
        public function resize()
        {
            foreach ($this->method as $item) {
                $method = $item['method'];
                $width = $item['width'];
                $height = $item['height'];
                $destFile = $this->createThumb($method, $width, $height, $this->newNameImg);
                $fileContent = $this->getFileContent($destFile);
                $file = new SymfonyFile($destFile);

                response()->make($fileContent, 200, [
                    'content-type' => $file->getMimeType()
                ]);
            }
        }

        /**
         * Create thumbnail
         *
         * @param  string method create image
         * @param  int $width Image width
         * @param  int $height Image height
         * @param  string $fileName Source file name
         * @return string Path to file resized
         */
        private function createThumb($method, $width, $height, $fileName)
        {
            $inputFilePath = sprintf('%s/%s', 'images/'.$this->baseDir, $fileName);
            $destFilePath = $this->getDestFilePath($method, $width, $height, $fileName);

            if ($this->isFile($destFilePath)) {
                return $destFilePath;
            } elseif (!$this->isFile($inputFilePath)) {
                return $this->noPhoto;
            }

            $thumbImage = $this->imageManager->make($inputFilePath);

            if ($this->watermark['image'] && $this->isFile($this->watermark['image'])) {
                $thumbImage = $this->addWatermark($thumbImage);
            }
            $thumbImage->$method($width, $height);

            try {
                $thumbImage->save($destFilePath, $this->imageQuality);
            } catch (\Exception $e) {
                $this->writeLog($e->getMessage());

                $destFilePath = $this->noPhoto;
            }

            return $destFilePath;
        }

        /**
         * Get destination file path
         *
         * @param  int $width Thumbnail width
         * @param  int $height Thumbnail height
         * @param  int $fileName Source file name
         * @return string Destination thumbnail path
         */
        private function getDestFilePath($method, $width, $height, $fileName)
        {
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            $thumbFolder = sprintf('%s(%sx%s)', $method, $width, $height);
            $destDir = sprintf('%s/%s', 'images/'.$this->outputDir, $thumbFolder);

            if (!$this->isDirectory($destDir)) {
                $this->makeDirectory($destDir);
            }
            //$thumbFileName = sprintf('%s.%s', $fileName, $fileExtension);

            return sprintf('%s/%s', $destDir, $fileName);
        }

        /**
         * Add watermark to image
         *
         * @param object $imageObj Intervention image object
         * @return object Intervention image object
         */
        private function addWatermark($imageObj)
        {
            $imageObj->insert($this->watermark['image'], $this->watermark['position']);

            return $imageObj;
        }
    }