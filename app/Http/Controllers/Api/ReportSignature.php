<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Signature;
use Illuminate\Http\Request;

class ReportSignature extends Controller
{
    public function update(Signature $signature)
    {
        $signature->flag();
        return $signature;
    }
}
