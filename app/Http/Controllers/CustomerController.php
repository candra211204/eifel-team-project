<?php

namespace App\Http\Controllers;

use App\Exports\PdfExport;
use App\Models\Buku;
use App\Models\Detailpesanan;
use App\Models\Kategori;
use App\Models\Pesanan;
use App\Models\User;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Midtrans\Config;
use Midtrans\Snap;

class CustomerController extends Controller
{
    public function index(Request $request){
        if ($request->has('search')) {
            $data = Buku::where('judul', 'LIKE', '%' . $request->search . '%')->orWhere('penulis', 'LIKE', '%' . $request->search . '%')->orWhere('penerbit', 'LIKE', '%' . $request->search . '%')->get();
        } else if ($request->has('kategori')) {
            $data = Buku::where('kategori_id', '=', $request->kategori)->get();
        } else {
            $data = Buku::all();
        }

        $kategori = Kategori::all();
        // $ratings = Buku::join('ratings', 'bukus.id', 'ratings.buku_id')->where('bukus.id', 'ratings.buku_id')->get();

        // dd($ratings);
        
        // $bukus = Buku::all()->where('id', '<', '3')->count();
        // // foreach($bukus as $data){
        // //     echo $data;
        //     dd($data);
        // // }

        if(isset(auth()->user()->name)){
        $carts = \Cart::session(auth()->user()->id)->getContent();

        return view('customer.index', [
            'listbuku' => $data,
            'kategori' => $kategori,
            // 'bukus' => $datas,
            'cart' => $carts
        ]);
        }else{
        return view('customer.index', [
            'listbuku' => $data,
            'kategori' => $kategori,
        ]);
        }
    }

    public function cartstore(Request $request){
        $buku = Buku::find($request->buku_id);
        // dd($buku);
        \Cart::session(auth()->user()->id)->add(
            $buku->id,
            $buku->judul,
            $buku->harga,
            $request->qty,
        );

        // Cart::add(array(
        //     'id' => $rowId,
        //     'name' => $Product->name,
        //     'price' => $Product->price,
        //     'quantity' => 4,
        //     'attributes' => array(),
        //     'associatedModel' => $Product
        // ));

        return redirect('/');
    }

    public function cart(){
        // Cart::destroy();
        // \Cart::clear();
        $datas = \Cart::session(auth()->user()->id)->getContent();
        $kategori = Kategori::all();

        return view('customer.cart.cart', [
            'carts' => $datas,
            'kategori' => $kategori,
        ]);
    }

    public function cart_update(Request $request){
        // dd($request);
        $data = \Cart::session(auth()->user()->id)->get($request->id);
        // dd($data);
        \Cart::session(auth()->user()->id)->update($data->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->qty,
            ),
        ));

        return redirect('cart');
    }

    public function cart_delete($id){
        // dd($harga);
        \Cart::session(auth()->user()->id)->remove($id);

        return redirect('cart');
    }

    public function check_out(){
        $datas = \Cart::session(auth()->user()->id)->getContent();
        $total = \Cart::session(auth()->user()->id)->getTotal();
        $date = date('Y-m-d H:i:s');

        Pesanan::create([
            'total' => $total,
            'order_id' => date('Y-m-d').'-'.auth()->user()->name.'-'.rand(),
            'metode_pembayaran' => 'gopai',
            'status' => 'menunggu pembayaran',
            'tanggal' => $date,
            'user_id' => Auth()->user()->id
        ]);

        $pesanan = Pesanan::where('user_id', auth()->user()->id)->where('tanggal', $date)->where('total', $total)->first();

        foreach($datas as $data){
            $total = \Cart::get($data->id)->getPriceSum();
            // dd($data);

            Detailpesanan::create([
                'harga' => $total,
                'jumlah' => $data->quantity,
                'pesanan_id' => $pesanan->id,
                'buku_id' => $data->id
            ]);
        }

        \Cart::clear();

        return redirect('/check-out/konfirmasi/'.$pesanan->id);
    }

    public function co_view($id){
        $data = Pesanan::find($id);
        $datas = Detailpesanan::where('pesanan_id',$id)->get();
        $kategori = Kategori::all();

        return view('customer.check-out', [
            'pesanan' => $data,
            'pesanans' => $datas,
            'kategori' => $kategori,
        ]);
    }

    public function midtrans($id){
            // $total = \Cart::session(auth()->user()->id)->getTotal();
            $pesanan = Pesanan::find($id);

            $total = $pesanan->total;
            $order = $pesanan->order_id;

            // Set your Merchant Server Key
            Config::$serverKey = 'SB-Mid-server-cq7kRbuqRQgu7TrMOWyyvTNF';
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            Config::$isProduction = false;
            // Set sanitization on (default)
            Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            Config::$is3ds = true;
    
            $params = array(
                'transaction_details' => array(
                    'order_id' => $order,
                    'gross_amount' => $total,
                ),
                "enabled_payments" => [
                    "bank_transfer", "shopeepay",
                ],
            );
            
            $snapToken = Snap::getSnapToken($params);
    
            return json_encode($snapToken);
        }

        public function pembayaran(Request $request){
            $json = json_decode($request->get('json'));
            // dd($json);
            $order_id = $json->order_id;
            // dd($order_id);
            $pesananid = Pesanan::where('order_id', $order_id)->first();
            $pesanan = Pesanan::find($pesananid->id);
            // dd($pesanan->id);
            $pesanan->update([
                'metode_pembayaran' => $json->payment_type,
                'status' => $json->status_message,
            ]);

            $datas = Detailpesanan::where('pesanan_id', $pesanan->id)->get();

            if($pesanan->status == 'Success, transaction is found'){
                foreach($datas as $data){
                    $buku = Buku::find($data->buku_id);

                    $buku->update([
                        'stok' => $buku->stok - $data->jumlah
                    ]);
                }
            }
            // dd($pesanan);
            return redirect('/');
        }

        public function pesanan(){
            $datas = Pesanan::where('user_id', auth()->user()->id)->get();
            $kategori = Kategori::all();
    
            return view('customer.daftar-pesanan.table', [
                'pesanans' => $datas,
                'kategori' => $kategori,
            ]);
        }

        public function detailpesanan($id){
            $datas = Detailpesanan::where('pesanan_id', $id)->get();
            $data = Pesanan::find($id);
            $kategori = Kategori::all();
    
            return view('customer.daftar-pesanan.detail', [
                'pesanans' => $datas,
                'kategori' => $kategori,
                'pesanan_data' => $data
            ]);
        }

        public function profil(){
            $kategori = Kategori::all();
            $data = User::find(auth()->user()->id);
    
            return view('customer.profil.profil', [
                'kategori' => $kategori,
            ]);
        }

        public function wilayah(){
            $wilayah = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
    
            return $wilayah->json();
        }

        public function profil_update(Request $request){
            if($request->provinces != 'Pilih Provinsi'){
                $prov = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
                $decpro = json_decode($prov, true);
                $jml = sizeof($decpro);
        
                for($i = 0; $i < $jml; $i++){
                    if($decpro[$i]['id'] == $request->provinces){
                        $prov = $decpro[$i]['name'];
                    }
                }
        
                $kota = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/regencies/'.$request->provinces.'.json');
                $decpro = json_decode($kota, true);
                $jml = sizeof($decpro);
        
                for($i = 0; $i < $jml; $i++){
                    if($decpro[$i]['id'] == $request->regencies){
                        $kota = $decpro[$i]['name'];
                    }
                }
        
                $kec = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/districts/'.$request->regencies.'.json');
                $decpro = json_decode($kec, true);
                $jml = sizeof($decpro);
        
                for($i = 0; $i < $jml; $i++){
                    if($decpro[$i]['id'] == $request->districts){
                        $kec = $decpro[$i]['name'];
                    }
                }
        
                $kel = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/villages/'.$request->districts.'.json');
                $decpro = json_decode($kel, true);
                $jml = sizeof($decpro);
        
                for($i = 0; $i < $jml; $i++){
                    if($decpro[$i]['id'] == $request->villages){
                        $kel = $decpro[$i]['name'];
                    }
                }
                
                $data = User::find(auth()->user()->id);
    
                $data->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'prov' => $prov,
                    'kab' => $kota,
                    'kec' => $kec,
                    'des' => $kel,
                    'detail' => $request->detail,
                ]);
            }else{
                $data = User::find(auth()->user()->id);
    
                $data->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
            }

            return \redirect('/user/profil');
        }

        public function exportPDF($id){
            return (new PdfExport)->idpesanan($id)->download('Invoices.pdf', \Maatwebsite\Excel\Excel::MPDF);
        }
}
