<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Item
 *
 * @package App\Models
 */
class Item extends Model
{
    use LogsActivity, SoftDeletes;


    /**
     * Model actions that needs to be logged.
     *
     * @var array
     */
    protected static $recordEvents = [];

    /**
     * Protected fields for the internal mass-assign system.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Function for setting the default message for the method logging.
     *
     * @param   string $eventName
     * @return  string
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        return "This model has been {$eventName}";
    }

    /**
     * Data for the storage location.
     *
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Scope for embedding the coordinator his location to the results.
     *
     * @param  Builder $query The eloquent query builder instance
     * @return Builder
     */
    public function scopeUserLocation(Builder $query): Builder
    {
        return $this->where('location_id', auth()->user()->location->id);
    }

    /**
     * Data relation for the category that is attached to the item.
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * A sure method to generate a unique API key
     *
     * @throws \Exception When an error of any kind occures.
     *
     * @return string
     */
    public static function generateItemCode(): string
    {
        do {
            $itemCode = random_int(1000, 9999);
        } // Already in the DB? Fail. Try again

        while (self::codeExists($itemCode));

        return $itemCode;
    }

    /**
     * Checks whether a item code in the database or not
     *
     * @param  string $code The item code that needs to be checked.
     * @return bool
     */
    private static function codeExists(string $code): bool
    {
        $apiKeyCount = self::where('item_code', '=', $code)->limit(1)->count();

        return $apiKeyCount > 0;
    }

    /**
     * Method for getting the items where the user is searching for.
     *
     * @param  string|null $term The given search term.
     * @return Builder
     */
    public function getSearchResults(?string $term): Builder
    {
        return $this->where('item_code', 'LIKE', "%{$term}%")
            ->orWhere('name', 'LIKE', "%{$term}%");
    }
}
