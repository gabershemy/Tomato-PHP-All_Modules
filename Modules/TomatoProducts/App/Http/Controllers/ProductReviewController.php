<?php

namespace Modules\TomatoProducts\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\TomatoProducts\App\Transformers\ProductReviewsResource;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class ProductReviewController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \Modules\TomatoProducts\App\Models\ProductReview::class;
    }

    /**
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'tomato-products::product-reviews.index',
            table: \Modules\TomatoProducts\App\Tables\ProductReviewTable::class,
            resource: ProductReviewsResource::class
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function api(Request $request): JsonResponse
    {
        return Tomato::json(
            request: $request,
            model: \Modules\TomatoProducts\App\Models\ProductReview::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-products::product-reviews.create',
        );
    }

    /**
     * @param \Modules\TomatoProducts\App\Http\Requests\ProductReview\ProductReviewStoreRequest $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(\Modules\TomatoProducts\App\Http\Requests\ProductReview\ProductReviewStoreRequest $request): RedirectResponse|JsonResponse
    {
        $response = Tomato::store(
            request: $request,
            model: \Modules\TomatoProducts\App\Models\ProductReview::class,
            message: __('ProductReview updated successfully'),
            redirect: 'admin.product-reviews.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return back();
    }

    /**
     * @param \Modules\TomatoProducts\App\Models\ProductReview $model
     * @return View|JsonResponse
     */
    public function show(\Modules\TomatoProducts\App\Models\ProductReview $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-products::product-reviews.show',
            resource: ProductReviewsResource::class
        );
    }

    /**
     * @param \Modules\TomatoProducts\App\Models\ProductReview $model
     * @return View
     */
    public function edit(\Modules\TomatoProducts\App\Models\ProductReview $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-products::product-reviews.edit',
        );
    }

    /**
     * @param \Modules\TomatoProducts\App\Http\Requests\ProductReview\ProductReviewUpdateRequest $request
     * @param \Modules\TomatoProducts\App\Models\ProductReview $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(\Modules\TomatoProducts\App\Http\Requests\ProductReview\ProductReviewUpdateRequest $request, \Modules\TomatoProducts\App\Models\ProductReview $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            message: __('ProductReview updated successfully'),
            redirect: 'admin.product-reviews.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return back();
    }

    /**
     * @param \Modules\TomatoProducts\App\Models\ProductReview $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\TomatoProducts\App\Models\ProductReview $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('ProductReview deleted successfully'),
            redirect: 'admin.product-reviews.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return back();
    }
}
