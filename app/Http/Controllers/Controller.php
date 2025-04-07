<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

/**
 * App Controller Class
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected ?string $slugPath = null;

    public function __construct()
    {
        if (! is_null($this->slugPath)) {
            $this->slugPath = strtolower($this->slugPath);

            $theme = Config::get($this->slugPath.'.theme');

            View::addLocation(base_path().'/resources/themes/'.$this->slugPath.'/'.$theme.'/layouts/');
            View::addLocation(base_path().'/resources/themes/'.$this->slugPath.'/'.$theme.'/views/');
        }
    }
}
