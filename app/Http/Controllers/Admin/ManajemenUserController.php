<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Storage;
use RahulHaque\Filepond\Facades\Filepond;


class ManajemenUserController extends Controller
{
    public function index()
    {
        $users = User::all();

        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('admin.pages.manajemen-user.index', compact('users'));
    }

    public function show($user)
    {
        $user = User::findOrFail($user);
        return view('admin.pages.manajemen-user.show-detail.detail', compact('user'));
    }

    public function edit($user)
    {
        $user = User::findOrFail($user);
        return view('admin.pages.manajemen-user.show-detail.edit', compact('user'));
    }

    public function invoice($user)
    {
        $user = User::findOrFail($user);
        return view('admin.pages.manajemen-user.show-detail.invoice', compact('user'));
    }

    public function destroy($user)

    {
        try {
            DB::beginTransaction();
            $user = User::findOrFail($user);
            $user->delete();
            DB::commit();

            // menampilkan alert success setelah confirmasi disetujui
            toast('Data Pengguna sudah dihapus', 'success', 'top-right');

            return to_route('admin.user.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
