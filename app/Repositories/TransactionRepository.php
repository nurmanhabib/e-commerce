<?php
/**
 * Created by PhpStorm.
 * User: bihama
 * Date: 17/02/2016
 * Time: 21.54
 */

namespace App\Repositories;

use App\Supports\Contracts\Buyerable;
use App\Events\UserRegistered;
use App\Models\Product;
use App\Models\User;
use App\Models\Supplier;
use App\Models\ShippingAddress;
use App\Models\Invoice;
use App\Models\TransactionShipping;
use Carbon\Carbon;
use Prettus\Repository\Criteria\RequestCriteria;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Mail;

class TransactionRepository extends Repository
{
    public function model()
    {
        return Invoice::class;
    }

    public function saveTransactionShipping($destination, $name = 'home')
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
            $shippingAddress            = $destination;
            $shippingAddress['name']    = $name;
        }

        $transactionShipping = TransactionShipping::create($shippingAddress);

        return $transactionShipping;
    }

    public function splitProductsBySupplier(array $carts)
    {
        $carts = collect($carts);

        $carts = $carts->map(function ($cart) {
            $product    = Product::find($cart['product_id']);

            return [
                'product'   => $product,
                'quantity'  => $cart['quantity'],
            ];
        });

        $grouping = $carts->groupBy(function ($cart) {
            return $cart['product']->supplier_id;
        });

        $splits = array();

        foreach ($grouping as $supplier_id => $carts) {
            $splits[] = [
                'supplier'  => Supplier::find($supplier_id),
                'carts'     => $carts
            ];
        }

        return $splits;
    }

    public function setPaymentConfirmation(Invoice $invoice, $bank_name, $on_behalf, $nominal)
    {

    }

    public function generateInvoiceNumber(Supplier $supplier, $unique_number = 1)
    {
        $format         = [
            'marketplace_code'  => config('amtekcommerce.code'),
            'date'              => Carbon::today()->format('Ymd'),
            'supplier_code'     => $supplier->code,
            'unique_number'     => str_pad($unique_number, 7, '0', STR_PAD_LEFT),
        ];

        $format_code    = implode('/', $format);
        $already        = $this->findWhere(['code' => $format_code])->first();

        if ($already) {
            return $this->generateInvoiceNumber($supplier, $unique_number + 1);
        }

        return $format_code;
    }

    public function createInvoice(
        Buyerable $buyer,
        Supplier $supplier,
        array $carts,
        TransactionShipping $transactionShipping,
        $note = null,
        $status = 'unpaid'
    )
    {
        $invoice = new Invoice;
        $invoice->code = $this->generateInvoiceNumber($supplier);
        $invoice->note = $note;
        $invoice->status = $status;
        $invoice->buyer()->associate($buyer);
        $invoice->transaction_shipping()->associate($transactionShipping);
        $invoice->save();

        foreach ($carts as $cart) {
            $product = $cart['product'];

            $invoice->details()->create([
                'name'          => $product->name,
                'description'   => $product->description,
                'quantity'      => $cart['quantity'],
                'price'         => $product->price,
                'product_id'    => $product->id,
            ]);
        }

        return $invoice->load('details');
    }

    public function getInvoice($invoice_code)
    {
        $invoice = $this->findWhere(['code' => $invoice_code])->first();

        return $invoice;
    }

    public function getInvoiceByUser(User $user)
    {
        return $user->invoices;
    }

    public function checkBalance(User $user, int $nominal)
    {

    }

    public function sendmailInvoice(array $invoiceData)
    {
        $data               =  $invoiceData;
        $data['subject']    = 'Invoice Pemesanan';

        Mail::send('emails.invoice-details', $data, function ($message) use ($data) {
            $message->to($data['email'], $data['email']);
            $message->subject($data['subject']);
        });

        // return $data;
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
        $user   =   User::where('email', $email)->first();

        if ($user) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserByEmail($email)
    {
        $user   =   User::where('email', $email)->first();

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

    public function totalPrice($products)
    {
        $totalPrice = 0;
        foreach ($products as $product) {
            $totalPrice = $totalPrice + ($product['price']*$product['quantity']);
        }

        return $totalPrice;
    }

    public function saveInvoiceDetails(Invoice $invoice, array $detailInvoice)
    {

    }
}