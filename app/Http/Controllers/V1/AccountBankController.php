<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\AccountBank;
use Illuminate\Http\Request;

class AccountBankController extends Controller
{
	/**
	 * Fungsi untuk menampilkan semua data akun bank supplier
	 * @return [type] [description]
	 */
	public function index()
	{
		$account_banks = AccountBank::all();

		return [
			'status' 		=> 'success',
			'account_banks'	=> $account_banks
		];
	}

	/**
	 * Fungsi untuk menyimpan data akun bank supplier
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
            'account_name'  	=> 'required',
            'account_number'	=> 'required',
            'bank_id'			=> 'required',
            'supplier_id'		=> 'required'
        ]);

        $account_bank = $request->only(
        	'account_name',  
            'account_number',
            'bank_id',	
            'supplier_id'
        );

        $account_bank = AccountBank::create($account_bank);

        if ($account_bank) {
        	return [
        		'status'		=> 'success',
        		'message'		=> 'Data account bank supplier berhasil ditambahkan.',
        		'account_bank'	=> $account_bank
        	];
        } else {
        	return [
        		'status'		=> 'failed',
        		'Message'		=> 'Data akun bank supplier gagal ditambahkan.',
        		'account_bank' 	=> null
        	];
        }
	}

	/**
	 * Fungsi untuk menampilkan detail dari akun bank supplier
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function show($id)
	{
		$account_bank = AccountBank::find($id);

		if ($account_bank) {
			return [
				'status'		=> 'success',
				'message'		=> 'Data akun bank berhasil ditemukan.',
				'account_bank'	=> $account_bank
			];
		} else {
			return [
				'status'		=> 'failed',
				'message'		=> 'Data akun bank tidak berhasil ditemukan.',
				'account_bank'	=> null
			];
		}
	}

	/**
	 * Fungsi untuk menyimpan pembaruan data akun bank supplier
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function update(Request $request, $id)
	{
		$this->validate($request, [
            'account_name'  	=> 'required',
            'account_number'	=> 'required',
            'bank_id'			=> 'required',
            'supplier_id'		=> 'required'
        ]);

        $account_bank = AccountBank::find($id);

        if ($account_bank) {
        	$account_bank->account_name 	= $request->input('account_name');
        	$account_bank->account_number	= $request->input('account_number');
        	$account_bank->bank_id 			= $request->input('bank_id');
        	$account_bank->supplier_id		= $request->input('supplier_id');

        	if ($account_bank->save()) {
        		return [
        			'status'		=> 'success', 
        			'message'		=> 'Data akun bank berhasil diperbarui',
        			'account_bank'	=> $account_bank
        		];
        	} else {
        		return [
        			'status'		=> 'failed',
        			'message'		=> 'Data akun bank gagal diperarui.',
        			'account_bank'	=> $account_bank
        		];
        	}
        } else {
        	return [
        		'status'		=> 'failed',
        		'message'		=> 'Data account bank tidak ditemukan.',
        		'account_bank'	=> null
        	];
        }
	}

	/**
	 * Fungsi untuk menghapus data akun bank supplier
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function destroy($id)
	{
		$account_bank 	= AccountBank::find($id);

		if ($account_bank) {
			if ($account_bank->delete()) {
				return [
					'status'	=> 'success',
					'message'	=> 'Data akun bank supplier berhasil dihapus.'
				];
			} else {
				return [
					'status'	=> 'failed',
					'message'	=> 'Data akun bank supplier gagal dihapus.'
				];
			}
		} else {
			return [
				'status'		=> 'failed',
				'message'		=> 'Data akun bank supplier tidak ditemukan.' 
			];
		}
	}
}