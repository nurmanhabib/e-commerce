<?php 

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
	/**
	 * Fungsi untuk menampilkan daftar seluruh payment method
	 * @return [type] [description]
	 */
	public function index()
    {
        $payment_methods     = PaymentMethod::orderBy('id', 'desc')->get();
        return [
            'status'        	=> 'success',
            'payment_methods'   => $payment_methods
        ];
    }

    /**
     * Fungsi untuk menyimpan data metode pembayaran
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
    	$this->validate($request, [
            'name'  		=> 'required',
            'description'	=> 'required'
        ]);

        $payment_method = $request->only(
            'name',
            'description'
        );

		$payment_method = PaymentMethod::create($payment_method);     
		
		if ($payment_method) {
			return [
				'status'			=> 'success',
				'message'			=> 'Metode pembayaran berhasil ditambahkan.',
				'payment_method'	=> $payment_method
			];
		} else {
			return [
				'status'			=> 'failed',
				'message'			=> 'Metode pembayaran gagal disimpan.',
				'payment_method'	=> null
			];
		}
    }

    /**
     * Fungsi untuk menampilkan detail metode pembayaran tertentu
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id)
    {
    	$payment_method 	= PaymentMethod::find($id);

    	if ($payment_method) {
    		return [
    			'status'			=> 'success',
    			'message'			=> 'Date metode pembayaran berhasil ditemukan.',
    			'payment_method'	=> $payment_method
    		];
    	} else {
    		return [
    			'status'			=> 'failed',
    			'message'			=> 'Data metode pembayaran tidak ditemukan.',
    			'payment_method'	=> null
    		];
    	}
    }

    /**
     * Fungsi untuk menyimpan pembaruan data metode pembayaran
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $id)
    {
    	$this->validate($request, [
            'name'  		=> 'required',
            'description'	=> 'required'
        ]);

        $payment_method = PaymentMethod::find($id);

        if ($payment_method) {
        	$payment_method->name 			= $request->input('name');
        	$payment_method->description 	= $request->input('description');

        	if ($payment_method->save()) {
        		return [
        			'status'			=> 'success',
        			'message'			=> 'Metode pembayaran berhasil diperbarui.',
        			'payment_method'	=> $payment_method
        		];
        	} else {
        		return [
        			'status'			=> 'failed',
        			'message'			=> 'Data metode pembayaran gagal diperbarui.',
        			'payment_method'	=> $payment_method
        		];
        	}
        } else {
        	return [
        		'status'			=> 'failed',
        		'message'			=> 'Data metode pembayaran tidak ditemukan.',
        		'payment_method'	=> null
        	];
        }
    }

    /**
     * Fungsi untuk menghapus data metode pembayaran
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id)
    {
    	$payment_method = PaymentMethod::find($id);

    	if ($payment_method) {
    		if ($payment_method->delete()) {
    			return [
    				'status'	=> 'success',
    				'message'	=> 'Metode pembayaran berhasil dihapus',
    			];
    		} else {
    			return [
    				'status'			=> 'failed',
    				'message'			=> 'Metode pembayaran gagal dihapus.'
    			];
    		}
    	} else {
    		return [
    			'status'			=> 'failed',
    			'message'			=> 'Metode pembayaran tidak ditemukan.'
    		];
    	}
    }
}