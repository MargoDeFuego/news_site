<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
{
    $articles = Article::orderBy('created_at', 'desc')->paginate(5);
    return view('articles.index', compact('articles'));
}
}
