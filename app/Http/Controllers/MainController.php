<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $json = File::get(public_path('articles.json'));
        $articles = json_decode($json, true);

        return view('home', compact('articles'));
    }

    public function gallery($id)
    {
        $json = File::get(public_path('articles.json'));
        $articles = json_decode($json, true);

        $article = $articles[$id] ?? null;

        return view('gallery', compact('article'));
    }

    // Админка: форма добавления новости
    public function admin()
    {
        $json = File::get(public_path('articles.json'));
        $articles = json_decode($json, true);

        return view('admin.news', compact('articles'));
    }

    // Сохранение новой новости
    public function store(Request $request)
    {
        $json = File::get(public_path('articles.json'));
        $articles = json_decode($json, true);

        $articles[] = [
            'date' => now()->format('d.m.Y'),
            'name' => $request->input('name'),
            'preview_image' => $request->input('preview_image'),
            'full_image' => $request->input('full_image'),
            'shortDesc' => $request->input('shortDesc'),
            'desc' => $request->input('desc'),
        ];

        File::put(public_path('articles.json'), json_encode($articles, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));

        return redirect()->route('admin.news')->with('success', 'Новость добавлена');
    }

    public function galleryAdmin()
{
    $json = File::get(public_path('gallery.json'));
    $images = json_decode($json, true);

    return view('admin.gallery', compact('images'));
}

public function galleryStore(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        'desc'  => 'nullable|string',
    ]);

    // Загружаем файл в storage/app/public/images/gallery
    $path = $request->file('image')->store('images/gallery', 'public');

    // Читаем gallery.json
    $jsonPath = public_path('gallery.json');
    if (!File::exists($jsonPath)) {
        File::put($jsonPath, json_encode([], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
    }
    $json = File::get($jsonPath);
    $images = json_decode($json, true) ?? [];

    // Добавляем новую запись
    $images[] = [
        'title' => $request->input('title'),
        'path'  => 'storage/' . $path, // путь для asset()
        'desc'  => $request->input('desc'),
    ];

    File::put($jsonPath, json_encode($images, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));

    return redirect()->route('admin.gallery')->with('success', 'Изображение добавлено');
}
}
