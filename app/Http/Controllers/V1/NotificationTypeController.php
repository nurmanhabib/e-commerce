<?php 

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\NotificationType;
use Illuminate\Http\Request;

class NotificationTypeController extends Controller
{
	/**
	 * Fungsi untuk mengambil semua data tipe notifikasi
	 * @return [type] [description]
	 */
	public function index()
	{
		$notificationTypes 	= NotificationType::all();

		return [
			'status'				=> 'success',
			'notification_types'	=> $notificationTypes
		];
	}

	/**
	 * Fungsi untuk menyimpan data tipe notifikasi
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
            'name'       => 'required'
        ]);

        $notificationType 	= $request->only(
        	'name',
        	'logo'
        );

        $notificationType 	= NotificationType::create($notificationType);

        if ($notificationType) {
        	return [
        		'status'			=> 'success',
        		'message'			=> 'Data tipe notifikasi berhasil disimpan.',
        		'notification_type'	=> $notificationType
        	];
        } else {
        	return [
        		'status'			=> 'failed',
        		'message'			=> 'Data tipe notifikasi tidak berhasil disimpan.',
        		'notification_type'	=> null
        	];
        }
	}

	/**
	 * Fungsi untuk menampilkan tipe notifikasi berdasarkan id nya
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function show($id)
	{
		$notificationType 	= NotificationType::find($id);

		if ($notificationType) {
			return [
				'status'			=> 'success',
				'message'			=> 'Data notifikasi berhasil ditemukan.',
				'notification_type'	=> $notificationType
			];
		} else {
			return [
				'status'			=> 'failed',
				'message'			=> 'Data tipe notifikasi tidak tersedia.',
				'notification_type'	=> null
			];
		}
	}

	/**
	 * Fungsi untuk menyimpan perubahan pada data tipe notifikasi
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function update(Request $request, $id)
	{
		$this->validate($request, [
            'name'       => 'required'
        ]);

        $notification_type 	= NotificationType::find($id);

        if ($notificationType) {
        	$notificationType->name 	= $request->input('name');
        	$notificationType->logo 	= $request->input('logo');

        	if ($notificationType->save()) {
        		return [
        			'status'			=> 'success',
        			'message'			=> 'Data tipe notifikasi berhasil disimpan.',
        			'notification_type'	=> $notificationType
        		];
        	} else {
        		return [
        			'status'			=> 'failed',
        			'message'			=> 'Data tipe notifikasi gagal disimpan.',
        			'notification_type'	=> $notificationType
        		];
        	}

        } else {
        	return [
        		'status'			=> 'failed',
        		'message'			=> 'Data tipe notifikasi tidak ditemukan.',
        		'notification_type'	=> null
        	];
        }
	}

	/**
	 * Fungsi untuk menghapus data tipe notifikasi
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function destroy($id)
	{
		$notificationType 	= NotificationType::find($id);

		if ($notificationType) {

			if ($notificationType->delete()) {
				return [
					'status'	=> 'success',
					'message'	=> 'Data tipe notifikasi berhasil dihapus.'
				];
			} else {
				return [
					'status'	=> 'failed',
					'message'	=> 'Data tipe notifikasi gagal dihapus.'
				];
			}

		} else {
			return [
				'status'	=> 'failed',
				'message'	=> 'Data tipe notifikasi tidak ditemukan.'
			];
		}
	}
}