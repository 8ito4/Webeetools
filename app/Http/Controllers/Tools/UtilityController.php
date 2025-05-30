<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class UtilityController extends Controller
{
    public function json(): View
    {
        return view('tools.json');
    }

    public function password(): View
    {
        return view('tools.password');
    }

    public function base64(): View
    {
        return view('tools.base64');
    }

    public function qrcode(): View
    {
        return view('tools.qrcode');
    }

    public function email(): View
    {
        return view('tools.email');
    }

    public function document(): View
    {
        return view('tools.document');
    }

    public function sha256(): View
    {
        return view('tools.sha256');
    }

    public function xml(): View
    {
        return view('tools.xml');
    }

    public function pomodoro(): View
    {
        return view('tools.pomodoro');
    }

    public function lorem(): View
    {
        return view('tools.lorem');
    }

    public function networkTools(): View
    {
        return view('tools.network-tools');
    }

    public function whatsappLink(): View
    {
        return view('tools.whatsapp-link');
    }
} 