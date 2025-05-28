<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $amenitie_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Amenities newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Amenities newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Amenities query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Amenities whereAmenitieName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Amenities whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Amenities whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Amenities whereUpdatedAt($value)
 */
	class Amenities extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $property_id
 * @property string|null $facility_name
 * @property string|null $distance
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facility query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facility whereDistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facility whereFacilityName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facility wherePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Facility whereUpdatedAt($value)
 */
	class Facility extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $property_id
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiImage query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiImage wherePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|MultiImage whereUpdatedAt($value)
 */
	class MultiImage extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $ptype_id
 * @property string $amenities_id
 * @property string $property_category
 * @property string $property_name
 * @property string $property_slug
 * @property string $property_code
 * @property string $property_status
 * @property string $furnishing
 * @property string|null $deposit
 * @property int|null $rent
 * @property string|null $property_thumbnail
 * @property string|null $description
 * @property string|null $bedrooms
 * @property string|null $bathrooms
 * @property string|null $floors
 * @property string|null $condition
 * @property string|null $availabilityDate
 * @property string|null $epc
 * @property string|null $council_band
 * @property string|null $property_size
 * @property string|null $property_year
 * @property string|null $property_video
 * @property string|null $address
 * @property string|null $street
 * @property string|null $city
 * @property string|null $state
 * @property string|null $postal_code
 * @property string|null $country
 * @property string|null $neighborhood
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $school_distance
 * @property string|null $bus_distance
 * @property string|null $station_distance
 * @property string|null $featured
 * @property string|null $hot
 * @property int|null $agent_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PropertyType|null $propertyType
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Wishlist> $wishlists
 * @property-read int|null $wishlists_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereAmenitiesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereAvailabilityDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereBathrooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereBedrooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereBusDistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereCouncilBand($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereEpc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereFloors($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereFurnishing($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereHot($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereNeighborhood($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property wherePropertyCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property wherePropertyCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property wherePropertyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property wherePropertySize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property wherePropertySlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property wherePropertyStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property wherePropertyThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property wherePropertyVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property wherePropertyYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property wherePtypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereRent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereSchoolDistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereStationDistance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Property whereUpdatedAt($value)
 */
	class Property extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $property_type_name
 * @property string|null $property_icon
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PropertyType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PropertyType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PropertyType query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PropertyType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PropertyType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PropertyType wherePropertyIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PropertyType wherePropertyTypeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PropertyType whereUpdatedAt($value)
 */
	class PropertyType extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $property_id
 * @property int|null $user_id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string $view_date
 * @property string $view_time
 * @property string|null $message
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Property $property
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PropertyViewing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PropertyViewing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PropertyViewing query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PropertyViewing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PropertyViewing whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PropertyViewing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PropertyViewing whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PropertyViewing whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PropertyViewing wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PropertyViewing wherePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PropertyViewing whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PropertyViewing whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PropertyViewing whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PropertyViewing whereViewDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PropertyViewing whereViewTime($value)
 */
	class PropertyViewing extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $username
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $avatar
 * @property string|null $phone
 * @property string|null $address
 * @property string $role
 * @property string $status
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Wishlist> $wishlists
 * @property-read int|null $wishlists_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUsername($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $property_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Property $property
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wishlist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wishlist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wishlist query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wishlist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wishlist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wishlist wherePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wishlist whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wishlist whereUserId($value)
 */
	class Wishlist extends \Eloquent {}
}

