<?php
    /**
     * Created by PhpStorm.
     * User: Admin
     * Date: 6/18/2017
     * Time: 10:30 PM
     */

    namespace App\Helper;
    use Intervention\Image\ImageManager;

    class Image
    {
        /**
         * Instance của Intervention\Image\ImageManager
         */
        private $imageManager;

        /**
         * Đường dẫn đến file sẽ resize
         */
        private $imagePath;

        /**
         * Tỷ lệ ảnh.
         * Dành cho trường hợp chỉ sử dụng width của ảnh thumbnail
         */
        private $thumbRate;

        /**
         * Width của ảnh thumb
         */
        private $thumbWidth;

        /**
         * Height của ảnh thumb
         */
        private $thumbHeight;

        /**
         * Thư mục sẽ chứa ảnh đã được resize
         */
        private $destPath;

        /**
         * Tọa độ X. Cho trường hợp crop ảnh
         */
        private $xCoordinate;

        /**
         * Tọa độ Y. Cho crop ảnh
         */
        private $yCoordinate;

        /**
         * Vị trí sẽ dùng cho cả 2 trường hợp crop và resize. Là fit
         */
        private $fitPosition;

        /**
         * Tên ảnh thumb sẽ được lưu
         */
        private $fileName;

        public function __construct()
        {
            /**
             * Khởi tạo instance của Intervention Image.
             * Hỗ trợ 2 image extension của PHP. là Imagik và GD
             * Mình dùng GD.
             */
            $this->imageManager = new ImageManager([
                'driver' => 'gd'
            ]);

            /**
             * Tỷ lệ ảnh.
             * Mặc định sẽ là tỉ lệ 3/4 (1024x768, 800x600, ..)
             */
            $this->thumbRate = 0.75;
            // Tọa độ X
            $this->xCoordinate = null;
            // Tọa độ Y
            $this->yCoordinate = null;
            // Vị trí sẽ dùng để crop và resize
            $this->fitPosition = 'center';
        }

        /**
         * @param string $imagePath Đường dẫn đến ảnh cần resize
         * @return App\Services\ThumbnailService
         */
        public function setImage($imagePath)
        {
            $this->imagePath = $imagePath;

            return $this;
        }

        /**
         * @return string $imagePath
         */
        public function getImage()
        {
            return $this->imagePath;
        }

        /**
         * @param double Tỷ lệ ảnh sẽ resize
         * @return App\Services\ThumbnailService
         */
        public function setRate($rate)
        {
            $this->thumbRate = $rate;

            return $this;
        }

        /**
         * @return double $thumbRate
         */
        public function getRate()
        {
            return $this->thumbRate;
        }

        /**
         * @param integer $thumbWidth
         * @param integer $thumbHeight
         * @return App\Services\ThumbnailService
         */
        public function setSize($width, $height = null)
        {
            $this->thumbWidth = $width;
            $this->thumbHeight = $height;

            /**
             * Nếu $height là null thì dùng tỉ lệ ảnh
             */
            if (is_null($height)) {
                $this->thumbHeight = ($this->thumbWidth * $this->thumbRate);
            }

            return $this;
        }

        /**
         * @return array Mảng chứa $thumbWidth và $thumbHeight
         */
        public function getSize()
        {
            return [$this->thumbWidth, $this->thumbHeight];
        }

        /**
         * @param string $destPath Đường dẫn sẽ lưu ảnh
         * @return App\Services\ThumbnailService
         */
        public function setDestPath($destPath)
        {
            $this->destPath = $destPath;

            return $this;
        }

        /**
         * @return string $destPath
         */
        public function getDestPath()
        {
            return $this->destPath;
        }

        /**
         * @param integer $xCoord Tọa độ X
         * @param integer $yCoord Tọa độ Y
         * @return App\Services\ThumbnailService
         */
        public function setCoordinates($xCoord, $yCoord)
        {
            $this->xCoordinate = $xCoord;
            $this->yCoordinate = $yCoord;

            return $this;
        }

        /**
         * @return array Mảng tọa độ X-Y
         */
        public function getCoordinates()
        {
            return [$this->xCoordinate, $this->yCoordinate];
        }

        /**
         * @param string Vị trí dùng để fit
         * @return App\Services\ThumbnailService
         */
        public function setFitPosition($position)
        {
            $this->fitPosition = $position;

            return $this;
        }

        /**
         * @return string $fitPosition
         */
        public function getFitPosition()
        {
            return $this->fitPosition;
        }

        /**
         * @param string Tên file sẽ lưu sau khi resize
         * @return App\Services\ThumbnailService
         */
        public function setFileName($fileName)
        {
            $this->fileName = $fileName;

            return $this;
        }

        /**
         * @return string $fileName
         */
        public function getFileName()
        {
            return $this->fileName;
        }

        /**
         * @param string $type Kiểu ảnh thumb. fit, crop hoặc resize
         * @param integer $quality Chất lượng ảnh thumbnail
         * @return mixed Tên file đã resize hoặc false khi xảy ra lỗi
         */
        public function save($type = 'fit', $quality = 80)
        {
            // Lấy tên file sẽ lưu từ file sẽ resize
            $fileName = pathinfo($this->imagePath, PATHINFO_BASENAME);

            /**
             * Nếu property $this->fileName không null (đã được set)
             * Sử dụng nó :D
             */
            if ($this->fileName) {
                $fileName = $this->fileName;
            }

            // Ghép $this->destPath và $fileName lại để có được vị trí file thumb sẽ được lưu
            $destPath = sprintf('%s/%s', trim($this->destPath, '/'), $fileName);

            /**
             * Tạo đối tượng ảnh từ Intervention Image Manage
             * Với đối tượng này, chúng ta có thể thao tác được hầu hết
             * các function mà Intervention Image hỗ trợ
             * Chi tiết các bạn có thể vào trang chủ của nó để xem
             */
            $thumbImage = $this->imageManager->make($this->imagePath);

            /**
             * Kiểm tra kiểu ảnh thumb được dùng. Mặc định sẽ là fit
             * Mỗi kiểu sẽ sử dụng các tham số phù hợp
             */
            switch ($type) {
                case 'resize':
                    $thumbImage->resize($this->thumbWidth, $this->thumbHeight);
                    break;
                case 'crop':
                    $thumbImage->crop($this->thumbWidth, $this->thumbHeight, $this->xCoordinate, $this->yCoordinate);
                    break;
                default:
                    $thumbImage->fit($this->thumbWidth, $this->thumbHeight, null, $this->fitPosition);
            }

            // Đặt bẫy cho chắc :D
            try {

                // Lưu xuống disk
                $thumbImage->save($destPath, $quality);
            } catch (\Exception $e) {
                // Log lại lỗi rồi trả false
                \Log::error($e->getMessage());

                return false;
            }

            // Lưu thành công rồi. Trả về đường dẫn tới ảnh đã lưu
            return $destPath;
        }
    }