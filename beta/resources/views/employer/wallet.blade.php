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
            <button class="addfund-btn" id="openWithdrawModalWallet">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="15" viewBox="0 0 12 15" fill="none">
                    <path d="M11.5 11.9156V14.5C11.5 14.6326 11.4473 14.7598 11.3536 14.8536C11.2598 14.9473 11.1326 15 11 15C10.8674 15 10.7402 14.9473 10.6464 14.8536C10.5527 14.7598 10.5 14.6326 10.5 14.5V11.9156C10.4977 11.2738 10.3633 10.6394 10.1052 10.0518C9.84719 9.46419 9.47097 8.93597 9 8.5V12.1469C8.99991 12.2545 8.96511 12.3592 8.90077 12.4454C8.83643 12.5317 8.74598 12.5949 8.64287 12.6256C8.53975 12.6564 8.42947 12.653 8.3284 12.6161C8.22733 12.5792 8.14088 12.5106 8.08187 12.4206L7.41438 11.4012C7.40938 11.3938 7.40437 11.3856 7.4 11.3775C7.30195 11.2044 7.13914 11.0773 6.94739 11.0242C6.75563 10.9711 6.55064 10.9963 6.3775 11.0944C6.20436 11.1924 6.07727 11.3552 6.02417 11.547C5.97107 11.7387 5.99633 11.9437 6.09437 12.1169L7.4775 14.2288C7.5501 14.3397 7.57565 14.475 7.54851 14.6048C7.52138 14.7346 7.44379 14.8483 7.33281 14.9209C7.22184 14.9935 7.08656 15.0191 6.95675 14.992C6.82694 14.9648 6.71323 14.8872 6.64062 14.7762L5.24938 12.6512L5.23438 12.6275C5.01901 12.2584 4.94613 11.8233 5.02946 11.4042C5.1128 10.9851 5.34659 10.611 5.68676 10.3524C6.02693 10.0938 6.44997 9.96856 6.87609 10.0004C7.30222 10.0322 7.70198 10.2188 8 10.525V3.5H7C6.86739 3.5 6.74021 3.44732 6.64645 3.35355C6.55268 3.25979 6.5 3.13261 6.5 3C6.5 2.86739 6.55268 2.74021 6.64645 2.64645C6.74021 2.55268 6.86739 2.5 7 2.5H8C8.26522 2.5 8.51957 2.60536 8.70711 2.79289C8.89464 2.98043 9 3.23478 9 3.5V7.22625C9.76744 7.74485 10.3964 8.44324 10.8322 9.26058C11.2679 10.0779 11.4972 10.9894 11.5 11.9156ZM2.5 3C2.5 2.86739 2.44732 2.74021 2.35355 2.64645C2.25979 2.55268 2.13261 2.5 2 2.5H1C0.734784 2.5 0.48043 2.60536 0.292893 2.79289C0.105357 2.98043 0 3.23478 0 3.5V12C0 12.1326 0.0526785 12.2598 0.146447 12.3536C0.240215 12.4473 0.367392 12.5 0.5 12.5C0.632608 12.5 0.759785 12.4473 0.853553 12.3536C0.947321 12.2598 1 12.1326 1 12V3.5H2C2.13261 3.5 2.25979 3.44732 2.35355 3.35355C2.44732 3.25979 2.5 3.13261 2.5 3ZM6.85375 5.64625C6.80731 5.59976 6.75217 5.56288 6.69147 5.53772C6.63077 5.51256 6.56571 5.49961 6.5 5.49961C6.43429 5.49961 6.36923 5.51256 6.30853 5.53772C6.24783 5.56288 6.19269 5.59976 6.14625 5.64625L5 6.79313V0.5C5 0.367392 4.94732 0.240215 4.85355 0.146447C4.75979 0.0526784 4.63261 0 4.5 0C4.36739 0 4.24021 0.0526784 4.14645 0.146447C4.05268 0.240215 4 0.367392 4 0.5V6.79313L2.85375 5.64625C2.75993 5.55243 2.63268 5.49972 2.5 5.49972C2.36732 5.49972 2.24007 5.55243 2.14625 5.64625C2.05243 5.74007 1.99972 5.86732 1.99972 6C1.99972 6.13268 2.05243 6.25993 2.14625 6.35375L4.14625 8.35375C4.19269 8.40024 4.24783 8.43712 4.30853 8.46228C4.36923 8.48744 4.43429 8.50039 4.5 8.50039C4.56571 8.50039 4.63077 8.48744 4.69147 8.46228C4.75217 8.43712 4.80731 8.40024 4.85375 8.35375L6.85375 6.35375C6.90024 6.30731 6.93712 6.25217 6.96228 6.19147C6.98744 6.13077 7.00039 6.06571 7.00039 6C7.00039 5.93429 6.98744 5.86923 6.96228 5.80853C6.93712 5.74783 6.90024 5.69269 6.85375 5.64625Z" fill="white" />
                </svg>
                <span>Add Funds</span>
            </button>
        </div>

        <div class="walletgrid">
            <div class="wallet-left">
                <div class="top-row">
                    <div class="d-balance-card">
                        <div class="label-text">
                            <h2>Total Wallet Amount</h2>
                            <p>Balance available for <br> Project</p>
                        </div>

                        <div class="amount">₹ {{ number_format($wallet->available_balance, 2) }}</div>
                        <button class="addfund-btn" id="openWithdrawModalTotal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                <path d="M14.0476 9.25522L13.5116 6.33682C13.2796 5.07602 13.1636 4.44562 12.7052 4.07282C12.2468 3.70002 11.5876 3.69922 10.27 3.69922H6.72921C5.41161 3.69922 4.75321 3.69922 4.29401 4.07282C3.83561 4.44562 3.71961 5.07602 3.48761 6.33682L2.95161 9.25522C2.47161 11.872 2.23081 13.1808 2.97081 14.0392C3.71081 14.8992 5.07881 14.8992 7.81321 14.8992H9.18601C11.9204 14.8992 13.2884 14.8992 14.0284 14.04C14.7684 13.1808 14.5284 11.872 14.0476 9.25602V9.25522Z" stroke="white" stroke-linecap="round" />
                                <path d="M7.2504 11.4352V7.16796M8.5 7.16796V6.10156M8.5 12.5016V11.4352M7.2504 9.30156H9.7496M9.7496 9.30156C10.164 9.30156 10.5 9.65996 10.5 10.1016V10.6352C10.5 11.0768 10.164 11.4352 9.7504 11.4352H6.5M9.7496 9.30156C10.1632 9.30156 10.5 8.94316 10.5 8.50156V7.96796C10.5 7.52636 10.164 7.16796 9.7504 7.16796H6.5" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15.7 6.9C15.8236 6.83834 15.9357 6.75579 16.0312 6.656C16.5 6.1712 16.5 5.388 16.5 3.8216C16.5 2.2552 16.5 1.4728 16.0312 0.9864C15.5624 0.5 14.8088 0.5 13.3 0.5H3.7C2.1912 0.5 1.4376 0.5 0.9688 0.9864C0.5 1.4728 0.5 2.256 0.5 3.8216C0.5 5.3872 0.5 6.1704 0.9688 6.656C1.0648 6.75627 1.1752 6.8376 1.3 6.9" stroke="white" stroke-linecap="round" />
                            </svg>
                            <span>Add Funds</span>
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
                                <div class="label">Total Spent</div>
                                <div class="amount">₹ {{ number_format($wallet->total_spent, 2) }}</div>
                                <div class="footnote">All time spent.</div>
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
                        <span>Available Funds</span>
                        <span class="gren-price">₹ {{ number_format($wallet->available_balance, 2) }}</span>
                    </div>
                    <div class="summary-row ">
                        <span>On hold</span>
                        <span class="hold-price">₹ {{ number_format($wallet->on_hold_balance, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Total Spent</span>
                        <span class="gren-price">₹ {{ number_format($wallet->total_spent, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Total Fund Added</span>
                        <span class="total-price">₹ {{ number_format($wallet->total_deposited, 2) }}</span>
                    </div>
                </div>

                <div class="wallet-tabpanel">
                    <div class="tabs-wrapper">
                        <div class="custom-tabs">
                            <button class="tab-btn active" data-tab="transactions">Transactions</button>
                            <button class="tab-btn" data-tab="spent">Spent</button>
                            <!-- <button class="tab-btn" data-tab="earnings">Earnings</button> -->
                        </div>

                        <!-- Transactions -->
                        <div class="tab-content active" id="transactions">
                            <div class="transaction-card">
                                <!-- Table Header -->
                                <div class="wallet-grid referral-header">
                                    <div class="cell">Date</div>
                                    <div class="cell">Details</div>
                                    <div class="cell">Type</div>
                                    <div class="cell">Transaction ID</div>
                                    <div class="cell">Amount</div>
                                    <div class="cell">Status</div>
                                </div>

                                <!-- Row 1 -->
                                @forelse($transactions as $t)
                                <div class="wallet-grid referral-table">
                                    <div class="cell date-one">
                                        <span>
                                            <svg class="calendar-date" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                <path d="M11.3333 1.33333H10V0.666667C10 0.489856 9.92976 0.320286 9.80474 0.195262C9.67971 0.0702379 9.51014 0 9.33333 0C9.15652 0 8.98695 0.0702379 8.86193 0.195262C8.7369 0.320286 8.66667 0.489856 8.66667 0.666667V1.33333H4.66667V0.666667C4.66667 0.489856 4.59643 0.320286 4.4714 0.195262C4.34638 0.0702379 4.17681 0 4 0C3.82319 0 3.65362 0.0702379 3.5286 0.195262C3.40357 0.320286 3.33333 0.489856 3.33333 0.666667V1.33333H2C1.46957 1.33333 0.960859 1.54405 0.585786 1.91912C0.210714 2.29419 0 2.8029 0 3.33333V11.3333C0 11.8638 0.210714 12.3725 0.585786 12.7475C0.960859 13.1226 1.46957 13.3333 2 13.3333H11.3333C11.8638 13.3333 12.3725 13.1226 12.7475 12.7475C13.1226 12.3725 13.3333 11.8638 13.3333 11.3333V3.33333C13.3333 2.8029 13.1226 2.29419 12.7475 1.91912C12.3725 1.54405 11.8638 1.33333 11.3333 1.33333ZM12 11.3333C12 11.5101 11.9298 11.6797 11.8047 11.8047C11.6797 11.9298 11.5101 12 11.3333 12H2C1.82319 12 1.65362 11.9298 1.5286 11.8047C1.40357 11.6797 1.33333 11.5101 1.33333 11.3333V6.66667H12V11.3333ZM12 5.33333H1.33333V3.33333C1.33333 3.15652 1.40357 2.98695 1.5286 2.86193C1.65362 2.7369 1.82319 2.66667 2 2.66667H3.33333V3.33333C3.33333 3.51014 3.40357 3.67971 3.5286 3.80474C3.65362 3.92976 3.82319 4 4 4C4.17681 4 4.34638 3.92976 4.4714 3.80474C4.59643 3.67971 4.66667 3.51014 4.66667 3.33333V2.66667H8.66667V3.33333C8.66667 3.51014 8.7369 3.67971 8.86193 3.80474C8.98695 3.92976 9.15652 4 9.33333 4C9.51014 4 9.67971 3.92976 9.80474 3.80474C9.92976 3.67971 10 3.51014 10 3.33333V2.66667H11.3333C11.5101 2.66667 11.6797 2.7369 11.8047 2.86193C11.9298 2.98695 12 3.15652 12 3.33333V5.33333Z" fill="#848484" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($t->created_at)->format('d M Y') }}
                                        </span>
                                        <span>
                                            <svg class="dot-svg" xmlns="http://www.w3.org/2000/svg" width="5" height="5" viewBox="0 0 5 5" fill="none">
                                                <circle cx="2.5" cy="2.5" r="2.5" fill="#ADADAD" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($t->created_at)->format('h:i:s A') }}
                                        </span>
                                    </div>
                                    <div class="cell name-tst">Mr. Mishra Khan</div>
                                    <div class="cell payment-rece">
                                        <span class="payment-type">{{ ucfirst(str_replace('_', ' ', $t->type)) }}</span>
                                    </div>
                                    <div class="cell project">{{ $t->note }}</div>
                                    <div class="cell amount-tst">
                                        <span class="received">₹ {{ number_format($t->amount, 2) }}</span>
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
                                    <button class="emptybtn">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                                            <path d="M12 5v14M5 12h14" stroke="#fff" stroke-width="2.2" stroke-linecap="round" />
                                        </svg>
                                        <span>Find work now</span>
                                    </button>
                                </div>
                                @endforelse

                                <div class="wallet-grid referral-table">
                                    <div class="cell date-one">
                                        <span>
                                            <svg class="calendar-date" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                <path d="M11.3333 1.33333H10V0.666667C10 0.489856 9.92976 0.320286 9.80474 0.195262C9.67971 0.0702379 9.51014 0 9.33333 0C9.15652 0 8.98695 0.0702379 8.86193 0.195262C8.7369 0.320286 8.66667 0.489856 8.66667 0.666667V1.33333H4.66667V0.666667C4.66667 0.489856 4.59643 0.320286 4.4714 0.195262C4.34638 0.0702379 4.17681 0 4 0C3.82319 0 3.65362 0.0702379 3.5286 0.195262C3.40357 0.320286 3.33333 0.489856 3.33333 0.666667V1.33333H2C1.46957 1.33333 0.960859 1.54405 0.585786 1.91912C0.210714 2.29419 0 2.8029 0 3.33333V11.3333C0 11.8638 0.210714 12.3725 0.585786 12.7475C0.960859 13.1226 1.46957 13.3333 2 13.3333H11.3333C11.8638 13.3333 12.3725 13.1226 12.7475 12.7475C13.1226 12.3725 13.3333 11.8638 13.3333 11.3333V3.33333C13.3333 2.8029 13.1226 2.29419 12.7475 1.91912C12.3725 1.54405 11.8638 1.33333 11.3333 1.33333ZM12 11.3333C12 11.5101 11.9298 11.6797 11.8047 11.8047C11.6797 11.9298 11.5101 12 11.3333 12H2C1.82319 12 1.65362 11.9298 1.5286 11.8047C1.40357 11.6797 1.33333 11.5101 1.33333 11.3333V6.66667H12V11.3333ZM12 5.33333H1.33333V3.33333C1.33333 3.15652 1.40357 2.98695 1.5286 2.86193C1.65362 2.7369 1.82319 2.66667 2 2.66667H3.33333V3.33333C3.33333 3.51014 3.40357 3.67971 3.5286 3.80474C3.65362 3.92976 3.82319 4 4 4C4.17681 4 4.34638 3.92976 4.4714 3.80474C4.59643 3.67971 4.66667 3.51014 4.66667 3.33333V2.66667H8.66667V3.33333C8.66667 3.51014 8.7369 3.67971 8.86193 3.80474C8.98695 3.92976 9.15652 4 9.33333 4C9.51014 4 9.67971 3.92976 9.80474 3.80474C9.92976 3.67971 10 3.51014 10 3.33333V2.66667H11.3333C11.5101 2.66667 11.6797 2.7369 11.8047 2.86193C11.9298 2.98695 12 3.15652 12 3.33333V5.33333Z" fill="#848484" />
                                            </svg>
                                            Nov 20, 2024
                                        </span>
                                        <span>
                                            <svg class="dot-svg" xmlns="http://www.w3.org/2000/svg" width="5" height="5" viewBox="0 0 5 5" fill="none">
                                                <circle cx="2.5" cy="2.5" r="2.5" fill="#ADADAD" />
                                            </svg> 10:30:00 am
                                        </span>
                                    </div>
                                    <div class="cell name-tst">Mr. Mishra Khan</div>
                                    <div class="cell payment-rece">
                                        <span class="payment-type withdrawal">Withdrawal</span>
                                    </div>
                                    <div class="cell project">Mobile App UI Design</div>
                                    <div class="cell amount-tst">
                                        <span class="deduction">₹ 15,00,000</span>
                                    </div>
                                    <div class="cell status-box">
                                        <span class="failed status">Failed</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Spent -->
                        <div class="tab-content" id="spent">
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

                <div class="pagination">
                    <a href="#" class="page-btn prev">
                        <svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8" fill="none">
                            <path d="M3.99945 8L4.93945 7.06L1.88612 4L4.93945 0.94L3.99945 8.21774e-08L-0.000547282 4L3.99945 8Z" fill="black" />
                        </svg>
                    </a>

                    <a href="#" class="page-number active">1</a>
                    <a href="#" class="page-number">2</a>
                    <a href="#" class="page-number">3</a>

                    <a href="#" class="page-btn next">
                        <svg xmlns="http://www.w3.org/2000/svg" width="5" height="8" viewBox="0 0 5 8" fill="none">
                            <path d="M0.94 0L0 0.94L3.05333 4L0 7.06L0.94 8L4.94 4L0.94 0Z" fill="black" />
                        </svg>
                    </a>
                </div>
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
                        <span class="gren-price">₹ {{ number_format($wallet->total_spent, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Total Withdrawn</span>
                        <span class="total-price">₹ {{ number_format($wallet->total_deposited, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add Funds Popup-->
<div class="addfund-overlay" id="FundOverlay">
    <div class="fund-model">
        <button class="fund-close" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <g clip-path="url(#clip0_3253_18177)">
                    <path d="M9.99939 5.99907L5.99907 9.99939M5.99907 5.99907L9.99939 9.99939M14.6664 7.99923C14.6664 11.6814 11.6814 14.6664 7.99923 14.6664C4.31704 14.6664 1.33203 11.6814 1.33203 7.99923C1.33203 4.31704 4.31704 1.33203 7.99923 1.33203C11.6814 1.33203 14.6664 4.31704 14.6664 7.99923Z" stroke="#64748B" stroke-width="2" stroke-linecap="round" />
                </g>
                <defs>
                    <clipPath id="clip0_3253_18177">
                        <rect width="16" height="16" fill="white" />
                    </clipPath>
                </defs>
            </svg>
        </button>
        <div class="fundheading">
            <h2>Add Funds</h2>
            <p>Scan the QR code or use the bank details below <br> to add funds to your wallet.</p>
        </div>

        <div class="qr-frame">
            <img src="{{ asset('frontend/images/idp-scaner.png') }}" alt="QR">
        </div>

        <div class="scan-pill">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                <g clip-path="url(#clip0_3253_18184)">
                    <path d="M12.7172 5.83272C12.9836 7.14014 12.7937 8.49938 12.1793 9.68376C11.5648 10.8681 10.5629 11.8061 9.34057 12.3412C8.11827 12.8762 6.74947 12.9761 5.46244 12.6241C4.17542 12.2721 3.04796 11.4895 2.2681 10.4069C1.48823 9.32423 1.10309 8.00694 1.17691 6.67469C1.25072 5.34245 1.77903 4.07577 2.67373 3.0859C3.56843 2.09603 4.77544 1.4428 6.09347 1.23515C7.41151 1.02749 8.76089 1.27797 9.9166 1.9448M5.25016 6.41577L7.00016 8.16577L12.8335 2.33244" stroke="#00A148" stroke-width="2" stroke-linecap="round" />
                </g>
                <defs>
                    <clipPath id="clip0_3253_18184">
                        <rect width="14" height="14" fill="white" />
                    </clipPath>
                </defs>
            </svg>
            <p>Scan & Pay with any UPI App</p>
        </div>

        <div class="funddivider"><span>OR</span></div>

        <h2 class="section-heading">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="17" viewBox="0 0 14 17" fill="none">
                <path d="M6.9994 7.00048H7.0069M6.9994 10.0007H7.0069M6.9994 4.00024H7.0069M9.9991 7.00048H10.0066M9.9991 10.0007H10.0066M9.9991 4.00024H10.0066M3.9997 7.00048H4.0072M3.9997 10.0007H4.0072M3.9997 4.00024H4.0072M4.74963 16.0012V13.751C4.74963 13.5521 4.82863 13.3613 4.96927 13.2206C5.10991 13.08 5.30066 13.001 5.49955 13.001H8.49925C8.69814 13.001 8.88889 13.08 9.02953 13.2206C9.17017 13.3613 9.24918 13.5521 9.24918 13.751V16.0012M2.49985 1H11.499C12.3273 1 12.9988 1.67163 12.9988 2.50012V14.5011C12.9988 15.3296 12.3273 16.0012 11.499 16.0012H2.49985C1.67151 16.0012 1 15.3296 1 14.5011V2.50012C1 1.67163 1.67151 1 2.49985 1Z" stroke="#00A148" stroke-width="2" stroke-linecap="round" />
            </svg>
            Bank Details
        </h2>

        <div class="bank-card">
            <div class="bank-row">
                <div class="bank-row-left">
                    <span class="icon-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M12.6664 14V12.6667C12.6664 11.9594 12.3854 11.2811 11.8853 10.781C11.3851 10.281 10.7068 10 9.99946 10H5.999C5.29168 10 4.61332 10.281 4.11317 10.781C3.61301 11.2811 3.33203 11.9594 3.33203 12.6667V14M10.6662 4.66667C10.6662 6.13943 9.47216 7.33333 7.99923 7.33333C6.5263 7.33333 5.33226 6.13943 5.33226 4.66667C5.33226 3.19391 6.5263 2 7.99923 2C9.47216 2 10.6662 3.19391 10.6662 4.66667Z" stroke="#00A148" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </span>
                    <span class="label">Beneficiary Name</span>
                </div>
                <div class="bank-row-right">
                    <span class="value">IDIGITALPRENEUR PRIVATE LIMITED</span>
                    <button class="copy-btn" data-copy="IDIGITALPRENEUR PRIVATE LIMITED" title="Copy">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <g clip-path="url(#clip0_3253_18223)">
                                <path d="M2.33473 9.33334C1.69301 9.33334 1.16797 8.80829 1.16797 8.16658V2.33278C1.16797 1.69106 1.69301 1.16602 2.33473 1.16602H8.16853C8.81025 1.16602 9.33529 1.69106 9.33529 2.33278M5.83501 4.6663H11.6688C12.3132 4.6663 12.8356 5.18867 12.8356 5.83306V11.6669C12.8356 12.3112 12.3132 12.8336 11.6688 12.8336H5.83501C5.19063 12.8336 4.66825 12.3112 4.66825 11.6669V5.83306C4.66825 5.18867 5.19063 4.6663 5.83501 4.6663Z" stroke="#00A148" stroke-width="2" stroke-linecap="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_3253_18223">
                                    <rect width="14" height="14" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="bank-row">
                <div class="bank-row-left">
                    <span class="icon-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M8.00077 6.66579H8.00743M8.00077 9.33267H8.00743M8.00077 3.99891H8.00743M10.6672 6.66579H10.6738M10.6672 9.33267H10.6738M10.6672 3.99891H10.6738M5.33437 6.66579H5.34103M5.33437 9.33267H5.34103M5.33437 3.99891H5.34103M6.00097 14.6664V12.6663C6.00097 12.4894 6.0712 12.3199 6.19621 12.1948C6.32122 12.0698 6.49078 11.9996 6.66757 11.9996H9.33397C9.51076 11.9996 9.68031 12.0698 9.80533 12.1948C9.93034 12.3199 10.0006 12.4894 10.0006 12.6663V14.6664M4.00117 1.33203H12.0004C12.7367 1.33203 13.3336 1.92903 13.3336 2.66547V13.333C13.3336 14.0694 12.7367 14.6664 12.0004 14.6664H4.00117C3.26486 14.6664 2.66797 14.0694 2.66797 13.333V2.66547C2.66797 1.92903 3.26486 1.33203 4.00117 1.33203Z" stroke="#00A148" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </span>
                    <span class="label">Bank Name</span>
                </div>
                <div class="bank-row-right">
                    <span class="value">IDFC First Bank</span>
                    <button class="copy-btn" data-copy="IDFC First Bank" title="Copy">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <g clip-path="url(#clip0_3253_18223)">
                                <path d="M2.33473 9.33334C1.69301 9.33334 1.16797 8.80829 1.16797 8.16658V2.33278C1.16797 1.69106 1.69301 1.16602 2.33473 1.16602H8.16853C8.81025 1.16602 9.33529 1.69106 9.33529 2.33278M5.83501 4.6663H11.6688C12.3132 4.6663 12.8356 5.18867 12.8356 5.83306V11.6669C12.8356 12.3112 12.3132 12.8336 11.6688 12.8336H5.83501C5.19063 12.8336 4.66825 12.3112 4.66825 11.6669V5.83306C4.66825 5.18867 5.19063 4.6663 5.83501 4.6663Z" stroke="#00A148" stroke-width="2" stroke-linecap="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_3253_18223">
                                    <rect width="14" height="14" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="bank-row">
                <div class="bank-row-left">
                    <span class="icon-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M1.33203 6.66575H14.6664M2.66547 3.33203H13.333C14.0694 3.33203 14.6664 3.92905 14.6664 4.66552V11.3329C14.6664 12.0694 14.0694 12.6664 13.333 12.6664H2.66547C1.92903 12.6664 1.33203 12.0694 1.33203 11.3329V4.66552C1.33203 3.92905 1.92903 3.33203 2.66547 3.33203Z" stroke="#00A148" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </span>
                    <span class="label">Account Number</span>
                </div>
                <div class="bank-row-right">
                    <span class="value">10156136451</span>
                    <button class="copy-btn" data-copy="10156136451" title="Copy">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <g clip-path="url(#clip0_3253_18223)">
                                <path d="M2.33473 9.33334C1.69301 9.33334 1.16797 8.80829 1.16797 8.16658V2.33278C1.16797 1.69106 1.69301 1.16602 2.33473 1.16602H8.16853C8.81025 1.16602 9.33529 1.69106 9.33529 2.33278M5.83501 4.6663H11.6688C12.3132 4.6663 12.8356 5.18867 12.8356 5.83306V11.6669C12.8356 12.3112 12.3132 12.8336 11.6688 12.8336H5.83501C5.19063 12.8336 4.66825 12.3112 4.66825 11.6669V5.83306C4.66825 5.18867 5.19063 4.6663 5.83501 4.6663Z" stroke="#00A148" stroke-width="2" stroke-linecap="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_3253_18223">
                                    <rect width="14" height="14" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="bank-row">
                <div class="bank-row-left">
                    <span class="icon-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M8.22741 14.6328C11.0005 13.6661 13.3336 11.9993 13.3336 8.6659V3.99908C13.3336 3.82227 13.2633 3.65269 13.1383 3.52766C13.0133 3.40264 12.8438 3.3324 12.667 3.3324C11.3338 3.3324 9.67393 2.53904 8.50738 1.519C8.36616 1.39833 8.18651 1.33203 8.00077 1.33203C7.81502 1.33203 7.63538 1.39833 7.49415 1.519C6.33427 2.53237 4.66777 3.3324 3.33457 3.3324C3.15778 3.3324 2.98822 3.40264 2.86321 3.52766C2.7382 3.65269 2.66797 3.82227 2.66797 3.99908V8.6659C2.66797 11.9993 5.00107 13.6661 7.78079 14.6261C7.92447 14.6796 8.0822 14.682 8.22741 14.6328Z" stroke="#00A148" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </span>
                    <span class="label">IFSC Code</span>
                </div>
                <div class="bank-row-right">
                    <span class="value">IDFB0020209</span>
                    <button class="copy-btn" data-copy="IDFB0020209" title="Copy">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <g clip-path="url(#clip0_3253_18223)">
                                <path d="M2.33473 9.33334C1.69301 9.33334 1.16797 8.80829 1.16797 8.16658V2.33278C1.16797 1.69106 1.69301 1.16602 2.33473 1.16602H8.16853C8.81025 1.16602 9.33529 1.69106 9.33529 2.33278M5.83501 4.6663H11.6688C12.3132 4.6663 12.8356 5.18867 12.8356 5.83306V11.6669C12.8356 12.3112 12.3132 12.8336 11.6688 12.8336H5.83501C5.19063 12.8336 4.66825 12.3112 4.66825 11.6669V5.83306C4.66825 5.18867 5.19063 4.6663 5.83501 4.6663Z" stroke="#00A148" stroke-width="2" stroke-linecap="round" />
                            </g>
                            <defs>
                                <clipPath id="clip0_3253_18223">
                                    <rect width="14" height="14" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="info-note">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                <g clip-path="url(#clip0_3253_18253)">
                    <path d="M7.99923 10.6661V7.99923M7.99923 5.33235H8.0059M14.6664 7.99923C14.6664 11.6814 11.6814 14.6664 7.99923 14.6664C4.31704 14.6664 1.33203 11.6814 1.33203 7.99923C1.33203 4.31704 4.31704 1.33203 7.99923 1.33203C11.6814 1.33203 14.6664 4.31704 14.6664 7.99923Z" stroke="#00A148" stroke-width="2" stroke-linecap="round" />
                </g>
                <defs>
                    <clipPath id="clip0_3253_18253">
                        <rect width="16" height="16" fill="white" />
                    </clipPath>
                </defs>
            </svg>
            <span>You can make payment by <b>scanning the QR code</b> above or by using the <b>bank details</b> provided.</span>
        </div>

        <div class="txn-card">
            <h2>Enter Transaction ID</h2>
            <p>After making the payment, please enter the transaction ID.</p>

            <div class="input-wrap">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <input type="text" id="transaction_id" placeholder="Enter Transaction ID">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M8.47403 11.1426C8.60159 11.0147 8.66537 10.8562 8.66537 10.6673V8.00065C8.66537 7.81176 8.60137 7.65354 8.47337 7.52598C8.34537 7.39843 8.18714 7.33443 7.9987 7.33398C7.81025 7.33354 7.65203 7.39754 7.52403 7.52598C7.39603 7.65443 7.33203 7.81265 7.33203 8.00065V10.6673C7.33203 10.8562 7.39603 11.0147 7.52403 11.1426C7.65203 11.2706 7.81025 11.3344 7.9987 11.334C8.18714 11.3335 8.34559 11.2702 8.47403 11.1426ZM8.47403 5.80865C8.60159 5.6811 8.66537 5.52287 8.66537 5.33398C8.66537 5.1451 8.60137 4.98687 8.47337 4.85932C8.34537 4.73176 8.18714 4.66776 7.9987 4.66732C7.81025 4.66687 7.65203 4.73087 7.52403 4.85932C7.39603 4.98776 7.33203 5.14598 7.33203 5.33398C7.33203 5.52198 7.39603 5.68043 7.52403 5.80932C7.65203 5.93821 7.81025 6.00198 7.9987 6.00065C8.18714 5.99932 8.34559 5.93532 8.47403 5.80865ZM7.9987 14.6673C7.07648 14.6673 6.20981 14.4922 5.3987 14.142C4.58759 13.7918 3.88203 13.3169 3.28203 12.7173C2.68203 12.1178 2.20714 11.4122 1.85737 10.6006C1.50759 9.78909 1.33248 8.92243 1.33203 8.00065C1.33159 7.07887 1.5067 6.21221 1.85737 5.40065C2.20803 4.5891 2.68292 3.88354 3.28203 3.28398C3.88114 2.68443 4.5867 2.20954 5.3987 1.85932C6.2107 1.5091 7.07737 1.33398 7.9987 1.33398C8.92003 1.33398 9.7867 1.5091 10.5987 1.85932C11.4107 2.20954 12.1163 2.68443 12.7154 3.28398C13.3145 3.88354 13.7896 4.5891 14.1407 5.40065C14.4918 6.21221 14.6667 7.07887 14.6654 8.00065C14.664 8.92243 14.4889 9.78909 14.14 10.6006C13.7911 11.4122 13.3163 12.1178 12.7154 12.7173C12.1145 13.3169 11.4089 13.792 10.5987 14.1426C9.78848 14.4933 8.92181 14.6682 7.9987 14.6673ZM7.9987 13.334C9.48759 13.334 10.7487 12.8173 11.782 11.784C12.8154 10.7507 13.332 9.48954 13.332 8.00065C13.332 6.51176 12.8154 5.25065 11.782 4.21732C10.7487 3.18398 9.48759 2.66732 7.9987 2.66732C6.50981 2.66732 5.2487 3.18398 4.21537 4.21732C3.18203 5.25065 2.66537 6.51176 2.66537 8.00065C2.66537 9.48954 3.18203 10.7507 4.21537 11.784C5.2487 12.8173 6.50981 13.334 7.9987 13.334Z" fill="#AFAFAF" />
                </svg>
                <p id="txn-error" style="color:#e11d48; margin:6px 0; display:none;"></p>
                <p id="txn-success" style="color:#16a34a; margin:6px 0; display:none;"></p>
                <div class="tooltip">
                    After completing your payment, enter your Transaction ID and click "Submit" to initiate the verification process.
                </div>
            </div>

            <button class="submit-btn">Submit Transaction ID</button>
        </div>

        <div class="footer-note">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                <g clip-path="url(#clip0_3253_18278)">
                    <path d="M3.5 5.50036V3.5002C3.5 2.83711 3.76339 2.20117 4.23223 1.73229C4.70107 1.26341 5.33696 1 6 1C6.66304 1 7.29893 1.26341 7.76777 1.73229C8.23661 2.20117 8.5 2.83711 8.5 3.5002V5.50036M2.5 5.50036H9.5C10.0523 5.50036 10.5 5.94811 10.5 6.50044V10.0007C10.5 10.553 10.0523 11.0008 9.5 11.0008H2.5C1.94772 11.0008 1.5 10.553 1.5 10.0007V6.50044C1.5 5.94811 1.94772 5.50036 2.5 5.50036Z" stroke="#94A3B8" stroke-width="2" stroke-linecap="round" />
                </g>
                <defs>
                    <clipPath id="clip0_3253_18278">
                        <rect width="12" height="12" fill="white" />
                    </clipPath>
                </defs>
            </svg>
            Your payment information is secure and encrypted.
        </div>
    </div>
</div>

<!-- FundOverlay Popup SCRIPT -->
<script>
    const fundOverlay = document.getElementById("FundOverlay");

    // Open popup
    document.querySelectorAll(".addfund-btn").forEach(btn => {
        btn.addEventListener("click", (e) => {
            e.preventDefault();
            fundOverlay.classList.add("open");
        });
    });

    // Close popup on overlay (backdrop) click
    fundOverlay.addEventListener("click", (e) => {
        if (e.target === fundOverlay) {
            fundOverlay.classList.remove("open");
        }
    });

    // Close popup on close (X) button click
    document.querySelectorAll(".fund-close").forEach(btn => {
        btn.addEventListener("click", (e) => {
            e.preventDefault();
            fundOverlay.classList.remove("open");
        });
    });

    // Copy bank details to clipboard + toggle copied icon
    document.querySelectorAll(".copy-btn").forEach(btn => {
        let hideTimer;
        btn.addEventListener("click", () => {
            const text = btn.getAttribute("data-copy");

            // copy to clipboard
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).catch(() => {});
            } else {
                // fallback for older/non-secure contexts
                const temp = document.createElement("textarea");
                temp.value = text;
                temp.style.position = "fixed";
                temp.style.opacity = "0";
                document.body.appendChild(temp);
                temp.focus();
                temp.select();
                try {
                    document.execCommand("copy");
                } catch (err) {}
                document.body.removeChild(temp);
            }

            btn.classList.add("copied");

            clearTimeout(hideTimer);
            hideTimer = setTimeout(() => {
                btn.classList.remove("copied");
            }, 1500);
        });
    });
</script>
<!-- FundOverlay Popup SCRIPT -->

<script>
    document.querySelector('.submit-btn').addEventListener('click', async function() {
        const btn = this;
        const input = document.querySelector('#transaction_id');
        const errorBox = document.querySelector('#txn-error');
        const okBox = document.querySelector('#txn-success');

        errorBox.style.display = okBox.style.display = 'none';
        errorBox.textContent = okBox.textContent = '';

        if (!input.value.trim()) {
            errorBox.textContent = 'Transaction ID is required.';
            errorBox.style.display = 'block';
            return;
        }

        btn.disabled = true;
        btn.textContent = 'Submitting...';

        try {
            const res = await fetch("{{ route('employer.transaction.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                    transaction_id: input.value.trim()
                })
            });

            const data = await res.json();

            if (res.status === 422) {
                errorBox.textContent = data.errors.transaction_id[0];
                errorBox.style.display = 'block';
            } else if (res.ok) {
                okBox.textContent = data.message;
                okBox.style.display = 'block';
                input.value = '';
            }
        } catch (e) {
            errorBox.textContent = 'Something went wrong. Please try again.';
            errorBox.style.display = 'block';
        } finally {
            btn.disabled = false;
            btn.textContent = 'Submit Transaction ID';
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


@endsection