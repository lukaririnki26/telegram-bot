<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxonomyPivot extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sys_taxonomies_pivot';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'taxonomy_id',
        'pivotable_id',
        'pivotable_type',
    ];

    /**
     * Get the tag associated with this pivot.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function taxonomy()
    {
        return $this->belongsTo(Taxonomy::class, 'taxonomy_id');
    }

    /**
     * Get the parent model (polymorphic relation).
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function pivotable()
    {
        return $this->morphTo();
    }
}
