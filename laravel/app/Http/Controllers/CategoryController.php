<?php

namespace App\Http\Controllers;

use App\WebFramework\Api;
use App\WebFramework\Api\ApiResultWithData;
use Illuminate\Http\Request;
use App\Category;
use App\Common\Exceptions\ListEmptyException;
use App\Common\Exceptions\NotFoundException;
use App\WebFramework\Api\ApiResult;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    public function get(){
        //$categories = Category::with(['Products'])->get();
        $categories = Category::all();
        if(count($categories) <= 0 )
            throw new ListEmptyException();

       return response()->json( new ApiResultWithData($categories));
    }

    public function getById($id){
        $category = Category::find($id);
        if($category == null )
            throw new NotFoundException();

        return response()->json( new ApiResultWithData($category));
    }

    public function create(Request $request){
        $this->performValidation($request);
        
        $category = Category::create($request->toArray());
        return Response()->json(new ApiResultWithData($category));
    }

    public function update(Category $category,Request $request){
        $this->performValidation($request);

        
        $category->update($request->toArray());
        return Response()->json(new ApiResultWithData($category));
    }

    public function delete(Category $category){
        $category->delete();
        return Response()->json(new ApiResult());
    }

    private function performValidation($request){
        $validator = Validator::make($request->toArray(),Category::$validationRules);
        if($validator->fails())
            throw new ValidationException($validator);
    }
}
