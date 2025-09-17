<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function home() {
        // return view('guest.home');
        $data = json_decode(Storage::get('website.json'), true);
        
        $url = 'https://bizlink.sites.id/api/article/'.$data['code'];

        $response = Http::get($url);

        if ($response->successful()) {
            $api = $response->object(); // mengubah hasil response jadi object

            // Akses datanya jika perlu
            $data = $api->data->data;
            $currentPage = $api->data->current_page;
            $lastPage = $api->data->last_page;

            $trend = $api->trend;

            $category = $api->categories;

            $url = url('/artikel/page/');

            return view('guest.home', compact('data', 'currentPage', 'lastPage', 'url', 'trend', 'category'));
        } else {
            return redirect()->route('notfound');
        }
    }

    public function article(Request $request, $page = null) {
        $data = json_decode(Storage::get('website.json'), true);
        
        if ($request->search) {
            $url = 'https://bizlink.sites.id/api/article/' . $data['code'] . ($page || $request->search ? '?' : '') . ($page ? 'page='.$page : '') . ($page && $request->search ? '&' : '') . 'search=' . ($request->search);
            $title = 'Pecaharian : ' . $request->search;
        } else {
            $url = 'https://bizlink.sites.id/api/article/'. $data['code'] . ($page ? '?page='.$page : '');
            $title = 'Artikel Terbaru';
        }

        // dd($url);

        $response = Http::get($url);

        if ($response->successful()) {
            $api = $response->object();

            // Akses datanya jika perlu
            $data = $api->data->data;
            $currentPage = $api->data->current_page;
            $lastPage = $api->data->last_page;

            $url = url('/artikel/page/');

            $category = $api->categories;

            return view('guest.article', compact('title', 'data', 'currentPage', 'lastPage', 'url', 'category'));
        } else {
            return redirect()->route('notfound');
        }
    }
    
    public function author($username, $page = null) {
        $data = json_decode(Storage::get('website.json'), true);

        $url = 'https://bizlink.sites.id/api/article/user/'.$username.'/'. $data['code'] . ($page ? '?page='.$page : '');

        $response = Http::get($url);

        if ($response->successful()) {
            $api = $response->object(); // mengubah hasil response jadi object

            // Akses datanya jika perlu
            $data = $api->data->data;
            $currentPage = $api->data->current_page;
            $lastPage = $api->data->last_page;

            $title = 'Penulis : '.$api->user;

            $url = url('/penulis/'.$username.'/page/');
            
            $category = $api->categories;

            return view('guest.article', compact('title', 'data', 'currentPage', 'lastPage', 'url', 'category'));
        } else {
            return redirect()->route('notfound');
        }
    }
    
    public function category($category, $page = null) {
        $data = json_decode(Storage::get('website.json'), true);

        $url = 'https://bizlink.sites.id/api/article/category/'.$category.'/' . $data['code'] . ($page ? '?page='.$page : '');

        $response = Http::get($url);

        if ($response->successful()) {
            $api = $response->object(); // mengubah hasil response jadi object

            // Akses datanya jika perlu
            $data = $api->data->data;
            $currentPage = $api->data->current_page;
            $lastPage = $api->data->last_page;

            $title = 'Kategori : '.$api->category;

            $url = url('/kategori/'.$category.'/page/');

            $category = $api->categories;

            return view('guest.article', compact('title', 'data', 'currentPage', 'lastPage', 'url', 'category'));
        } else {
            return redirect()->route('notfound');
        }
    }

    public function tag($tag, $page = null) {
        $data = json_decode(Storage::get('website.json'), true);

        $url = 'https://bizlink.sites.id/api/article/tag/'.$tag.'/'. $data['code'] . ($page ? '?page='.$page : '');

        $response = Http::get($url);

        if ($response->successful()) {
            $api = $response->object(); // mengubah hasil response jadi object

            // Akses datanya jika perlu
            $data = $api->data->data;
            $currentPage = $api->data->current_page;
            $lastPage = $api->data->last_page;

            $title = 'Tag : '.$api->tag;

            $url = url('/tag/'.$tag.'/page/');

            $category = $api->categories;

            return view('guest.article', compact('title', 'data', 'currentPage', 'lastPage', 'url', 'category'));
        } else {
            return redirect()->route('notfound');
        }
    }

    public function detail($slug) {
        $data = json_decode(Storage::get('website.json'), true);

        $url = 'https://bizlink.sites.id/api/article/slug/'.$slug.'/'.$data['code'];

        $response = Http::get($url);

        if ($response->successful()) {
            $api = $response->object(); // mengubah hasil response jadi object

            // Akses datanya jika perlu
            $data = $api->data;

            $data->date = Carbon::parse($data->created_at)->locale('id')->translatedFormat('d F Y');

            $data->articleshowgallery = collect($data->articleshowgallery);

            $template = $data->template;

            $category = $api->categories;

            return view('guest.detail', compact('data', 'template', 'category'));
        } else {
            return redirect()->route('notfound');
        }
    }

    public function notfound() {
        $data = json_decode(Storage::get('website.json'), true);

        $url = 'https://bizlink.sites.id/api/article/notfound/'.$data['code'];

        $response = Http::get($url);

        if ($response->successful()) {
            $api = $response->object();

            $category = $api->categories;

            return view('guest.page-not-found', compact('category'));
        } else {
            return redirect()->route('notfound');
        }
    }
}
