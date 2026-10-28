@extends('layouts.main')

@section('main-section')

<link rel="stylesheet" href="{{ asset('frontend/css/wallet.css') }}" />

<section class="payment-section" id="scrollArea">
    <div class="pay-box">
        <div class="withdrawfunds">
            <div class="wallet-header">
                <h2>Wallet</h2>
                <p>Track your earnings, Transactions and Withdrawels</p>
            </div>
            <button class="funds-btn" id="openWithdrawModalWallet">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="15" viewBox="0 0 12 15" fill="none">
                    <path d="M11.5 11.9156V14.5C11.5 14.6326 11.4473 14.7598 11.3536 14.8536C11.2598 14.9473 11.1326 15 11 15C10.8674 15 10.7402 14.9473 10.6464 14.8536C10.5527 14.7598 10.5 14.6326 10.5 14.5V11.9156C10.4977 11.2738 10.3633 10.6394 10.1052 10.0518C9.84719 9.46419 9.47097 8.93597 9 8.5V12.1469C8.99991 12.2545 8.96511 12.3592 8.90077 12.4454C8.83643 12.5317 8.74598 12.5949 8.64287 12.6256C8.53975 12.6564 8.42947 12.653 8.3284 12.6161C8.22733 12.5792 8.14088 12.5106 8.08187 12.4206L7.41438 11.4012C7.40938 11.3938 7.40437 11.3856 7.4 11.3775C7.30195 11.2044 7.13914 11.0773 6.94739 11.0242C6.75563 10.9711 6.55064 10.9963 6.3775 11.0944C6.20436 11.1924 6.07727 11.3552 6.02417 11.547C5.97107 11.7387 5.99633 11.9437 6.09437 12.1169L7.4775 14.2288C7.5501 14.3397 7.57565 14.475 7.54851 14.6048C7.52138 14.7346 7.44379 14.8483 7.33281 14.9209C7.22184 14.9935 7.08656 15.0191 6.95675 14.992C6.82694 14.9648 6.71323 14.8872 6.64062 14.7762L5.24938 12.6512L5.23438 12.6275C5.01901 12.2584 4.94613 11.8233 5.02946 11.4042C5.1128 10.9851 5.34659 10.611 5.68676 10.3524C6.02693 10.0938 6.44997 9.96856 6.87609 10.0004C7.30222 10.0322 7.70198 10.2188 8 10.525V3.5H7C6.86739 3.5 6.74021 3.44732 6.64645 3.35355C6.55268 3.25979 6.5 3.13261 6.5 3C6.5 2.86739 6.55268 2.74021 6.64645 2.64645C6.74021 2.55268 6.86739 2.5 7 2.5H8C8.26522 2.5 8.51957 2.60536 8.70711 2.79289C8.89464 2.98043 9 3.23478 9 3.5V7.22625C9.76744 7.74485 10.3964 8.44324 10.8322 9.26058C11.2679 10.0779 11.4972 10.9894 11.5 11.9156ZM2.5 3C2.5 2.86739 2.44732 2.74021 2.35355 2.64645C2.25979 2.55268 2.13261 2.5 2 2.5H1C0.734784 2.5 0.48043 2.60536 0.292893 2.79289C0.105357 2.98043 0 3.23478 0 3.5V12C0 12.1326 0.0526785 12.2598 0.146447 12.3536C0.240215 12.4473 0.367392 12.5 0.5 12.5C0.632608 12.5 0.759785 12.4473 0.853553 12.3536C0.947321 12.2598 1 12.1326 1 12V3.5H2C2.13261 3.5 2.25979 3.44732 2.35355 3.35355C2.44732 3.25979 2.5 3.13261 2.5 3ZM6.85375 5.64625C6.80731 5.59976 6.75217 5.56288 6.69147 5.53772C6.63077 5.51256 6.56571 5.49961 6.5 5.49961C6.43429 5.49961 6.36923 5.51256 6.30853 5.53772C6.24783 5.56288 6.19269 5.59976 6.14625 5.64625L5 6.79313V0.5C5 0.367392 4.94732 0.240215 4.85355 0.146447C4.75979 0.0526784 4.63261 0 4.5 0C4.36739 0 4.24021 0.0526784 4.14645 0.146447C4.05268 0.240215 4 0.367392 4 0.5V6.79313L2.85375 5.64625C2.75993 5.55243 2.63268 5.49972 2.5 5.49972C2.36732 5.49972 2.24007 5.55243 2.14625 5.64625C2.05243 5.74007 1.99972 5.86732 1.99972 6C1.99972 6.13268 2.05243 6.25993 2.14625 6.35375L4.14625 8.35375C4.19269 8.40024 4.24783 8.43712 4.30853 8.46228C4.36923 8.48744 4.43429 8.50039 4.5 8.50039C4.56571 8.50039 4.63077 8.48744 4.69147 8.46228C4.75217 8.43712 4.80731 8.40024 4.85375 8.35375L6.85375 6.35375C6.90024 6.30731 6.93712 6.25217 6.96228 6.19147C6.98744 6.13077 7.00039 6.06571 7.00039 6C7.00039 5.93429 6.98744 5.86923 6.96228 5.80853C6.93712 5.74783 6.90024 5.69269 6.85375 5.64625Z" fill="white" />
                </svg>
                <span>Withdraw Funds</span>
            </button>

            <button class="kycpending-btn d-none" id="openKYCModalWallet">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <g clip-path="url(#clip0_1295_3132)">
                        <path d="M2.92984 17.0718C1.97473 16.1493 1.21291 15.0459 0.688821 13.8258C0.164731 12.6058 -0.111131 11.2936 -0.122669 9.9658C-0.134207 8.63801 0.11881 7.32121 0.621618 6.09225C1.12443 4.86328 1.86696 3.74677 2.80589 2.80784C3.74481 1.86891 4.86133 1.12638 6.09029 0.623572C7.31926 0.120763 8.63605 -0.132254 9.96385 -0.120716C11.2916 -0.109178 12.6038 0.166684 13.8239 0.690774C15.0439 1.21486 16.1474 1.97669 17.0698 2.93179C18.8914 4.81781 19.8994 7.34383 19.8766 9.9658C19.8538 12.5878 18.8021 15.0959 16.948 16.95C15.0939 18.8041 12.5858 19.8557 9.96385 19.8785C7.34188 19.9013 4.81586 18.8934 2.92984 17.0718ZM8.99984 5.00179V11.0018H10.9998V5.00179H8.99984ZM8.99984 13.0018V15.0018H10.9998V13.0018H8.99984Z" fill="black" />
                    </g>
                    <defs>
                        <clipPath id="clip0_1295_3132">
                            <rect width="20" height="20" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
                <span>KYC Pending</span>
            </button>
        </div>

        <div class="walletgrid">
            <div class="wallet-left">
                <div class="top-row">
                    <div class="d-balance-card">
                        <div class="label-text">
                            <h2>Total Balance</h2>
                            <p>Balance available for <br> Withdraw</p>
                        </div>

                        <div class="amount">₹ {{ number_format($wallet->available_balance, 2) }}</div>
                        <button class="funds-btn" id="openWithdrawModalTotal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                <path d="M14.0476 9.25522L13.5116 6.33682C13.2796 5.07602 13.1636 4.44562 12.7052 4.07282C12.2468 3.70002 11.5876 3.69922 10.27 3.69922H6.72921C5.41161 3.69922 4.75321 3.69922 4.29401 4.07282C3.83561 4.44562 3.71961 5.07602 3.48761 6.33682L2.95161 9.25522C2.47161 11.872 2.23081 13.1808 2.97081 14.0392C3.71081 14.8992 5.07881 14.8992 7.81321 14.8992H9.18601C11.9204 14.8992 13.2884 14.8992 14.0284 14.04C14.7684 13.1808 14.5284 11.872 14.0476 9.25602V9.25522Z" stroke="white" stroke-linecap="round" />
                                <path d="M7.2504 11.4352V7.16796M8.5 7.16796V6.10156M8.5 12.5016V11.4352M7.2504 9.30156H9.7496M9.7496 9.30156C10.164 9.30156 10.5 9.65996 10.5 10.1016V10.6352C10.5 11.0768 10.164 11.4352 9.7504 11.4352H6.5M9.7496 9.30156C10.1632 9.30156 10.5 8.94316 10.5 8.50156V7.96796C10.5 7.52636 10.164 7.16796 9.7504 7.16796H6.5" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15.7 6.9C15.8236 6.83834 15.9357 6.75579 16.0312 6.656C16.5 6.1712 16.5 5.388 16.5 3.8216C16.5 2.2552 16.5 1.4728 16.0312 0.9864C15.5624 0.5 14.8088 0.5 13.3 0.5H3.7C2.1912 0.5 1.4376 0.5 0.9688 0.9864C0.5 1.4728 0.5 2.256 0.5 3.8216C0.5 5.3872 0.5 6.1704 0.9688 6.656C1.0648 6.75627 1.1752 6.8376 1.3 6.9" stroke="white" stroke-linecap="round" />
                            </svg>
                            <span>Withdraw Funds</span>
                        </button>
                        <button class="kycpending-btn d-none" id="openKYCModalTotal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <g clip-path="url(#clip0_1295_3132)">
                                    <path d="M2.92984 17.0718C1.97473 16.1493 1.21291 15.0459 0.688821 13.8258C0.164731 12.6058 -0.111131 11.2936 -0.122669 9.9658C-0.134207 8.63801 0.11881 7.32121 0.621618 6.09225C1.12443 4.86328 1.86696 3.74677 2.80589 2.80784C3.74481 1.86891 4.86133 1.12638 6.09029 0.623572C7.31926 0.120763 8.63605 -0.132254 9.96385 -0.120716C11.2916 -0.109178 12.6038 0.166684 13.8239 0.690774C15.0439 1.21486 16.1474 1.97669 17.0698 2.93179C18.8914 4.81781 19.8994 7.34383 19.8766 9.9658C19.8538 12.5878 18.8021 15.0959 16.948 16.95C15.0939 18.8041 12.5858 19.8557 9.96385 19.8785C7.34188 19.9013 4.81586 18.8934 2.92984 17.0718ZM8.99984 5.00179V11.0018H10.9998V5.00179H8.99984ZM8.99984 13.0018V15.0018H10.9998V13.0018H8.99984Z" fill="black" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_1295_3132">
                                        <rect width="20" height="20" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <span>KYC Pending</span>
                        </button>
                        <div class="d-illustration">
                            <img src="{{ asset('frontend/images/wallet-img.png') }}" alt="">
                        </div>
                    </div>

                    <div class="stacked">
                        <div class="d-mini-card hold">
                            <div>
                                <div class="label">On Hold</div>
                                <div class="amount">₹ {{ number_format($wallet->on_hold_balance, 2) }}</div>
                                <div class="footnote">Funds on Escrow / Milestones</div>
                            </div>
                            <div class="icon-circle" style="background: #FFEDD0;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38" fill="none">
                                    <path d="M9.50016 34.832C8.62933 34.832 7.88411 34.5222 7.2645 33.9026C6.64488 33.283 6.33455 32.5373 6.3335 31.6654V15.832C6.3335 14.9612 6.64383 14.216 7.2645 13.5964C7.88516 12.9768 8.63038 12.6664 9.50016 12.6654H11.0835V9.4987C11.0835 7.30842 11.8556 5.44167 13.3999 3.89845C14.9442 2.35523 16.8109 1.58309 19.0002 1.58203C21.1894 1.58098 23.0567 2.35312 24.602 3.89845C26.1473 5.44378 26.9189 7.31053 26.9168 9.4987V12.6654H28.5002C29.371 12.6654 30.1167 12.9757 30.7374 13.5964C31.3581 14.217 31.6679 14.9623 31.6668 15.832V31.6654C31.6668 32.5362 31.357 33.2819 30.7374 33.9026C30.1178 34.5233 29.3721 34.8331 28.5002 34.832H9.50016ZM21.2374 25.986C21.857 25.3653 22.1668 24.6195 22.1668 23.7487C22.1668 22.8779 21.857 22.1326 21.2374 21.513C20.6178 20.8934 19.8721 20.5831 19.0002 20.582C18.1283 20.581 17.3831 20.8913 16.7645 21.513C16.1459 22.1348 15.8356 22.88 15.8335 23.7487C15.8314 24.6174 16.1417 25.3632 16.7645 25.986C17.3873 26.6087 18.1325 26.9185 19.0002 26.9154C19.8678 26.9122 20.6136 26.6024 21.2374 25.986ZM14.2502 12.6654H23.7502V9.4987C23.7502 8.17925 23.2884 7.05773 22.3647 6.13412C21.4411 5.2105 20.3196 4.7487 19.0002 4.7487C17.6807 4.7487 16.5592 5.2105 15.6356 6.13412C14.712 7.05773 14.2502 8.17925 14.2502 9.4987V12.6654Z" fill="#F49600" />
                                </svg>
                            </div>
                        </div>

                        <div class="d-mini-card earn">
                            <div>
                                <div class="label">Total Earning</div>
                                <div class="amount">₹ {{ number_format($wallet->total_earned, 2) }}</div>
                                <div class="footnote">All time earning.</div>
                            </div>
                            <div class="icon-circle" style="background: #D8FFD8;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38" fill="none">
                                    <path d="M26.6001 5.22578C26.6001 4.84785 26.7502 4.48539 27.0175 4.21815C27.2847 3.95091 27.6472 3.80078 28.0251 3.80078H32.7751C33.153 3.80078 33.5155 3.95091 33.7827 4.21815C34.05 4.48539 34.2001 4.84785 34.2001 5.22578V9.97578C34.2001 10.3537 34.05 10.7162 33.7827 10.9834C33.5155 11.2506 33.153 11.4008 32.7751 11.4008C32.3972 11.4008 32.0347 11.2506 31.7675 10.9834C31.5002 10.7162 31.3501 10.3537 31.3501 9.97578V8.66478L22.8571 17.1578C22.5899 17.4246 22.2277 17.5745 21.8501 17.5745C21.4725 17.5745 21.1103 17.4246 20.8431 17.1578L16.1501 12.4648L8.1321 20.4828C8.00164 20.6228 7.84432 20.7351 7.66952 20.813C7.49472 20.8909 7.30602 20.9327 7.11469 20.9361C6.92335 20.9395 6.7333 20.9043 6.55586 20.8326C6.37842 20.7609 6.21724 20.6543 6.08192 20.519C5.94661 20.3836 5.83993 20.2225 5.76826 20.045C5.69659 19.8676 5.6614 19.6775 5.66477 19.4862C5.66815 19.2949 5.71003 19.1062 5.78791 18.9314C5.8658 18.7566 5.97809 18.5992 6.1181 18.4688L15.1431 9.44378C15.4103 9.17692 15.7725 9.02704 16.1501 9.02704C16.5277 9.02704 16.8899 9.17692 17.1571 9.44378L21.8501 14.1368L29.3361 6.65078H28.0251C27.6472 6.65078 27.2847 6.50065 27.0175 6.23341C26.7502 5.96617 26.6001 5.60371 26.6001 5.22578ZM7.1251 26.6008C7.50303 26.6008 7.86548 26.7509 8.13272 27.0182C8.39996 27.2854 8.5501 27.6478 8.5501 28.0258V32.7758C8.5501 33.1537 8.39996 33.5162 8.13272 33.7834C7.86548 34.0506 7.50303 34.2008 7.1251 34.2008C6.74716 34.2008 6.38471 34.0506 6.11747 33.7834C5.85023 33.5162 5.7001 33.1537 5.7001 32.7758V28.0258C5.7001 27.6478 5.85023 27.2854 6.11747 27.0182C6.38471 26.7509 6.74716 26.6008 7.1251 26.6008ZM16.1501 22.3258C16.1501 21.9478 16 21.5854 15.7327 21.3182C15.4655 21.0509 15.103 20.9008 14.7251 20.9008C14.3472 20.9008 13.9847 21.0509 13.7175 21.3182C13.4502 21.5854 13.3001 21.9478 13.3001 22.3258V32.7758C13.3001 33.1537 13.4502 33.5162 13.7175 33.7834C13.9847 34.0506 14.3472 34.2008 14.7251 34.2008C15.103 34.2008 15.4655 34.0506 15.7327 33.7834C16 33.5162 16.1501 33.1537 16.1501 32.7758V22.3258ZM22.3251 24.7008C22.703 24.7008 23.0655 24.8509 23.3327 25.1182C23.6 25.3854 23.7501 25.7478 23.7501 26.1258V32.7758C23.7501 33.1537 23.6 33.5162 23.3327 33.7834C23.0655 34.0506 22.703 34.2008 22.3251 34.2008C21.9472 34.2008 21.5847 34.0506 21.3175 33.7834C21.0502 33.5162 20.9001 33.1537 20.9001 32.7758V26.1258C20.9001 25.7478 21.0502 25.3854 21.3175 25.1182C21.5847 24.8509 21.9472 24.7008 22.3251 24.7008ZM31.3501 18.5258C31.3501 18.1478 31.2 17.7854 30.9327 17.5182C30.6655 17.2509 30.303 17.1008 29.9251 17.1008C29.5472 17.1008 29.1847 17.2509 28.9175 17.5182C28.6502 17.7854 28.5001 18.1478 28.5001 18.5258V32.7758C28.5001 33.1537 28.6502 33.5162 28.9175 33.7834C29.1847 34.0506 29.5472 34.2008 29.9251 34.2008C30.303 34.2008 30.6655 34.0506 30.9327 33.7834C31.2 33.5162 31.3501 33.1537 31.3501 32.7758V18.5258Z" fill="#009E00" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wallet-summary">
                    <h3>Wallet Summary</h3>

                    <div class="summary-row">
                        <span>Available Balance</span>
                        <span class="gren-price">₹ 15,000</span>
                    </div>
                    <div class="summary-row ">
                        <span>On hold</span>
                        <span class="hold-price">₹ {{ number_format($wallet->on_hold_balance, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Total Earnings</span>
                        <span class="gren-price">₹ {{ number_format($wallet->total_earned, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Total Withdrawn</span>
                        <span class="total-price">₹ {{ number_format($wallet->total_withdrawn, 2) }}</span>
                    </div>
                </div>

                <div class="wallet-tabpanel">
                    <div class="tabs-wrapper">
                        <div class="custom-tabs">
                            <button class="tab-btn active" data-tab="transactions">Transactions</button>
                            <button class="tab-btn" data-tab="withdrawals">Withdrawals</button>
                            <button class="tab-btn" data-tab="earnings">Earnings</button>
                        </div>

                        <!-- Transactions -->
                        <div class="tab-content active" id="transactions">
                            <div class="transaction-card">
                                <!-- Table Header -->
                                <div class="wallet-grid referral-header">
                                    <div class="cell">Date</div>
                                    <div class="cell">Received from</div>
                                    <div class="cell">Type</div>
                                    <div class="cell">Project</div>
                                    <div class="cell">Amount</div>
                                    <div class="cell">Status</div>
                                </div>

                                <!-- Row 1 -->
                                @forelse($transactions as $t)
                                @php
                                $date = \Carbon\Carbon::parse($t->created_at);

                                $typeLabels = [
                                'escrow_in' => 'Payment Received',
                                'release' => 'Payment Released',
                                'withdrawal' => 'Withdrawal',
                                'refund' => 'Refund',
                                'deposit' => 'Deposit',
                                'escrow_out' => 'Payment Sent',
                                ];
                                $typeLabel = $typeLabels[$t->type] ?? ucfirst(str_replace('_', ' ', $t->type));

                                $isCredit = in_array($t->type, ['escrow_in', 'release', 'refund', 'deposit']);
                                @endphp
                                <div class="wallet-grid referral-table">
                                    <div class="cell date-one">
                                        <span>
                                            <svg class="calendar-date" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                <path d="M11.3333 1.33333H10V0.666667C10 0.489856 9.92976 0.320286 9.80474 0.195262C9.67971 0.0702379 9.51014 0 9.33333 0C9.15652 0 8.98695 0.0702379 8.86193 0.195262C8.7369 0.320286 8.66667 0.489856 8.66667 0.666667V1.33333H4.66667V0.666667C4.66667 0.489856 4.59643 0.320286 4.4714 0.195262C4.34638 0.0702379 4.17681 0 4 0C3.82319 0 3.65362 0.0702379 3.5286 0.195262C3.40357 0.320286 3.33333 0.489856 3.33333 0.666667V1.33333H2C1.46957 1.33333 0.960859 1.54405 0.585786 1.91912C0.210714 2.29419 0 2.8029 0 3.33333V11.3333C0 11.8638 0.210714 12.3725 0.585786 12.7475C0.960859 13.1226 1.46957 13.3333 2 13.3333H11.3333C11.8638 13.3333 12.3725 13.1226 12.7475 12.7475C13.1226 12.3725 13.3333 11.8638 13.3333 11.3333V3.33333C13.3333 2.8029 13.1226 2.29419 12.7475 1.91912C12.3725 1.54405 11.8638 1.33333 11.3333 1.33333ZM12 11.3333C12 11.5101 11.9298 11.6797 11.8047 11.8047C11.6797 11.9298 11.5101 12 11.3333 12H2C1.82319 12 1.65362 11.9298 1.5286 11.8047C1.40357 11.6797 1.33333 11.5101 1.33333 11.3333V6.66667H12V11.3333ZM12 5.33333H1.33333V3.33333C1.33333 3.15652 1.40357 2.98695 1.5286 2.86193C1.65362 2.7369 1.82319 2.66667 2 2.66667H3.33333V3.33333C3.33333 3.51014 3.40357 3.67971 3.5286 3.80474C3.65362 3.92976 3.82319 4 4 4C4.17681 4 4.34638 3.92976 4.4714 3.80474C4.59643 3.67971 4.66667 3.51014 4.66667 3.33333V2.66667H8.66667V3.33333C8.66667 3.51014 8.7369 3.67971 8.86193 3.80474C8.98695 3.92976 9.15652 4 9.33333 4C9.51014 4 9.67971 3.92976 9.80474 3.80474C9.92976 3.67971 10 3.51014 10 3.33333V2.66667H11.3333C11.5101 2.66667 11.6797 2.7369 11.8047 2.86193C11.9298 2.98695 12 3.15652 12 3.33333V5.33333Z" fill="#848484" />
                                            </svg>
                                            {{ $date->format('M d, Y') }}
                                        </span>
                                        <span>
                                            <svg class="dot-svg" xmlns="http://www.w3.org/2000/svg" width="5" height="5" viewBox="0 0 5 5" fill="none">
                                                <circle cx="2.5" cy="2.5" r="2.5" fill="#ADADAD" />
                                            </svg> {{ $date->format('h:i:s a') }}
                                        </span>
                                    </div>
                                    <div class="cell name-tst">{{ $t->counterparty_name ?? '—' }}</div>
                                    <div class="cell payment-rece">
                                        <span class="payment-type {{ $t->type === 'withdrawal' ? 'withdrawal' : '' }}">{{ $typeLabel }}</span>
                                    </div>
                                    <div class="cell project">{{ $t->project_title ?? '—' }}</div>
                                    <div class="cell amount-tst">
                                        <span class="{{ $isCredit ? 'received' : 'deduction' }}">₹ {{ number_format($t->amount, 2) }}</span>
                                    </div>
                                    <div class="cell status-box">
                                        <span class="completed status">Completed</span>
                                    </div>
                                </div>
                                @empty
                                <div class="empty-state">
                                    <div class="empty-illustration">
                                        <img src="{{ asset('frontend/images/no-trans.png') }}" alt="">
                                    </div>
                                    <h3>No Transaction yet !</h3>
                                    <p>Once you start working and start the earning your earning are going to be displayed here.</p>
                                    <a href="{{ route('freelancer.find.work') }}" class="emptybtn">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                            <path d="M12 5v14M5 12h14" stroke="#fff" stroke-width="2.2" stroke-linecap="round" />
                                        </svg>
                                        <span>Find work now</span>
                                    </a>
                                </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Withdrawals -->
                        <div class="tab-content" id="withdrawals">
                            <div class="empty-state">
                                <div class="empty-illustration">
                                    <img src="assets/images/no-trans.png" alt="">
                                </div>
                                <h3>No Transaction yet !</h3>
                                <p>Once you start working and start the earning your earning are going to be displayed here.</p>
                                <button class="emptybtn">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                        <path d="M12 5v14M5 12h14" stroke="#fff" stroke-width="2.2" stroke-linecap="round" />
                                    </svg>
                                    <span>Find work now</span>
                                </button>
                            </div>
                        </div>

                        <!-- Earnings -->
                        <div class="tab-content" id="earnings">
                            <div class="empty-state">
                                <div class="empty-illustration">
                                    <img src="assets/images/no-trans.png" alt="">
                                </div>
                                <h3>No Transaction yet !</h3>
                                <p>Once you start working and start the earning your earning are going to be displayed here.</p>
                                <button class="emptybtn">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                        <path d="M12 5v14M5 12h14" stroke="#fff" stroke-width="2.2" stroke-linecap="round" />
                                    </svg>
                                    <span>Find work now</span>
                                </button>
                            </div>
                        </div>

                    </div>

                </div>

                @if($transactions->hasPages())
                <div class="pagination">
                    {{ $transactions->links() }}
                </div>
                @endif
            </div>


            <div class="wallet-right">
                <div class="wallet-summary">
                    <h3>Wallet Summary</h3>
                    <img src="{{ asset('frontend/images/wallet-summy.png') }}" alt="">

                    <div class="summary-row">
                        <span>Available Balance</span>
                        <span class="gren-price">₹ {{ number_format($wallet->available_balance, 2) }}</span>
                    </div>
                    <div class="summary-row ">
                        <span>On hold</span>
                        <span class="hold-price">₹ {{ number_format($wallet->on_hold_balance, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Total Earnings</span>
                        <span class="gren-price">₹ {{ number_format($wallet->total_earned, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Total Withdrawn</span>
                        <span class="total-price">₹ {{ number_format($wallet->total_withdrawn, 2) }}</span>
                    </div>
                </div>

                <div class="complete-kyc">
                    <div class="kyc-card">
                        <div class="kyc-content">
                            <h3>
                                Complete KYC to <br>
                                <span>Receive Payments</span>
                            </h3>

                            <p>
                                Verify your Identity For
                                receiving the Money
                                you earned
                            </p>

                            <button class="kyc-btn" id="openKYCModalDesktop">
                                <span>Complete KYC Now</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="16" viewBox="0 0 8 16" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.77113 8.47572L2.9998 12.2471L2.05713 11.3044L5.35713 8.00438L2.05713 4.70439L2.9998 3.76172L6.77113 7.53305C6.89611 7.65807 6.96632 7.82761 6.96632 8.00438C6.96632 8.18116 6.89611 8.3507 6.77113 8.47572Z" fill="white" />
                                </svg>
                            </button>
                        </div>

                        <div class="kyc-image">
                            <img src="{{ asset('frontend/images/kyc-illustration.png') }}" alt="KYC">
                        </div>
                    </div>

                    <div class="withdraw-card d-none">
                        <h4>Withdraw to</h4>
                        <div class="bank-card">
                            <div class="bank-left">
                                <div class="bank-logo">
                                    <img src="{{ asset('frontend/images/hdfc-logo.png') }}" alt="HDFC Bank">
                                </div>

                                <div class="bank-info">
                                    <h3>HDFC Bank</h3>
                                    <span>**** **** **** 6463</span>
                                </div>
                            </div>
                            <span class="primary-tag">Primary</span>
                        </div>

                        <button class="withdraw-btn" id="openWithdrawModalDesktop">
                            Withdraw Funds in this Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Withdraw Amount modal -->
<div class="withdraw-overlay" id="withdrawOverlay">
    <div class="modal-sheet">
        <img src="{{ asset('frontend/images/wallet-arrow.png') }}" class="wallet-arrow" alt="">

        <div class="modal-header">
            <div class="walleticon">
                <img src="{{ asset('frontend/images/wallet-summy.png') }}" alt="Wallet Icon">
            </div>

            <div class="title-group">
                <h3>Withdraw Amount</h3>
                <p>Enter the amount you want to <br> withdraw from your Wallet</p>
            </div>

            <button class="modal-close" id="closeWithdrawModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M8.46484 15.5348L15.5368 8.46484M8.46484 8.46484L15.5368 15.5348" stroke="black" stroke-width="1.5" stroke-linecap="round" />
                </svg>
            </button>
        </div>

        <svg class="svg-img1" xmlns="http://www.w3.org/2000/svg" width="87" height="159" viewBox="0 0 87 159" fill="none">
            <g filter="url(#filter0_f_1207_2506)">
                <circle cx="7" cy="79.5" r="24" fill="#9FFF9C" />
            </g>
            <defs>
                <filter id="filter0_f_1207_2506" x="-72.5" y="0" width="159" height="159" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                    <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
                    <feGaussianBlur stdDeviation="27.75" result="effect1_foregroundBlur_1207_2506" />
                </filter>
            </defs>
        </svg>

        <svg class="svg-img2" xmlns="http://www.w3.org/2000/svg" width="206" height="206" viewBox="0 0 206 206" fill="none">
            <g filter="url(#filter0_f_1207_2508)">
                <circle cx="103" cy="103" r="26.5" fill="#9FFF9C" />
            </g>
            <defs>
                <filter id="filter0_f_1207_2508" x="0" y="0" width="206" height="206" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                    <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
                    <feGaussianBlur stdDeviation="38.25" result="effect1_foregroundBlur_1207_2508" />
                </filter>
            </defs>
        </svg>

        <svg class="svg-img3" xmlns="http://www.w3.org/2000/svg" width="206" height="206" viewBox="0 0 206 206" fill="none">
            <g filter="url(#filter0_f_1207_2508)">
                <circle cx="103" cy="103" r="26.5" fill="#9FFF9C" />
            </g>
            <defs>
                <filter id="filter0_f_1207_2508" x="0" y="0" width="206" height="206" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                    <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
                    <feGaussianBlur stdDeviation="38.25" result="effect1_foregroundBlur_1207_2508" />
                </filter>
            </defs>
        </svg>

        <div class="popup-middle">
            <div class="balance-row">
                <span>Available Balance</span>
                <span class="amt">₹ {{ number_format($wallet->available_balance, 2) }}</span>
            </div>

            <div class="amount-box">
                <span class="rupee">₹</span>
                <input type="number" id="withdrawInput" placeholder="0.00" />
            </div>

            <div class="quick-amounts">
                <button data-amt="500">500</button>
                <button data-amt="1000">1000</button>
                <button data-amt="1500">1500</button>
                <button data-amt="2000">2000</button>
                <button data-amt="2500">2500</button>
            </div>

            <div class="secure-box">
                <div class="badge">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M12 19.8984C13.6167 19.3984 14.9667 18.4111 16.05 16.9364C17.1333 15.4618 17.7667 13.8158 17.95 11.9984H12V4.12344L6 6.37344V11.5484C6 11.6651 6.01667 11.8151 6.05 11.9984H12V19.8984ZM11.675 21.8734C11.575 21.8568 11.475 21.8318 11.375 21.7984C9.125 21.0484 7.33333 19.6611 6 17.6364C4.66667 15.6118 4 13.4324 4 11.0984V6.37344C4 5.95677 4.121 5.58177 4.363 5.24844C4.605 4.9151 4.91733 4.67344 5.3 4.52344L11.3 2.27344C11.5333 2.1901 11.7667 2.14844 12 2.14844C12.2333 2.14844 12.4667 2.1901 12.7 2.27344L18.7 4.52344C19.0833 4.67344 19.396 4.9151 19.638 5.24844C19.88 5.58177 20.0007 5.95677 20 6.37344V11.0984C20 13.4318 19.3333 15.6111 18 17.6364C16.6667 19.6618 14.875 21.0491 12.625 21.7984C12.525 21.8318 12.425 21.8568 12.325 21.8734C12.225 21.8901 12.1167 21.8984 12 21.8984C11.8833 21.8984 11.775 21.8901 11.675 21.8734Z" fill="#00A148" />
                    </svg>
                </div>
                <div class="text">
                    <h4>Secure & Seamless Payments</h4>
                    <p>Secure payments with fast, reliable, and protected transactions for a seamless experience.</p>
                </div>
            </div>

            <button class="confirm-btn" id="withdrawNowBtn">Withdraw Fund Now</button>
        </div>
    </div>
</div>
<!-- Withdraw Amount modal -->

<!-- Withdraw Amount modal -->
<div class="kyc-overlay" id="kycOverlay">

    <div class="kyc-section">
        <div class="kyccard">
            <div class="progress-wrapper">
                <div class="progress-steps">
                    <div class="step-item" id="pStep1">
                        <div class="circle">1</div>
                    </div>

                    <div class="line" id="line1"></div>

                    <div class="step-item" id="pStep2">
                        <div class="circle">2</div>
                    </div>

                    <div class="line" id="line2"></div>

                    <div class="step-item" id="pStep3">
                        <div class="circle">3</div>
                    </div>

                    <div class="line" id="line3"></div>

                    <div class="step-item" id="pStep4">
                        <div class="circle">4</div>
                    </div>
                </div>
            </div>

            <div class="kycpanel" id="panel">
                <div class="step-panel" id="step1">
                    <div class="kyc-header">
                        <div class="kyc-text">
                            <h2>Complete Your KYC</h2>
                            <p>Verify your identity to enjoy secure and uninterrupted <br> services.</p>
                        </div>
                    </div>

                    <div class="form-grid row">
                        <div class="col-lg-6 col-12">
                            <label for="name">Name</label>
                            <input type="text" placeholder="Your Name" id="name">
                        </div>

                        <div class="col-lg-6 col-12">
                            <label for="email">Email</label>
                            <input type="email" placeholder="Your Email" id="email">
                        </div>

                        <div class="col-lg-6 col-12">
                            <label for="number">Contact</label>
                            <input type="number" id="number" placeholder="Your Number" maxlength="10" pattern="[0-9]{10}" inputmode="numeric">
                        </div>

                        <div class="col-lg-6 col-12">
                            <label for="city">City</label>
                            <input type="text" id="city" placeholder="Your City">
                        </div>

                        <div class="col-lg-6 col-12">
                            <label for="state">State</label>
                            <input type="text" id="state" placeholder="Your State">
                        </div>

                        <div class="col-lg-6 col-12">
                            <label for="pincode">Pincode</label>
                            <input type="number" id="pincode" placeholder="Your Pincode" maxlength="6" pattern="[0-6]{6}" inputmode="numeric">
                        </div>
                    </div>

                    <div class="row-actions">
                        <button class="kycbtn disabled" id="goStep2">
                            <span>Continue with Aadhar Verification</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.63326 9.44627L12.2545 9.44626L9.61472 12.6143C9.3575 12.9224 9.39965 13.3809 9.70773 13.6374C10.0165 13.8946 10.4743 13.8524 10.7308 13.5444L14.3639 9.18468C14.3922 9.15053 14.4067 9.11057 14.4278 9.07279C14.4452 9.04227 14.4663 9.01611 14.4794 8.98269C14.5121 8.89913 14.5317 8.81121 14.5317 8.72256C14.5317 8.72183 14.5324 8.72038 14.5324 8.71965C14.5324 8.71893 14.5317 8.71747 14.5317 8.71675C14.5317 8.6281 14.5121 8.54018 14.4794 8.45662C14.4663 8.42319 14.4452 8.39704 14.4278 8.36652C14.4067 8.32874 14.3922 8.28877 14.3639 8.25462L10.7308 3.89495C10.5869 3.72274 10.3806 3.63337 10.1728 3.63337C10.0085 3.63337 9.84361 3.68859 9.70773 3.80195C9.39965 4.05844 9.3575 4.51693 9.61472 4.82501L12.2545 7.99304L3.63326 7.99304C3.23217 7.99304 2.90664 8.31856 2.90664 8.71965C2.90664 9.12074 3.23217 9.44627 3.63326 9.44627Z" fill="white" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- STEP 2 -->
                <div class="step-panel" id="step2" style="display:none">
                    <div class="kyc-header">
                        <div class="kyc-text">
                            <h2>Aadhaar Card Verification</h2>
                            <p>Verify your Aadhaar details for secure and <br> hassle-free services.</p>
                        </div>
                    </div>

                    <div class="form-grid row">
                        <div id="aadhaarStatus" class="aadhaar-verified-box" style="display:none;">
                            <label>Aadhaar Verified</label>
                            <input type="text" id="aadhaarVerifiedInput" placeholder="9867-XXXX-XXXX-XXXX" readonly>
                            <span class="tick-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.252 0.0658387C7.32753 0.0226935 7.41301 0 7.5 0C7.58699 0 7.67247 0.0226935 7.748 0.0658387L14.748 4.06584C14.8245 4.10955 14.8881 4.17272 14.9324 4.24893C14.9766 4.32515 15 4.41171 15 4.49984V5.21984C15 7.42581 14.2814 9.57174 12.9528 11.3328C11.6243 13.0938 9.75818 14.3741 7.637 14.9798C7.54745 15.0054 7.45255 15.0054 7.363 14.9798C5.24182 14.3741 3.37571 13.0938 2.04717 11.3328C0.718624 9.57174 -2.74894e-05 7.42581 7.88645e-10 5.21984L7.88644e-10 4.49984C2.84278e-05 4.41171 0.0233513 4.32515 0.0676055 4.24893C0.11186 4.17272 0.175473 4.10955 0.252 4.06584L7.252 0.0658387ZM7.072 10.7108L11.39 5.31184L10.61 4.68784L6.928 9.28884L4.32 7.11584L3.68 7.88384L7.072 10.7108Z" fill="#3FA528" />
                                </svg>
                            </span>

                            <div class="row-actions">
                                <button class="kycbtn disabled" id="goStep3">Continue with Pan Verification →</button>
                            </div>
                        </div>

                        <div class="row-actions">
                            <button class="kycbtn" id="verifyAadhaar">
                                <span>Verify Now with Digilocker</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.63326 9.44627L12.2545 9.44626L9.61472 12.6143C9.3575 12.9224 9.39965 13.3809 9.70773 13.6374C10.0165 13.8946 10.4743 13.8524 10.7308 13.5444L14.3639 9.18468C14.3922 9.15053 14.4067 9.11057 14.4278 9.07279C14.4452 9.04227 14.4663 9.01611 14.4794 8.98269C14.5121 8.89913 14.5317 8.81121 14.5317 8.72256C14.5317 8.72183 14.5324 8.72038 14.5324 8.71965C14.5324 8.71893 14.5317 8.71747 14.5317 8.71675C14.5317 8.6281 14.5121 8.54018 14.4794 8.45662C14.4663 8.42319 14.4452 8.39704 14.4278 8.36652C14.4067 8.32874 14.3922 8.28877 14.3639 8.25462L10.7308 3.89495C10.5869 3.72274 10.3806 3.63337 10.1728 3.63337C10.0085 3.63337 9.84361 3.68859 9.70773 3.80195C9.39965 4.05844 9.3575 4.51693 9.61472 4.82501L12.2545 7.99304L3.63326 7.99304C3.23217 7.99304 2.90664 8.31856 2.90664 8.71965C2.90664 9.12074 3.23217 9.44627 3.63326 9.44627Z" fill="white" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- STEP 3 -->
                <div class="step-panel" id="step3" style="display:none">
                    <div class="kyc-header">
                        <div class="kyc-text">
                            <h2>PAN Card Verification</h2>
                            <p>Confirm your PAN details to ensure <br> compliance and secure transactions.</p>
                        </div>
                    </div>

                    <div class="form-grid row">
                        <div class="col-12">
                            <label for="pan">Pan Card Number</label>

                            <div class="input-with-action">
                                <input id="pan" type="text" placeholder="XXXXX0000X" />

                                <!-- VERIFY BUTTON -->
                                <button id="verifyPan" type="button" class="verify-btn disabled">Verify !</button>

                                <!-- TICK ICON -->
                                <span id="panTick" class="tick-icon" style="display:none;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.252 0.0658387C7.32753 0.0226935 7.41301 0 7.5 0C7.58699 0 7.67247 0.0226935 7.748 0.0658387L14.748 4.06584C14.8245 4.10955 14.8881 4.17272 14.9324 4.24893C14.9766 4.32515 15 4.41171 15 4.49984V5.21984C15 7.42581 14.2814 9.57174 12.9528 11.3328C11.6243 13.0938 9.75818 14.3741 7.637 14.9798C7.54745 15.0054 7.45255 15.0054 7.363 14.9798C5.24182 14.3741 3.37571 13.0938 2.04717 11.3328C0.718624 9.57174 -2.74894e-05 7.42581 7.88645e-10 5.21984L7.88644e-10 4.49984C2.84278e-05 4.41171 0.0233513 4.32515 0.0676055 4.24893C0.11186 4.17272 0.175473 4.10955 0.252 4.06584L7.252 0.0658387ZM7.072 10.7108L11.39 5.31184L10.61 4.68784L6.928 9.28884L4.32 7.11584L3.68 7.88384L7.072 10.7108Z" fill="#3FA528" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row-actions">
                        <button class="kycbtn disabled" id="goStep4">
                            <span>Continue with Bank Verification</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.63326 9.44627L12.2545 9.44626L9.61472 12.6143C9.3575 12.9224 9.39965 13.3809 9.70773 13.6374C10.0165 13.8946 10.4743 13.8524 10.7308 13.5444L14.3639 9.18468C14.3922 9.15053 14.4067 9.11057 14.4278 9.07279C14.4452 9.04227 14.4663 9.01611 14.4794 8.98269C14.5121 8.89913 14.5317 8.81121 14.5317 8.72256C14.5317 8.72183 14.5324 8.72038 14.5324 8.71965C14.5324 8.71893 14.5317 8.71747 14.5317 8.71675C14.5317 8.6281 14.5121 8.54018 14.4794 8.45662C14.4663 8.42319 14.4452 8.39704 14.4278 8.36652C14.4067 8.32874 14.3922 8.28877 14.3639 8.25462L10.7308 3.89495C10.5869 3.72274 10.3806 3.63337 10.1728 3.63337C10.0085 3.63337 9.84361 3.68859 9.70773 3.80195C9.39965 4.05844 9.3575 4.51693 9.61472 4.82501L12.2545 7.99304L3.63326 7.99304C3.23217 7.99304 2.90664 8.31856 2.90664 8.71965C2.90664 9.12074 3.23217 9.44627 3.63326 9.44627Z" fill="white" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- STEP 4 -->
                <div class="step-panel" id="step4" style="display:none;">
                    <div class="kyc-header">
                        <div class="kyc-text">
                            <h2>Bank Verification</h2>
                            <p>Confirm your Bank details to ensure <br> compliance and secure transactions.</p>
                        </div>
                    </div>

                    <div class="form-grid row">
                        <div class="aadhaar-verified-box">
                            <label>Bank Account Number</label>

                            <div class="input-bank">
                                <input type="text" id="accountNumber" placeholder="9867-XXXX-XXXX-XXXX">
                                <span class="tick-icon" id="accTick" style="display:none;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.252 0.0658387C7.32753 0.0226935 7.41301 0 7.5 0C7.58699 0 7.67247 0.0226935 7.748 0.0658387L14.748 4.06584C14.8245 4.10955 14.8881 4.17272 14.9324 4.24893C14.9766 4.32515 15 4.41171 15 4.49984V5.21984C15 7.42581 14.2814 9.57174 12.9528 11.3328C11.6243 13.0938 9.75818 14.3741 7.637 14.9798C7.54745 15.0054 7.45255 15.0054 7.363 14.9798C5.24182 14.3741 3.37571 13.0938 2.04717 11.3328C0.718624 9.57174 -2.74894e-05 7.42581 7.88645e-10 5.21984L7.88644e-10 4.49984C2.84278e-05 4.41171 0.0233513 4.32515 0.0676055 4.24893C0.11186 4.17272 0.175473 4.10955 0.252 4.06584L7.252 0.0658387ZM7.072 10.7108L11.39 5.31184L10.61 4.68784L6.928 9.28884L4.32 7.11584L3.68 7.88384L7.072 10.7108Z" fill="#3FA528" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <div class="aadhaar-verified-box">
                            <label>IFSC Code</label>
                            <div class="input-bank">
                                <input type="text" id="ifscCode" placeholder="XXXX0XXXXX">

                                <span class="tick-icon" id="ifscTick" style="display:none;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.252 0.0658387C7.32753 0.0226935 7.41301 0 7.5 0C7.58699 0 7.67247 0.0226935 7.748 0.0658387L14.748 4.06584C14.8245 4.10955 14.8881 4.17272 14.9324 4.24893C14.9766 4.32515 15 4.41171 15 4.49984V5.21984C15 7.42581 14.2814 9.57174 12.9528 11.3328C11.6243 13.0938 9.75818 14.3741 7.637 14.9798C7.54745 15.0054 7.45255 15.0054 7.363 14.9798C5.24182 14.3741 3.37571 13.0938 2.04717 11.3328C0.718624 9.57174 -2.74894e-05 7.42581 7.88645e-10 5.21984L7.88644e-10 4.49984C2.84278e-05 4.41171 0.0233513 4.32515 0.0676055 4.24893C0.11186 4.17272 0.175473 4.10955 0.252 4.06584L7.252 0.0658387ZM7.072 10.7108L11.39 5.31184L10.61 4.68784L6.928 9.28884L4.32 7.11584L3.68 7.88384L7.072 10.7108Z" fill="#3FA528" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <div class="aadhaar-verified-box">
                            <label>Bank Name</label>
                            <div class="input-bank">
                                <input type="text" id="bankName" placeholder="Kotak Bank">
                                <span class="tick-icon" id="bankTick" style="display:none;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.252 0.0658387C7.32753 0.0226935 7.41301 0 7.5 0C7.58699 0 7.67247 0.0226935 7.748 0.0658387L14.748 4.06584C14.8245 4.10955 14.8881 4.17272 14.9324 4.24893C14.9766 4.32515 15 4.41171 15 4.49984V5.21984C15 7.42581 14.2814 9.57174 12.9528 11.3328C11.6243 13.0938 9.75818 14.3741 7.637 14.9798C7.54745 15.0054 7.45255 15.0054 7.363 14.9798C5.24182 14.3741 3.37571 13.0938 2.04717 11.3328C0.718624 9.57174 -2.74894e-05 7.42581 7.88645e-10 5.21984L7.88644e-10 4.49984C2.84278e-05 4.41171 0.0233513 4.32515 0.0676055 4.24893C0.11186 4.17272 0.175473 4.10955 0.252 4.06584L7.252 0.0658387ZM7.072 10.7108L11.39 5.31184L10.61 4.68784L6.928 9.28884L4.32 7.11584L3.68 7.88384L7.072 10.7108Z" fill="#3FA528" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <div class="aadhaar-verified-box">
                            <label>Account Type</label>
                            <div class="input-bank">
                                <input type="text" id="accountType" placeholder="Saving Account">
                                <span class="tick-icon" id="typeTick" style="display:none;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.252 0.0658387C7.32753 0.0226935 7.41301 0 7.5 0C7.58699 0 7.67247 0.0226935 7.748 0.0658387L14.748 4.06584C14.8245 4.10955 14.8881 4.17272 14.9324 4.24893C14.9766 4.32515 15 4.41171 15 4.49984V5.21984C15 7.42581 14.2814 9.57174 12.9528 11.3328C11.6243 13.0938 9.75818 14.3741 7.637 14.9798C7.54745 15.0054 7.45255 15.0054 7.363 14.9798C5.24182 14.3741 3.37571 13.0938 2.04717 11.3328C0.718624 9.57174 -2.74894e-05 7.42581 7.88645e-10 5.21984L7.88644e-10 4.49984C2.84278e-05 4.41171 0.0233513 4.32515 0.0676055 4.24893C0.11186 4.17272 0.175473 4.10955 0.252 4.06584L7.252 0.0658387ZM7.072 10.7108L11.39 5.31184L10.61 4.68784L6.928 9.28884L4.32 7.11584L3.68 7.88384L7.072 10.7108Z" fill="#3FA528" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row-actions">
                        <button class="kycbtn disabled" id="verifyBank">
                            <span>Bank Verification</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.63326 9.44627L12.2545 9.44626L9.61472 12.6143C9.3575 12.9224 9.39965 13.3809 9.70773 13.6374C10.0165 13.8946 10.4743 13.8524 10.7308 13.5444L14.3639 9.18468C14.3922 9.15053 14.4067 9.11057 14.4278 9.07279C14.4452 9.04227 14.4663 9.01611 14.4794 8.98269C14.5121 8.89913 14.5317 8.81121 14.5317 8.72256C14.5317 8.72183 14.5324 8.72038 14.5324 8.71965C14.5324 8.71893 14.5317 8.71747 14.5317 8.71675C14.5317 8.6281 14.5121 8.54018 14.4794 8.45662C14.4663 8.42319 14.4452 8.39704 14.4278 8.36652C14.4067 8.32874 14.3922 8.28877 14.3639 8.25462L10.7308 3.89495C10.5869 3.72274 10.3806 3.63337 10.1728 3.63337C10.0085 3.63337 9.84361 3.68859 9.70773 3.80195C9.39965 4.05844 9.3575 4.51693 9.61472 4.82501L12.2545 7.99304L3.63326 7.99304C3.23217 7.99304 2.90664 8.31856 2.90664 8.71965C2.90664 9.12074 3.23217 9.44627 3.63326 9.44627Z" fill="white" />
                            </svg>
                        </button>
                        <button class="kycbtn disabled" id="finishKyc" style="display: none;">
                            <span>Complete Verification</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.63326 9.44627L12.2545 9.44626L9.61472 12.6143C9.3575 12.9224 9.39965 13.3809 9.70773 13.6374C10.0165 13.8946 10.4743 13.8524 10.7308 13.5444L14.3639 9.18468C14.3922 9.15053 14.4067 9.11057 14.4278 9.07279C14.4452 9.04227 14.4663 9.01611 14.4794 8.98269C14.5121 8.89913 14.5317 8.81121 14.5317 8.72256C14.5317 8.72183 14.5324 8.72038 14.5324 8.71965C14.5324 8.71893 14.5317 8.71747 14.5317 8.71675C14.5317 8.6281 14.5121 8.54018 14.4794 8.45662C14.4663 8.42319 14.4452 8.39704 14.4278 8.36652C14.4067 8.32874 14.3922 8.28877 14.3639 8.25462L10.7308 3.89495C10.5869 3.72274 10.3806 3.63337 10.1728 3.63337C10.0085 3.63337 9.84361 3.68859 9.70773 3.80195C9.39965 4.05844 9.3575 4.51693 9.61472 4.82501L12.2545 7.99304L3.63326 7.99304C3.23217 7.99304 2.90664 8.31856 2.90664 8.71965C2.90664 9.12074 3.23217 9.44627 3.63326 9.44627Z" fill="white" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
</div>
<!-- Withdraw Amount modal -->

<!-- Popup Overlay -->
<div id="kycPopup" class="kycpopup" style="display:none;">
    <div class="popup-box">
        <!-- Status Icon -->
        <div class="status-icon success" id="popupStatusIcon">
            <!-- Success Tick -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 65 65" fill="none">
                <circle cx="32.5" cy="32.5" r="32.5" fill="#E9FFD4" />
                <path d="M26.7909 40.0443L47.2796 19.5L50 22.2278L26.7909 45.5L16 34.6829L18.7204 31.9551L26.7909 40.0443Z" fill="#269337" />
            </svg>

            <!-- Error Cross -->
            <svg id="errorIcon" style="display:none;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 65 65" fill="none">
                <circle cx="32.5" cy="32.5" r="32.5" fill="#FFD4D4" />
                <path d="M22.9219 42.074L42.0752 22.926M22.9219 22.926L42.0752 42.074" stroke="#FF3E3E" fill="#269337" stroke-width="2" stroke-linecap="round" />
            </svg>
        </div>

        <h2>KYC Completed !</h2>
        <p class="popup-subtext">Ensure your Aadhar is linked with<br>your Pan Card !</p>
        <a href="#" id="closePopup" class="dashboard-btn">Go on Dashboard</a>
    </div>
</div>
<!-- Popup Overlay -->

<button class="kyc-pill" id="openKYCModalMobile">
    <span class="icon kyc-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
            <path d="M2.92984 17.0718C1.97473 16.1493 1.21291 15.0459 0.688821 13.8258C0.164731 12.6058 -0.111131 11.2936 -0.122669 9.9658C-0.134207 8.63801 0.11881 7.32121 0.621618 6.09225C1.12443 4.86328 1.86696 3.74677 2.80589 2.80784C3.74481 1.86891 4.86133 1.12638 6.09029 0.623572C7.31926 0.120763 8.63605 -0.132254 9.96385 -0.120716C11.2916 -0.109178 12.6038 0.166684 13.8239 0.690774C15.0439 1.21486 16.1474 1.97669 17.0698 2.93179C18.8914 4.81781 19.8994 7.34383 19.8766 9.9658C19.8538 12.5878 18.8021 15.0959 16.948 16.95C15.0939 18.8041 12.5858 19.8557 9.96385 19.8785C7.34188 19.9013 4.81586 18.8934 2.92984 17.0718ZM8.99984 5.00179V11.0018H10.9998V5.00179H8.99984ZM8.99984 13.0018V15.0018H10.9998V13.0018H8.99984Z" fill="black" />
        </svg>
    </span>

    <span class="label">
        KYC Pending
    </span>
</button>

<button class="withdraw-pill" id="openWithdrawModalMobile">
    <span class="icon withdraw-icon">
        <img src="{{ asset('frontend/images/wallet-icon.svg') }}" alt="">
    </span>

    <span class="label">
        Withdraw Payment
    </span>
</button>

<!---- KycPills SCRIPT ----->
<script>
    const kycPills = document.getElementsByClassName("kyc-pill");
    const withdrawPills = document.getElementsByClassName("withdraw-pill");

    let activated = false;

    window.addEventListener("scroll", () => {
        if (!activated && window.scrollY > 20) {
            activated = true;

            for (let pill of kycPills) {
                pill.classList.add("sticky");
            }

            for (let pill of withdrawPills) {
                pill.classList.add("sticky");
            }
        }
    });
</script>

<!-- Popup Script Withdraw Amount modal -->
<script>
    document.addEventListener("DOMContentLoaded", function() {

        // Buttons
        const withdrawOpenDesktop = document.getElementById("openWithdrawModalDesktop");
        const withdrawOpenMobile = document.getElementById("openWithdrawModalMobile");
        const withdrawOpenTotal = document.getElementById("openWithdrawModalTotal");
        const withdrawOpenWallet = document.getElementById("openWithdrawModalWallet");

        // Modal
        const withdrawOverlay = document.getElementById("withdrawOverlay");
        const withdrawCloseBtn = document.getElementById("closeWithdrawModal");

        // Input & Buttons
        const withdrawInput = document.getElementById("withdrawInput");
        const withdrawQuickBtns = document.querySelectorAll(".quick-amounts button");
        const withdrawConfirmBtn = document.getElementById("withdrawNowBtn");

        // Open Popup (Desktop)
        if (withdrawOpenDesktop) {
            withdrawOpenDesktop.addEventListener("click", function() {
                withdrawOverlay.classList.add("open");
            });
        }

        // Open Popup (Mobile)
        if (withdrawOpenMobile) {
            withdrawOpenMobile.addEventListener("click", function() {
                withdrawOverlay.classList.add("open");
            });
        }

        // Open Popup (Total)
        if (withdrawOpenTotal) {
            withdrawOpenTotal.addEventListener("click", function() {
                withdrawOverlay.classList.add("open");
            });
        }

        // Open Popup (Wallet)
        if (withdrawOpenWallet) {
            withdrawOpenWallet.addEventListener("click", function() {
                withdrawOverlay.classList.add("open");
            });
        }

        // Close Button
        if (withdrawCloseBtn) {
            withdrawCloseBtn.addEventListener("click", function() {
                withdrawOverlay.classList.remove("open");
            });
        }

        // Click Outside
        if (withdrawOverlay) {
            withdrawOverlay.addEventListener("click", function(e) {
                if (e.target === withdrawOverlay) {
                    withdrawOverlay.classList.remove("open");
                }
            });
        }

        // Quick Amount Buttons
        withdrawQuickBtns.forEach(function(btn) {
            btn.addEventListener("click", function() {
                withdrawInput.value = this.dataset.amt;
            });
        });

        // Confirm Withdraw
        if (withdrawConfirmBtn) {
            withdrawConfirmBtn.addEventListener("click", function() {

                const amount = withdrawInput.value.trim();

                if (!amount || Number(amount) <= 0) {
                    alert("Please enter a valid amount");
                    return;
                }

                alert("Withdraw request submitted for ₹" + amount);

                withdrawOverlay.classList.remove("open");
            });
        }

    });
</script>

<!---- TAB SCRUPT ---->
<script>
    const tabs = document.querySelectorAll(".tab-btn");
    const contents = document.querySelectorAll(".tab-content");

    tabs.forEach(tab => {
        tab.addEventListener("click", () => {

            tabs.forEach(btn => btn.classList.remove("active"));
            contents.forEach(content => content.classList.remove("active"));

            tab.classList.add("active");

            document
                .getElementById(tab.dataset.tab)
                .classList.add("active");

        });
    });
</script>

<!--KYC FORM Poupop SCRIPT -->
<script>
    const overlayKYC = document.getElementById("kycOverlay");

    document.getElementById("openKYCModalDesktop").addEventListener("click", () => {
        overlayKYC.classList.add("open");
    });

    document.getElementById("openKYCModalMobile").addEventListener("click", () => {
        overlayKYC.classList.add("open");
    });

    document.getElementById("openKYCModalWallet").addEventListener("click", () => {
        overlayKYC.classList.add("open");
    });

    document.getElementById("openKYCModalTotal").addEventListener("click", () => {
        overlayKYC.classList.add("open");
    });

    overlayKYC.addEventListener("click", (e) => {
        if (e.target === overlayKYC) {
            overlayKYC.classList.remove("open");
        }
    });
</script>

<!-- KYC FORM SCRIPT MULTIPAL SCRIPT -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const $ = id => document.getElementById(id);
        const setEnabled = (btn, enable) => {
            if (!btn) return;
            enable ? btn.classList.remove("disabled") : btn.classList.add("disabled");
        };


        const updateProgressBar = (currentStep) => {
            const totalSteps = 4;

            // STEP CIRCLES
            for (let i = 1; i <= totalSteps; i++) {
                const stepItem = document.getElementById(`pStep${i}`);
                if (!stepItem) continue;

                if (i < currentStep) {
                    stepItem.classList.add("completed");
                    stepItem.classList.remove("active");
                } else if (i === currentStep) {
                    stepItem.classList.add("active");
                    stepItem.classList.remove("completed");
                } else {
                    stepItem.classList.remove("active", "completed");
                }
            }

            // STEP LINES (50% for current, 100% for completed)
            for (let i = 1; i < totalSteps; i++) {
                const line = document.getElementById(`line${i}`);
                if (!line) continue;

                // ⭐ Current step → half-filled
                if (currentStep === i) {
                    line.classList.add("half");
                    line.classList.remove("completed");
                }

                // ⭐ Once step completed → fully filled
                else if (currentStep > i) {
                    line.classList.add("completed");
                    line.classList.remove("half");
                }

                // ⭐ Future steps → empty line
                else {
                    line.classList.remove("half", "completed");
                }
            }

            // STEP TEXT
            const progressText = document.getElementById("progressText");
            if (progressText) {
                progressText.textContent = `Step ${currentStep} of ${totalSteps}`;
            }
        };

        /* -------------------------
            SHOW STEP FUNCTION
        ------------------------- */
        const showStep = (step) => {
            for (let i = 1; i <= 4; i++) {
                const box = document.getElementById(`step${i}`);
                if (box) {
                    box.style.display = i === step ? "block" : "none";
                }
            }
            updateProgressBar(step);
        };

        // INIT STEP 1
        showStep(1);

        /* -------------------------
            STEP 1 PERSONAL
        ------------------------- */
        const personalFields = ["name", "email", "number", "city", "state", "pincode"];
        const goStep2 = $("goStep2");

        personalFields.forEach(id => {
            const input = $(id);
            if (!input) return;

            input.addEventListener("input", () => {
                const filled = personalFields.every(fid => $(fid)?.value.trim() !== "");
                setEnabled(goStep2, filled);
            });
        });

        goStep2?.addEventListener("click", () => {
            if (!goStep2.classList.contains("disabled")) showStep(2);
        });

        /* -------------------------
            STEP 2 AADHAAR
        ------------------------- */
        const aadhaar = $("aadhaar");
        const verifyAadhaar = $("verifyAadhaar");
        const aadhaarStatus = $("aadhaarStatus");
        const goStep3 = $("goStep3");

        aadhaar?.addEventListener("input", () => {
            const val = aadhaar.value.replace(/\s/g, "");
            setEnabled(verifyAadhaar, val.length >= 12);
            setEnabled(goStep3, false);
            aadhaarStatus.style.display = "none";
            verifyAadhaar.style.display = "inline-flex";
        });

        verifyAadhaar?.addEventListener("click", () => {
            if (verifyAadhaar.classList.contains("disabled")) return;

            aadhaarStatus.style.display = "block";
            setEnabled(goStep3, true);
            verifyAadhaar.style.display = "none";
        });

        goStep3?.addEventListener("click", () => {
            if (!goStep3.classList.contains("disabled")) showStep(3);
        });

        /* -------------------------
            STEP 3 PAN
        ------------------------- */
        const pan = $("pan");
        const verifyPan = $("verifyPan");
        const panTick = $("panTick");
        const goStep4 = $("goStep4");

        pan?.addEventListener("input", () => {
            const val = pan.value.trim().toUpperCase();
            pan.value = val;

            if (val.length === 10) verifyPan.classList.remove("disabled");
            else {
                verifyPan.classList.add("disabled");
                verifyPan.style.display = "inline-flex";
                panTick.style.display = "none";
            }

            setEnabled(goStep4, val.length === 10);
        });

        verifyPan?.addEventListener("click", () => {
            if (verifyPan.classList.contains("disabled")) return;

            verifyPan.style.display = "none";
            panTick.style.display = "inline-flex";
        });

        goStep4?.addEventListener("click", () => {
            if (!goStep4.classList.contains("disabled")) showStep(4);
        });

        /* -------------------------
            STEP 4 BANK
        ------------------------- */
        const acc = $("accountNumber");
        const ifsc = $("ifscCode");
        const bankName = $("bankName");
        const accType = $("accountType");

        const verifyBank = $("verifyBank");
        const finishKyc = $("finishKyc");

        const accTick = $("accTick");
        const ifscTick = $("ifscTick");
        const bankTick = $("bankTick");
        const typeTick = $("typeTick");

        const kycPopup = $("kycPopup");
        const closePopup = $("closePopup");

        // Hide Complete Verification initially
        finishKyc.style.display = "none";

        const checkBankFields = () => {
            const ok =
                acc.value.trim() &&
                ifsc.value.trim() &&
                bankName.value.trim() &&
                accType.value.trim();

            setEnabled(verifyBank, ok);
            finishKyc.style.display = "none";

            accTick.style.display = "none";
            ifscTick.style.display = "none";
            bankTick.style.display = "none";
            typeTick.style.display = "none";
        };

        [acc, ifsc, bankName, accType].forEach(el => {
            el?.addEventListener("input", checkBankFields);
        });

        verifyBank?.addEventListener("click", () => {
            if (verifyBank.classList.contains("disabled")) return;

            accTick.style.display = "inline-flex";
            ifscTick.style.display = "inline-flex";
            bankTick.style.display = "inline-flex";
            typeTick.style.display = "inline-flex";

            verifyBank.style.display = "none";
            finishKyc.style.display = "inline-flex";
            setEnabled(finishKyc, true);
        });

        finishKyc?.addEventListener("click", () => {
            if (!finishKyc.classList.contains("disabled"))
                showSuccessPopup(); // Popup success mode
        });

        closePopup?.addEventListener("click", () => {
            kycPopup.style.display = "none";
        });

        /* -------------------------
            POPUP SUCCESS + FAILED LOGIC
        ------------------------- */



        function showSuccessPopup() {
            kycPopup.style.display = "flex";

            // KYC Modal Close
            document.querySelector(".kyc-overlay")?.classList.remove("open");

            $("successIcon").style.display = "block";
            $("errorIcon").style.display = "none";

            kycPopup.querySelector("h2").innerHTML = "KYC Completed !";
            kycPopup.querySelector(".popup-subtext").innerHTML =
                "Ensure your Aadhar is linked with<br>your Pan Card !";

            closePopup.innerHTML = "Go on Dashboard";
        }

        function showFailedPopup() {
            kycPopup.style.display = "flex";

            $("successIcon").style.display = "none";
            $("errorIcon").style.display = "block";

            kycPopup.querySelector("h2").innerHTML = "KYC Failed !";
            kycPopup.querySelector(".popup-subtext").innerHTML =
                "Something went wrong while verifying<br>your KYC details !";

            closePopup.innerHTML = "Try Again";
        }

    });
</script>

@endsection