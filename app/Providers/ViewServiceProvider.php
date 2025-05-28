<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\PropertyViewing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Property;

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
        // $newUsers = User::whereIn('role', ['user', 'agent'])
        //     ->latest()
        //     ->take(5)
        //     ->get();
        $totalCount = $pendingCount + $inActiveUserCount;
        // dd($propertyRequests);
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
            // 'newUsers' => $newUsers
        ]);
    }
}
