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
	public function model()
    {
        return Invoice::class;
    }

    public function saveTransactionShipping(array $buyer)
    {
    	$transactionShipping = $this->transaction_address()->create($buyer);

    	return $transactionShipping;
    }

    public function splitProductsBySupplier(array $products)
    {
    	$products = collect($products);

    	$products = $products->map(function ($product_id) {
    		return Product::find($product_id);
    	});

    	$grouping = $products->groupBy(function ($product) {
    		return $product->supplier_id;
    	});

    	$groupProductBySupplier = [];

    	foreach ($grouping as $supplier_id => $products) {
    		$groupProductBySupplier[] = [
    			'supplier'	=> Supplier::find($supplier_id),
    			'products'	=> $products
    		];
    	}

    	return $groupProductBySupplier;
    }

	public function createInvoice(User $user, Invoice $invoice, array $products, ShippingAddress $shippingAddress)
	{
		$invoice = $invoice->detail_invoice()->create($products);

		$user->invoices()->create($invoice);

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

	public function sendmailInvoice(User $user, Invoice $invoice)
	{
        $data   = [
        	'email' 			=> $email['to']['email'],
            'invoice_id'  		=> $invoice['invoice'],
            'invoice_item' 		=> $invoice['items'],
            'total_transfer'	=> $invoice['total_prices']
        ];

        Mail::send('emails.invoice', $data, function ($message) use ($email) {
            $message->to($email['to']['email'], $email['to']['name']);
            $message->subject($email['subject']);
        });

        return $user;
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