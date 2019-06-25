<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use GuzzleHttp\Client;
use Illuminate\Container\Container as App;

class PermissionsRepository extends Repository
{
    public function __construct(Client $http, App $app)
    {
        parent::__construct($app);
        $this->http = $http;
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return 'App\\Models\\Permissions';
    }

    public function getNodes($request)
    {
        $data = $request->all();
        $keyword = isset($data['keyword']) ? $data['keyword'] : '';
        $paginate = $this->model->where(['deleted' => 0])
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($query) use ($keyword) {
                    return $query->orWhere('name', 'like', "%{$keyword}%");
                });
            })->paginate($request->pageSize);

        return collection($paginate);
    }

    public function addNode($request)
    {
        $data = $request->all();
        if (!isset($data['id'])) {
            $res = $this->model->create($data);

            return $this->respondWith(['created' => (bool) $res, 'role' => $res]);
        } else {
            $arr = [
                'name' => $data['name'],
                'router' => $data['router'],
                'pid' => $data['pid'],
            ];

            $res = $this->update($arr, $data['id']);

            return $this->respondWith(['updated' => (bool) $res, 'role' => $res]);
        }
    }
}
