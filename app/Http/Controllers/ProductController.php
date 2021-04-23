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
    private function getCategories()
    {
        return DB::table('categories')->select('id','name')->get();
    }

    public function index()
    {
        return view(
            'product.index'
        )->with(
            'prod',
            Product::all()
        )->with(
            'cats',
            $this->getCategories()
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.new')->with('cats', $this->getCategories());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Product::create(
            [
                'name' => $request->nameProduct,
                'stock' => $request->stockProduct,
                'price' => $request->priceProduct,
                'category_id' => $request->catProduct
            ]
        );
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view(
            'product.update'
        )->with(
            'prod',
            Product::find($id)
        )->with(
            'cats',
            $this->getCategories()

        );
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
        Product::find($id)->fill(
            [
                'name' =>
                    $request->nameProduct,
                'stock' =>
                    $request->stockProduct,
                'price' =>
                    $request->priceProduct,
                'category_id' =>
                    $request->catProduct
            ]
        )->save();
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return $this->index();
    }
}
