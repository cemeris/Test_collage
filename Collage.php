<?php
class Collage
{
    private $single_width = 362;
    private $single_height = 544;
    private $gap = 10;
    private $im;

    public function create(string $dir_name) {
        $this->im = @imagecreatetruecolor($this->single_width * 5 + 40, $this->single_height * 2 + 10) or
            die("Cannot Initialize new GD image stream");
        imagesavealpha($this->im, true);
        $color = imagecolorallocatealpha($this->im, 0, 0, 0, 127);
        imagefill($this->im, 0, 0, $color);

        for ($i = 0; $i < 10; $i++) {
            $filename = $dir_name . '/' . ($i + 1) . '.png';
            if (!file_exists($filename))
                continue;
  
            $image_file = imagecreatefrompng($filename);
            $col = $i % 5;
            $x = $this->single_width * $col + $this->gap * $col;

            $row = ($i - $col) / 5;
            $y = $this->single_height * $row + $this->gap * $row;

            imagecopy($this->im, $image_file, $x, $y, 0, 0, $this->single_width, $this->single_height);
            imagedestroy($image_file);
        }

        return $this;
    }

    public function display() {
        header('Content-Type: image/png');
        imagepng($this->im);
        imagedestroy($this->im);
    }

    public function save(string $filename) {
        if (!empty($filename)) {
            imagepng($this->im, BASE . $filename);
            imagedestroy($this->im);
        }
    }
}