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
use App\Models\TransactionShipping;
use Prettus\Repository\Criteria\RequestCriteria;
use Tymon\JWTAuth\Facades\JWTAuth;

class TransactionRepository extends Repository
{
    public function model()
    {
        return Invoice::class;
    }

    public function saveTransactionShipping($destination)
    {
        if (is_numeric($destination)) {
            $address            = ShippingAddress::find($destination);
            $shippingAddress    = [
                'name'              => $address->name,
                'address_line_1'    => $address->address_line_1,
                'address_line_2'    => $address->address_line_2,
                'postal_code'       => $address->postal_code,
                'city'              => $address->city,
                'phone'             => $address->phone
            ];
        } else {
            $shippingAddress = $destination;
        }

        $transactionShipping = TransactionShipping::create($shippingAddress);

        return $transactionShipping;
    }

    public function splitProductsBySupplier(array $products, array $quantity)
    {
        $products = collect($products);

        $products = $products->map(function ($product_id) {
            return Product::find($product_id);
        });

        foreach ($products as $index=>$product) {
            $product['quantity'] = $quantity[$index];
        }

        $grouping = $products->groupBy(function ($product) {
            return $product->supplier_id;
        });

        $groupProductBySupplier = [];

        foreach ($grouping as $supplier_id => $products) {
            $supplier   = Supplier::find($supplier_id);
            $groupProductBySupplier[] = [
                'supplier'      => $supplier,
                'products'      => $products,
                'invoice_id'    => $this->generateInvoice($supplier),
                'checkout_date' => date('Y-m-d H:i:s'),
                'due_date'      => date('Y-m-d H:i:s', strtotime('+24 hours'))
            ];
        }

        return $groupProductBySupplier;
    }

    public function setPaymentConfirmation(Invoice $invoice, array $paymentConfirmation)
    {

    }

    public function createInvoice(User $user, array $invoice, Product $products, TransactionShipping $transactionShipping)
    {   
        $invoice = $user->invoices()->create($invoice);

        $invoice = $invoice->detail_invoice()->create($products);

        return $user->load('invoices');
    }

    public function getInvoice($invoice_code)
    {
        $invoice = $this->findWhere('code', $invoice_code);

        return $Invoice;
    }

    public function getInvoiceByUser(User $user)
    {
        $invoice = $this->findWhere('user_id', $user->id);

        return $invoice;
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
            'email'             => $email['to']['email'],
            'invoice_id'        => $invoice['invoice'],
            'invoice_item'      => $invoice['items'],
            'total_transfer'    => $invoice['total_prices']
        ];

        Mail::send('emails.invoice', $data, function ($message) use ($email) {
            $message->to($email['to']['email'], $email['to']['name']);
            $message->subject($email['subject']);
        });

        return $user;
    }

    public function setStatusInvoice(Invoice $invoice, $status)
    {
        $invoice->status    = $status;
        $invoice->save();

        return $invoice;
    }

    public function getAllInvoice()
    {
        $invoice = $this->all();

        return $invoice;
    }

    public function getInvoiceByStatus($status)
    {
        $invoice = $this->findWhere('status', $status);

        return $invoice;
    }

    public function checkUser($email)
    {
        $user   =   User::where('email', $email)->get();

        if (count($user) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserByEmail($email)
    {
        $user   =   User::where('email', $email)->get();

        return $user;
    }

    public function generateInvoice(Supplier $supplier)
    {
        $slug           = $supplier->slug;
        $date           = date('Ymd');
        $randomNumber   = rand(00000, 99999);

        $invoice    = 'INV/AMC/' . $slug . '/' . $date . '/' . $randomNumber;

        return $invoice;
    }

    public function generatePaymentCode()
    {
        return rand(001,999);
    }
}