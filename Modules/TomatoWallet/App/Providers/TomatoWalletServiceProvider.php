<?php

namespace Modules\TomatoWallet\App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\TomatoWallet\App\Payment;
use Modules\TomatoWallet\App\Request;
use Shetabit\Payment\Events\InvoicePurchasedEvent;
use Shetabit\Payment\Events\InvoiceVerifiedEvent;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;

class TomatoWalletServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'TomatoWallet';

    protected string $moduleNameLower = 'tomato-wallet';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        TomatoMenu::register([
            Menu::make()
                ->group(__('Wallets'))
                ->label(__('Wallets'))
                ->icon('bx bxs-wallet')
                ->route('admin.wallets.index'),
            Menu::make()
                ->group(__('Wallets'))
                ->label(__('Transactions'))
                ->icon('bx bx-money')
                ->route('admin.transactions.index'),
            Menu::make()
                ->group(__('Wallets'))
                ->label(__('Transfers'))
                ->icon('bx bx-transfer')
                ->route('admin.transfers.index'),
            Menu::make()
                ->group(__('Wallets'))
                ->label(__('Payments'))
                ->icon('bx bxs-credit-card')
                ->route('admin.payments.index')
        ]);
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        //Register generate command
        $this->commands([
            \Modules\TomatoWallet\App\Console\TomatoWalletInstall::class,
        ]);

        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'tomato-wallet');

        //Publish Lang
        $this->publishes([
            __DIR__.'/../../resources/lang' => app_path('lang/vendor/tomato-wallet'),
        ], 'tomato-wallet-lang');

        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/migrations'));


        Request::overwrite('input', function ($key) {
            return \request($key);
        });

        /**
         * Bind to service container.
         */
        $this->app->bind('tomato-payment', function () {
            $config = config('payment') ?? [];

            return new Payment($config);
        });

        $this->registerEvents();

        // use blade to render redirection form
        Payment::setRedirectionFormViewRenderer(function ($view, $action, $inputs, $method) {
            if ($this->existCustomRedirectFormView()) {
                return $this->loadNormalRedirectForm($action, $inputs, $method);
            }
            return Blade::render(
                str_replace('</form>', '@csrf</form>', file_get_contents($view)),
                [
                    'action' => $action,
                    'inputs' => $inputs,
                    'method' => $method,
                ]
            );
        });

        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register Laravel events.
     *
     * @return void
     */
    public function registerEvents()
    {
        Payment::addPurchaseListener(function ($driver, $invoice) {
            event(new InvoicePurchasedEvent($driver, $invoice));
        });

        Payment::addVerifyListener(function ($reciept, $driver, $invoice) {
            event(new InvoiceVerifiedEvent($reciept, $driver, $invoice));
        });
    }

    /**
     * Checks whether the user has customized the view file called `redirectForm.blade.php` or not
     *
     * @return bool
     */
    private function existCustomRedirectFormView()
    {
        return file_exists(resource_path('views/vendor/tomato-wallet') . '/redirectForm.blade.php');
    }

    /**
     * @param $action
     * @param $inputs
     * @param $method
     * @return Application|Factory|View
     */
    private function loadNormalRedirectForm($action, $inputs, $method)
    {
        return view('tomato-wallet::redirectForm')->with(
            [
                'action' => $action,
                'inputs' => $inputs,
                'method' => $method,
            ]
        );
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
        $langPath = resource_path('lang/modules/'.$this->moduleNameLower);

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
        $this->publishes([module_path($this->moduleName, 'config/config.php') => config_path($this->moduleNameLower.'.php')], 'config');
        $this->mergeConfigFrom(module_path($this->moduleName, 'config/config.php'), $this->moduleNameLower);
    }

    /**
     * Register views.
     */
    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/'.$this->moduleNameLower);
        $sourcePath = module_path($this->moduleName, 'resources/views');

        $this->publishes([$sourcePath => $viewPath], ['views', $this->moduleNameLower.'-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);

        $componentNamespace = str_replace('/', '\\', config('modules.namespace').'\\'.$this->moduleName.'\\'.config('modules.paths.generator.component-class.path'));
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
            if (is_dir($path.'/modules/'.$this->moduleNameLower)) {
                $paths[] = $path.'/modules/'.$this->moduleNameLower;
            }
        }

        return $paths;
    }
}
