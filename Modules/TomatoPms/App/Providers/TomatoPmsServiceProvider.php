<?php

namespace Modules\TomatoPms\App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Modules\TomatoCategory\App\Facades\TomatoCategory;
use Modules\TomatoCategory\App\Services\Contracts\Type;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoAdmin\Facade\TomatoSlot;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;

class TomatoPmsServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'TomatoPms';

    protected string $moduleNameLower = 'tomato-pms';

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

        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'tomato-pms');

        //Publish Lang
        $this->publishes([
            __DIR__.'/../../resources/lang' => base_path('lang/vendor/tomato-pms'),
        ], 'tomato-pms-lang');

        TomatoMenu::register([
            Menu::make()
                ->group(__('PMS'))
                ->label(__('Projects'))
                ->route('admin.projects.index')
                ->icon('bx bxs-business'),
            Menu::make()
                ->group(__('PMS'))
                ->label(__('Sprints'))
                ->route('admin.sprints.index')
                ->icon('bx bxs-pie-chart'),
            Menu::make()
                ->group(__('PMS'))
                ->label(__('Issues'))
                ->route('admin.issues.index')
                ->icon('bx bxs-bolt-circle'),
            Menu::make()
                ->group(__('PMS'))
                ->label(__('Timer'))
                ->route('admin.timers.index')
                ->icon('bx bxs-time'),
        ]);

        TomatoCategory::register([
            Type::make()
                ->label(__('Issues Type'))
                ->back('admin.issues.index')
                ->for('issues')
                ->type('types'),
            Type::make()
                ->label(__('Issues Status'))
                ->back('admin.issues.index')
                ->for('issues')
                ->type('status')
        ]);

        TomatoSlot::navLeftSide('tomato-pms::timers.header');

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
