@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Header -->
            <div class="text-center mb-4">
                <h2 class="fw-bold text-dark">
                    <i class="fas fa-plus-circle text-primary me-2"></i>Create New Account
                </h2>
                <p class="text-muted">Add a new financial account to your portfolio</p>
            </div>

            <div class="card border-0 shadow-lg">
                <div class="card-header card-header-custom border-0">
                    <h5 class="mb-0 d-flex align-items-center">
                        <i class="fas fa-form me-2"></i>Account Information
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('accounts.store') }}" method="POST">
                        @csrf
                        
                        <!-- Balance & Currency Row -->
                        <div class="row mb-4">
                            <div class="col-md-8">
                                <label for="available_balance" class="form-label fw-semibold">
                                    <i class="fas fa-dollar-sign text-primary me-2"></i>Available Balance
                                </label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light">$</span>
                                    <input type="number" class="form-control @error('available_balance') is-invalid @enderror" 
                                           id="available_balance" name="available_balance" step="0.01" min="0"
                                           value="{{ old('available_balance', $account->available_balance) }}" placeholder="0.00" required>
                                </div>
                                @error('available_balance')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="currency" class="form-label fw-semibold">
                                    <i class="fas fa-globe text-primary me-2"></i>Currency
                                </label>
                                <select class="form-select form-select-lg @error('currency') is-invalid @enderror" 
                                        id="currency" name="currency" required>
                                    <option value="">Select Currency</option>
                                    <option value="USD" {{ (old('currency', $account->currency) == 'USD') ? 'selected' : '' }}>🇺🇸 USD - US Dollar</option>
                                    <option value="EUR" {{ (old('currency', $account->currency) == 'EUR') ? 'selected' : '' }}>🇪🇺 EUR - Euro</option>
                                    <option value="GBP" {{ (old('currency', $account->currency) == 'GBP') ? 'selected' : '' }}>🇬🇧 GBP - British Pound</option>
                                    <option value="JPY" {{ (old('currency', $account->currency) == 'JPY') ? 'selected' : '' }}>🇯🇵 JPY - Japanese Yen</option>
                                    <option value="CAD" {{ (old('currency', $account->currency) == 'CAD') ? 'selected' : '' }}>🇨🇦 CAD - Canadian Dollar</option>
                                </select>
                                @error('currency')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Financial Details Row -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label for="active_deposit" class="form-label fw-semibold">
                                    <i class="fas fa-piggy-bank text-info me-2"></i>Active Deposit
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control @error('active_deposit') is-invalid @enderror" 
                                           id="active_deposit" name="active_deposit" step="0.01" min="0"
                                           value="{{ old('active_deposit', $account->active_deposit) }}" placeholder="0.00" required>
                                </div>
                                @error('active_deposit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="total_earnings" class="form-label fw-semibold">
                                    <i class="fas fa-chart-line text-success me-2"></i>Total Earnings
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control @error('total_earnings') is-invalid @enderror" 
                                           id="total_earnings" name="total_earnings" step="0.01" min="0"
                                           value="{{ old('total_earnings', $account->total_earnings) }}" placeholder="0.00" required>
                                </div>
                                @error('total_earnings')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="total_withdrawal" class="form-label fw-semibold">
                                    <i class="fas fa-arrow-down text-warning me-2"></i>Pending Withdrawal charge
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control @error('total_withdrawal') is-invalid @enderror" 
                                           id="total_withdrawal" name="kyc_status" step="0.01" min="0"
                                           value="{{ old('total_withdrawal', $account->total_withdrawal) }}" placeholder="0.00" required>
                                </div>
                                @error('total_withdrawal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            
                        </div>

                        <!-- Status & Type Row -->
                        <div class="row mb-4">

                           
                            

                            <div class="col-md-6">
                                <label for="account_type" class="form-label fw-semibold">
                                    <i class="fas fa-star text-warning me-2"></i>Plan
                                </label>
                                <select class="form-select @error('account_type') is-invalid @enderror" 
                                        id="account_type" name="account_type" required>
                                    <option value="">Duration</option>
                                    <option value="24 Hours" {{ (old('account_type', $account->account_type) == 'Basic') ? 'selected' : '' }}>
                                        24 Hours
                                    </option>
                                    <option value="2 Days" {{ (old('account_type', $account->account_type) == 'Premium') ? 'selected' : '' }}>
                                       2 Days
                                    </option>
                                    
                                </select>
                                @error('account_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-3 pt-3 border-top">
                            <button type="submit" class="btn btn-gradient btn-lg flex-fill py-3">
                                <i class="fas fa-save me-2"></i>Update Account
                            </button>
                            <a href="{{ route('accounts.index') }}" class="btn btn-outline-secondary btn-lg px-4 py-3">
                                <i class="fas fa-arrow-left me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
