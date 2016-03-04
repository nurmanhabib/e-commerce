<?php
/**
 * Created by PhpStorm.
 * User: bihama
 * Date: 17/02/2016
 * Time: 21.54
 */

namespace App\Repositories;

use App\Events\UserRegistered;
use App\Models\Product;
use App\Models\User;
use App\Models\Supplier;
use App\Models\ShippingAddress;
use App\Models\invoice;
use Prettus\Repository\Criteria\RequestCriteria;
use Tymon\JWTAuth\Facades\JWTAuth;

class TransactionRepository extends Repository
{
	public function createInvoice(User $user, array $product)
	{
		$user->invoices()->create($product);

        return $user->load('invoices');
	}

	public function getInvoice($invoice_code)
	{
		$invoice = Invoice::where('code', $invoice_code)->first();

		return $Invoice;
	}

	public function getInvoiceByUser(User $user)
	{
		$invoice = Invoice::where('user_id', $user->id)->get();

		return $invoice;
	}

	public function addFund(User $user, int $nominal)
	{

	}

	public function checkBalance(User $user, int $nominal)
	{

	}

	public function createTransferConfirmation(Invoice $invoice, $bank_name, $on_behalf, $nominal)
	{

	}

	public function sendmailInvoice(User $user, array $invoice)
	{

	}

	public function setStatusInvoice(Invoice $invoice, $status)
	{
		$invoice->status 	= $status;
		$invoice->save();

		return $invoice;
	}

	public function getAllInvoice()
	{
		$invoice = Invoice::all();

		return $invoice;
	}

	public function getInvoiceByStatus($status)
	{
		$invoice = Invoice::where('status', $status)->get();

		return $invoice;
	}
}