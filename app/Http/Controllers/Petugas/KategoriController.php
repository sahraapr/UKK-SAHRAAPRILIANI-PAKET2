<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('_petugas.kategori.index');
    }

    public function getKategori()
    {
        $data = Kategori::get();

        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row){
            $id = $row->id;
            $edit = route('_petugas.kategori.edit', $id);

            $actionbtn = '<a href="'. $edit .'" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>
                            <a href="javascript:void(0)" onclick="deleteData(\''. $id .'\')" class="btn btn-sm btn-danger"><i
                                    class="far fa-trash-alt"></i></a>';
            return $actionbtn;
        })
        ->rawColumns(['action'])
        ->make(true);
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
        $validate = $request->validate([
            'nama' => 'required'
        ]);
        
        Kategori::create($validate);

        alert()->success('Berhasil!','Data berhasil ditambahkan')->persistent(true,false)->autoClose(3000);

        return back();
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
        $data = Kategori::findOrFail($id);

        return view('_petugas.kategori.edit', compact('data'));
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
        $data = Kategori::findOrFail($id);

        $validate = $request->validate([
            'nama' => 'required'
        ]);

        $data->update([
            'nama' => $request->nama
        ]);

        alert()->success('Berhasil!','Data berhasil diubah')->persistent(true,false)->autoClose(3000);

        return redirect()->route('_petugas.kategori');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kategori::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus',
            'success' => true
        ]);
    }
}
