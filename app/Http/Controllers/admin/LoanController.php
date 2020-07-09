<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $data['action'] = route('admin.loan.store');
        return view('admin.pages.loan', $data);
    }

    public function datatable()
    {
        return DataTables::of(Peminjaman::query())
            ->addColumn('action', function(Peminjaman $loan) {
                return "
                    <a class='btn btn-sm btn-warning' href='".route('admin.loan.edit', $loan->id)."'>Edit</a>
                    <a class='btn btn-sm btn-danger' href='".route('admin.loan.destroy', $loan->id)."'>Hapus</a>
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
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required|numeric',
            'role' => 'required',
            'password' => 'required',
        ]);

        $request->merge([
            'password' => Hash::make($request->password)
        ]);

        Peminjaman::create($request->all());

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
}
