<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

class ProductController extends Controller
{
	public function index() {
		return Products::all();
	}

	public function pollo() {
		return 'hola';
	}

	public function save_product(Request $request) {
		$inputs = $request->input();
		$response = Products::create($inputs);

		if (isset($response)) {
			return response()->json(['message' => 'Product created successfully'], 200);
		} else {
			return response()->json(['message' => 'Product can´t be created successfully'], 500);

		}
	}

	public function update(Request $request, $id) {
		$product = Products::find($id);

		if (isset($product)) {
			$product->name = $request->name;
			$product->description = $request->description;
			$product->stock = $request->stock;
			$product->price = $request->price;
			$product->image = $request->image;

			if ($product->save()) {
				return response()->json(['message' => 'Product update successfully'], 200);
			} else {
				return response()->json(['message' => 'Can´t update the data'], 404);
			}
		}	else {
			return response()->json(['message' => 'error'], 404);
		}
	}

	public function show($id) {
		$product = Products::find($id);

		if (isset($product)) {
			return response()->json([
				'data' => $product
			], 200);
		} else {
			return response()->json(['message' => 'Product doesn´t exist'], 404);
		}
	}

	public function delete($id) {
		$product = Products::find($id);

		if (isset($product)) {
			$response = Products::destroy($id);
			if ($response) {
				return response()->json(['message' => 'Product deleted successfully'], 200);
			} else {
				return response()->json(['message' => 'Can´t delete the product'], 500);
			}
		}	else {
			return response()->json(['message' => 'Product doesn´t exist'], 404);
		}
	}
}
