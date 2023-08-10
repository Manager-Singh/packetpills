<?php

namespace App\Models\Traits\Relationships;

use App\Models\Auth\User;
use App\Models\BlogCategory;
use App\Models\BlogTag;

trait DrugRelationships
{
    /**
     * Drugs has many relationship with drug categories.
     */
    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_map_categories', 'blog_id', 'category_id');
    }

    /**
     * Drugs has many relationship with blog tags.
     */
    public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_map_tags', 'blog_id', 'tag_id');
    }

    /**
     * Drugs belongsTo with User.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Drugs updated by User.
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
