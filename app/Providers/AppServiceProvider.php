<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\View;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyViewing;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

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

        // if (env('APP_ENV') !== 'local') {
        //     URL::forceScheme('https');
        // }
        View::composer('*', function ($view) {
            $userWishlist = [];
            $userViewings = [];
            $segments = Request::segments(); // eg. ['property', 'details', '9', 'city-center-shop']

            $pageTitle = 'Dashboard';
            $breadcrumbs = [];

            if (count($segments) === 0 || $segments[0] === 'dashboard') {
                $pageTitle = 'Dashboard';
                $breadcrumbs = ['Dashboard'];
            } elseif ($segments[0] === 'user' && $segments[1] === 'property') {
                $pageTitle = 'User Profile';
                $breadcrumbs = ['User', $segments[2]];
            } elseif ($segments[0] === 'all' && $segments[1] === 'property') {
                $pageTitle = 'Property List';
                $breadcrumbs = ['Property', 'List'];
            } elseif ($segments[0] === 'property' && $segments[2] === 'sale') {
                $pageTitle = 'Sales Property';
                $breadcrumbs = ['Property', 'Sales'];
            } elseif ($segments[0] === 'property' && $segments[2] === 'rent') {
                $pageTitle = 'Rental Property';
                $breadcrumbs = ['Property', 'Rent'];
            } elseif ($segments[0] === 'property' && $segments[1] === 'details') {
                $pageTitle = 'Property Details';
                $breadcrumbs = ['Property'];

                if (isset($segments[3])) {
                    $breadcrumbs[] = ucwords(str_replace('-', ' ', $segments[3]));
                }
            } else {

                $breadcrumbs = collect($segments)->map(function ($seg) {
                    return ucwords(str_replace('-', ' ', $seg));
                })->toArray();

                $pageTitle = end($breadcrumbs);
            }

            if (Auth::check()) {
                $userWishlist = Wishlist::where('user_id', Auth::id())->pluck('property_id')->toArray();
                $userViewings = PropertyViewing::where('user_id', Auth::id())->pluck('property_id')->toArray();
            }

            $view->with([
                'userWishlist' => $userWishlist,
                'userViewings' => $userViewings,
                'pageTitle' => $pageTitle,
                'breadcrumbs' => $breadcrumbs,
            ]);
        });
        Route::aliasMiddleware('role', Role::class);
        Route::aliasMiddleware('guest', RedirectIfAuthenticated::class);
    }
}
