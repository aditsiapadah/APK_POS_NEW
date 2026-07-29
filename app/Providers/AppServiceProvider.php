<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider;
// use Illuminate\Pagination\Paginator; // Hapus atau comment
use Carbon\Carbon;
use App\Models\User;
use App\Policies\DashboardPolicy;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\ItemPenjualan;
use App\Policies\ItemPenjualanPolicy;
use App\Policies\PenjualPolicy;
use App\Policies\ProdukPolicy;

class AppServiceProvider extends AuthServiceProvider
{
    protected $policies = [
        User::class => DashboardPolicy::class,
        Produk::class => ProdukPolicy::class,
        Penjualan::class => PenjualPolicy::class,
        ItemPenjualan::class => ItemPenjualanPolicy::class
    ];

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Paginator::useBootstrapFive(); <-- Hapus baris ini
        Carbon::setLocale('id');
        $this->registerPolicies();
    }
}