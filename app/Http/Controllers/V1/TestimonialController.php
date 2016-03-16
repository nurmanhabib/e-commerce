<?php 

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
	/**
	 * Fungsi untuk menampilkan semua reputasi
	 * @return [type] [description]
	 */
	public function index()
	{
		$testimonials 	= Testimonial::all();

		return [
			'status'		=> 'success',
			'testimonials'	=> $testimonials
		];
	}

	/**
	 * Fungsi untuk menyimpan testimoni product
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'point_speed'	=> 'required',
			'point_quality'	=> 'required',
			'point_package'	=> 'required',
            'product_id'    => 'required|exists:products,id'
        ]);

        $testimony 	= $request->only(
        	'subject',
        	'testimonial',
        	'point_speed',
        	'point_quality',
        	'point_package',
        	'product_id'
        );

        $testimony 	= Testimonial::create($testimony);

        if ($testimony) {
        	return [
        		'status'	=> 'success',
        		'message'	=> 'Testimoni berasil disimpan.',
        		'testimony'	=> $testimony
        	];
        } else {
        	return [
        		'status'	=> 'failed',
        		'message' 	=> 'Testimoni gagal disimpan.',
        		'testimony'	=> null
        	];
        }
	}

	/**
	 * Fungsi untuk menampilkan testimoni berdasarkan id nya
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function show($id)
	{
		$testimony 	= Testimonial::find($id);

		if ($testimony) {
			return [
				'status'	=> 'success',
				'message'	=> 'Testimoni berhasil ditemukan.',
				'testimony'	=> $testimony
			];
		} else {
			return [
				'status'	=> 'failed',
				'message'	=> 'Testimoni tidak tersedia.',
				'testimony'	=> null
			];
		}
	}

	/**
	 * Fungsi untuk menyimpan pembaruan data testimony
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'point_speed'	=> 'required',
			'point_quality'	=> 'required',
			'point_package'	=> 'required',
            'product_id'    => 'required|exists:products,id'
        ]);

        $testimony 	= Testimonial::find($id);

        if ($testimony) {
        	$testimony->subject 		= $request->input('subject');
        	$testimony->testimonial		= $request->input('testimonial');
        	$testimony->point_speed		= $request->input('point_speed');
        	$testimony->point_quality	= $request->input('point_quality');
        	$testimony->point_package 	= $request->input('point_package');
        	$testimony->product_id 		= $request->input('product_id');

        	if ($testimony->save()) {
        		return [
        			'status'	=> 'success',
        			'message'	=> 'Testimony berhasil diperbarui.',
        			'testimony'	=> $testimony
        		];
        	} else {
        		return [
        			'status'	=> 'failed',
        			'message'	=> 'Testimony gagal diperbarui.',
        			'testimony'	=> $testimony
        		];
        	}

        } else {
        	return [
        		'status'	=> 'failed',
        		'message'	=> 'Testimony tidak tersedia.',
        		'testimony'	=> null
        	];
        }
	}

	/**
	 * Fungsi untuk menghapus testimony
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function destroy($id)
	{
		$testimony 	= Testimonial::find($id);

		if ($testimony) {

			if ($testimony->delete()) {
				return [
					'status'	=> 'success',
					'message'	=> 'Testimony berhasil dihapus.'
				];
			} else {
				return [
					'status'	=> 'failed',
					'message'	=> 'Testimony gagal dihapus.'
				];
			}

		} else {
			return [
				'status'	=> 'failed',
				'message'	=> 'Testimony tidak tersedia.'
			];
		}
	}
}