<?php

namespace App\Services;

use App\Models\Users;

class UserService
{
    /**
     * @param array $params
     * @return mixed
     */
    public function create(array $params): mixed
    {
        return Users::create([
            'name' => $params['name'],
            'password' => $params['password']
        ]);
    }

    /**
     * @param $id
     * @param array $params
     * @return mixed
     */
    public function update($id, array $params): mixed
    {
        Users::where('id', $id)->update([
            'name' => $params['name'],
            'password' => $params['password'],
        ]);

        return Users::where('id', $id)->first();

    }
}

