<?php 

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Repositories\TransactionRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use App\Models\Invoice;
use App\Models\User;
use App\Model\Product;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Carbon\Carbon;

class TransactionController extends Controller
{
    protected $transactionRepository, $productRepository, $userRepository;

    public function __construct(TransactionRepository $transactionRepository, ProductRepository $productRepository, UserRepository $userRepository)
    {
        $this->transactionRepository    = $transactionRepository;
        $this->productRepository        = $productRepository;
        $this->userRepository           = $userRepository;
    }

    public function checkout(Request $request)
    {
        $email          = $request->get('email');
        $carts          = $request->get('carts');
        $destination    = $request->get('destination');

        $userStatus         = $this->transactionRepository->checkUser($email);
        if ($userStatus === false) {
            $user = $this->saveUser($email);
        } else {
            $user = $this->transactionRepository->getUserByEmail($email);
        }

        $supplierCarts          = $this->transactionRepository->splitProductsBySupplier($carts);
        $transactionShipping    = $this->transactionRepository->saveTransactionShipping($destination);

        $invoices = array();
        foreach ($supplierCarts as $carts) {
            $invoices[] = $this->transactionRepository->createInvoice(
                $user,
                $carts['supplier'],
                $carts['carts']->toArray(),
                $transactionShipping
            );
        }

        return $invoices;
    }

    public function saveUser($email)
    {
        $credentials    = [
            'username'      => null,
            'email'         => $email,
            'password'      => null
        ];
        $profile        = [
            'first_name'    => null,
            'last_name'     => null,
            'gender'        => null,
            'avatar'        => null
        ];

        $user   = $this->userRepository->registerAndActivate($credentials, $profile);

        return $user;
    }

    public function sendmailInvoice(Request $request)
    {
        
    }
}