<?php

namespace App\Http\Controllers;

use App\Models\Rw;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactPublicController extends Controller
{
    public function index(): View
    {
        $settings = Setting::getSettings();
        
        $rws = Rw::where('status', 'terbit')
            ->orderBy('nomor_rw')
            ->get();

        return view('kontak', compact('settings', 'rws'));
    }
}
