<?php

namespace App\Http\Controllers;

use App\Common\Exceptions\ApplicationException;
use App\Common\Exceptions\ListEmptyException;
use App\Common\Exceptions\NotFoundException;
use App\Product;
use App\WebFramework\Api\ApiResult;
use App\WebFramework\Api\ApiResultWithData;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function get(){
        $products = Product::with(['Category'])->get();
        if(count($products) <= 0 )
            throw new ListEmptyException();

       return response()->json( new ApiResultWithData($products));
    }

    // Rout model binding is also possible
    // public function getById(Product $id)
    public function getById($id){
        $product = Product::where('id',$id)->firstOfFail();
        if($product == null )
            //this is also possible
            //abort(404 , "رکورد مورد نظر پیدا نشد")
            throw new NotFoundException();

        return response()->json( new ApiResultWithData($product));
    }

    public function create(Request $request){
        $this->performValidation($request);
        
        $path = $this->ImageUpload($request->file('file'));
        
        $product = new Product($request->toArray());
        $product->ImageUrl = $path;
        $product->save();
        return Response()->json(new ApiResultWithData($product));
    }

    public function update(Product $product ,Request $request){
        $this->performValidation($request);

        if($request->file("file")){
            $path = $this->ImageUpload($request->file('file'));

            $product = new Product($request->toArray());
            $product->ImageUrl = $path;
            $product->update();
        }else{
            $product->update($request->toArray());
        }
        
        
        return Response()->json(new ApiResultWithData($product));
    }

    public function delete(Product $product){
        $product->delete();
        return Response()->json(new ApiResult());
    }

    private function performValidation($request){
        $validator = Validator::make($request->toArray(),Product::$validationRules);
        if($validator->fails())
            //this is also possible
            //abort(400 , "پارامتر های ارسالی معتبر نیستند")
            throw new ValidationException($validator);
    }

    private function ImageUpload($imageUploaded){
        try{
            $basename = Str::random();
            $path =  $basename.".". $imageUploaded->getClientOriginalExtension();
            $imageUploaded->move(public_path('/images'),$path);
            return $path;
        }catch(Exception $exception){
            //this is also possible
            //abort(500 , "خطایی در سرور رخ داده است")
            throw new ApplicationException();
        }
        
    }
}
