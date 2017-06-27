<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\CateFoodRepository;
use App\Models\CateFood;
use App\Validators\CateFoodValidator;

/**
 * Class CateFoodRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class CateFoodRepositoryEloquent extends BaseRepository implements CateFoodRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CateFood::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
