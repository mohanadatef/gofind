<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LanguageTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(StateTableSeeder::class);
        $this->call(CategoryCustomTranslationsTableSeeder::class);
        $this->call(HomeSliderCustomTranslationsTableSeeder::class);
        $this->call(TagCustomTranslationsTableSeeder::class);
        $this->call(userCustomTranslationsTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(customTranslationsTableSeeder::class);
        $this->call(pageCustomTranslationsTableSeeder::class);
        $this->call(settingTableSeeder::class);
        $this->call(settingCustomTranslationsTableSeeder::class);
        $this->call(LogCustomTranslationsTableSeeder::class);
        $this->call(OtpCustomTranslationsTableSeeder::class);
        $this->call(OtpSettingValueTableSeeder::class);
        $this->call(PermissionCustomTranslationsTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(UserPermissionTableSeeder::class);
        $this->call(PropertyPermissionTableSeeder::class);
        $this->call(PermissionPermissionTableSeeder::class);
        $this->call(CityPermissionTableSeeder::class);
        $this->call(StatePermissionTableSeeder::class);
        $this->call(TagPermissionTableSeeder::class);
        $this->call(PropertyCustomTranslationsTableSeeder::class);
        $this->call(SettingPermissionTableSeeder::class);
        $this->call(LanguagePermissionTableSeeder::class);
        $this->call(CategoryPermissionTableSeeder::class);
        $this->call(HomeSliderPermissionTableSeeder::class);
        $this->call(CustomTranslationPermissionTableSeeder::class);
        $this->call(PagePermissionTableSeeder::class);
        $this->call(ContactUsPermissionTableSeeder::class);
        $this->call(RoleCustomTranslationsTableSeeder::class);
        $this->call(RolePermissionTableSeeder::class);
        $this->call(LogPermissionTableSeeder::class);
        $this->call(CountryPermissionTableSeeder::class);
        $this->call(LeadPermissionTableSeeder::class);
        $this->call(LeadCustomTranslationsTableSeeder::class);
        $this->call(AddAdminRoleTableSeeder::class);
        $this->call(PassportTokens::class);
    }
}
