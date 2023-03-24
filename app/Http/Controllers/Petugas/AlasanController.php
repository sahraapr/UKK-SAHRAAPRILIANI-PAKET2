<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Alasan;
use Illuminate\Http\Request;

class AlasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('_petugas.alasan.index');
    }

    public function getAlasan()
    {
        $data = Alasan::get();

        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row){
            $id = $row->id;
            $edit = route('_petugas.alasan.edit', $id);

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
            'alasan' => 'required'
        ]);
        
        Alasan::create($validate);

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
        $data = Alasan::findOrFail($id);

        return view('_petugas.alasan.edit', compact('data'));
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
        $data = Alasan::findOrFail($id);

        $validate = $request->validate([
            'alasan' => 'required'
        ]);

        $data->update([
            'alasan' => $request->alasan
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
        Alasan::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus',
            'success' => true
        ]);
    }
}
