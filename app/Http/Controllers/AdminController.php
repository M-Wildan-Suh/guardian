<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class AdminController extends Controller
{
    public function dashboard() {
        return view('admin.dashboard');
    }

    public function code() {
        $data = json_decode(Storage::get('website.json'), true);
        $code = $data['code'] ?? null;
        return view('admin.code', compact('code'));
    }

    public function codestore(Request $request) {
        $request->validate([
            'code' => 'required|string|max:255',
        ]);

        $existingData = [];
        if (Storage::exists('website.json')) {
            $existingData = json_decode(Storage::get('website.json'), true);
        }
        $newData = ['code' => $request->code];

        $mergedData = array_merge($existingData, $newData);

        Storage::put('website.json', json_encode($mergedData));

        session(['logged_in_code' => $request->code]);

        return redirect()->route('dashboard');
    }

    public function website() {
        $data = json_decode(Storage::get('website.json'), true);

        $item = new \stdClass();

        $item->icon = $data['icon'] ?? null;
        $item->type = $data['type'] ?? null;
        $item->title = $data['title'] ?? null;
        $item->image = $data['image'] ?? null;
        
        return view('admin.website', compact('item'));
    }

    public function websitestore(Request $request) {
        $request->validate([
            'type' => 'required|string|max:255',
        ]);

        $existingData = [];
        if (Storage::exists('website.json')) {
            $existingData = json_decode(Storage::get('website.json'), true);
        }

        $icon = $existingData['icon'] ?? null;
        if ($request->hasFile('icon')) {
            
            if (!empty($icon)) {
                $oldImagePath = public_path('storage/images/' . $icon);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $imageFile = $request->file('icon');
            $imageName = time();
            $imagePath = public_path('storage/images/');

            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0755, true);
            }

            $manager = new ImageManager(new Driver());
            $image = $manager->read($imageFile->getPathname());
            $imageFullPath = $imagePath . $imageName . '-ico.webp';
            $image->save($imageFullPath);

            $icon = $imageName . '-ico.webp';
        }
        
        
        $type = $request->type;
        $title = $request->input('title');

        $image = $existingData['image'] ?? null;
        if ($request->hasFile('image') && $request->type === 'image') {

            if (!empty($image)) {
                $oldImagePath = public_path('storage/images/' . $image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $imageFile = $request->file('image');
            $imageName = time();
            $imagePath = public_path('storage/images/');

            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0755, true);
            }

            $manager = new ImageManager(new Driver());
            $image = $manager->read($imageFile->getPathname());
            $imageFullPath = $imagePath . $imageName . '-img.webp';
            $image->save($imageFullPath);

            $image = $imageName . '-img.webp';
        }

        $newData = [
            'icon' => $icon,
            'type' => $type,
            'title' => $title,
            'image' => $image,
        ];
        
        $mergedData = array_merge($existingData, $newData);
        
        Storage::put('website.json', json_encode($mergedData));

        return redirect()->route('dashboard');
    }
    
    public function template() {
        $data = json_decode(Storage::get('website.json'), true);
        $template = $data['template'] ?? null;

        $templates = json_decode(Storage::get('template.json'), true);
        return view('admin.template', compact('template', 'templates'));
    }

    public function templatestore(Request $request) {
        $request->validate([
            'template' => 'required|string|max:255',
        ]);

        $existingData = [];
        if (Storage::exists('website.json')) {
            $existingData = json_decode(Storage::get('website.json'), true);
        }

        $newData = ['template' => $request->template];

        $mergedData = array_merge($existingData, $newData);

        Storage::put('website.json', json_encode($mergedData));

        return redirect()->route('dashboard');
    }

    public function login() {
        if (session()->has('logged_in_code') || session('logged_in_code')) {
            return redirect()->route('dashboard');
        }
        return view('admin.login');
    }

    public function loginstore(Request $request) {
        $existingData = [];
        if (Storage::exists('website.json')) {
            $existingData = json_decode(Storage::get('website.json'), true);
        }

        if ($request->code === $existingData['code']) {
            session(['logged_in_code' => $request->code]);

            return redirect()->route('dashboard');
        } else {
            return redirect()->back();
        }
    }

    public function register() {
        $data = json_decode(Storage::get('website.json'), true);

        if ($data && $data['code']) {
            return redirect()->route('login');
        }
        return view('admin.register');
    }

    public function registerstore(Request $request) {
        $request->validate([
            'code' => 'required|string|max:255',
        ]);

        Storage::put('website.json', json_encode(['code' => $request->code]));

        session(['logged_in_code' => $request->code]);

        return redirect()->route('dashboard');
    }

    public function logout() {
        session()->forget('logged_in_code');
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}
