@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="display-6 fw-bold text-dark mb-1">
                        <i class="fas fa-wallet text-primary me-3"></i>Account Portfolio
                    </h1>
                    <p class="text-muted mb-0">Manage and monitor your financial accounts</p>
                </div>
                <a href="{{ route('accounts.create') }}" class="btn btn-gradient btn-lg px-4 py-2">
                    <i class="fas fa-plus me-2"></i>New Account
                </a>
            </div>

            <!-- Success Alert -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Summary Statistics -->
            @if($accounts->count() > 0)
                @php
                    $totalBalance = $accounts->sum('available_balance');
                    $totalEarnings = $accounts->sum('total_earnings');
                    $totalDeposits = $accounts->sum('active_deposit');
                    $totalWithdrawals = $accounts->sum('total_withdrawal');
                @endphp
                <div class="row mb-5">
                    <div class="col-md-3 mb-3">
                        <div class="card stats-card border-0">
                            <div class="card-body text-center py-4">
                                <div class="text-primary mb-2">
                                    <i class="fas fa-wallet fa-2x"></i>
                                </div>
                                <h3 class="fw-bold text-primary mb-1">${{ number_format($totalBalance, 2) }}</h3>
                                <p class="text-muted mb-0 small">Total Balance</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card stats-card border-0">
                            <div class="card-body text-center py-4">
                                <div class="text-success mb-2">
                                    <i class="fas fa-arrow-trend-up fa-2x"></i>
                                </div>
                                <h3 class="fw-bold text-success mb-1">${{ number_format($totalEarnings, 2) }}</h3>
                                <p class="text-muted mb-0 small">Total Earnings</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card stats-card border-0">
                            <div class="card-body text-center py-4">
                                <div class="text-info mb-2">
                                    <i class="fas fa-piggy-bank fa-2x"></i>
                                </div>
                                <h3 class="fw-bold text-info mb-1">${{ number_format($totalDeposits, 2) }}</h3>
                                <p class="text-muted mb-0 small">Active Deposits</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card stats-card border-0">
                            <div class="card-body text-center py-4">
                                <div class="text-warning mb-2">
                                    <i class="fas fa-arrow-down fa-2x"></i>
                                </div>
                                <h3 class="fw-bold text-warning mb-1">${{ number_format($totalWithdrawals, 2) }}</h3>
                                <p class="text-muted mb-0 small">Total Withdrawals</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Accounts Grid -->
            <div class="row">
                @forelse($accounts as $account)
                    <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                        <div class="card account-card h-100 position-relative">
                            <!-- Account Type Badge -->
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge type-{{ strtolower($account->account_type) }} status-badge">
                                    {{ $account->account_type }}
                                </span>
                            </div>

                            <div class="card-body p-4">
                                <!-- Balance Section -->
                                <div class="text-center mb-4">
                                    <div class="mb-2">
                                        <i class="fas fa-university fa-2x opacity-75"></i>
                                    </div>
                                    <h6 class="card-subtitle mb-2 opacity-75 text-uppercase tracking-wider" style="letter-spacing: 1px; font-size: 0.8rem;">
                                        Available Balance
                                    </h6>
                                    <h2 class="balance-amount mb-0">
                                        ${{ number_format($account->available_balance, 2) }} 
                                        <small class="fs-6 opacity-75">{{ $account->currency }}</small>
                                    </h2>
                                </div>

                                <!-- Account Details Grid -->
                                <div class="account-details mb-4">
                                    <div class="row account-detail-row">
                                        <div class="col-7">
                                            <span class="opacity-90">
                                                <i class="fas fa-coins me-2 opacity-75"></i>Active Deposit
                                            </span>
                                        </div>
                                        <div class="col-5 text-end">
                                            <strong>${{ number_format($account->active_deposit, 2) }}</strong>
                                        </div>
                                    </div>
                                    
                                    <div class="row account-detail-row">
                                        <div class="col-7">
                                            <span class="opacity-90">
                                                <i class="fas fa-chart-line me-2 opacity-75"></i>Total Earnings
                                            </span>
                                        </div>
                                        <div class="col-5 text-end">
                                            <strong>${{ number_format($account->total_earnings, 2) }}</strong>
                                        </div>
                                    </div>
                                    
                                    <div class="row account-detail-row">
                                        <div class="col-7">
                                            <span class="opacity-90">
                                                <i class="fas fa-arrow-down me-2 opacity-75"></i>Total Withdrawal
                                            </span>
                                        </div>
                                        <div class="col-5 text-end">
                                            <strong>${{ number_format($account->total_withdrawal, 2) }}</strong>
                                        </div>
                                    </div>
                                    
                                    <div class="row account-detail-row">
                                        <div class="col-7">
                                            <span class="opacity-90">
                                                <i class="fas fa-shield-check me-2 opacity-75"></i>KYC Status
                                            </span>
                                        </div>
                                        <div class="col-5 text-end">
                                            <span class="badge status-{{ strtolower($account->kyc_status) }} status-badge">
                                                {{ $account->kyc_status }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Owner Info -->
                                <div class="text-center mb-4">
                                    <div class="d-flex align-items-center justify-content-center opacity-75">
                                        <i class="fas fa-user-circle me-2"></i>
                                        <small>{{ $account->user->name }}</small>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex gap-2">
                                    <a href="{{ route('accounts.show', $account) }}" 
                                       class="btn btn-outline-light btn-sm flex-fill d-flex align-items-center justify-content-center py-2">
                                        <i class="fas fa-eye me-1"></i>View
                                    </a>
                                    <a href="{{ route('accounts.edit', $account) }}" 
                                       class="btn btn-light btn-sm flex-fill d-flex align-items-center justify-content-center py-2 text-primary">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    <form action="{{ route('accounts.destroy', $account) }}" method="POST" class="flex-fill">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-outline-danger btn-sm w-100 d-flex align-items-center justify-content-center py-2" 
                                                onclick="return confirm('Are you sure you want to delete this account?')">
                                            <i class="fas fa-trash me-1"></i>Delete
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Performance Indicator -->
                            @php
                                $roi = $account->active_deposit > 0 ? (($account->total_earnings - $account->total_withdrawal) / $account->active_deposit) * 100 : 0;
                            @endphp
                            <div class="position-absolute bottom-0 start-0 end-0" 
                                 style="height: 4px; background: {{ $roi > 0 ? 'linear-gradient(90deg, #4CAF50, #81C784)' : ($roi < 0 ? 'linear-gradient(90deg, #F44336, #E57373)' : 'linear-gradient(90deg, #9E9E9E, #BDBDBD)') }};">
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="fas fa-wallet"></i>
                            <h3 class="text-muted fw-light">No Accounts Found</h3>
                            <p class="text-muted mb-4">Start by creating your first financial account to track your portfolio.</p>
                            <a href="{{ route('accounts.create') }}" class="btn btn-gradient btn-lg px-5">
                                <i class="fas fa-plus me-2"></i>Create Your First Account
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($accounts->hasPages())
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-center mt-4">
                            {{ $accounts->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection