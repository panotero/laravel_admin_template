<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\QrCodeService;
use App\Services\EndroidQrService;

class QrCodeController extends Controller
{

    protected EndroidQrService $qrService;

    public function __construct(EndroidQrService $qrService)
    {
        $this->qrService = $qrService;
    }

    public function generate(Request $request)
    {
        $request->validate([
            'value' => 'required|string',
            'img' => 'nullable|string',
        ]);

        // Default logo
        $logoPath = public_path('images/lenovologo.png');

        // Override if provided
        if ($request->filled('img')) {
            $custom = public_path($request->img);

            if (file_exists($custom)) {
                $logoPath = $custom;
            }
        }

        $qr = $this->qrService->generate(
            $request->value,
            $logoPath
        );

        return response($qr)
            ->header('Content-Type', 'image/png');
    }
}
