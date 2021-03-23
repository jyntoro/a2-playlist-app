<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuration;

class ConfigurationController extends Controller
{
    public function store(Request $request) {
        $configuration = new Configuration();
        $configuration->name = 'maintenance-mode';
        $configuration->value = boolval($request->input('maintenance-mode'));
        $configuration->save();

        return redirect()->route('admin.edit');
    }
}
