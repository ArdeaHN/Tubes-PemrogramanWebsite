<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     ** @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ProductCategory::get();
        $title = 'Hapus Kategori!';
        $text = "Apakah Anda yakin ingin menghapus?";
        confirmDelete($title, $text);
        return view('admin.pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $product_categories['name'] = $request->name;
        $product_categories['description'] = $request->description;

        ProductCategory::create($product_categories);

        toast('Data Kategori Produk Berhasil Disimpan', 'success', 'top-right');

        return redirect()->route('admin.category');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product_categories = ProductCategory::find($id);
        return view('admin.pages.category.show-detail.detail', compact('product_categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product_categories = ProductCategory::find($id);
        return view('admin.pages.category.show-detail.edit', compact('product_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $product_categories['name'] = $request->name;
        $product_categories['description'] = $request->description;

        ProductCategory::whereId($id)->update($product_categories);

        toast('Data Kategori Produk Berhasil Diperbaharui', 'success', 'top-right');
        return redirect()->route('admin.category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product_categories = ProductCategory::find($id);

        if ($product_categories) {
            $product_categories->delete();
        }
        toast('Data Kategori Produk Berhasil Dihapus', 'success', 'top-right');
        return redirect()->route('admin.category');
    }
}
