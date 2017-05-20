<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Response, DB, Hash;

class SalesController extends Controller{

      public function Property_type(Request $request){

          $propertys = DB::table('property_type')->get();
          return Response::json([
            'result' => 'Susccess',
            "code" => "0",
            'propertys' => $propertys,
          ]);

      }

      public function Sales_type(Request $request){
        $rules = [
          'property_id' => 'required|numeric',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        {
          $errors = array();
          print_r($validator->errors()->messages());
          foreach ($validator->errors()->messages() as $key => $value) {
            $errors[] = [
              'field' => $key,
              'message' => $value[0]
            ];
          }

          return Response::json([
            'result' => 'Error',
            "code" => "10",
            'errors' => $errors,
          ]);
        }

          $sales = DB::table('sales_type')->select('id', 'sales_name',
          'property_id')->where('property_id', $request->get('property_id'))->get();
          return Response::json([
            'result' => 'Susccess',
            "code" => "0",
            'sales' => $sales,
          ]);

      }

      public function Product_type(Request $request){
        $rules = [
          'sales_id' => 'required|numeric',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        {
          $errors = array();
          print_r($validator->errors()->messages());
          foreach ($validator->errors()->messages() as $key => $value) {
            $errors[] = [
              'field' => $key,
              'message' => $value[0]
            ];
          }

          return Response::json([
            'result' => 'Error',
            "code" => "10",
            'errors' => $errors,
          ]);
        }

          $product = DB::table('product_type')->select('id', 'product_name',
          'sales_id')->where('sales_id', $request->get('sales_id'))->get();
          return Response::json([
            'result' => 'Susccess',
            "code" => "0",
            'product' => $product,
          ]);

      }

}
