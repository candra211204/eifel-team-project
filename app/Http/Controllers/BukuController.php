<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

use function PHPUnit\Framework\fileExists;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
                // dd($request->search);
                if($request->has('search')){
                    $data = Buku::where('judul','LIKE','%'.$request->search.'%')->orWhere('penulis','LIKE','%'.$request->search.'%')->orWhere('penerbit','LIKE','%'.$request->search.'%')->get();
                }else{
                    $data = Buku::all();
                }
                // dd($data);
                
                // $data = Buku::all();
                // $caribuku = $request->caribuku;
                // dd($caribuku);
                // $data = Buku::where('penulis', 'LIKE', '%'.$caribuku.'%');
        
                return view('admin.daftar-buku.index', [
                    'listbuku' => $data
                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $foreign = Kategori::all();
        return view('admin.daftar-buku.create', [
            'kategori' => $foreign
        ]);
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
            'judul' => 'required',
            'penulis' => 'required|string',
            'penerbit' => 'required|string',
            'sinopsis' => 'required|string',
            'stok' => 'required|integer',
            'harga' => 'required|integer',
            'kategori_id' => 'required|integer',
            'cover' => 'required|image'
        ]);

        $namacover = $request->judul.'-'.now()->timestamp;
        $file = $request->file('cover')->storeAs('cover', $namacover);

        // $request['cover'] = $namacover;
        // $buku = Buku::create($request->all());
        Buku::create([
            'judul' => $validate['judul'],
            'penulis' => $validate['penulis'],
            'penerbit' => $validate['penerbit'],
            'sinopsis' => $validate['sinopsis'],
            'stok' => $validate['stok'],
            'harga' => $validate['harga'],
            'kategori_id' => $validate['kategori_id'],
            'cover' => $file
        ]);
        // dd($request);
        return redirect(url('buku'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit(Buku $buku)
    {
        $kategori = kategori::all();

        return view('admin.daftar-buku.edit', [
            'buku' => $buku, 
            'kategori' => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buku $buku)
    {
        if($request->cover){    
            $validate = $request->validate([
                'judul' => 'required',
                'penulis' => 'required|string',
                'penerbit' => 'required|string',
                'sinopsis' => 'required|string',
                'stok' => 'required|integer',
                'harga' => 'required|integer',
                'kategori_id' => 'required|integer',
                'cover' => 'required|image'
            ]);

            if(fileExists('storage/'. $request->oldcover)){
                unlink('storage/'. $request->oldcover);
            }
            
            // dd($request->file('cover'));

            $namacover = $request->judul.'-'.now()->timestamp;
            $file = $request->file('cover')->storeAs('cover', $namacover);

            $buku->update([
            'judul' => $validate['judul'],
            'penulis' => $validate['penulis'],
            'penerbit' => $validate['penerbit'],
            'sinopsis' => $validate['sinopsis'],
            'stok' => $validate['stok'],
            'harga' => $validate['harga'],
            'kategori_id' => $validate['kategori_id'],
            'cover' => $file
            ]);
        }else{
            $validate = $request->validate([
                'judul' => 'required',
                'penulis' => 'required|string',
                'penerbit' => 'required|string',
                'sinopsis' => 'required|string',
                'stok' => 'required|integer',
                'harga' => 'required|integer',
                'kategori_id' => 'required|integer',
            ]);

            $buku->update([
            'judul' => $validate['judul'],
            'penulis' => $validate['penulis'],
            'penerbit' => $validate['penerbit'],
            'sinopsis' => $validate['sinopsis'],
            'stok' => $validate['stok'],
            'harga' => $validate['harga'],
            'kategori_id' => $validate['kategori_id'],
            ]);
        }

        return \redirect('/buku');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buku $buku)
    {
        unlink('storage/'. $$buku->cover);

        $buku->delete();
        
        return \redirect('/buku');
    }
}
