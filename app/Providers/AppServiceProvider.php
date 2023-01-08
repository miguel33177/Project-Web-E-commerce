<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('categories')) {
            $dataCategories = array('Tecnology', 'Sport', 'Car', 'Home', 'Fashion');
            for ($i = 0; $i < count($dataCategories); $i++) {
                if (Category::select('*')->where('category', $dataCategories[$i])->count() == 0) {
                    $category = new Category();
                    $category->category = $dataCategories[$i];
                    $category->save();
                }
            }
            $categories = Category::all();
            view()->share('categories', $categories);
        }
    }
}
