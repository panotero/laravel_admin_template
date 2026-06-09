<?php

namespace App\Services;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\ErrorCorrectionLevel;

class EndroidQrService
{
    public function generate(string $value, ?string $logoPath = null): string
    {
        $builder = Builder::create()
            ->writer(new PngWriter())
            ->data($value)
            ->size(300)
            ->margin(10)
            ->errorCorrectionLevel(ErrorCorrectionLevel::High); // ✅ correct v5 syntax

        if ($logoPath && file_exists($logoPath)) {
            $builder
                ->logoPath($logoPath)
                ->logoResizeToWidth(80);
        }

        return $builder->build()->getString();
    }
}
