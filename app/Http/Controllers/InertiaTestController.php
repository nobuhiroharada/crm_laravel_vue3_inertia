<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class InertiaTestController extends Controller
{
    public function index()
    {
        return Inertia::render('Inertia/Index');
    }

    public function show($id)
    {
        // dd($id);
        return Inertia::render('Inertia/Show',
            [
                'id' => $id,
            ]
        );
    }
}
