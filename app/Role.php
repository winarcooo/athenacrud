<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function givePermissionTo($permission)
    {
        return $this->permissions()->save(
            Permission::whereName($permission)->firstOrFail()
        );
        //return $this->permissions()->save($permission);
    }
}
