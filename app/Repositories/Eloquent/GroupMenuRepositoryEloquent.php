<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\GroupMenuRepository;
use App\Models\GroupMenu;
use App\Validators\GroupMenuValidator;

/**
 * Class GroupMenuRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class GroupMenuRepositoryEloquent extends BaseRepository implements GroupMenuRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return GroupMenu::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return GroupMenuValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
