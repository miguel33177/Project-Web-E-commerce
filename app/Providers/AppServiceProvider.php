<?php

namespace App\Providers;

use App\Http\Controllers\MessagesController as ControllersMessagesController;
use App\Models\Category;
use Chatify\Http\Controllers\MessagesController;
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
        $this->app->bind(MessagesController::class, ControllersMessagesController::class);
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
