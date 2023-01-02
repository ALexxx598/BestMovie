<?php

namespace App\MovieDomain\Role\Repository;

use App\MovieDomain\Role\Role;
use App\Models\Role as RoleModel;
use App\MovieDomain\Role\RoleType;
use Illuminate\Support\Collection;

class RoleRepository implements RoleRepositoryInterface
{
    /**
     * @param RoleRepositoryMapper $roleRepositoryMapper
     */
    public function __construct(
      private RoleRepositoryMapper $roleRepositoryMapper
    ) {
    }

    /**
     * @param int $userId
     * @return Collection<Role>
     */
    public function getRolesByUserId(int $userId): Collection
    {
        $query = RoleModel::query();
        $query->where('user_id', $userId);

        return $this->roleRepositoryMapper->mapModelsToEntities($query->get());
    }

    /**
     * @param int $userId
     * @param RoleType $role
     * @return Role
     */
    public function save(int $userId, RoleType $role): Role
    {
        $model = new RoleModel();

        $model->user_id = $userId;
        $model->role = $role;
        $model->exists = false;

        $model->save();

        return $this->roleRepositoryMapper->mapModelToEntity($model);
    }
}
