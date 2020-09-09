<?php

namespace App\Http\Controllers;

use App\Common\Exceptions\ListEmptyException;
use App\Common\Exceptions\NotFoundException;
use App\Role;
use App\WebFramework\Api\ApiResult;
use App\WebFramework\Api\ApiResultWithData;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function get()
    {
        $roles = Role::all();
        if (count($roles) <= 0)
            throw new ListEmptyException();

        return response()->json(new ApiResultWithData($roles));
    }

    public function getById($id)
    {
        $role = Role::find($id);
        if ($role == null)
            throw new NotFoundException();

        return response()->json(new ApiResultWithData($role));
    }

    public function create(Request $request)
    {
        $this->performValidation($request);

        $role = Role::create($request->toArray());
        return Response()->json(new ApiResultWithData($role));
    }

    public function update(Role $role, Request $request)
    {
        $this->performValidation($request);


        $role->update($request->toArray());
        return Response()->json(new ApiResultWithData($role));
    }

    public function delete(Role $role)
    {
        $role->delete();
        return Response()->json(new ApiResult());
    }

    private function performValidation($request)
    {
        $validator = Validator::make($request->toArray(), Role::$validationRules);
        if ($validator->fails())
            throw new ValidationException($validator);
    }
}
