<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $product;

    protected $productService;
    /**
     * Display a listing of the resource.
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product_categories = ProductCategory::all();
        $product = Product::whereNull('deleted_at')->get();
        $title = 'Hapus Produk!';
        $text = "Apakah Anda yakin ingin menghapus?";
        confirmDelete($title, $text);
        return view('admin.pages.product.index', compact('product_categories', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product_categories = ProductCategory::all();
        $product = Product::all();
        return view('admin.pages.product.modal.addproduct', compact('product_categories', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirimkan dari formulir
        $validatedData = $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            // Sesuaikan dengan jenis file gambar yang diizinkan
        ]);

        // Upload gambar produk
        $imagePath = $request->file('image')->store('product_images', 'public');

        // Simpan data produk ke database
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->weight = $request->weight;
        $product->image = $imagePath; // Simpan path gambar yang diunggah
        $product->save();
        toast('Data Produk Berhasil di tambahkan', 'success', 'top-right');

        // Redirect kembali ke halaman produk atau sesuai kebijakan Anda
        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil ditambahkan ');

        // Proses penyimpanan data produk ke database
        // ...

        // Redirect kembali ke halaman produk atau sesuai kebijakan Anda
    }

    /**
     * Display the specified resource.
     */
    public function show($product)
    {
        $product_categories = ProductCategory::all();
        $product = Product::findOrFail($product);
        return view('admin.pages.product.show-detail.detail', compact('product', 'product_categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {
        $product = Product::find($id);
        // You may also need to fetch the product categories for your select dropdown here.
        // Example:
        $product_categories = ProductCategory::all();

        return view('admin.pages.product.show-detail.edit-product', compact('product', 'product_categories'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang dikirimkan dari formulir
        $validatedData = $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'weight' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif', // Anda dapat memungkinkan pembaruan gambar opsional
        ]);

        // Temukan produk yang akan diperbarui
        $product = Product::find($id);

        if (!$product) {
            // Handle jika produk tidak ditemukan, misalnya dengan melempar exception atau menampilkan pesan kesalahan
            return redirect()->route('admin.product.index')->with('error', 'Produk tidak ditemukan');
        }

        // Update data produk yang ada
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->weight = $request->weight;

        if ($request->hasFile('image')) {
            // Jika ada gambar baru yang diunggah, hapus gambar lama (opsional) dan simpan yang baru
            Storage::disk('public')->delete($product->image);
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = $imagePath;
        }

        $product->save();


        toast('Data Product Berhasil di perbaharui', 'success', 'top-right');
        // Redirect kembali ke halaman produk atau sesuai kebijakan Anda
        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil diperbarui');
    }


    public function destroy($product)

    {
        try {
            DB::beginTransaction();
            $product = Product::findOrFail($product);
            $product->delete();
            DB::commit();
            toast('Data Product Berhasil di hapus', 'success', 'top-right');
            return to_route('admin.product.index')->with('success', "data Product sudah dihapus");
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
            // return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
