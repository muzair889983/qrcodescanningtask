<?php

namespace App\Http\Controllers;

use App\Models\QrCodeResult;
use Illuminate\Http\Request;

class QrCodeResultController extends Controller
{
    public function store(Request $request)
    {
        QrCodeResult::create([
            'result' => $request->result,
        ]);

        return response()->json(['success' => 'QR Code result stored successfully']);
    }
}
