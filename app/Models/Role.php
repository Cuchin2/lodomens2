<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    public function scopeSearch($query, $term)
    {
        return $query->where('name', 'LIKE', "%{$term}%");
    }
}
