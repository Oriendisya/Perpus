<?php

namespace App\Http\Controllers\admin;

use App\Buku;
use App\DetailPeminjaman;
use App\Http\Controllers\Controller;
use App\Peminjaman;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'action' => route('admin.loan.store'),
            'user' => User::where('role', 'peminjam')->get(),
            'book' => Buku::all(),
        ];

        return view('admin.pages.loan', $data);
    }

    public function datatable()
    {
        $data = Peminjaman::with([
            'user',
            'detail_peminjaman',
            'detail_peminjaman.book',
        ]);

        return DataTables::of($data)
            ->addColumn('denda_format', function(Peminjaman $loan) {
                return 'Rp '.number_format($loan->denda);
            })
            ->addColumn('book', function() use($data) {
                $html = '<ul>';

                foreach ($data->first()->detail_peminjaman as $detail) {
                    $html .= "
                        <li>".$detail->book->judul."</li>
                    ";
                }

                $html .= '</ul>';

                return $html;
            })
            ->addColumn('action', function(Peminjaman $loan) {
                return "
                    <a class='btn btn-sm btn-success' href='".route('admin.loan.return.book', $loan->id)."'>Kembalikan</a>
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
        DB::beginTransaction();

        $request->validateWithBag('message', [
            'tanggal_pengembalian' => 'required',
            'user_id' => 'required',
            'denda' => 'required',
            'book_id.*' => 'required',
            'book_id' => 'required',
        ]);

        $request->request->add([
            'tanggal_peminjaman' => date('Y-m-d')
        ]);

        $peminjaman = Peminjaman::create($request->all());

        foreach ($request->book_id as $book_id) {
            DetailPeminjaman::create([
                'peminjaman_id' => $peminjaman->id,
                'book_id' => $book_id
            ]);
        }

        DB::commit();

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
            'data' => Peminjaman::find($id),
            'action' => route('admin.loan.update', $id),
        ];
        return view('admin.pages.loan', $data);
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
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required|numeric',
            'role' => 'required',
        ]);

        if ($request->password) {
            $request->merge([
                'password' => Hash::make($request->password)
            ]);
        }else{
            unset($request['password']);
        }

        Peminjaman::where('id', $id)->update($request->except([
            '_token'
        ]));

        return redirect()->route('admin.loan.index')
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
        Peminjaman::where('id', $id)->delete();

        return redirect()->back()->with(['success' => 'Data Berhasil Dihapus']);
    }

    public function returnBook($id)
    {
        Peminjaman::where('id', $id)->update([
            'is_return' => true
        ]);

        return redirect()->back()->with(['success' => 'Buku berhasil dikembalikan']);
    }
}
