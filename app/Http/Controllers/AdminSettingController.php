<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index() {
        $files = Storage::files("login-background");

        $backgroundExtension = null;

        if (!empty($files)) {
            $firstFile = $files[0];
            $backgroundExtension = pathinfo($firstFile, PATHINFO_EXTENSION);
        }

        $props = [
            'backgroundExtension' => $backgroundExtension
        ];
        return view('admin.admin-settings', ['props' => $props]);
    }

    public function update(Request $request) {
        $attributes = $request->validate([
            'loginbg' => 'image|max:2048'
        ]);
        $extension = $attributes['loginbg']->getClientOriginalExtension();
        $filename = 'background.' . $extension;
        $attributes['loginbg']->storeAs('login-background', $filename);

        return redirect('/admin-dashboard/settings')->with('success', 'You changes have been saved');
    }
}
