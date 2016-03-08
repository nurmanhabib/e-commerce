<?php 

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Repositories\TransactionRepository;
use App\Repositories\ProductRepository;
use App\Models\Invoice;
use App\Models\User;
use App\Model\Product;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
	protected $transactionRepository, $productRepository;

    public function __construct(TransactionRepository $transactionRepository, ProductRepository $productRepository)
    {
        $this->transactionRepository 	= $transactionRepository;
        $this->productRepository 		= $productRepository;
    }

	public function checkout(Request $request)
	{
		$products 		= $request->get('product_id');
		$quantities 	= $request->get('quantity');
		$invoiceId 		= $request->get('invoice_id');
		$buyer 			= $request->get('buyer');

		$products 	= $this->transactionRepository->splitProductsBySupplier($products);

		return [
			'status' 		=> 'success',
			'products' 		=> $products,
			'invoice_id'	=> $invoiceId,
			'buyer' 		=> $buyer,
			'quantity'		=> $quantities
		];
	}

	public function sendmailInvoice(Request $request)
	{
		
	}
}