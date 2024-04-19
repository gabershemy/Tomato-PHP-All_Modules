<?php

namespace Modules\TomatoCoupons\App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;

class TomatoCouponsServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'TomatoCoupons';

    protected string $moduleNameLower = 'tomato-coupons';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/migrations'));

        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'tomato-coupons');

        //Publish Lang
        $this->publishes([
            __DIR__.'/../../resources/lang' => base_path('lang/vendor/tomato-coupons'),
        ], 'tomato-coupons-lang');

        $menus = [];

        if (config("tomato-coupons.features.coupons")) {
            $menus[] = Menu::make()
                ->group(__('Offers'))
                ->label(__('Coupons'))
                ->icon('bx bxs-discount')
                ->route('admin.coupons.index');
        }

        if (config("tomato-coupons.features.gift_cards")) {
            $menus[] = Menu::make()
                ->group(__('Offers'))
                ->label(__('Gift Cards'))
                ->icon('bx bx-gift')
                ->route('admin.gift-cards.index');
        }

        if (config("tomato-coupons.features.referral_codes")) {
            $menus[] = Menu::make()
                ->group(__('Offers'))
                ->label(__('Referral Codes'))
                ->icon('bx bx-link')
                ->route('admin.referral-codes.index');
        }

        TomatoMenu::register($menus);
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->registerConfig();
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
