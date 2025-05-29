<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function documentation()
    {
        return view('pages.documentation');
    }

    public function support()
    {
        return view('pages.support');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function suggestions()
    {
        return view('pages.suggestions');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    // Páginas legais
    public function termosDeUso()
    {
        return view('pages.termos-de-uso');
    }

    public function politicaPrivacidade()
    {
        return view('pages.politica-privacidade');
    }

    public function cookies()
    {
        return view('pages.cookies');
    }

    public function licensa()
    {
        return view('pages.licensa');
    }
} 