<?php

namespace App\Http\Controllers\Api;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class AccountsController extends Controller
{
    /**
     * Display a listing of all accounts.
     */
    public function index(): JsonResponse
    {
        try {
            $accounts = Account::select([
                'id',
                'available_balance',
                'currency',
                'account_type',
                'kyc_status',
                'user_id',
                'created_at'
            ])->with(['user' => function($query) {
                $query->select('id', 'name', 'email');
            }])->get();

            return response()->json([
                'success' => true,
                'data' => $accounts,
                'message' => 'Accounts retrieved successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve accounts',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified account with detailed information.
     */
    public function show($id): JsonResponse
    {
        try {
            $account = Account::with(['user' => function($query) {
                $query->select('id', 'name', 'email');
            }])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $account,
                'message' => 'Account details retrieved successfully'
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Account not found'
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve account details',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}