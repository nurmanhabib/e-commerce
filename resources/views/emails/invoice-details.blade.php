@extends('layouts.email')

@section('content')
    <div id=":253" class="ii gt m1531b755ebbeb0f6 adP adO">
		<div id=":24x" class="a3s" style="overflow: hidden;">
			<u></u>
			<div style="background:#f9f9f9;color:#373737;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-size:17px;line-height:24px;max-width:100%;width:100%!important;margin:0 auto;padding:0">
				<table style="border-collapse:collapse;line-height:24px;margin:0;padding:0;width:100%;font-size:17px;color:#373737;background:#8BB9F5; border-radius: 10px;" border="0" cellpadding="0" cellspacing="0" width="100%">
					<tbody>
						<tr>
							<td style="border-collapse:collapse" valign="top">
								<table style="border-collapse:collapse" border="0" cellpadding="0" cellspacing="0" width="100%">
									<tbody>
										<tr>
											<td style="border-collapse:collapse;padding:20px 16px 12px" valign="bottom">
												<div style="text-align:center">
													<a href="https://www.slack.com" style="color:#439fe0;font-weight:bold;text-decoration:none;word-break:break-word" target="_blank">
																				<!-- <img class="CToWUd" src="https://ci5.googleusercontent.com/proxy/79C4QYCVhMwY_KK8LVXiGp6kz_c6D71WL_zVp6r3IOo0TLVxYanwjlq0eoG2c4MFV0s9GOU3VA1PX5CotkszUbTw_cL4CqyhoUnNRhqLyQDD_9NVlg=s0-d-e1-ft#https://slack.global.ssl.fastly.net/66f9/img/slack_logo_240.png" style="outline:none;text-decoration:none;border:none;width:120px;min-height:36px"> -->
																				<h2>LOGO</h2>
													</a>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td style="border-collapse:collapse" valign="top">	
								<table style="border-collapse:collapse;background:white;border-radius:0.5rem;margin-bottom:1rem" align="center" border="0" cellpadding="32" cellspacing="0">
									<tbody>
										<tr>
											<td style="border-collapse:collapse" valign="top" width="556">
												<div style="max-width:540px;margin:0 auto">
													<div style="background:white;border-radius:0.5rem;margin-bottom:1rem">
														<h2 style="color:#2ab27b;line-height:30px;margin-bottom:12px;margin:0 0 12px">
															<center>Hai {{ $email }} !!</center>
														</h2>

														<p style="font-size:18px;line-height:24px;margin:0 0 16px">
															Terima kasih sudah melakukan pemesanan.
														</p>
														<p>
															Anda sudah melakukan check-out untuk pemesanan dari toko {{ $toko }}.
														</p>
														<p>
															<div style="margin:0 0 20px;padding:0">
																<table style="width:100%;max-width:100%;border-collapse:collapse;border-spacing:0;background-color:transparent;margin:5px 0;padding:0" bgcolor="transparent">
																	<tbody style="margin:0;padding:0">
																		<tr>
																			<td style="width:25%;font-size:13px;vertical-align:top;line-height:18px;margin:0;padding:0 10px 0 0" valign="top">
																				Nomor Pembayaran
																			</td>
																			<td>:</td>
																			<td> {{$invoice}}</td>
																		</tr>
																		<tr>
																			<td style="width:25%;font-size:13px;vertical-align:top;line-height:18px;margin:0;padding:0 10px 0 0" valign="top">
																				Nama Toko
																			</td>
																			<td>:</td>
																			<td> {{$toko}}</td>
																		</tr>
																		<tr>
																			<td style="width:25%;font-size:13px;vertical-align:top;line-height:18px;margin:0;padding:0 10px 0 0" valign="top">
																				Total Nilai Pesanan
																			</td>
																			<td>:</td>
																			<td> {{rupiahFormat($total_payment)}}</td>
																		</tr>
																		<tr>
																			<td style="width:25%;font-size:13px;vertical-align:top;line-height:18px;margin:0;padding:0 10px 0 0" valign="top">
																				Tanggal Transaksi
																			</td>
																			<td>:</td>
																			<td> {{$checkout_date}}</td>
																		</tr>
																		<tr>
																			<td style="width:25%;font-size:13px;vertical-align:top;line-height:18px;margin:0;padding:0 10px 0 0" valign="top">
																				Batas Transaksi
																			</td>
																			<td>:</td>
																			<td> {{$due_date}}</td>
																		</tr>
																		<tr style="margin:0;padding:0">
																			<td style="width:25%;font-size:13px;vertical-align:top;line-height:18px;margin:0;padding:0 10px 0 0" valign="top">
																				Status Pembayaran
																			</td>
																			<td>:</td>
																			<td style="font-size:13px;vertical-align:top;line-height:18px;margin:0;padding:0 10px 0 0" valign="top">
																				<div style="margin:0 0 4px;padding:0">
																					<span style="color:#ffffff;font-size:11px;text-decoration:none;outline:none;background-color:#ec7000!important;margin:0;padding:0 5px 1px;border:1px solid #ec7000!important">
																						Menunggu konfirmasi pembayaran
																					</span>
																				</div>
																			</td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</p>
														<p>
															<h5>Rincian Pemesanan :</h5>
														</p>
														<p>
															<table style="border:#777 1px solid; width:100%;">
																<thead>
																	<tr style="background-color:#2ab27b;">
																		<th colspan="4">Rincian Pemesanan</th>
																	</tr>
																	<tr>
																		<td>Nama Barang</td>
																		<td>Harga Barang</td>
																		<td>Jumlah Barang</td>
																		<td>Harga Jumlah Barang</td>
																	</tr>
																</thead>
																<tbody>
																	@foreach ($products as $product)
																	<tr>
																		<td>{{$product['name']}}</td>
																		<td>{{rupiahFormat($product['price'])}}</td>
																		<td>{{$product['quantity']}}</td>
																		<td>{{rupiahFormat(($product['price']*$product['quantity']))}}</td>
																	</tr>
																	@endforeach
																</tbody>
															</table>
														</p>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td style="border-collapse:collapse">
								<table style="border-collapse:collapse;margin-top:1rem;background:white;color:#989ea6" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
									<tbody>
										<tr>
											<td style="border-collapse:collapse;height:5px;background-image:url('https://ci4.googleusercontent.com/proxy/HzVdB1b8ViwO5j9_pLX5Fk4HKXY232E1BpGTE7cX4LYydeKxvOnovyQv85NrUdewb44TDk3Ydo0VEPG9UAtF351uBDMZu1Hcv9bgR_qho9VfyNAelMdW=s0-d-e1-ft#https://slack.global.ssl.fastly.net/66f9/img/email-ribbon_@2x.png');background-repeat:repeat-x">
											</td>
										</tr>
										<tr>
											<td style="border-collapse:collapse;padding:16px 8px 24px" align="center" valign="top">
												<div style="max-width:600px;margin:0 auto">
													<a href="#">admin@amtekcommerce.com</a>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="yj6qo"></div><div class="adL">
			</div>
		</div>
	</div>
@stop