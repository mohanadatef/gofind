<?php

namespace Modules\Basic\Providers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Modules\Acl\Service\RoleService;
use Modules\Acl\Service\UserService;
use Modules\Basic\Service\CustomTranslationService;
use Modules\CoreData\Service\CategoryService;
use Modules\CoreData\Service\CityService;
use Modules\CoreData\Service\CountryService;
use Modules\CoreData\Service\CurrencyService;
use Modules\CoreData\Service\GenderService;
use Modules\CoreData\Service\JobNameService;
use Modules\CoreData\Service\NationalityService;
use Modules\CoreData\Service\StateService;
use Modules\CoreData\Service\StatusService;
use Modules\Setting\Entities\Cancellation;
use Modules\Setting\Entities\Setting;
use Modules\Setting\Service\NotificationService;
use Modules\Setting\Service\CancellationService;
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
        view()->composer(['*'], function ($view) {
            $languageActive = languageActive();
            $language = language();
            $setting = app()->make(SettingService::class)->findBy(new Request(['status' => activeType()['as']]), '', ['value', 'key']);
            $custom = app()->make(CustomTranslationService::class)->findBy(new Request(['status' => activeType()['as']]));
            $custom = $custom->pluck('value.value', 'key')->toArray();
            $view->with('languageActive', $languageActive->count() > 1 ? $languageActive : null);
            $view->with('language', $language);
            $view->with('custom', $custom);
            $view->with('setting', $setting);
            $view->with('user', user());
        });
        view()->composer(['acl::user.create','acl::user.filter'], function ($view) {
            $view->with('category', app()->make(CategoryService::class)->findBy(new Request()));
            $view->with('role', app()->make(RoleService::class)->findBy(new Request()));
            $view->with('country', app()->make(CountryService::class)->findBy(new Request()));
            $view->with('city', app()->make(CityService::class)->findBy(new Request()));
            $view->with('state', app()->make(StateService::class)->findBy(new Request()));
        });
    }
}
