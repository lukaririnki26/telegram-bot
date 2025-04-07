<?php

namespace App\Http\Controllers\Site;

use App\Models\Posts;
use App\Services\Payfren;

/**
 * Class Home
 */
class HomeController extends SiteController
{
    /**
     * Home Index
     */
    public function index()
    {
        $data = [
            'posts' => Posts::paginate(5),
        ];

        return view('home', $data);
    }
}
