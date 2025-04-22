<?php

namespace App\Helpers;

class imageHelper
{
    public static function uploadAndResize($file, $directory, $fileName, $width = null, $height = null)
    {
        // Tentukan lokasi penyimpanan file
        $destinationPath = public_path($directory);

        // Ambil ekstensi file
        $extension = strtolower($file->getClientOriginalExtension());

        // Inisialisasi variabel gambar
        $image = null;

        // Tentukan metode pembuatan gambar berdasarkan ekstensi file
        switch ($extension) {
            case 'jpeg':
            case 'jpg':
                $image = imagecreatefromjpeg($file->getRealPath());
                break;
            case 'png':
                $image = imagecreatefrompng($file->getRealPath());
                break;
            case 'gif':
                $image = imagecreatefromgif($file->getRealPath());
                break;
            default:
                throw new \Exception('Unsupported image type: ' . $extension);
        }

        // Jika imagecreatefromjpeg gagal, pastikan untuk menangani error
        if (!$image) {
            throw new \Exception('Failed to create image from file: ' . $file->getRealPath());
        }

        // Resize gambar jika lebar diset
        if ($width) {
            $oldWidth = imagesx($image);
            $oldHeight = imagesy($image);
            $aspectRatio = $oldWidth / $oldHeight;

            // Jika tinggi tidak diset, hitung tinggi berdasarkan lebar dengan mempertahankan aspek rasio
            if (!$height) {
                $height = $width / $aspectRatio;
            }

            // Membuat gambar baru dengan ukuran yang diinginkan
            $newImage = imagecreatetruecolor($width, $height);
            imagecopyresampled($newImage, $image, 0, 0, 0, 0, $width, $height, $oldWidth, $oldHeight);
            imagedestroy($image);
            $image = $newImage;
        }

        // Tentukan nama file dan simpan gambar dengan kualitas asli
        $filePath = $destinationPath . '/' . $fileName;

        switch ($extension) {
            case 'jpeg':
            case 'jpg':
                if (!imagejpeg($image, $filePath)) {
                    throw new \Exception('Failed to save JPEG image to ' . $filePath);
                }
                break;
            case 'png':
                if (!imagepng($image, $filePath)) {
                    throw new \Exception('Failed to save PNG image to ' . $filePath);
                }
                break;
            case 'gif':
                if (!imagegif($image, $filePath)) {
                    throw new \Exception('Failed to save GIF image to ' . $filePath);
                }
                break;
        }

        // Bersihkan memory yang digunakan oleh gambar
        imagedestroy($image);

        // Kembalikan nama file gambar yang disimpan
        return $fileName;
    }
}
