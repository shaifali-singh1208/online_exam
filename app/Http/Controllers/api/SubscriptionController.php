<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Password;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SubscriptionController extends Controller
{
    public function index($userId)
    {
        $transactions = Transaction::where('user_id', $userId)->with('user', 'subscription')->get();

        if ($transactions->isEmpty()) {
            
            return response()->json([
                'status' => 'failed',
                'message' => 'No transactions found',
                'data' => 'No data here'
            ], 404);
        } else {
            return response()->json([                                                                                                                               
                'status' => 'success',
                'message' => 'Transactions found',
                'data' => $transactions,
            ], 200);
        }

    }
    public function get_all_subscription(){
           $data = Subscription::all();

           {
            return response()->json([
                'status' => 'success',
                'message' => 'all subscription  found',
                'data' => $data,
            ], 200);
           }

    }

    public function currentTransaction($userId)
    {
        $userTransactions = Transaction::where('user_id', $userId)
            ->orderBy('created_at', 'desc')  // Order by the 'created_at' column in descending order
            ->with('user', 'subscription')
            ->first(); 

        if ($userTransactions) {
            return response()->json([
                'status' => 'success',
                'message' => 'Last transaction found',
                'data' => $userTransactions,
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'No last transaction found',
                'data' => 'No data',
            ], 404);
        }
    }

    public function getUserProfile($userId)
    {
        $user = User::where('id', $userId)->get();

        if ($user->isEmpty()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No User found',
                'data' => 'No data'
            ], 404);
        } else {
            return response()->json([
                'status' => 'success',
                'message' => 'Sucessfully get user profile',
                'data' => $user,
            ], 200);
        }

    }

    public function editUserProfile(Request $request, $userId)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'number' => 'required|string|max:15',
            'email' => 'required|email',

        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validation->errors(),
            ], 422);
        }


    $user = User::find($userId);
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found',
            ], 404);
        }
        $user->name = $request->input('name');
        $user->number = $request->input('number');
        $user->email = $request->input('email');
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully',
            'data' => $user,
        ], 200);
    }

    public function sendPasswordResetLink(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $email = $request->input('email');
        $token = Str::random(64);

        Password::where('email', $email)->delete();

        $pass = new Password();
        $pass->email = $email;
        $pass->token = $token;
        $pass->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Password reset link  sent successfully',
            'reset_link' => $this->generateResetUrl($token),
        ]);
    }

    protected function generateResetUrl($token)
    {
        return url('/password-reset?token=' . $token);

    }


    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
            'new_password' => 'required|string|min:6',
            'confirm_password' => 'required|string|same:new_password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $token = $request->input('token');
        $password = bcrypt($request->input('new_password'));

        // Find the user by token and update the password
        $passwordReset = Password::where('token', $token)->first();

        if (!$passwordReset) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid token',
            ], 400);
        }

        User::where('email', $passwordReset->email)->update([
            'password' => $password,
        ]);

        // You can optionally delete the password reset record from the password_resets table
        Password::where('token', $token)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Password updated successfully',
        ]);
    }


    


    public function createPaymentIntent(Request $request)
    {
        $stripeSecretKey = env('STRIPE_TEST_SK');
        $stripePublishKey = env('STRIPE_TEST_PK');
        $stripe = new StripeClient($stripeSecretKey);
        $orderId = mt_rand(111111, 999999999);
        $tid = Str::random(30);
        $user = User::where('id', $request->user_id)->first();
        $package = Subscription::where('id', $request->subs_id)->first();
        $transaction = new Transaction();
        if ($package->id == 1 || $package->days == null) {
            $payment_intent = 'pi_' . Str::random(64);
            $transaction->user_id = $user->id;
            $transaction->payment_intent = $payment_intent;
            $transaction->order_id = '#' . $user->id . '_ORD_' . $orderId;
            $transaction->amount = 0.00;
            $transaction->amount_currency = 'inr';
            $transaction->subscription_start = now();
            $transaction->subscription_time = now()->format('H:i:s');
            $transaction->transaction_status = 'success';
            $transaction->stripe_transaction_id = '#'. $user->id. '_TID_' .$tid;
            $transaction->subscription_expiry = null;
            $transaction->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Subscribe successfully',
                'data' => $package,
                'LastTransactionDetail' => $transaction,
            ], 200);
            
        } else {
            // create customer 
            $customer = $stripe->customers->create([
                "name" => $user->name,
                "email" => $user->email
            ]);
            // genrate Empheral key
            $ephemeralKey = $stripe->ephemeralKeys->create([
                'customer' => $customer->id,
            ], [
                'stripe_version' => '2022-08-01',
            ]);
            // create Payment Intent
            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => $request->amount*100,
                'currency' => 'inr',
                'customer' => $customer->id,
                'metadata' => [
                    'order_id' => '#' . $user->id . '_ORD_' . $orderId, // Replace with your order ID
                    'package_id' => $package->id,
                    'package_name' => $package->name,
                    'package_month' => $package->days,
                    'package_start' => now(),
                ],
            ]);

            if ($paymentIntent) {
                $transaction->user_id = $user->id;
                $transaction->payment_intent = $paymentIntent->client_secret;
                $transaction->order_id = '#' . $user->id . '_ORD_' . $orderId;
                $transaction->amount = $request->amount;
                $transaction->amount_currency = 'inr';
                $transaction->subscription_start = now();
                // $transaction->subscription_time = now()->format('H:i:s');
                $transaction->transaction_status = null;
                // $transaction->subscription_expiry = now()->addMonths($package->months);
                $transaction->stripe_transaction_id = null;
                $transaction->save();
                // return response of Payment Intent for user
                if($transaction->save()){
                    return response()->json([
                        'status' => 'success',
                        'subscriptionPackageDetail' => $package,
                        'paymentIntent' => $paymentIntent->client_secret,
                        'ephemeralKey' => $ephemeralKey->secret,
                        'customer' => $customer->id,
                        'paymentIntentDetails' => $paymentIntent,
                        'LastTransactionDetail' => $transaction,
                    ], 200);
                }else{
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Unable to create transaction',
                    ], 401);
                }
                
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Unable to create payment Intent',
                ], 401);
            }
        }

    }

    public function updateTransaction(Request $request)
    {

        $userId = $request->user_id;
        $subId = $request->package_id;
        $tid = Str::random(30);
        $package = Subscription::where('id', $subId)->first();
        $transaction = Transaction::where('user_id', $userId)->where('transaction_status', null)->orderby('id', 'desc')->first();
        $transaction->transaction_status = $request->transaction_status;
        $transaction->stripe_transaction_id = '#'. $userId . '_TID_' .$tid;
        $transaction->subscription_time = now()->format('H:i:s');
        $transaction->subscription_expiry = now()->addDays($package->days);
        if ($transaction->save()) {

            return response()->json([
                'status' => 'success',
                'message' => 'Subscribe successfully',
                'subscriptionPackageDetail' => $package, 
                'LastTransactionDetail' => $transaction,
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong',
            ], 401);
        }
    }

}