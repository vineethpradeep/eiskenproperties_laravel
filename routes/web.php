<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Backend\SupabaseUploadController;
use App\Http\Controllers\ContactController;
use App\Http\Middleware\Role;
use App\Models\Property;
use App\Models\User;

// Route::get('/', function () {
//     return view('welcome');
// });

//User frontend routes
Route::get('/', [UserController::class, 'Index']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/about', function () {
    return view('frontend.about');
})->name('about');

Route::get('/mail', function () {
    return view('mail.contact_enquiry_mail');
})->name('mail');

Route::get('/contact', function () {
    return view('frontend.contact');
})->name('contact');

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::get('/all/users', [UserController::class, 'AllUsers'])->name('all.users');
    Route::get('/user/property/info', [UserController::class, 'UserPropertyInfo'])->name('user.property.info');
    Route::get('/user/property/wishlist', [UserController::class, 'UserWishlist'])->name('user.property.wishlist');
    Route::get('/user/property/enquiry', [UserController::class, 'UserPropertyEnquiry'])->name('user.property.enquiry');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');
});

Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('/agent/dashboard', [AgentController::class, 'agentDashboard'])->name('agent.dashboard');
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->middleware('guest')->name('admin.login');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(PropertyTypeController::class)->group(function () {
        Route::get('/all/property_type', 'AllPropertyType')->name('all.property_type');
        Route::get('/add/property_type', 'AddPropertyType')->name('add.property_type');
        Route::post('/store/property_type', 'StorePropertyType')->name('store.property_type');
        Route::get('/edit/property_type/{id}', 'EditPropertyType')->name('edit.property_type');
        Route::post('/update/property_type', 'UpdatePropertyType')->name('update.property_type');
        Route::get('/delete/property_type/{id}', 'DeletePropertyType')->name('delete.property_type');
    });
    Route::controller(PropertyTypeController::class)->group(function () {
        Route::get('/all/amenitie', 'AllAmenitie')->name('all.amenitie');
        Route::get('/add/amenitie', 'AddAmenitie')->name('add.amenitie');
        Route::post('/store/amenitie', 'StoreAmenitie')->name('store.amenitie');
        Route::get('/edit/amenitie/{id}', 'EditAmenitie')->name('edit.amenitie');
        Route::post('/update/amenitie', 'UpdateAmenitie')->name('update.amenitie');
        Route::get('/delete/amenitie/{id}', 'DeleteAmenitie')->name('delete.amenitie');
    });
    Route::controller(PropertyController::class)->group(function () {
        Route::get('/all/property', 'AllProperty')->name('all.property');
        Route::get('/add/property', 'AddProperty')->name('add.property');
        Route::post('/store/property', 'StoreProperty')->name('store.property');
        Route::get('/edit/property/{id}', 'EditProperty')->name('edit.property');
        Route::post('/update/property', 'UpdateProperty')->name('update.property');
        Route::get('/delete/property/{id}', 'DeleteProperty')->name('delete.property');
        Route::get('/details/property/{id}', 'DetailsProperty')->name('details.property');
        Route::post('/toggle/property/status', 'ToggleStatus')->name('toggle.property.status');

        Route::post('/update/property/thumbnail', 'UpdatePropertyThumbnail')->name('update.property.thumbnail');
        Route::post('/update/property/multiimage', 'UpdatePropertyMultiImage')->name('update.property.multiimage');
        Route::get('/property/multiimage/delete/{id}', 'PropertyMultiImageDelete')->name('property.multiimage.delete');
        Route::post('/store/new/multiimage', 'StoreNewMultiImage')->name('store.new.multiimage');

        Route::get('/property/view/schedule/{id}', 'ViewSchedule')->name('property.view.schedule');
        Route::post('/property/update/schedule', 'UpdateSchedule')->name('property.update.schedule');
    });
});

//User frontend routes
Route::get('/property/details/{id}/{slug}', [IndexController::class, 'PropertyDetails']);
// Route::post('/property/search', [IndexController::class, 'BuyPropertySearch'])->name('property.search');

Route::get('/property/search/sale', [IndexController::class, 'SearchSale'])->name('property.search.sale');
Route::get('/property/search/rent', [IndexController::class, 'SearchRent'])->name('property.search.rent');
Route::get('/property/search/all', [IndexController::class, 'SearchAll'])->name('property.search.all');
Route::get('/all/property/list', [IndexController::class, 'AllPropertyList'])->name('all.property.list');


Route::post('/wishlist/toggle/{id}', [WishlistController::class, 'toggle'])
    ->middleware('auth')
    ->name('wishlist.toggle');
Route::post('/schedule/viewing', [PropertyController::class, 'ScheduleViewing'])->name('schedule.viewing');
Route::get('/schedule/request', [PropertyController::class, 'ScheduleRequest'])->name('schedule.request');
Route::get('/delete/schedule/{id}', [PropertyController::class, 'DeleteSchedule'])->name('delete.schedule');

Route::post('/contacts/store', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/property/enquiry/request', [ContactController::class, 'EnquiryRequest'])->name('property.enquiry.request');
Route::get('/property/enquiry/view/{id}', [ContactController::class, 'EnquiryView'])->name('property.enquiry.view');
Route::post('/property/update/enquiry', [ContactController::class, 'UpdateEnquiry'])->name('property.update.enquiry');
Route::get('/property/delete/enquiry/{id}', [ContactController::class, 'DeleteEnquiry'])->name('property.delete.enquiry');
