<?php

// Helper resource controller
function resource($path, $controller, &$api)
{
    $api->get($path, $controller . '@index');
    $api->post($path, $controller . '@store');
    $api->get($path . '/{id}', $controller . '@show');
    $api->put($path . '/{id}', $controller . '@update');
    $api->delete($path . '/{id}', $controller . '@destroy');
}

// Register
$api->post('auth/register-email',       'Auth\RegisterController@emailOnly');
$api->post('auth/complete-registration', 'Auth\RegisterController@completeRegistration');
$api->post('auth/complete-registration-supplier', 'Auth\RegisterController@completeRegistrationSupplier');
$api->post('auth/register',             'Auth\RegisterController@register');

// Autentikasi
$api->post('auth/credentials',      'Auth\LoginController@credentials');
$api->post('auth/id',               'Auth\LoginController@id');
$api->post('auth/remember',         'Auth\LoginController@viaRemember');
// $api->post('auth/hashids',          'Auth\LoginController@hashids');
$api->post('auth/refresh-token',    'Auth\LoginController@refreshToken');

// Reset Password
$api->post('auth/forgot-password',  'Auth\ResetPasswordController@forgotPassword');
$api->post('auth/reset-password',   'Auth\ResetPasswordController@resetPassword');

/*******************************
 **  User Profile (Logged In) **
 *******************************/
$api->group(['middleware' => 'auth'], function ($api) {
    $api->get('user',                   'User\UserController@show');
    $api->get('user/roles',             'User\UserController@roles');
    // $api->put('user',                   'User\UserController@update');
    $api->get('user/profile',           'User\ProfileController@show');
    $api->put('user/profile',           'User\ProfileController@update');
    $api->put('user/change-password',   'User\ProfileController@changePassword');

    /* Balance */
    // $api->get('user/balances',          'User\BalanceController@index');
    // $api->get('user/balances/{id}',     'User\BalanceController@show');
    // $api->post('user/add-funds',        'User\BalanceController@addFund');

    /* History */
    // $api->post('user/history/transactions',     'User\HistoryController@transactions');
    // $api->post('user/history/payments',         'User\HistoryController@payments');
    // $api->post('user/history/activities',       'User\HistoryController@activities');

    /* User Shipping Address */
    // resource('user/shippings',          'User\ShippingAddressController', $api);
});

/*******************************
 **  Resource Route (or CRUD) **
 *******************************/
resource('users',           'Admin\UserController', $api);
resource('suppliers',       'SupplierController', $api);

$api->get('products/images',        'ProductImageController@index');
$api->get('products/image/{id}',    'ProductImageController@show');
$api->get('products/images/{id}',    'ProductImageController@showProductImages');
$api->post('products/image',        'ProductImageController@store');
$api->post('products/image/{id}',    'ProductImageController@update');
$api->delete('products/image/{id}',  'ProductImageController@destroy');
$api->delete('products/images/{id}',  'ProductImageController@destroyByProduct');

$api->post('products/inc/{id}',     'ProductController@incrementStock');
$api->post('products/dec/{id}',     'ProductController@decrementStock');
$api->get('products/supplier', 'ProductController@showBySupplier');
resource('products',        'ProductController', $api);

resource('banks',           'BankController', $api);
resource('payment-method',  'PaymentMethodController', $api);
resource('account-bank',    'AccountBankController', $api);
resource('testimonial',    'TestimonialController', $api);

$api->get('configs/autoload', 'ConfigController@autoload');
resource('configs',     'ConfigController', $api);

$api->get('categories/{id}/childs', 'CategoryController@childs');
resource('categories',  'CategoryController', $api);

resource('ticket-departments',              'TicketDepartmentController', $api);
resource('tickets/{ticket_id}/replies',     'TicketReplyController', $api);
resource('tickets',                         'TicketController', $api);

// resource('discounts',   'DiscountController', $api);

/*******************************
 **         Sendmail          **
 *******************************/
$api->post('sendmail',          'Sendmail\SendmailController@send');
$api->post('welcome-mail',      'Sendmail\SendmailController@welcome');
$api->post('forgot-password',   'Sendmail\SendmailController@forgotPassword');
$api->post('register',          'Sendmail\SendmailController@register');

/*******************************
 **       Transactions        **
 *******************************/
$api->post('checkout', 'TransactionController@checkout');
