<?php

namespace Modules\TomatoProducts\App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use Modules\TomatoCategory\App\Models\Type;

class ProductAlertsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(\Modules\TomatoProducts\App\Models\Product $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-products::product-alerts.index',
        );
    }
}
