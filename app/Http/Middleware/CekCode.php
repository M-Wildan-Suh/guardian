<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CekCode
{
    public function handle(Request $request, Closure $next)
    {
        if (!Storage::exists('website.json')) {
            return redirect()->route('register');
        }

        $data = json_decode(Storage::get('website.json'), true);

        // Jika file ada tapi 'code' tidak ada atau kosong
        if (empty($data['code'])) {
            return redirect()->route('register');
        }

        if (empty($data['template'])) {
            return redirect()->route('template');
        }

        return $next($request);
    }
}
