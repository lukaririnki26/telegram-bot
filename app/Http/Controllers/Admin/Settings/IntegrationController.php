<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Options;
use Illuminate\Http\Request;

class IntegrationController extends AdminController
{
    public function form()
    {
        $options = Options::where('entity_type', 'integration_settings')->get();

        $integration_settings = [];

        foreach($options as $option){
            $integration_settings[$option->key] = $option->value;
        }

        return view('settings.integration', compact('integration_settings'));
    }

    public function store(Request $request)
    {
        foreach($request->all() as $key => $value) {
            Options::updateOrCreate(
                [
                    'entity_type' => 'integration_settings',
                    'key' => $key
                ],
                [
                    'entity_type' => 'integration_settings',
                    'key' => $key,
                    'value' => $value
                ]
            );
        }

        return redirect()->route('settings.integration')
            ->with('success', "Success store integration settings");
    }
}
