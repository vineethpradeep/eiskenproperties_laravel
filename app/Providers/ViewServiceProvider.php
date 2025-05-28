<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\PropertyViewing;
use App\Models\User;

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
        View::composer('admin.container.header', function ($view) {
            $inActiveUser = User::where('status', 'active')->whereIn('role', ['user', 'agent'])->get();
            $requestView = PropertyViewing::with('property', 'user')->latest()->get();
            $pendingCount = PropertyViewing::where('status', 0)->count();
            $inActiveUserCount = $inActiveUser->count();
            $activeUsers = User::whereIn('role', ['user', 'agent'])
                ->where('status', 'active')
                ->latest()
                ->take(5)
                ->get();
            // $newUsers = User::whereIn('role', ['user', 'agent'])
            //     ->latest()
            //     ->take(5)
            //     ->get();

            $totalCount = $pendingCount + $inActiveUserCount;
            $view->with([
                'requestView' => $requestView,
                'pendingCount' => $pendingCount,
                'inActiveUser' => $inActiveUser,
                'totalCount' => $totalCount,
                'activeUsers' => $activeUsers,
                // 'newUsers' => $newUsers
            ]);
        });
    }
}
