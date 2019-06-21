<?php

namespace App\Http\Controllers;

use Artisan;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{

    public function index(Request $request)
    {
        $skins      = Storage::disk('skins')->directories();
        $currencies = config('currencies');
        $languages  = config('languages');
        $time_zones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);

        return view('settings.index', compact(
            'skins',
            'currencies',
            'languages',
            'time_zones'
        ));
    }

    public function update(Request $request)
    {

        $request->validate([
            'settings'                   => 'required',
            'settings.APP_URL'           => 'required|url',
            'settings.MAIL_FROM_ADDRESS' => 'nullable|email',
        ]);

        $settings = collect($request->settings)->filter(function ($value, $setting) {
            if (is_null($value)) {
                setting()->forget($setting);
            }
            return !is_null($value);
        });

        // Bool params
        $settings->put('SYSTEM_PROXY', $request->filled('settings.SYSTEM_PROXY'));
        $settings->put('CUSTOM_PROXY', $request->filled('settings.CUSTOM_PROXY'));

        setting($settings->all())->save();

        Artisan::call('config:clear');

        return redirect()->route('settings.index')
            ->with('success', __('Settings saved successfully'));
    }
}
