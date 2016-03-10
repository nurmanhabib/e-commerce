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
        $quantities     = $request->get('quantity');
        $productIDs     = $request->get('product_id');
        $destination    = $request->get('destination');

        $productsBySupplier = $this->transactionRepository->splitProductsBySupplier($productIDs, $quantities);

        // // $transactionShipping    = $this->transactionRepository->saveTransactionShipping($destination);

        $userStatus         = $this->transactionRepository->checkUser($email);

        if ($userStatus === false) {
            $buyer = $this->saveUser($email);
        } else {
            $buyer = $this->transactionRepository->getUserByEmail($email);
        }

        return [
         'status'                    => 'success',
         'buyer'                     => $buyer,
         'products'                  => $productsBySupplier,
         'payment_code'              => $this->transactionRepository->generatePaymentCode(),
        ];
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