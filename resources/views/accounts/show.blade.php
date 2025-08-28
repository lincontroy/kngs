@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-dark mb-1">
                        <i class="fas fa-eye text-primary me-2"></i>Account Overview
                    </h2>
                    <p class="text-muted mb-0">Detailed view of account information</p>
                </div>
                <div class="btn-group">
                    <a href="{{ route('accounts.edit', $account) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Edit Account
                    </a>
                    <a href="{{ route('accounts.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to List
                    </a>
                </div>
            </div>

            <!-- Main Account Card -->
            <div class="row mb-4">
                <div class="col-lg-8">
                    <div class="card account-card h-100">
                        <div class="card-body p-5">
                            <!-- Account Type Badge -->
                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <div>
                                    <span class="badge type-{{ strtolower($account->account_type) }} status-badge fs-6 px-3 py-2">
                                        <i class="fas fa-star me-1"></i>{{ $account->account_type }}
                                    </span>
                                </div>
                                <div>
                                    <span class="badge status-{{ strtolower($account->kyc_status) }} status-badge fs-6 px-3 py-2">
                                        <i class="fas fa-shield-check me-1"></i>{{ $account->kyc_status }}
                                    </span>
                                </div>
                            </div>

                            <!-- Balance Display -->
                            <div class="text-center mb-5">
                                <div class="mb-3">
                                    <i class="fas fa-university fa-3x opacity-75"></i>
                                </div>
                                <h6 class="card-subtitle mb-2 opacity-75 text-uppercase" style="letter-spacing: 2px; font-size: 0.8rem;">
                                    Available Balance
                                </h6>
                                <h1 class="display-4 fw-bold mb-0" style="text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                    ${{ number_format($account->available_balance, 2) }}
                                    <small class="fs-4 opacity-75">{{ $account->currency }}</small>
                                </h1>
                            </div>

                            <!-- Financial Details -->
                            <div class="row text-center mb-4">
                                <div class="col-4">
                                    <div class="border-end border-light border-opacity-25 pe-3">
                                        <div class="opacity-75 mb-1">
                                            <i class="fas fa-coins"></i>
                                        </div>
                                        <h5 class="mb-1">${{ number_format($account->active_deposit, 2) }}</h5>
                                        <small class="opacity-75">Active Deposit</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border-end border-light border-opacity-25 pe-3">
                                        <div class="opacity-75 mb-1">
                                            <i class="fas fa-chart-line"></i>
                                        </div>
                                        <h5 class="mb-1">${{ number_format($account->total_earnings, 2) }}</h5>
                                        <small class="opacity-75">Total Earnings</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div>
                                        <div class="opacity-75 mb-1">
                                            <i class="fas fa-arrow-down"></i>
                                        </div>
                                        <h5 class="mb-1">${{ number_format($account->total_withdrawal, 2) }}</h5>
                                        <small class="opacity-75">Withdrawals</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Owner Information -->
                            <div class="text-center pt-3 border-top border-light border-opacity-25">
                                <div class="d-flex align-items-center justify-content-center opacity-75">
                                    <i class="fas fa-user-circle fa-lg me-2"></i>
                                    <span>Account Owner: <strong>{{ $account->user->name }}</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistics Panel -->
                <div class="col-lg-4">
                    <div class="row h-100">
                        <!-- Net Profit Card -->
                        <div class="col-12 mb-3">
                            <div class="card stats-card border-0 h-100">
                                <div class="card-body text-center py-4">
                                    @php
                                        $netProfit = $account->total_earnings - $account->total_withdrawal;
                                        $profitClass = $netProfit > 0 ? 'text-success' : ($netProfit < 0 ? 'text-danger' : 'text-muted');
                                        $profitIcon = $netProfit > 0 ? 'fa-arrow-trend-up' : ($netProfit < 0 ? 'fa-arrow-trend-down' : 'fa-minus');
                                    @endphp
                                    <div class="{{ $profitClass }} mb-2">
                                        <i class="fas {{ $profitIcon }} fa-2x"></i>
                                    </div>
                                    <h4 class="{{ $profitClass }} fw-bold mb-1">
                                        ${{ number_format(abs($netProfit), 2) }}
                                    </h4>
                                    <p class="text-muted mb-0 small text-uppercase">Net {{ $netProfit >= 0 ? 'Profit' : 'Loss' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- ROI Card -->
                        <div class="col-12 mb-3">
                            <div class="card stats-card border-0 h-100">
                                <div class="card-body text-center py-4">
                                    @php
                                        $roi = $account->active_deposit > 0 ? (($account->total_earnings - $account->total_withdrawal) / $account->active_deposit) * 100 : 0;
                                        $roiClass = $roi > 0 ? 'text-success' : ($roi < 0 ? 'text-danger' : 'text-muted');
                                    @endphp
                                    <div class="{{ $roiClass }} mb-2">
                                        <i class="fas fa-percentage fa-2x"></i>
                                    </div>
                                    <h4 class="{{ $roiClass }} fw-bold mb-1">
                                        {{ number_format(abs($roi), 1) }}%
                                    </h4>
                                    <p class="text-muted mb-0 small text-uppercase">Return on Investment</p>
                                </div>
                            </div>
                        </div>

                        <!-- Total Assets Card -->
                        <div class="col-12">
                            <div class="card stats-card border-0 h-100">
                                <div class="card-body text center py-4">
                                    <div class="text-info mb-2">
                                        <i class="fas fa-coins fa-2x"></i>
                                    </div>
                                    <h4 class="text-info fw-bold mb-1">
                                        ${{ number_format($account->available_balance + $account->active_deposit, 2) }}
                                    </h4>
                                    <p class="text-muted mb-0 small text-uppercase">Total Assets</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Timeline Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0 text-dark">
                        <i class="fas fa-history text-primary me-2"></i>Account Timeline
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary rounded-circle p-2 me-3">
                                    <i class="fas fa-plus text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-semibold">Account Created</h6>
                                    <small class="text-muted">{{ $account->created_at->format('F j, Y \a\t g:i A') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-warning rounded-circle p-2 me-3">
                                    <i class="fas fa-edit text-white"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-semibold">Last Updated</h6>
                                    <small class="text-muted">{{ $account->updated_at->format('F j, Y \a\t g:i A') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Account Performance Metrics -->
                    <div class="row pt-3 border-top">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted">Account Age:</span>
                                <strong>{{ $account->created_at->diffForHumans(null, true) }}</strong>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted">Account ID:</span>
                                <strong>#{{ str_pad($account->id, 6, '0', STR_PAD_LEFT) }}</strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted">Net Worth:</span>
                                <strong class="{{ ($account->total_earnings - $account->total_withdrawal) > 0 ? 'text-success' : 'text-danger' }}">
                                    ${{ number_format($account->total_earnings - $account->total_withdrawal, 2) }}
                                </strong>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted">Activity Status:</span>
                                <strong class="text-success">
                                    <i class="fas fa-circle fa-xs me-1"></i>Active
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection