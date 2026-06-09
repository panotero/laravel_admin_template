<?php

namespace App\Services;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeService
{
    /**
     * Generate QR code with optional center logo (GD-based, no Imagick required)
     *
     * @param string $url
     * @param string|null $imgPath
     * @return string PNG binary
     */
    public function generate(string $url, ?string $imgPath = null): string
    {
        // 1. Generate base QR code (NO merge)
        $qrBinary = QrCode::format('svg')
            ->size(300)
            ->errorCorrection('H')
            ->generate($url);

        // If no logo, return QR directly
        if (!$imgPath || !file_exists($imgPath)) {
            return $qrBinary;
        }

        // 2. Create image resources
        $qrImage = imagecreatefromstring($qrBinary);

        // Support PNG logo with transparency
        $logo = imagecreatefromstring(file_get_contents($imgPath));

        if (!$qrImage || !$logo) {
            return $qrBinary; // fallback safety
        }

        // 3. QR dimensions
        $qrWidth = imagesx($qrImage);
        $qrHeight = imagesy($qrImage);

        // 4. Logo resize (20% of QR width)
        $logoWidth = imagesx($logo);
        $logoHeight = imagesy($logo);

        $newLogoWidth = $qrWidth * 0.2;
        $scale = $newLogoWidth / $logoWidth;
        $newLogoHeight = $logoHeight * $scale;

        $resizedLogo = imagecreatetruecolor($newLogoWidth, $newLogoHeight);

        // Preserve transparency
        imagealphablending($resizedLogo, false);
        imagesavealpha($resizedLogo, true);
        $transparent = imagecolorallocatealpha($resizedLogo, 0, 0, 0, 127);
        imagefill($resizedLogo, 0, 0, $transparent);

        // Resize logo
        imagecopyresampled(
            $resizedLogo,
            $logo,
            0,
            0,
            0,
            0,
            $newLogoWidth,
            $newLogoHeight,
            $logoWidth,
            $logoHeight
        );

        // 5. Center logo on QR
        $x = ($qrWidth - $newLogoWidth) / 2;
        $y = ($qrHeight - $newLogoHeight) / 2;

        imagecopy(
            $qrImage,
            $resizedLogo,
            $x,
            $y,
            0,
            0,
            $newLogoWidth,
            $newLogoHeight
        );

        // 6. Output final image
        ob_start();
        imagepng($qrImage);
        $output = ob_get_clean();

        // cleanup
        imagedestroy($qrImage);
        imagedestroy($logo);
        imagedestroy($resizedLogo);

        return $output;
    }
}
