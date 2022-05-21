<?php

namespace Modules\CoreData\Service;

use Illuminate\Http\Request;
use Modules\Basic\Service\BasicService;
use Modules\Basic\Service\CustomTranslationService;
use Modules\Setting\Service\PageService;
use Modules\Setting\Service\SettingService;

class CoreDataService extends BasicService
{
    protected  $categoryService, $cityService, $languageService, $stateService,
        $customTranslationService, $pageService, $settingService,  $tagService;

    public function __construct( CategoryService $categoryService, CityService $cityService,
                                LanguageService $languageService,  StateService $stateService,
                                CustomTranslationService $customTranslationService, PageService $pageService,
                                SettingService  $settingService,  TagService $tagService,
   )
    {
        $this->categoryService = $categoryService;
        $this->cityService = $cityService;
        $this->languageService = $languageService;
        $this->stateService = $stateService;
        $this->customTranslationService = $customTranslationService;
        $this->pageService = $pageService;
        $this->settingService = $settingService;
        $this->tagService = $tagService;
    }

    public function list(Request $request, $pagination = false, $perPage = 10)
    {
        if ($request && isset($request->model) && !empty($request->model)) {
            $data = [];
            if (!is_array($request->model)) {
                $models = explode(',', $request->model);
            } else {
                $models = $request->model;
            }
            foreach ($models as $model) {
                $checkModel = $this->{$model . 'Service'} ?? null;
                if ($checkModel) {
                    $data[$model] = $this->{$model . 'Service'}->list($request, $pagination, $perPage);
                }
            }
            return $data;
        }
        return [];
    }
}
