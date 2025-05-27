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

    public function contact(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'subject' => 'nullable|string|max:255',
                'message' => 'required|string',
            ]);


            return redirect()->route('contact')->with('success', 'Sua mensagem foi enviada com sucesso!');

        } else {
            return view('pages.contact');
        }
    }
} 