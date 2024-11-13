<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TransporterController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Customer;
use App\Http\Middleware\Transporter;
use Illuminate\Support\Facades\Route;

// home request form
Route::get('/', [IndexController::class, 'home'])->name('home');
Route::post('/submit-request', [CustomerController::class, 'submitRequest'])->name('request.submit');
Route::post('/submit-request-part', [CustomerController::class, 'submitRequestPart'])->name('request.submit.part');

// Route::get('/second', [IndexController::class, 'secondIndex'])->name('second.index');

Route::get('/search', [IndexController::class, 'search'])->name('search');
Route::get('/get-distances', [IndexController::class, 'getDistances'])->name('get.distances');
Route::delete('/controller/{filename}', [AdminController::class, 'destroy']);
Route::get('/get-distance', [IndexController::class, 'getDistance'])->name('get.distance');

// Route::get('/verify-pincode', [IndexController::class, 'submitPincodeVerification'])->name('verify.pincode');
Route::get('/verify-pincode-city', [IndexController::class, 'verifyPincodeCity'])->name('verify.pincode.city');
// Route::get('/verify-pincode-city', [CustomerController::class, 'verifyPincodeCity'])->name('verify.pincode.city');


// Route For Admin Dashboard
Route::prefix("admin")->group(function () {
    Route::get('/', [AdminController::class, 'login'])->name('login');
    // Admin Route For Login Check
    Route::post('/login-check', [AdminController::class, "loginCheck"])->name("admin.login.check");

    Route::middleware(Admin::class)->group(function () {

        Route::get('dashboard', [AdminController::class, 'index'])->name('index');

        // plan
        Route::get('plans', [PlanController::class, 'index'])->name('plans.index');
        Route::get('plans-create', [PlanController::class, 'create'])->name('plans.create');
        Route::post('plans-store', [PlanController::class, 'store'])->name('plans.store');
        Route::get('/plans/{id}/edit', [PlanController::class, 'edit'])->name('plans.edit');
        Route::put('/plans/{id}', [PlanController::class, 'update'])->name('plans.update');
        // Route::delete('/plans/{id}', [PlanController::class, 'destroy'])->name('plans.destroy');
        // Route::post('/plans/{id}/deactivate', [PlanController::class, 'deactivate'])->name('plans.deactivate');


        // subscriptions
        // Route::get('subscriptions', [SubscriptionController::class, 'index'])->name('admin.subscription.index');
        Route::get('/subscription-management', [SubscriptionController::class, 'index'])->name('admin.subscription.index');
        Route::post('subscription-cancel/{id}', [SubscriptionController::class, 'cancelSubscription'])->name('admin.cancel.subscription');

        // profile
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::post('/update-profile', [AdminController::class, 'updateprofile'])->name('update.profile');

        // Customers
        Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
        Route::get('/customer-detail/{id}', [AdminController::class, 'customerDetail'])->name('customer.detail');
        Route::get('/customer-delete/{id}', [AdminController::class, 'deleteCustomer'])->name('customer.delete');


        // Transporters
        Route::get('/transporeters', [AdminController::class, 'transporters'])->name('transporters');
        Route::get('/transporeter-delete/{id}', [AdminController::class, 'deleteTransporters'])->name('transporter.delete');
        Route::get('/transporeter-detail/{id}', [AdminController::class, 'transporeterDetail'])->name('transporeter.detail');


        // FAQs
        Route::get('/FAQs', [AdminController::class, 'faqs'])->name('faq');
        Route::get('/add-faq', [AdminController::class, 'addFaqs'])->name('add.faq');
        Route::post('/store-faq', [AdminController::class, 'storeFaqs'])->name('store.faq');
        Route::get('/delete-faq/{id}', [AdminController::class, 'deleteFaqs'])->name('delete.faq');
        Route::get('/check-faq/{id}', [AdminController::class, 'checkFaqs'])->name('check.faq');
        Route::post('/update-faq/{id}', [AdminController::class, 'updateFaqs'])->name('update.faq');

        // CMS
        // terms and conditions
        Route::get('/terms-and-conditions', [AdminController::class, 'termAndConditions'])->name('terms.conditions');
        Route::post('/update-terms-and-conditions', [AdminController::class, 'updateTermAndConditions'])->name('update.terms.conditions');

        // privacy policy
        Route::get('/privacy-policy', [AdminController::class, 'privacyPolicy'])->name('privacy.policy');
        Route::post('/update-privacy-policy', [AdminController::class, 'updateprivacyPolicy'])->name('update.privacy.policy');

        // Packages
        // Route::get('packages', [AdminController::class, 'packages'])->name('packages');
        // Route::get('add-packages', [AdminController::class, 'addPackage'])->name('add-packages');
        // Route::post('create-packages', [AdminController::class, 'create_packages'])->name('create-packages');
        // Route::get('edit-packages/{id}', [AdminController::class, 'edit_packages'])->name('edit-packages');
        // Route::post('update-packages/{id}', [AdminController::class, 'update_packages'])->name('update-packages');
        // Route::get('delete-packages/{id}', [AdminController::class, 'delete_packages'])->name('delete-packages');

        // Contact Management
        Route::get('contact-management', [AdminController::class, 'contact_management'])->name('contact-management');
        Route::get('delete-contact/{id}', [AdminController::class, 'delete_contact'])->name('delete-contact');
        // Route::post('store-cm',[AdminController::class, 'store_cm'])->name('store-cm');
        // Route::get('show-contact-management',[AdminController::class, 'show_contact_management'])->name('show-contact-management');
        // Route::get('edit-contact/{id}',[AdminController::class, 'edit_contact'])->name('edit-contact');
        // Route::post('update-contact/{id}',[AdminController::class, 'update_contact'])->name('update-contact');

        // Website Setting
        Route::get('website-setting', [AdminController::class, 'website_setting'])->name('website-setting');
        Route::post('update-setting/{id}', [AdminController::class, 'updateSetting'])->name('update.setting');
        // Route::post('store-website',[AdminController::class, 'store_website'])->name('store-website');

        // Admin Route For Logout
        Route::get('/logout', [AdminController::class, "logout"])->name("admin.logout");
    });
});


Route::prefix("customer")->group(function () {

    Route::get('/login', [CustomerController::class, 'login'])->name('customer.login');
    // Customer Route For Login Check
    Route::post('/login-check', [CustomerController::class, "loginCheck"])->name("customer.login.check");
    // register
    Route::get('/C-register', [CustomerController::class, 'register'])->name('customer.register');
    // register Store
    Route::post('/c-register-store', [CustomerController::class, 'registerStore'])->name('customer.register.store');

    // email verification
    Route::post('/verify-email-customer', [CustomerController::class, 'verifyEmail'])->name('customer.email.verify');
    Route::get('/email-verify', [CustomerController::class, 'emailVerificationPage'])->name('customer.email.verify.page');

    // phone verification
    Route::get('/phone-verify', [CustomerController::class, 'phoneVerificationPage'])->name('customer.phone.verify.page');
    Route::post('/verify-phone-customer', [CustomerController::class, 'verifyPhone'])->name('customer.phone.verify');
    Route::post('/phone/resend', [CustomerController::class, 'resendOtp'])->name('customer.phone.resend');


    Route::middleware(Customer::class)->group(function () {

        Route::get('dashboard', [CustomerController::class, 'index'])->name('customer.index');

        Route::get('/truck-request', [CustomerController::class, 'truckRequest'])->name('customer.truck.request');
        Route::get('/add-truck-request', [CustomerController::class, 'addTruckRequest'])->name('customer.add.truck.request');
        Route::post('/add-request', [CustomerController::class, 'addRequest'])->name('customer.add.request');
        Route::post('/add-request-part', [CustomerController::class, 'addRequestPart'])->name('customer.add.request.part');
        Route::get('/delete-request/{id}', [CustomerController::class, 'deleteRequest'])->name('customer.delete.request');
        Route::get('/update-request/{id}', [CustomerController::class, 'updateRequest'])->name('customer.update.request');
        Route::post('/update-truck/{id}', [CustomerController::class, 'updateTruck'])->name('customer.update.truck');

        Route::get('/request-bids', [CustomerController::class, 'requestBids'])->name('customer.requestbids');
        Route::get('/all-bids/{id}', [CustomerController::class, 'allBids'])->name('customer.allbids');

        // Request Accepted Detail
        Route::get('/request-detail/{id}', [CustomerController::class, 'requestDetail'])->name('customer.request.detail');

        // profile
        Route::get('/C-profile', [CustomerController::class, 'profile'])->name('customer.profile');
        // update profile
        Route::post('/update-profile', [CustomerController::class, 'updateProfile'])->name('customer.updateprofile');

        // Chat
        Route::get('/chat/{id}', [CustomerController::class, 'chat'])->name('customer.chat');

        // payment
        Route::get('/initiate-payment', [PaymentController::class, 'initiatePayment'])->name('payment.initiate');
        Route::post('/handle-callback', [PaymentController::class, 'handleCallback'])->name('payment.callback');

        Route::get('/payment-success', function () {
            return view('customer.payment-success');
        })->name('payment.success');

        // Aadhaar verify
        Route::get('/aadhaar-verify/{id}', [CustomerController::class, 'aadhaarVerficationPage'])->name('customer.aadhaar.verify.page');
        Route::post('/send-otp-aadhaar/{id}', [CustomerController::class, 'sendOtp'])->name('customer.send.otp');
        Route::post('/verify-otp-aadhaar/{id}', [CustomerController::class, 'verifyOtp'])->name('customer.verify.otp');

        // Verify Pan
        Route::get('/pan-verify/{id}', [CustomerController::class, 'panVerficationPage'])->name('customer.pan.verify.page');
        Route::post('/pan-number-verify', [CustomerController::class, 'verifyPan'])->name('customer.verify.pan');

        // Invoice
        Route::get('/invoice/{id}', [PaymentController::class, 'showInvoice'])->name('customer.invoice');


        // Customer Route For Logout
        Route::get('/logout', [CustomerController::class, "logout"])->name("customer.logout");
    });
});

// customer to transporter chat routes
Route::get('/get-messages/{id}', [ChatController::class, 'fetchMessages'])->name("get.message");
Route::post('/messages', [ChatController::class, 'sendMessage'])->name("send.message");


Route::prefix("transporter")->group(function () {

    Route::get('/login', [TransporterController::class, 'login'])->name('transporter.login');
    // Transporter Route For Login Check
    Route::post('/login-check', [TransporterController::class, "loginCheck"])->name("transporter.login.check");

    // register
    Route::get('/T-register', [TransporterController::class, 'register'])->name('transporter.register');
    // register Store
    Route::post('/t-register-store', [TransporterController::class, 'registerStore'])->name('transporter.register.store');

    Route::get('/verify-phone', [TransporterController::class, 'phoneVerificationPage'])->name('transporter.phone.verify.page');
    Route::post('/phone-verify', [TransporterController::class, 'verifyPhone'])->name('transporter.phone.verify');
    Route::post('/phone/resend', [TransporterController::class, 'resendOtp'])->name('transporter.phone.resend');

    Route::post('/email-verify', [TransporterController::class, 'verifyEmail'])->name('transporter.email.verify');
    Route::get('/verify-email', [TransporterController::class, 'emailVerificationPage'])->name('transporter.email.verify.page');

    // Route::post('/verify-otp', [TransporterController::class, 'verifyOtp'])->name('transporter.verify.otp');

    Route::middleware(Transporter::class)->group(function () {

        Route::get('dashboard', [TransporterController::class, 'index'])->name('transporter.index');

        // Aadhaar verify
        Route::get('/verify-aadhaar', [TransporterController::class, 'aadhaarVerficationPage'])->name('transporter.aadhaar.verify.page');
        Route::post('/aadhaar-send-otp', [TransporterController::class, 'sendOtp'])->name('transporter.send.otp');
        Route::post('/aadhaar-verify-otp', [TransporterController::class, 'verifyOtp'])->name('transporter.verify.otp');

        // Verify Pan
        Route::get('/verify-pan', [TransporterController::class, 'panVerficationPage'])->name('transporter.pan.verify.page');
        Route::post('/verify-pan-number', [TransporterController::class, 'verifyPan'])->name('transporter.verify.pan');

        // Verify Vehicle Rc
        Route::get('/verify-rc', [TransporterController::class, 'RcVerificationPage'])->name('transporter.rc.verify.page');
        Route::post('/verify-rc-number', [TransporterController::class, 'verifyRc'])->name('transporter.verify.rc');

        // Verify Bank
        Route::get('/verify-bank', [TransporterController::class, 'bankVerificationPage'])->name('transporter.bank.verify.page');
        Route::post('/verify-bank-acc', [TransporterController::class, 'verifyBank'])->name('transporter.verify.bank');

        // Invoice
        Route::get('/invoice/{id}', [PaymentController::class, 'showInvoiceTransporter'])->name('transporter.invoice');

        // subscription
        Route::post('/webhook/razorpay', [SubscriptionController::class, 'handleWebhook']);
        Route::get('/subscriptions', [SubscriptionController::class, 'showPlans'])->name('subscriptions');
        Route::post('/subscriptions/create', [SubscriptionController::class, 'createSubscription'])->name('subscription.create');
        Route::post('subscription/callback', [SubscriptionController::class, 'subscriptionCallBack'])->name('subscription.callback');
        Route::get('/subscription/success', [SubscriptionController::class, 'successSubscription'])->name('subscription.success');
        Route::post('/subscription/unsubscribe', [SubscriptionController::class, 'unsubscribe'])->name('subscription.unsubscribe');


        Route::get('/hiring-request', [TransporterController::class, 'hiringRequest'])->name('transporter.hiring.request');

        Route::get('/bid/{id}', [TransporterController::class, 'bid'])->name('transporter.bid');
        Route::post('/add-bid/{id}', [TransporterController::class, 'addBid'])->name('transporter.add.bid');

        Route::get('/my-bids', [TransporterController::class, 'myBids'])->name('transporter.mybids');
        Route::get('/delete-mybid/{id}', [TransporterController::class, 'deleteMyBid'])->name('transporter.delete.mybids');
        Route::get('/mybid-detail/{id}', [TransporterController::class, 'MyBidDetail'])->name('transporter.mybid.detail');

        // profile
        Route::get('/T-profile', [TransporterController::class, 'profile'])->name('transporter.profile');
        // update profile
        Route::post('/update-profile', [TransporterController::class, 'updateProfile'])->name('transporter.updateprofile');

        // Chat
        Route::get('/chat/{id}', [TransporterController::class, 'chat'])->name('transporter.chat');

        // Transporter Route For Logout
        Route::get('/logout', [TransporterController::class, "logout"])->name("transporter.logout");
    });
});

// transporter to customer chat routes
Route::get('/get-message-second/{id}', [ChatController::class, 'fetchMessagesSecond'])->name("get.message.second");
Route::post('/send-message-Second', [ChatController::class, 'sendMessageSecond'])->name("send.message.Second");
