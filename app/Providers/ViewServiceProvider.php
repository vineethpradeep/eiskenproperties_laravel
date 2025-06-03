<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\PropertyViewing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Property;
use Illuminate\Support\Facades\Schema;

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
        // Initialize default empty values
        $requestView = collect();
        $pendingCount = 0;
        $inActiveUser = collect();
        $totalCount = 0;
        $activeUsers = collect();
        $allUserCount = 0;
        $totalViewingRequests = 0;
        $acceptedView = 0;
        $todayRequests = collect();
        $propertyRequests = collect();

        if (
            Schema::hasTable('property_viewings') &&
            Schema::hasTable('users') &&
            Schema::hasTable('properties')
        ) {
            $propertyRequests = PropertyViewing::select('property_id', DB::raw('count(*) as request_count'))
                ->groupBy('property_id')
                ->with('property')
                ->get();

            $inActiveUser = User::where('status', 'active')->whereIn('role', ['user', 'agent'])->get();
            $allUserCount = User::whereIn('role', ['user', 'agent'])->count();
            $requestView = PropertyViewing::with('property', 'user')->latest()->get();
            $pendingCount = PropertyViewing::where('status', 0)->count();
            $acceptedView = PropertyViewing::where('status', 1)->count();
            $todayRequests = PropertyViewing::with('property', 'user')
                ->whereDate('view_date', Carbon::today())
                ->latest()
                ->get();
            $totalViewingRequests = PropertyViewing::count();
            $inActiveUserCount = $inActiveUser->count();
            $activeUsers = User::whereIn('role', ['user', 'agent'])
                ->where('status', 'active')
                ->latest()
                ->take(5)
                ->get();
            $totalCount = $pendingCount + $inActiveUserCount;
        }

        View::share([
            'requestView' => $requestView,
            'pendingCount' => $pendingCount,
            'inActiveUser' => $inActiveUser,
            'totalCount' => $totalCount,
            'activeUsers' => $activeUsers,
            'allUserCount' => $allUserCount,
            'totalViewingRequests' => $totalViewingRequests,
            'acceptedView' => $acceptedView,
            'todayRequests' => $todayRequests,
            'propertyRequests' => $propertyRequests,
        ]);
    }
}
