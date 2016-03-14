<?php 

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
	/**
	 * Fungsi untuk menampilkan seluruh daftar bank
	 * @return [type] [description]
	 */
    public function index()
    {
        $banks     = Bank::orderBy('id', 'desc')->get();
        return [
            'status'   => 'success',
            'banks'    => $banks
        ];
    }

    /**
     * Fungsi untuk menyimpan data bank baru
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
    	$this->validate($request, [
            'name'  => 'required',
            'logo'	=> 'required'
        ]);

        $bank = $request->only(
            'name',
            'logo'
        );

        $bank = Bank::create($bank);

        if ($bank) {
        	return [
        		'status' 	=> 'success',
        		'message'	=> 'Bank '.$bank->name.' berhasil ditambahkan.',
        		'bank'		=> $bank
        	];
        } else {
        	return [
        		'status'	=> 'failed',
        		'message' 	=> 'bank tidak berhasil ditambahkan.',
        		'bank'		=> null
        	];
        }
    }

    /**
     * Fungsi untuk menampilkan data bank tertentu
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id)
    {
    	$bank 	= Bank::find($id);

    	if ($bank) {
    		return [
    			'status'	=> 'success',
    			'message'	=> 'Data bank berhasil ditemukan.',
    			'bank'		=> $bank
    		];
    	} else {
    		return [
    			'status'	=> 'failed',
    			'message' 	=> 'Nama bank tidak terdaftar.',
    			'bank'		=> null
    		];
    	}
    }

    /**
     * Fungsi untuk menyimpan perubahan data bank
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $id)
    {
    	$this->validate($request, [
            'name'  => 'required',
            'logo'	=> 'required'
        ]);

        $bank 	= Bank::find($id);

        if ($bank) {
        	$bank->name = $request->input('name');
        	$bank->logo = $request->input('logo');

        	if ($bank->save()) {
        		return [
        			'status' 	=> 'success',
        			'message'	=> 'Data bank berhasil diperbarui',
        			'bank'		=> $bank
        		];
        	} else {
        		return [
        			'status'	=> 'failed',
        			'message'	=> 'Data bank gagal diperbarui.',
        			'bank'		=> $bank
        		];
        	}
        } else {
        	return [
        		'status' 	=> 'failed',
        		'message'	=> 'Nama bank tidak terdaftar.',
        		'bank'		=> null	
        	];
        }
    }

    /**
     * Fungsi untuk menghapus data bank
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id)
    {
    	$bank =	Bank::find($id);

    	if ($bank) {
    		if ($bank->delete()) {
    			return [
    				'status'	=> 'success',
    				'message'	=> 'Data bank berhasil dihapus.'
    			];
    		} else {
    			return [
    				'status'	=> 'failed',
    				'message'	=> 'Data bank tidak berhasil dihapus.'
    			];
    		}
    	} else {
    		return [
    			'status'	=> 'failed',
    			'message'	=> 'Data bank tidak ditemukan.'

    		];
    	}
    }
}