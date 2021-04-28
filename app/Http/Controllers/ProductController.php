<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return json_encode(Product::all());
    }

    public function indexView()
    {
        return view(
            'product.index'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prod = Product::create(
            [
                'name' => $request->input('name'),
                'stock' => $request->input('stock'),
                'price' => $request->input('price'),
                'category_id' => $request->input('category_id')
            ]
        );
        return json_encode($prod);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prod = Product::find($id);
        if ($prod) {
            return json_encode($prod);
        }
        return response('Error', 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $prod = Product::find($id);
        if ($prod) {
            $prod->fill(
                [
                    'name' => $request->input('name'),
                    'stock' => $request->input('stock'),
                    'price' => $request->input('price'),
                    'category_id' => $request->input('category_id')
                ]
            )->save();
            return json_encode($prod);
        }
       return response(
            'Deu errado issoae manin',
            404
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Product::find($id)->delete()) {
            return response('OK', 200);
        } else {
            return response('ERROR', 404);
        }
    }
}
