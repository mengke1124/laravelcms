<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Navigation;

/**
 * 文章控制器
 *
 * Class ArticleController
 * @package App\Http\Controllers
 */
class ArticleController extends Controller
{

    /**
     * 分类
     *
     * @param int $navigation
     * @param Category $articleCategory
     * @param Article $article
     * @return mixed
     */
    public function category($navigation = 0, Category $articleCategory, Article $article)
    {
        $category = $articleCategory;
        $articles = [];
        $articles = $articleCategory->articles()->ordered()->recent()->paginate(10);

        return frontend_view('category.'.$articleCategory->getTemplate('index'), compact('navigation','category','articles'));
    }

    /**
     * 列表
     *
     * @param int $navigation
     * @param Category $articleCategory
     * @param Article $article
     * @return mixed
     */
    public function index($navigation = 0, Category $articleCategory, Article $article)
    {
        $category = $articleCategory;
        $articles = $category->articles()->active()->ordered()->recent()->paginate(10);

        return frontend_view('article.'.$articleCategory->getTemplate('list'), compact('navigation','category','articles'));
    }

    /**
     * 详情
     *
     * @param int $navigation
     * @param int $category
     * @param Article $safeArticle
     * @return mixed
     */
    public function show($navigation = 0, $category = 0, Article $safeArticle)
    {
        $article = $safeArticle;
        $article->increment('views');

        return frontend_view('article.'.$article->getTemplate($category), compact('article'));
    }

}
