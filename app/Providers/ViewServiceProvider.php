<?php

namespace App\Providers;

use App\Models\Pendaftaran;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('currentUser', Auth::user());
        });
        View::composer('pages.loket.dashboard', function ($view) {
            $antrians = Pendaftaran::with(['kunjungan'])
                ->whereDate('tanggal_periksa', Carbon::today())
                ->where('status', 'Mengantri')
                ->orderBy('created_at', 'asc')
                ->get()
                ->groupBy('poli');

            $view->with([
                'antrians' => $antrians,
                'totalAntrian' => $antrians->sum(function ($antrian) {
                    return $antrian->count();
                }),
                'antrian_umum' => $antrians->get('Umum', collect())->count(),
                'antrian_gigi' => $antrians->get('Gigi', collect())->count(),
                'antrian_kia' => $antrians->get('KIA', collect())->count(),
            ]);
        });
        View::composer('pages.pasien.dashboard', function ($view) {
            $antrians = Pendaftaran::with(['kunjungan'])
                ->whereDate('tanggal_periksa', Carbon::today())
                ->where('status', 'Mengantri')
                ->orderBy('created_at', 'asc')
                ->get()
                ->groupBy('poli');

            $view->with([
                'antrians' => $antrians,
                'totalAntrian' => $antrians->sum(function ($antrian) {
                    return $antrian->count();
                }),
                'antrian_umum' => $antrians->get('Umum', collect())->count(),
                'antrian_gigi' => $antrians->get('Gigi', collect())->count(),
                'antrian_kia' => $antrians->get('KIA', collect())->count(),
            ]);
        });
    }
}
