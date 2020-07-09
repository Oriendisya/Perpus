<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['action'] = route('admin.book.store');
        return view('admin.pages.book', $data);
    }

    public function datatable()
    {
        return DataTables::of(Buku::query())
            ->addColumn('render', function(Buku $book) {
                return "
                    <img src='".url($book->gambar)."' alt='' height='150px'>
                ";
            })
            ->addColumn('action', function(Buku $book) {
                return "
                    <a class='btn btn-sm btn-warning' href='".route('admin.book.edit', $book->id)."'>Edit</a>
                    <a class='btn btn-sm btn-danger' href='".route('admin.book.destroy', $book->id)."'>Hapus</a>
                ";
            })
            ->escapeColumns([])
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validateWithBag('message', [
            'judul' => 'required',
            'penerbit' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png',
            'tahun_terbit' => 'required',
        ]);

        $request->request->add([
            'gambar' => $request->file('image')->store('assets/images')
        ]);

        Buku::create($request->except([
            'image'
        ]));

        return redirect()->back()->with(['success' => 'Data Berhasil Tersimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'data' => Buku::find($id),
            'action' => route('admin.book.update', $id),
        ];
        return view('admin.pages.book', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validateWithBag('message', [
            'judul' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
        ]);

        $book = Buku::find($id);

        if ($request->image) {
            $request->validateWithBag('message', [
                'image' => 'required|mimes:jpg,jpeg,png',
            ]);

            $request->request->add([
                'gambar' => $request->file('image')->store('assets/images')
            ]);

            Storage::delete($book->gambar);
        }

        Buku::where('id', $id)->update($request->except([
            '_token',
            'image',
        ]));

        return redirect()->route('admin.book.index')
            ->with(['success' => 'Data Berhasil Diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Buku::find($id);
        Buku::where('id', $id)->delete();

        Storage::delete($book->gambar);

        return redirect()->back()->with(['success' => 'Data Berhasil Dihapus']);
    }
}