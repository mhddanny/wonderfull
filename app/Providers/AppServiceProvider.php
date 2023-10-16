<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
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
      Blade::directive('rupiah', function($expression){
          return "Rp. <?php echo number_format($expression,0,',','.'); ?>";
      });
      View::composer('WF_Collection.*', 'App\Http\View\KategoriComposer');
    }
}
