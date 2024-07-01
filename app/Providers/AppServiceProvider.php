<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Collection;
use App\Models\General;
use App\Models\Message;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Pagination\Paginator as PaginationPaginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('components.public.footer', function ($view) {
            // Obtener los datos del footer
            $datosgenerales = General::all(); // Suponiendo que tienes un modelo Footer y un método footerData() en él
            // Pasar los datos a la vista
            $view->with('datosgenerales', $datosgenerales);
        });

        View::composer('components.public.header', function ($view) {
            // Obtener los datos del footer
            $submenucategorias = Category::where('status', '=', 1)->where('visible', '=', 1)->get(); // Suponiendo que tienes un modelo Footer y un método footerData() en él
            $submenucolecciones = Collection::where('status', '=', 1)->where('visible', '=', 1)->get();
            $generalinfo = General::first();
            // Pasar los datos a la vista
            $view->with('submenucategorias', $submenucategorias)
                    ->with('generalinfo', $generalinfo)
                 ->with('submenucolecciones', $submenucolecciones);
        });
        
        View::composer('auth.login', function ($view) {
            // Obtener los datos del footer
            
            $generalinfo = General::first();
            // Pasar los datos a la vista
            $view->with('generalinfo', $generalinfo)
                 ;
        });

        View::composer('components.app.sidebar', function ($view) {
            // Obtener los datos del footer
            $mensajes = Message::where('is_read', '!=', 1 )->where('status', '!=', 0)->count(); // Suponiendo que tienes un modelo Footer y un método footerData() en él
            // Pasar los datos a la vista
            $view->with('mensajes', $mensajes);
        });

         PaginationPaginator::useTailwind();   
    }
}
