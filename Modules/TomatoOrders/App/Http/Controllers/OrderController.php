<?php

namespace Modules\TomatoOrders\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Modules\TomatoBranches\App\Models\Branch;
use Modules\TomatoBranches\App\Models\Company;
use Modules\TomatoLocations\App\Models\Area;
use Modules\TomatoLocations\App\Models\City;
use Modules\TomatoLocations\App\Models\Country;
use Modules\TomatoOrders\App\Models\Order;
use Modules\TomatoOrders\App\Models\OrdersItem;
use Modules\TomatoOrders\App\Facades\TomatoOrdering;
use Modules\TomatoOrders\App\Settings\OrderingSettings;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoAdmin\Facade\Tomato;
use Modules\TomatoProducts\App\Models\Product;
use Modules\TomatoSettings\App\Models\Setting;

class OrderController extends Controller
{
    public string $model;
    private array $order = [];
    private Collection $items;
    private array $errors = [];

    public function __construct()
    {
        $this->model = \Modules\TomatoOrders\App\Models\Order::class;
    }

    /**
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        $settings = Setting::whereIn('name', [
            'ordering_pending_status',
            'ordering_prepared_status',
            'ordering_withdrew_status',
            'ordering_shipped_status',
            'ordering_delivered_status',
            'ordering_cancelled_status',
            'ordering_refunded_status',
            'ordering_paid_status',
        ])->get();
        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'tomato-orders::orders.index',
            table: \Modules\TomatoOrders\App\Tables\OrderTable::class,
            filters: [
                "branch_id",
                "status",
                "soruce",
                "name",
                "phone",
                "uuid"
            ],
            data: [
                'statues' => $settings
            ]
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
            model: \Modules\TomatoOrders\App\Models\Order::class,
            filters: [
                "branch_id",
                "status",
                "soruce",
                "name",
                "phone",
                "uuid"
            ]
        );
    }

    /**
     * @return View
     */
    public function create(Request $request): View
    {
        $checkIfCompanyExists = Company::count();
        if($checkIfCompanyExists < 1){
            $company = Company::create([
                'country_id' => Country::first()?->id,
                'name' => "3x1",
                'ceo' => "CEO",
                'address' => "Cairo, Egypt",
                'city' => "Cairo",
                'zip' => "110821",
                'email' => "info@3x1.io",
                'phone' => "+201207860084",
                'website'=> "https://docs.tomatophp.com"
            ]);
        }
        else {
            $company = Company::first();
        }

        $checkIfBranchExists = Branch::count();
        if($checkIfBranchExists < 1){
            $branch = Branch::create([
                "name" => "Main",
                'company_id' => $company->id,
                'branch_number' => "001",
                'phone' => "+201207860084",
                'address' => "Cairo, Egypt"
            ]);
        }
        $items = [];
        if($request->has('ids') && $request->get('ids')){
            foreach ($request->get('ids') as $id){
                $product = Product::where('id', $id)->with('productMetas', function ($q){
                    $q->where('key', 'options');
                })->first();

                $items[] = [
                    'item' => $product,
                    'price' => $product->price,
                    'discount' => $product->discount,
                    'qty' => 1,
                    'tax' => $product->tax,
                    'total' => ($product->price+$product->tax)-$product->discount,
                    'options' => (object)[]
                ];
            }

        }

        return Tomato::create(
            view: 'tomato-orders::orders.create',
            data: [
                'items' => $items
            ]
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $response = TomatoOrdering::store($request);

        Toast::success(__('Order created successfully'))->autoDismiss(2);
        return redirect()->route('admin.orders.show', $response->id);
    }

    /**
     * @param \Modules\TomatoOrders\App\Models\Order $model
     * @return View|JsonResponse
     */
    public function show(\Modules\TomatoOrders\App\Models\Order $model): View|JsonResponse
    {
        $model = TomatoOrdering::setOrder($model)->get();
        return view('tomato-orders::orders.show', compact('model'));
    }

    /**
     * @param \Modules\TomatoOrders\App\Models\Order $model
     * @return View
     */
    public function edit(\Modules\TomatoOrders\App\Models\Order $model): View
    {
        $model = TomatoOrdering::setOrder($model)->get();
        return view('tomato-orders::orders.edit', compact('model'));
    }

    /**
     * @param Request $request
     * @param \Modules\TomatoOrders\App\Models\Order $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \Modules\TomatoOrders\App\Models\Order $model): RedirectResponse|JsonResponse
    {
        TomatoOrdering::setOrder($model)->update($request);

        Toast::success(__('Order updated successfully'))->autoDismiss(2);
        return redirect()->back();
    }

    /**
     * @param \Modules\TomatoOrders\App\Models\Order $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\Modules\TomatoOrders\App\Models\Order $model): RedirectResponse|JsonResponse
    {
        TomatoOrdering::setOrder($model)->delete();

        Toast::success(__('Order deleted successfully'))->autoDismiss(2);
        return redirect()->back();
    }

    public function settings(){
        $settings = new OrderingSettings();
        return view('tomato-orders::orders.settings', compact('settings'));
    }

    public function settingsUpdate(Request $request){
        $setting = new OrderingSettings();
        foreach ($request->all() as $key => $value) {
            if($value !== null){
                $setting->{$key} = $value;
            }
        }

        $setting->save();

        Toast::success(__('Ordering settings updated successfully'))->autoDismiss(2);
        return redirect()->route('admin.orders.settings');
    }

    public function user(Request $request){
        $request->validate([
            "search" => "required|max:255|string",
        ]);

        $q = $request->get('search');

        $account = config('tomato-crm.model')::where(function ($query) use ($q) {
            $query->where('name', 'like', "%$q%")
                ->orWhere('email', 'like', "%$q%")
                ->orWhere('phone', 'like', "%$q%");
        })
            ->with('locations', function ($q){
                $q->where('is_main', true)->first();
            })->with('locations.city', 'locations.area', 'locations.country')->get();
        if($account){
            return response()->json($account);
        }
    }

    public function product(Request $request){
        $request->validate([
            "search" => "required|max:255|string",
        ]);

        $q = $request->get('search');

        $account = Product::where(function ($query) use ($q) {
            $query->whereJsonContains('name', $q)
                ->orWhere('sku', 'like', "%$q%")
                ->orWhere('barcode', 'like', "%$q%");
        })->with('productMetas', function ($q){
            $q->where('key', 'options')->first();
        })->get();
        if($account){
            return response()->json($account);
        }
    }

    public function status(Request $request, Order $model){
        $request->validate([
            "status" => "required|max:255|string",
        ]);

        $status = TomatoOrdering::setOrder($model)->status($request->get('status'));

        if(is_string($status)){
            Toast::danger($status)->autoDismiss(2);
            return redirect()->back();
        }
        else {
            Toast::success(__('Order status updated successfully'))->autoDismiss(2);
            return redirect()->back();
        }

    }

    public function approve(Order $model){
        $checkStatus = TomatoOrdering::setOrder($model)->approve();
        if(is_string($checkStatus)){
            Toast::danger($checkStatus)->autoDismiss(2);
            return redirect()->back();
        }
        else {
            Toast::success(__('Order approved successfully'))->autoDismiss(2);
            return redirect()->back();
        }
    }

    public function shipping(Order $model)
    {
        return view('tomato-orders::orders.shipping', compact('model'));
    }

    public function ship(Request $request, Order $model)
    {
        TomatoOrdering::setOrder($model)->shipping($request);

        Toast::success(__('Order shipped successfully'))->autoDismiss(2);
        return redirect()->back();
    }

    public function print(Order $model){
        return view('tomato-orders::orders.print', compact('model'));
    }

    public function account()
    {
        return view('tomato-orders::orders.account');
    }

    public function storeAccount(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'phone' => 'required|max:255|string|unique:accounts,phone',
            'street' => 'required|string',
            'home_number' => 'required|max:255|string',
            'flat_number' => 'required|max:255|string',
            'floor_number' => 'required|max:255|string',
            'country_id' => 'required|integer|exists:cities,id',
            'city_id' => 'required|integer|exists:cities,id',
            'area_id' => 'required|integer|exists:areas,id',
        ]);

        $request->merge([
            "type" => "customer",
            "loginBy" => "phone",
            "is_login" => false,
            "is_active" => true,
            "email" => $request->get('phone') .'@phone.com',
            "username" => $request->get('phone'),
        ]);

        $account = config('tomato-crm.model')::create($request->all());
        $account->locations()->create([
            'country_id' => $request->get('country_id'),
            'city_id' => $request->get('city_id'),
            'area_id' => $request->get('area_id'),
            'street' => $request->get('street'),
            'home_number' => $request->get('home_number'),
            'flat_number' => $request->get('flat_number'),
            'floor_number' => $request->get('floor_number'),
            'is_main' => true,
        ]);

        Toast::success(__('Account created successfully'))->autoDismiss(2);
        return redirect()->to(route('admin.orders.create').'?account_id='.$account->id);
    }
}
