<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Options;
use Illuminate\Http\Request;

class GeneralController extends AdminController
{
    public function form()
    {
        $options = Options::where('entity_type', 'general_settings')->get();

        foreach($options as $option){
            $general_settings[$option->key] = $option->value;
        }

        return view('settings.general', compact('general_settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'site_name' => 'required|max:255',
        ]);

        foreach($request->all() as $key => $value) {
            Options::updateOrCreate(
                [
                    'entity_type' => 'general_settings',
                    'key' => $key
                ],
                [
                    'entity_type' => 'general_settings',
                    'key' => $key,
                    'value' => $value
                ]
            );
        }

        return redirect()->route('settings.general')
            ->with('success', "Success store general settings");
    }
}
