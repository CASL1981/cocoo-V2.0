<?php

use Illuminate\Support\Str;

function canView(string $permission): bool
{
    $permissions = auth()->user()->getPermissionsViaRoles();

        $permissions = $permissions->filter(function($p) use ($permission){
            return Str::contains($p->name, $permission);
        });

    return boolval($permissions->count());
}

function can(string $permission)
{
    if(!auth()->user()->can($permission))
    {
        abort(403, 'Usuario no tiene permiso para visualizar esta pagina');
    }
}