<?php

namespace App\Models;

use App\Models\Traits\MediaTrait;
use Illuminate\Database\Eloquent\Model;
use Neo\UserStamps\Concerns\HasUserStamps;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Posts extends Model
{
    use HasFactory;
    use HasUserStamps;
    use SoftDeletes;
    use MediaTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sys_posts';

    /**
     * The primary key for the model.
     * Composite key: 'id' and 'lang'.
     *
     * @var array
     */
    protected $primaryKey = ['id', 'lang'];

    /**
     * Indicates if the IDs are auto-incrementing.
     * Since we have composite keys, this is set to false.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The type of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     * These attributes can be filled during model creation.
     *
     * @var array
     */
    protected $fillable = [
        'lang',
        'title',
        'slug',
        'excerpt',
        'content',
        'metadata',
        'settings',
        'start_publish',
        'end_publish',
        'record_visibility',
        'record_type',
        'record_left',
        'record_right',
        'parent_id',
        'record_status',
    ];

    /**
     * The attributes that should be cast to native types.
     * Metadata and settings are JSON, while timestamps are cast to datetime.
     *
     * @var array
     */
    protected $casts = [
        'metadata' => 'array',
        'settings' => 'array',
        'start_publish' => 'datetime',
        'end_publish' => 'datetime',
    ];

    /**
     * Accessor for the 'metadata' attribute.
     * Decodes the JSON metadata into an array.
     * Returns null if the JSON is invalid.
     *
     * @return mixed
     */
    public function getMetadataAttribute(): mixed
    {
        $metadata = json_decode($this->attributes['metadata'], true);
        return json_last_error() === JSON_ERROR_NONE ? $metadata : null;
    }

    /**
     * Accessor for the 'settings' attribute.
     * Decodes the JSON settings into an array.
     * Returns null if the JSON is invalid.
     *
     * @return mixed
     */
    public function getSettingsAttribute(): mixed
    {
        $settings = json_decode($this->attributes['settings'], true);
        return json_last_error() === JSON_ERROR_NONE ? $settings : null;
    }


    /**
     * Get Created At
     *
     * @return \DateTime|void|null
     * @throws \DateMalformedStringException
     */
    public function createdAt()
    {
        if(is_null($this->attributes['created_at'])) {
            return null;
        } elseif(is_string($this->attributes['created_at'])) {
            return new \DateTime($this->attributes['created_at']);
        } elseif($this->attributes['created_at'] instanceof \DateTime) {
            return $this->attributes['created_at'];
        }
    }

    /**
     * Relationship to the User model for 'created_by'.
     * Defines a belongsTo relationship for the user who created the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Get Updated At
     *
     * @return \DateTime|void|null
     * @throws \DateMalformedStringException
     */
    public function updatedAt()
    {
        if(is_null($this->attributes['updated_at'])) {
            return $this->createdAt();
        } elseif(is_string($this->attributes['updated_at'])) {
            return new \DateTime($this->attributes['updated_at']);
        } elseif($this->attributes['updated_at'] instanceof \DateTime) {
            return $this->attributes['updated_at'];
        }
    }

    /**
     * Relationship to the User model for 'updated_by'.
     * Defines a belongsTo relationship for the user who last updated the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updatedBy()
    {
        if(is_null($this->attributes['updated_at'])) {
            return $this->createdBy();
        }

        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    /**
     * Accessor for the 'first_create' attribute.
     */
    public function getFirstCreateAttribute()
    {
        return [
            'created_at' => $this->createdAt(),
            'created_by' => $this->createdBy()->first(),
        ];
    }

    /**
     * Accessor for the 'last_update' attribute.
     */
    public function getLastUpdateAttribute()
    {
        return [
            'updated_at' => $this->updatedAt(),
            'updated_by' => $this->updatedBy()->first(),
        ];
    }

    public function getFeaturedImageAttribute()
    {
        return $this->getMediaUrl('featured_image');
    }
}
