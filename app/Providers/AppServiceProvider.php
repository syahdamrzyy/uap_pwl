<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\View;


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
    View::composer('admin.*', function ($view) {
        $notifPeminjaman = Peminjaman::where('status', 'menunggu')->count();
        $notifDikembalikan = Peminjaman::where('status', 'dikembalikan')->count();

        $view->with([
            'notifPeminjaman' => $notifPeminjaman,
            'notifDikembalikan' => $notifDikembalikan
        ]);
    });
}
}
