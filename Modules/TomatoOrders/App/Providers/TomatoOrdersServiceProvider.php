<?php

namespace Modules\TomatoOrders\App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Modules\TomatoOrders\App\Console\TomatoOrdersInstall;
use Modules\TomatoOrders\App\Models\Order;
use Modules\TomatoOrders\App\Tables\OrderTable;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoAdmin\Facade\TomatoWidget;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Widget;
use Modules\TomatoCrm\App\Facades\TomatoCrm;
use Modules\TomatoCrm\App\Services\Contracts\AccountReleation;
use Nwidart\Modules\Facades\Module;
use TomatoPHP\TomatoAdmin\Facade\TomatoSlot;

class TomatoOrdersServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'TomatoOrders';

    protected string $moduleNameLower = 'tomato-orders';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/migrations'));
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'tomato-orders');

        $this->commands([
            TomatoOrdersInstall::class
        ]);

        TomatoMenu::register([
            Menu::make()
                ->group(__('Ordering'))
                ->label(__('Orders'))
                ->icon('bx bxs-rocket')
                ->route('admin.orders.index'),
            Menu::make()
                ->group(__('Ordering'))
                ->label(__('Vendors'))
                ->icon('bx bxs-truck')
                ->route('admin.shipping-vendors.index'),
            Menu::make()
                ->group(__('Ordering'))
                ->label(__('Delivery'))
                ->icon('bx bxs-car')
                ->route('admin.deliveries.index'),
            Menu::make()
                ->group(__('Ordering'))
                ->label(__('Prices'))
                ->icon('bx bx-money')
                ->route('admin.shipping-prices.index')
        ]);

        $this->app->bind('tomato-ordering', function () {
            return new \Modules\TomatoOrders\App\Services\Ordering();
        });


        if (Module::find('TomatoCrm')) {
            TomatoCrm::registerAccountReleation(
                AccountReleation::make('orders')
                    ->label([
                        "ar" => "الطلبات",
                        "en" => "Orders"
                    ])
                    ->table(OrderTable::class)
                    ->view('tomato-orders::orders.table')
                    ->path('orders')
                    ->toArray()
            );
        }

        if (Schema::hasTable('orders')) {
            $filterBy = [];
            if (request()->has('filterBy') && request()->get('filterBy') === 'today') {
                $filterBy = [
                    Carbon::now()->startOfDay(),
                    Carbon::now()->endOfDay()
                ];
            } elseif (request()->has('filterBy') && request()->get('filterBy') === 'week') {
                $filterBy = [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ];
            } elseif (request()->has('filterBy') && request()->get('filterBy') === 'month') {
                $filterBy = [
                    Carbon::now()->startOfMonth(),
                    Carbon::now()->endOfMonth()
                ];
            } elseif (request()->has('filterBy') && request()->get('filterBy') === 'year') {
                $filterBy = [
                    Carbon::now()->startOfYear(),
                    Carbon::now()->endOfYear()
                ];
            } else {
                $filterBy = [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ];
            }


            $totalOrders = Order::query()->whereBetween('created_at', $filterBy)->count();

            $canceledOrders = Order::query()->whereBetween('created_at', $filterBy)
                ->where('status', setting('ordering_cancelled_status'))
                ->count();

            $shippedOrdres = Order::query()->whereBetween('created_at', $filterBy)
                ->where('status', setting('ordering_shipped_status'))
                ->count();

            $sumPaidOrders = number_format(
                Order::query()->whereBetween('created_at', $filterBy)
                    ->where('status', setting('ordering_paid_status'))
                    ->sum('total'),
                2
            ) . setting('local_currency');

            TomatoWidget::register([
                Widget::make()
                    ->title(__('Total Orders This') . ' ' . Str::title(request()->get('filterBy') ?? 'Week'))
                    ->icon('bx bxs-rocket')
                    ->counter($totalOrders),
                Widget::make()
                    ->title(__('Canceled Orders This') . ' ' . Str::title(request()->get('filterBy') ?? 'Week'))
                    ->icon('bx bx-x')
                    ->counter($canceledOrders),
                Widget::make()
                    ->title(__('Shipped Orders This') . ' ' . Str::title(request()->get('filterBy') ?? 'Week'))
                    ->icon('bx bxs-truck')
                    ->counter($shippedOrdres),
                Widget::make()
                    ->title(__('Paid Orders This') . ' ' . Str::title(request()->get('filterBy') ?? 'Week'))
                    ->icon('bx bx-money')
                    ->counter($sumPaidOrders)
            ]);

            TomatoSlot::dashboardTop('tomato-orders::orders.filter');
        }
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register commands in the format of Command::class
     */
    protected function registerCommands(): void
    {
        // $this->commands([]);
    }

    /**
     * Register command Schedules.
     */
    protected function registerCommandSchedules(): void
    {
        // $this->app->booted(function () {
        //     $schedule = $this->app->make(Schedule::class);
        //     $schedule->command('inspire')->hourly();
        // });
    }

    /**
     * Register translations.
     */
    public function registerTranslations(): void
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'lang'), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, 'lang'));
        }
    }

    /**
     * Register config.
     */
    protected function registerConfig(): void
    {
        $this->publishes([module_path($this->moduleName, 'config/config.php') => config_path($this->moduleNameLower . '.php')], 'config');
        $this->mergeConfigFrom(module_path($this->moduleName, 'config/config.php'), $this->moduleNameLower);
    }

    /**
     * Register views.
     */
    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);
        $sourcePath = module_path($this->moduleName, 'resources/views');

        $this->publishes([$sourcePath => $viewPath], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);

        $componentNamespace = str_replace('/', '\\', config('modules.namespace') . '\\' . $this->moduleName . '\\' . config('modules.paths.generator.component-class.path'));
        Blade::componentNamespace($componentNamespace, $this->moduleNameLower);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (config('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }

        return $paths;
    }
}
