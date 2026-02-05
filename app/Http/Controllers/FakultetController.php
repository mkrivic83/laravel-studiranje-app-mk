<?php

namespace App\Http\Controllers;
use App\Models\Fakultet;
use Illuminate\Http\Request;

class FakultetController extends Controller
{
    public function index()
    {
        $fakulteti = Fakultet::orderBy('naziv')->get();
        return view('fakulteti.index', compact('fakulteti'));
    }
}
