<?php

namespace App\Http\Controllers;

use App\Models\HelpContent;
use Illuminate\Http\Request;

class HelpCenterController extends Controller
{
    public function index()
    {
        $helpTopics = HelpContent::all();
        return view('helpCenter', compact('helpTopics'));
    }

    public function show($id)
    {
        $helpContent = HelpContent::findOrFail($id);
        return view('HC1', compact('helpContent'));
    }
}
