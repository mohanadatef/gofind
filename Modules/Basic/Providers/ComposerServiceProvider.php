<?php

namespace Modules\Basic\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Modules\Acl\Service\RoleService;
use Modules\Basic\Service\CustomTranslationService;
use Modules\CoreData\Service\CategoryService;
use Modules\CoreData\Service\CityService;
use Modules\CoreData\Service\CountryService;
use Modules\CoreData\Service\StateService;
use Modules\CoreData\Service\TagService;
use Modules\Setting\Service\SettingService;

class ComposerServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     * @return void
     */
    public function boot()
    {
        $setting = $language = $languageActive = [];
        if (Schema::hasTable('languages')) {
            $languageActive = languageActive();
            $language = language();
        }
        if (Schema::hasTable('settings')) {
            $setting = app()->make(SettingService::class)->findBy(new Request(['status' => activeType()['as']]), '', ['value', 'key']);
        }
        view()->composer(['*'], function ($view) use ( $languageActive, $language, $setting) {
            $custom = app()->make(CustomTranslationService::class)->findBy(new Request(['status' => activeType()['as']]));
            $custom = $custom->pluck('value.value', 'key')->toArray();
            $view->with('languageActive', $languageActive->count() > 1 ? $languageActive : null);
            $view->with('language', $language);
            $view->with('custom', $custom);
            $view->with('setting', $setting);
            $view->with('user', user());
        });
        view()->composer(['acl::user.*','property::property.*'], function ($view) {
            $view->with('category', app()->make(CategoryService::class)->findBy(new Request()));
            $view->with('role', app()->make(RoleService::class)->findBy(new Request()));
            $view->with('country', app()->make(CountryService::class)->findBy(new Request()));
            $view->with('city', app()->make(CityService::class)->findBy(new Request()));
            $view->with('state', app()->make(StateService::class)->findBy(new Request()));
        });
        view()->composer(['property::property.*'], function ($view) {
            $view->with('tag', app()->make(TagService::class)->findBy(new Request()));
        });
    }
}
