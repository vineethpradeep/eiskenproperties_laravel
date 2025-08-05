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
use App\Models\Contact;
use Illuminate\Support\Facades\App;

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
            $data = [
                'requestView' => collect(),
                'pendingCount' => 0,
                'inActiveUser' => collect(),
                'totalCount' => 0,
                'activeUsers' => collect(),
                'allUserCount' => 0,
                'totalViewingRequests' => 0,
                'acceptedView' => 0,
                'todayRequests' => collect(),
                'propertyRequests' => collect(),
                'totalEnquiries' => 0,
                'pendingEnquiries' => 0,
                'contactsData' => collect(),
            ];

            try {
                if (
                    Schema::hasTable('property_viewings') &&
                    Schema::hasTable('users') &&
                    Schema::hasTable('properties') &&
                    Schema::hasTable('contacts')
                ) {
                    $data['propertyRequests'] = PropertyViewing::select('property_id', DB::raw('count(*) as request_count'))
                        ->groupBy('property_id')
                        ->with('property')
                        ->get();

                    $data['inActiveUser'] = User::where('status', 'active')->whereIn('role', ['user', 'agent'])->get();
                    $data['allUserCount'] = User::whereIn('role', ['user', 'agent'])->count();
                    $data['requestView'] = PropertyViewing::with('property', 'user')->latest()->get();
                    $data['pendingCount'] = PropertyViewing::where('status', 0)->count();
                    $data['acceptedView'] = PropertyViewing::where('status', 1)->count();
                    $data['todayRequests'] = PropertyViewing::with('property', 'user')
                        ->whereDate('view_date', Carbon::today())
                        ->latest()
                        ->get();
                    $data['totalViewingRequests'] = PropertyViewing::count();
                    $inActiveUserCount = $data['inActiveUser']->count();
                    $data['activeUsers'] = User::whereIn('role', ['user', 'agent'])
                        ->where('status', 'active')
                        ->latest()
                        ->take(5)
                        ->get();
                    $data['totalCount'] = $data['pendingCount'] + $inActiveUserCount;

                    $data['totalEnquiries'] = Contact::count();
                    $data['pendingEnquiries'] = Contact::where('status', '0')->count();
                    $data['contactsData'] = Contact::select('contacts.name', 'contacts.property_id', 'properties.address')
                        ->join('properties', 'contacts.property_id', '=', 'properties.id')
                        ->where('contacts.status', 0)
                        ->get();
                }
            } catch (\Exception $e) {
                \Log::error('Dashboard view data load failed: ' . $e->getMessage());
            }

            $view->with($data);
        });
    }
}
