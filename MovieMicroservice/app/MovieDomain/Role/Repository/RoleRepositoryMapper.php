<?php

namespace App\MovieDomain\Role\Repository;

use App\Models\Role as RoleModel;
use App\MovieDomain\Role\Role;
use App\MovieDomain\Role\RoleType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as IlluminateCollection;

class RoleRepositoryMapper
{
    /**
     * @param Collection<RoleModel> $rolesCollection
     * @return Collection<Role>
     */
    public function mapModelsToEntities(Collection $rolesCollection): IlluminateCollection
    {
        return $rolesCollection->map(function (RoleModel $role) {
            return $this->mapModelToEntity($role);
        });
    }

    /**
     * @param RoleModel $model
     * @return Role
     */
    public function mapModelToEntity(RoleModel $model): Role
    {
        return new Role(
            id: $model->id,
            userId: $model->user_id,
            role: RoleType::from($model->role)
        );
    }
}
