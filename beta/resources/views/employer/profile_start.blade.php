@extends('employer.layouts.main')



@section('main-section')



<link rel="stylesheet" href="{{ asset('frontend/css/register.css') }}?v={{ filemtime(public_path('frontend/css/register.css')) }}" />



<section class="register-page">

    <img src="{{ asset('frontend/images/bg-img1.png') }}" class="bg-img1" alt="">

    <img src="{{ asset('frontend/images/bg-img2.png') }}" class="bg-img2" alt="">

    <img src="{{ asset('frontend/images/bg-img3.png') }}" class="bg-img3" alt="">



    <div class="container">

        <div class="profile-header">

            <div class="letget">

                <img src="{{ asset('frontend/images/handimg.svg') }}" alt="">

                lets get Started !

            </div>

            <h1>Start your <span>Employeer Journey</span></h1>

            <p>Launch your independent career: find clients, build skills, earn on your terms.</p>

        </div>



        <div class="progress-steps">



            <div class="step-item" id="pStep1">

                <div class="circle">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">

                        <path d="M18.8439 7.875C18.7065 9.78141 17.2923 11.25 15.7501 11.25C14.2079 11.25 12.7914 9.78188 12.6564 7.875C12.5157 5.89172 13.8925 4.5 15.7501 4.5C17.6078 4.5 18.9845 5.92781 18.8439 7.875Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />

                        <path d="M15.7498 14.25C12.695 14.25 9.75731 15.7673 9.02138 18.7223C8.92388 19.1133 9.16903 19.5 9.57075 19.5H21.9293C22.3311 19.5 22.5748 19.1133 22.4787 18.7223C21.7428 15.72 18.8051 14.25 15.7498 14.25Z" stroke="currentColor" stroke-miterlimit="10" />

                        <path d="M9.37496 8.71594C9.26527 10.2384 8.12246 11.4375 6.89058 11.4375C5.65871 11.4375 4.51402 10.2389 4.40621 8.71594C4.29418 7.13203 5.40652 6 6.89058 6C8.37465 6 9.48699 7.16109 9.37496 8.71594Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />

                        <path d="M9.65622 14.3414C8.81013 13.9538 7.87825 13.8047 6.8906 13.8047C4.4531 13.8047 2.10466 15.0164 1.51638 17.3766C1.43903 17.6888 1.63497 17.9977 1.9556 17.9977H7.21872" stroke="currentColor" stroke-miterlimit="10" stroke-linecap="round" />

                    </svg>

                </div>

                <p>Personal details</p>

            </div>



            <div class="line" id="line1"></div>



            <div class="step-item" id="pStep2">

                <div class="circle">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">

                        <path d="M6.25 12C6.05109 12 5.86032 12.079 5.71967 12.2197C5.57902 12.3603 5.5 12.5511 5.5 12.75C5.5 12.9489 5.57902 13.1397 5.71967 13.2803C5.86032 13.421 6.05109 13.5 6.25 13.5H6.75C6.94891 13.5 7.13968 13.421 7.28033 13.2803C7.42098 13.1397 7.5 12.9489 7.5 12.75C7.5 12.5511 7.42098 12.3603 7.28033 12.2197C7.13968 12.079 6.94891 12 6.75 12H6.25ZM5.5 9.25C5.5 9.05109 5.57902 8.86032 5.71967 8.71967C5.86032 8.57902 6.05109 8.5 6.25 8.5H6.75C6.94891 8.5 7.13968 8.57902 7.28033 8.71967C7.42098 8.86032 7.5 9.05109 7.5 9.25C7.5 9.44891 7.42098 9.63968 7.28033 9.78033C7.13968 9.92098 6.94891 10 6.75 10H6.25C6.05109 10 5.86032 9.92098 5.71967 9.78033C5.57902 9.63968 5.5 9.44891 5.5 9.25ZM6.25 5C6.05109 5 5.86032 5.07902 5.71967 5.21967C5.57902 5.36032 5.5 5.55109 5.5 5.75C5.5 5.94891 5.57902 6.13968 5.71967 6.28033C5.86032 6.42098 6.05109 6.5 6.25 6.5H6.75C6.94891 6.5 7.13968 6.42098 7.28033 6.28033C7.42098 6.13968 7.5 5.94891 7.5 5.75C7.5 5.55109 7.42098 5.36032 7.28033 5.21967C7.13968 5.07902 6.94891 5 6.75 5H6.25ZM9 12.75C9 12.5511 9.07902 12.3603 9.21967 12.2197C9.36032 12.079 9.55109 12 9.75 12H10.25C10.4489 12 10.6397 12.079 10.7803 12.2197C10.921 12.3603 11 12.5511 11 12.75C11 12.9489 10.921 13.1397 10.7803 13.2803C10.6397 13.421 10.4489 13.5 10.25 13.5H9.75C9.55109 13.5 9.36032 13.421 9.21967 13.2803C9.07902 13.1397 9 12.9489 9 12.75ZM9.75 8.5C9.55109 8.5 9.36032 8.57902 9.21967 8.71967C9.07902 8.86032 9 9.05109 9 9.25C9 9.44891 9.07902 9.63968 9.21967 9.78033C9.36032 9.92098 9.55109 10 9.75 10H10.25C10.4489 10 10.6397 9.92098 10.7803 9.78033C10.921 9.63968 11 9.44891 11 9.25C11 9.05109 10.921 8.86032 10.7803 8.71967C10.6397 8.57902 10.4489 8.5 10.25 8.5H9.75ZM9 5.75C9 5.55109 9.07902 5.36032 9.21967 5.21967C9.36032 5.07902 9.55109 5 9.75 5H10.25C10.4489 5 10.6397 5.07902 10.7803 5.21967C10.921 5.36032 11 5.55109 11 5.75C11 5.94891 10.921 6.13968 10.7803 6.28033C10.6397 6.42098 10.4489 6.5 10.25 6.5H9.75C9.55109 6.5 9.36032 6.42098 9.21967 6.28033C9.07902 6.13968 9 5.94891 9 5.75ZM13.25 12C13.0511 12 12.8603 12.079 12.7197 12.2197C12.579 12.3603 12.5 12.5511 12.5 12.75C12.5 12.9489 12.579 13.1397 12.7197 13.2803C12.8603 13.421 13.0511 13.5 13.25 13.5H13.75C13.9489 13.5 14.1397 13.421 14.2803 13.2803C14.421 13.1397 14.5 12.9489 14.5 12.75C14.5 12.5511 14.421 12.3603 14.2803 12.2197C14.1397 12.079 13.9489 12 13.75 12H13.25ZM12.5 9.25C12.5 9.05109 12.579 8.86032 12.7197 8.71967C12.8603 8.57902 13.0511 8.5 13.25 8.5H13.75C13.9489 8.5 14.1397 8.57902 14.2803 8.71967C14.421 8.86032 14.5 9.05109 14.5 9.25C14.5 9.44891 14.421 9.63968 14.2803 9.78033C14.1397 9.92098 13.9489 10 13.75 10H13.25C13.0511 10 12.8603 9.92098 12.7197 9.78033C12.579 9.63968 12.5 9.44891 12.5 9.25ZM13.25 5C13.0511 5 12.8603 5.07902 12.7197 5.21967C12.579 5.36032 12.5 5.55109 12.5 5.75C12.5 5.94891 12.579 6.13968 12.7197 6.28033C12.8603 6.42098 13.0511 6.5 13.25 6.5H13.75C13.9489 6.5 14.1397 6.42098 14.2803 6.28033C14.421 6.13968 14.5 5.94891 14.5 5.75C14.5 5.55109 14.421 5.36032 14.2803 5.21967C14.1397 5.07902 13.9489 5 13.75 5H13.25Z" fill="currentColor" />

                        <path d="M2 20V3C2 2.46957 2.21071 1.96086 2.58579 1.58579C2.96086 1.21071 3.46957 1 4 1H16C16.5304 1 17.0391 1.21071 17.4142 1.58579C17.7893 1.96086 18 2.46957 18 3V20C18 20.1733 17.979 20.34 17.937 20.5H20C20.1326 20.5 20.2598 20.4473 20.3536 20.3536C20.4473 20.2598 20.5 20.1326 20.5 20V12C20.5 11.9224 20.4819 11.8458 20.4472 11.7764C20.4125 11.707 20.3621 11.6466 20.3 11.6L19.8 11.225C19.6409 11.1057 19.5357 10.928 19.5075 10.7311C19.4794 10.5342 19.5307 10.3341 19.65 10.175C19.7693 10.0159 19.947 9.91067 20.1439 9.88254C20.3408 9.85441 20.5409 9.90565 20.7 10.025L21.2 10.4C21.704 10.778 22 11.37 22 12V20C22 20.5304 21.7893 21.0391 21.4142 21.4142C21.0391 21.7893 20.5304 22 20 22H16.438C16.3823 21.9986 16.3267 21.9926 16.272 21.982C16.1827 21.994 16.092 22 16 22H12.25C12.0511 22 11.8603 21.921 11.7197 21.7803C11.579 21.6397 11.5 21.4489 11.5 21.25V19H8.5V21.25C8.5 21.4489 8.42098 21.6397 8.28033 21.7803C8.13968 21.921 7.94891 22 7.75 22H4C3.46957 22 2.96086 21.7893 2.58579 21.4142C2.21071 21.0391 2 20.5304 2 20ZM4 20.5H7V18.25C7 18.0511 7.07902 17.8603 7.21967 17.7197C7.36032 17.579 7.55109 17.5 7.75 17.5H12.25C12.4489 17.5 12.6397 17.579 12.7803 17.7197C12.921 17.8603 13 18.0511 13 18.25V20.5H16C16.1326 20.5 16.2598 20.4473 16.3536 20.3536C16.4473 20.2598 16.5 20.1326 16.5 20V3C16.5 2.86739 16.4473 2.74021 16.3536 2.64645C16.2598 2.55268 16.1326 2.5 16 2.5H4C3.86739 2.5 3.74021 2.55268 3.64645 2.64645C3.55268 2.74021 3.5 2.86739 3.5 3V20C3.5 20.1326 3.55268 20.2598 3.64645 20.3536C3.74021 20.4473 3.86739 20.5 4 20.5Z" fill="currentColor" />

                    </svg>

                </div>

                <p>Organization details</p>

            </div>

        </div>





        <!-- STEP 1 -->

        <div class="step-panel" id="step1">

            <div class="profile-infom">

                <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa908046cb05.jpg" class="profile-top" alt="">



                <div class="pro-header">

                    <div class="pro-icon">

                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">

                            <path d="M11.0832 12.25V11.0833C11.0832 10.4645 10.8373 9.871 10.3998 9.43342C9.96217 8.99583 9.36868 8.75 8.74984 8.75H5.24984C4.631 8.75 4.03751 8.99583 3.59992 9.43342C3.16234 9.871 2.9165 10.4645 2.9165 11.0833V12.25" stroke="white" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />

                            <path d="M6.99984 6.41667C8.2885 6.41667 9.33317 5.372 9.33317 4.08333C9.33317 2.79467 8.2885 1.75 6.99984 1.75C5.71117 1.75 4.6665 2.79467 4.6665 4.08333C4.6665 5.372 5.71117 6.41667 6.99984 6.41667Z" stroke="white" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />

                        </svg>

                    </div>

                    <h2>Profile Details.</h2>

                </div>



                <div class="tip-header">

                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">

                        <g clip-path="url(#clip0_3862_10412)">

                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.72068 8.31458C2.62422 8.26605 2.52298 8.22765 2.4186 8.2C2.31187 8.19029 2.20449 8.19029 2.09776 8.2C0.943596 8.02292 0.881096 8.14792 0.809221 8.31458C0.737346 8.48125 0.757138 8.73958 1.75401 9.25937C1.85401 9.31354 1.95818 9.35868 2.06651 9.39479C2.1804 9.41076 2.29464 9.41076 2.40922 9.39479C2.5238 9.39479 3.58318 9.39479 3.6561 9.06146C3.67693 9.04062 3.7811 8.8125 2.72068 8.31458ZM4.79985 4.28125C4.79985 4.28125 5.62068 4.60417 5.83839 4.41667C6.05714 4.22917 5.7238 3.37708 5.71339 3.37708C5.68337 3.31368 5.64085 3.25699 5.58839 3.21042C5.52869 3.16824 5.46205 3.13686 5.39151 3.11771C4.57068 2.73229 4.43526 2.86771 4.35297 2.98229C4.26964 3.09687 4.15505 3.21146 4.55089 4.02187C4.57444 4.07163 4.60573 4.11734 4.6436 4.15729C4.68213 4.21353 4.73652 4.256 4.79985 4.28125ZM12.5936 2.07812C12.8748 2.07812 13.1967 1.33021 13.228 1.24687C13.2396 1.17792 13.2396 1.1075 13.228 1.03854C13.2384 0.965625 13.2384 0.893055 13.228 0.820833C12.9259 0 12.7592 0 12.5936 0C12.428 0 12.2613 0 11.9915 0.883333C11.9815 0.95242 11.9815 1.02258 11.9915 1.09167C11.9815 1.16075 11.9815 1.23091 11.9915 1.3C12.303 2.20312 12.5832 2.07812 12.5936 2.07812ZM18.7978 3.54375C18.8752 3.50772 18.9457 3.45836 19.0061 3.39792C19.067 3.33667 19.1228 3.27047 19.1728 3.2C19.7644 2.36979 19.6707 2.25521 19.5676 2.16146C19.4634 2.06771 19.2967 1.86979 18.3821 2.30729L18.1426 2.45312C18.0751 2.51423 18.0159 2.58392 17.9665 2.66042C17.9165 2.73646 17.4571 3.53333 17.6644 3.7C17.8728 3.86667 18.7259 3.58542 18.7978 3.54375ZM23.1009 7.77396C23.0213 7.76474 22.9409 7.76474 22.8613 7.77396C22.7792 7.78519 22.6988 7.80617 22.6217 7.83646C21.5832 8.2625 21.7603 8.52187 21.7603 8.53229C21.7603 8.83437 22.5811 9.04167 22.7998 9.07292C22.8936 9.08819 22.987 9.08819 23.0801 9.07292C23.1713 9.06181 23.2597 9.03353 23.3405 8.98958C24.254 8.5625 24.2436 8.34479 24.2019 8.16875C24.1603 7.99271 23.9936 7.84687 23.1009 7.77396ZM13.0311 12.8656C12.5207 11.6812 12.178 12.0031 11.8873 12.8656V13.625C11.8853 14.1076 11.9096 14.5889 11.9603 15.0687C12.0228 15.7969 12.1373 16.5031 12.179 17.2312C12.1862 17.3283 12.2298 17.4191 12.3011 17.4853C12.3724 17.5515 12.4661 17.5883 12.5634 17.5883C12.6607 17.5883 12.7544 17.5515 12.8257 17.4853C12.897 17.4191 12.9406 17.3283 12.9478 17.2312C13.0665 16.5118 13.1495 15.7875 13.1967 15.0583V14.1333C13.1873 13.8278 13.163 13.5229 13.1238 13.2198L13.0311 12.8656Z" fill="#575757" />

                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9728 8.72045C19.6842 7.19187 18.9629 5.77825 17.8946 4.64754C16.8233 3.47296 15.4021 2.67484 13.8415 2.3715C12.0993 2.15904 10.3356 2.52387 8.82067 3.41004C7.27698 4.21318 6.01816 5.47236 5.21546 7.01629C4.68449 8.21129 4.4422 9.51447 4.50817 10.8205C4.55943 12.115 4.91562 13.3792 5.54776 14.51C6.13005 15.5486 6.82588 16.2455 7.32484 17.1184C7.63208 17.6384 7.83351 18.214 7.91755 18.8121H7.81338C7.76672 18.8095 7.72002 18.8165 7.67614 18.8326C7.63226 18.8487 7.59212 18.8736 7.55818 18.9057C7.52424 18.9378 7.4972 18.9765 7.47872 19.0194C7.46024 19.0624 7.45071 19.1086 7.45071 19.1554C7.45071 19.2021 7.46024 19.2483 7.47872 19.2913C7.4972 19.3342 7.52424 19.3729 7.55818 19.405C7.59212 19.4371 7.63226 19.462 7.67614 19.4781C7.72002 19.4942 7.76672 19.5012 7.81338 19.4986H11.6894L14.2467 19.5923C14.7037 19.609 15.1575 19.6607 15.6082 19.7475C15.8269 19.7705 16.0394 19.8371 16.2311 19.9455C16.3665 20.0184 16.4603 20.0809 16.4915 20.1642C16.5228 20.2475 16.4915 20.2465 16.4082 20.2986C16.3396 20.3889 16.259 20.4695 16.1686 20.5382C15.5928 20.9656 14.9165 21.2372 14.205 21.3267C13.0384 21.4902 11.853 21.4684 10.6915 21.2642C10.3088 21.1916 9.93819 21.0658 9.59046 20.8902C9.2299 20.7148 8.88247 20.5136 8.55088 20.2882C8.51117 20.256 8.46532 20.2323 8.41613 20.2186C8.36695 20.2048 8.31546 20.2012 8.26484 20.208C8.21422 20.2149 8.16552 20.2319 8.12175 20.2583C8.07797 20.2846 8.04003 20.3196 8.01026 20.3611C7.95107 20.4433 7.92564 20.545 7.9392 20.6454C7.95277 20.7458 8.00429 20.8371 8.08317 20.9007C8.51512 21.2527 8.97588 21.5611 9.46546 21.8257C9.53838 21.8257 9.63213 21.8777 9.71546 21.9194C9.65843 21.9566 9.61462 22.0109 9.5903 22.0745C9.56598 22.1381 9.56239 22.2078 9.58005 22.2736C9.71338 22.9257 10.0217 23.5298 10.4738 24.0184C10.9634 24.5236 11.5998 24.8621 12.2925 24.985C13.0697 25.0641 13.8482 24.8493 14.4748 24.383C14.7804 24.1506 15.0159 23.8384 15.1552 23.4807C15.2946 23.123 15.3323 22.7337 15.2644 22.3559C15.8808 22.2244 16.4643 21.9701 16.98 21.608C17.4353 21.3048 17.7384 20.8194 17.8113 20.2777C17.8171 19.9765 17.7332 19.6803 17.5704 19.4268C17.4075 19.1733 17.1731 18.9738 16.8967 18.8538C16.7456 18.7899 16.5886 18.7411 16.428 18.708C16.2686 18.6757 16.428 18.6559 16.428 18.6142C16.4655 18.0913 16.6446 17.5882 16.9488 17.16C17.4269 16.4319 18.0915 15.7986 18.58 15.0809C19.1603 14.1599 19.572 13.143 19.7957 12.0777C20.0792 10.9822 20.1394 9.8408 19.9728 8.7215M14.0592 23.2715C13.8375 23.4364 13.5821 23.5502 13.3113 23.6048C13.0332 23.6569 12.7478 23.6569 12.4696 23.6048C12.0064 23.5781 11.5613 23.415 11.1905 23.1361C10.8058 22.8477 10.4928 22.4745 10.2759 22.0455C10.3599 22.0864 10.4467 22.1211 10.5363 22.1496C11.7925 22.46 13.0905 22.5684 14.3811 22.4715H14.4436C14.4359 22.6237 14.398 22.7729 14.332 22.9102C14.266 23.0476 14.1733 23.1704 14.0592 23.2715ZM10.4113 10.2705C10.5571 9.89545 10.703 9.53087 10.88 9.16837C10.9623 8.98087 11.0769 8.80379 11.1707 8.6267C11.3693 8.7399 11.5769 8.83365 11.7936 8.90795C11.9505 8.94962 12.1103 8.97045 12.2728 8.97045C12.4366 8.97323 12.5991 8.95587 12.7603 8.91837C13.055 8.83712 13.3353 8.71004 13.5915 8.54441C13.8936 9.1267 14.1738 9.70795 14.4644 10.2902C14.0175 10.2277 13.5811 10.1652 13.1342 10.1236H11.6894C11.2217 10.1548 10.8061 10.2184 10.4113 10.2705ZM11.6686 7.71212C11.8665 7.34754 12.054 6.984 12.2519 6.67254L12.3863 6.23608C12.48 6.46525 12.5634 6.69441 12.605 6.7767C12.7915 7.07879 12.9478 7.39025 13.1238 7.69129H12.6144C12.4165 7.68087 12.2193 7.68087 12.0228 7.69129C11.8939 7.68629 11.7649 7.69326 11.6373 7.71212H11.6686ZM14.3603 18.4371L11.7728 18.5621L10.7332 18.6246V14.9663C10.7332 14.5496 10.7332 14.1455 10.6603 13.7288C10.5769 12.8455 10.4634 11.983 10.38 11.11C11.6421 11.4838 12.9819 11.509 14.2571 11.183C14.1217 12.0684 14.0488 12.9586 14.0384 13.8538C14.0384 14.4361 14.1009 15.0184 14.153 15.5892C14.2363 16.4517 14.3821 17.3038 14.4238 18.1673C14.4197 18.2172 14.4268 18.2673 14.4446 18.314C14.4625 18.3607 14.4906 18.4028 14.5269 18.4371H14.3603ZM18.8498 11.7965C18.6706 12.7593 18.3188 13.6818 17.8113 14.5194C17.2696 15.4132 16.4603 16.1715 16.0134 17.0965C15.8071 17.5225 15.6905 17.985 15.6696 18.458C15.476 18.4471 15.282 18.4471 15.0884 18.458C15.1569 18.3921 15.1978 18.3028 15.203 18.208C15.3384 17.2295 15.4075 16.2458 15.4103 15.2569C15.4103 14.6746 15.4103 14.0934 15.3061 13.5111C15.1349 11.6511 14.8433 9.80417 14.4332 7.98191C14.1962 7.38823 13.9398 6.8025 13.6644 6.22566C13.4688 5.7821 13.2324 5.3577 12.9582 4.95795C12.806 4.76093 12.5996 4.61252 12.3644 4.53087C12.1993 4.50968 12.0316 4.54042 11.8847 4.61881C11.7378 4.69721 11.619 4.81938 11.5446 4.96837C11.3884 5.27045 11.0342 6.07045 11.0238 6.09025C10.6613 6.984 10.2655 7.88816 9.98526 8.82358C9.39255 10.5486 9.59046 9.77983 9.46546 13.7715V15.0382C9.46546 15.4652 9.51755 15.8705 9.55921 16.2861C9.65296 17.0965 9.77796 17.8965 9.89255 18.6965L8.66546 18.7798C8.589 18.0741 8.37714 17.3897 8.0415 16.7642C7.5738 15.8705 6.90921 15.1007 6.36859 14.083C5.84472 13.0668 5.56711 11.9418 5.55817 10.7986C5.54153 9.67096 5.79438 8.55566 6.29567 7.54545C6.98399 6.23897 8.05803 5.1762 9.37171 4.5017C10.6308 3.78102 12.0888 3.48584 13.529 3.66004C14.8404 3.89534 16.0422 4.54353 16.9592 5.51004C17.9099 6.4468 18.5793 7.63111 18.8915 8.92879C19.0598 9.87902 19.0456 10.8526 18.8498 11.7975" fill="#00A148" />

                        </g>

                        <defs>

                            <clipPath id="clip0_3862_10412">

                                <rect width="25" height="25" fill="white" />

                            </clipPath>

                        </defs>

                    </svg>

                    <h2>Your details are pre-filled. Please verify your email to continue.</h2>

                </div>



                <div class="row">

                    <div class="col-lg-6 col-12 input-row">

                        <label>Full Name <span class="req">*</span></label>

                        <input id="fullName" type="text" placeholder="Enter your name.." value="{{ $profile->user_name }}" readonly>

                    </div>



                    <div class="col-lg-6 col-12 input-row">

                        <label>Company Name ( optional )</label>

                        <input id="company" type="text" placeholder="Enter your company name..">

                    </div>

                </div>



                <div class="input-row">

                    <div class="field">

                        <label>Email Address <span class="req">*</span></label>

                        <div class="contact-row">

                            <div class="input-wrap">

                                <input

                                    id="personalEmail"

                                    type="email"

                                    placeholder="sarah.johnson@example.com" value="{{ $profile->email }}"

                                    readonly>

                            </div>



                            <button

                                class="verifybtn"

                                id="sendEmailOtp"

                                type="button" @if(!empty($profile->email_verified_at))

                                style="display:none;"

                                @endif>

                                Send OTP

                            </button>



                            <button

                                class="verifybtn"

                                id="emailAlreadyVerified"

                                type="button"

                                @if(empty($profile->email_verified_at))

                                style="display:none;"

                                @endif

                                disabled

                                >

                                Verified

                            </button>

                        </div>



                        <div id="otpResendTimer"style=""></div>



                    </div>

                </div>



                <div

                    class="hiddenOTP input80"

                    id="otpEmailRow"

                    style="display:none">

                    <div class="input-row">



                        <label>

                            Enter OTP <span class="req">*</span>

                        </label>



                        <div class="contact-row">



                            <div class="input-wrap">

                                <input

                                    type="text"

                                    id="otpEmail"

                                    placeholder="Enter OTP here...."

                                    maxlength="6"

                                    inputmode="numeric">

                            </div>



                            <button

                                class="verifybtn"

                                id="verifyEmailBtn"

                                type="button"

                                disabled>

                                Verify

                            </button>



                        </div>

                    </div>

                </div>



                <div class="input-row">

                    <label>Mobile Number <span class="req">*</span></label>

                    <div class="contact-row">

                        <div class="input-wrap">

                            <span class="prefix">+91</span>

                            <input type="tel" class="input-left" id="phone" placeholder="Enter number here..." maxlength="10" autofill="off" inputmode="numeric" value="{{ $profile->phone }}">

                        </div>

                    </div>

                </div>



                <div class="bottom-footer">





                    <button class="btn-save" id="goStep2" type="button">

                        <span>Next</span>

                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="15" viewBox="0 0 14 15" fill="none">

                            <path d="M1.74967 7.5L11.958 7.5" stroke="white" stroke-linecap="round" stroke-linejoin="round" />

                            <path d="M8.16667 11.875L12.25 7.5L8.16667 3.125" stroke="white" stroke-linecap="round" stroke-linejoin="round" />

                        </svg>

                    </button>

                </div>



            </div>

        </div>



        <!-- STEP 2 -->

        <div class="step-panel" id="step2" style="display: none">

            <div class="profile-infom">

                <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa908046cb05.jpg" class="profile-top" alt="">



                <div class="pro-header">

                    <div class="pro-icon">

                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">

                            <path d="M11.0832 12.25V11.0833C11.0832 10.4645 10.8373 9.871 10.3998 9.43342C9.96217 8.99583 9.36868 8.75 8.74984 8.75H5.24984C4.631 8.75 4.03751 8.99583 3.59992 9.43342C3.16234 9.871 2.9165 10.4645 2.9165 11.0833V12.25" stroke="white" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />

                            <path d="M6.99984 6.41667C8.2885 6.41667 9.33317 5.372 9.33317 4.08333C9.33317 2.79467 8.2885 1.75 6.99984 1.75C5.71117 1.75 4.6665 2.79467 4.6665 4.08333C4.6665 5.372 5.71117 6.41667 6.99984 6.41667Z" stroke="white" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />

                        </svg>

                    </div>

                    <h2>Organization Details.</h2>

                </div>



                <div class="input-row">

                    <div class="col-12">

                        <label>Organization name 

                        <!--<span class="req">*</span>-->

                        </label>

                        <input id="orgName" type="text" placeholder="Organization Name">

                        <span class="error-msg" id="orgNameError"></span>

                    </div>

                </div>



                <div class="working-checkbox">

                    <input type="checkbox" id="isFreelancer">

                    <label for="isFreelancer">I am an independent practitioner (freelancer, architect, lawyer etc.) hiring for myself and I am NOT hiring on behalf of a company.</label>

                </div>



                <div class="input-row">

                    <div class="col-12">

                        <label>Organization website 

                        <!--<span class="req">*</span>-->

                        </label>

                        <input id="orgWebsite" type="url" placeholder="e.g. https://internshala.com">

                        <span class="error-msg" id="orgWebsiteError"></span>

                    </div>

                </div>



                <div class="working-checkbox">

                    <input type="checkbox" id="noWebsite">

                    <label for="noWebsite">Website does not exist</label>

                </div>



                <div class="input-row row">

                    <div class="field">

                        <label class="extra-space">Organization description

                        <span class="req">*</span>

                        </label>

                        <textarea class="profile-summary-input" id="orgDescription" placeholder="Describe your organization's core activities, culture, etc..."></textarea>

                        <span class="error-msg" id="orgDescriptionError"></span>

                    </div>

                </div>



                <div class="input-row row">

                    <div class="col-lg-4 col-12">

                        <label>Organization city <span class="req">*</span></label>

                        <input id="orgCity" type="text" placeholder="e.g. Mumbai">

                        <span class="error-msg" id="orgCityError"></span>

                    </div>



                    <div class="col-lg-4 col-12">

                        <label>Industry</label>

                        <select class="form-select" id="industry">

                            <option value="" selected>Select industry</option>

                            <option value="IT">IT</option>

                            <option value="Finance">Finance</option>

                            <option value="Education">Education</option>

                            <option value="Healthcare">Healthcare</option>

                            <option value="Marketing">Marketing</option>

                            <option value="Other">Other</option>

                        </select>

                        <span class="error-msg" id="industryError"></span>

                    </div>



                    <div class="col-lg-4 col-12">

                        <label class="extra-space">No. of employees </label>

                        <select class="form-select" id="employeeCount">

                            <option value="" selected>Select an option</option>

                            <option value="1-10">1-10</option>

                            <option value="11-50">11-50</option>

                            <option value="51-200">51-200</option>

                            <option value="201-500">201-500</option>

                            <option value="501-1000">501-1000</option>

                            <option value="1000+">1000+</option>

                        </select>

                        <span class="error-msg" id="employeeCountError"></span>

                    </div>

                </div>



                <div class="input-row">

                    <label>Organization logo <span>(Recommended)</span></label>

                    <div class="resume-upload" id="logoDropzone">

                        <label class="change-photo-btn upload-btn" id="logoUploadBtn" for="logoFileInput">

                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">

                                <g clip-path="url(#clip0_4151_5396)">

                                    <path d="M6 1.5V7.5M3.5 4L6 1.5L8.5 4M10.5 7.5V9.5C10.5 9.76522 10.3946 10.0196 10.2071 10.2071C10.0196 10.3946 9.76522 10.5 9.5 10.5H2.5C2.23478 10.5 1.98043 10.3946 1.79289 10.2071C1.60536 10.0196 1.5 9.76522 1.5 9.5V7.5" stroke="#00A148" stroke-width="2" stroke-linecap="round"></path>

                                </g>

                                <defs>

                                    <clipPath id="clip0_4151_5396">

                                        <rect width="12" height="12" fill="white"></rect>

                                    </clipPath>

                                </defs>

                            </svg> Upload File

                        </label>

                        <div class="hint">Max file size: 1Mb and max resolution: 500px x 500px. File type: jpeg, jpg, png</div>

                        <input type="file" id="logoFileInput" accept=".jpg,.jpeg,.png">

                        <div class="file-list" id="logoFileList"></div>

                    </div>

                </div>

            </div>



            <div class="profile-infom">

                <img src="https://idpdefault.s3.ap-south-1.amazonaws.com/6aa908046cb05.jpg" class="profile-top" alt="">



                <div class="pro-header-extra">

                    <h2>Organization verification</h2>

                    <p>Get your organization verified by submitting the below mentioned details and start posting internships/jobs.</p>

                </div>



                <label class="radio-option">

                    <input type="radio" name="documentType" value="official" checked>

                    <span>Official company documents</span>

                </label>



                <div class="company-div">

                    <p>Verify using any government-issued business registration document</p>



                    <div class="input-row">

                        <label>Upload official document <span>(Optional)</span></label>

                        <div class="resume-upload" id="dropzone">

                            <label class="change-photo-btn" class="upload-btn" id="uploadBtn">

                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">

                                    <g clip-path="url(#clip0_4151_5396)">

                                        <path d="M6 1.5V7.5M3.5 4L6 1.5L8.5 4M10.5 7.5V9.5C10.5 9.76522 10.3946 10.0196 10.2071 10.2071C10.0196 10.3946 9.76522 10.5 9.5 10.5H2.5C2.23478 10.5 1.98043 10.3946 1.79289 10.2071C1.60536 10.0196 1.5 9.76522 1.5 9.5V7.5" stroke="#00A148" stroke-width="2" stroke-linecap="round"></path>

                                    </g>

                                    <defs>

                                        <clipPath id="clip0_4151_5396">

                                            <rect width="12" height="12" fill="white"></rect>

                                        </clipPath>

                                    </defs>

                                </svg> Upload File

                            </label>

                            <input type="file" id="fileInputDoc" multiple accept=".pdf,.doc,.docx">

                            <div class="file-list" id="fileList"></div>

                        </div>

                    </div>

                </div>



                <!--<div class="working-checkbox">-->

                <!--    <input type="checkbox" id="noDocuments">-->

                <!--    <label for="noDocuments">I do not have required documents</label>-->

                <!--</div>-->

            </div>



            <div class="footer-btn">

                <button class="post-btn" id="submitForm" type="button">

                    <span>Submit</span>

                </button>

            </div>

        </div>





    </div>

</section>





<!-- KYC FORM SCRIPT (2 STEPS, NO VALIDATION) -->

<script>

    function showFieldError(input, errorElement, message) {

    

        if (input) {

            input.classList.add("error");

        }

    

        if (errorElement) {

            errorElement.textContent = message;

            errorElement.style.display = "block";

        }

    }

    

    function clearFieldError(input, errorElement) {

    

        if (input) {

            input.classList.remove("error");

        }

    

        if (errorElement) {

            errorElement.textContent = "";

            errorElement.style.display = "none";

        }

    }



    window.selectedCompanyDocuments = [];

    

    document.addEventListener("DOMContentLoaded", () => {

        const $ = id => document.getElementById(id);



        const totalSteps = 2;



        const updateProgressBar = (currentStep) => {

            for (let i = 1; i <= totalSteps; i++) {

                const stepItem = $(`pStep${i}`);

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



            for (let i = 1; i < totalSteps; i++) {

                const line = $(`line${i}`);

                if (!line) continue;

                currentStep > i ? line.classList.add("completed") : line.classList.remove("completed");

            }



            const progressText = $("progressText");

            if (progressText) progressText.textContent = `Step ${currentStep} of ${totalSteps}`;

        };



        const showStep = (step) => {

            for (let i = 1; i <= totalSteps; i++) {

                const box = $(`step${i}`);

                if (box) box.style.display = i === step ? "block" : "none";

            }

            updateProgressBar(step);

            window.scrollTo({

                top: 0,

                behavior: "smooth"

            });

        };



        // INIT STEP 1

        showStep(1);



        /* -------------------------

            STEP 1 -> STEP 2

        ------------------------- */

        const goStep2 = $("goStep2");



        goStep2?.addEventListener("click", () => {
        
            // Email verification check
            if (!emailVerified) {
                alert("Please verify your email address before continuing.");
                return;
            }
        
            // Phone validation
            const phoneInput = $("phone");
            const phone = phoneInput?.value.trim() || "";
        
            if (!phone) {
                alert("Please enter your mobile number.");
                phoneInput?.focus();
                return;
            }
        
            // Validate 10-digit Indian mobile number
            if (!/^[6-9]\d{9}$/.test(phone)) {
                alert("Please enter a valid 10-digit mobile number.");
                phoneInput?.focus();
                return;
            }
        
            // Everything valid → Step 2
            showStep(2);
        });



        /* -------------------------

        EMAIL OTP

        ------------------------- */



        const email = $("personalEmail");

        const sendEmailOtp = $("sendEmailOtp");

        const otpEmailRow = $("otpEmailRow");

        const otpEmail = $("otpEmail");

        const verifyEmailBtn = $("verifyEmailBtn");

        const emailAlreadyVerified = $("emailAlreadyVerified");



        let emailVerified = @json(!empty($profile->email_verified_at));



        const otpResendTimer = $("otpResendTimer");



        let resendTimerInterval = null;

        const RESEND_TIME = 5 * 60; // 5 minutes



        if (emailVerified) {



            if (sendEmailOtp) {

                sendEmailOtp.style.display = "none";

            }



            if (emailAlreadyVerified) {

                emailAlreadyVerified.style.display = "inline-block";

            }



            if (otpEmailRow) {

                otpEmailRow.style.display = "none";

            }



        } else {



            if (sendEmailOtp) {

                sendEmailOtp.style.display = "inline-block";

            }



            if (emailAlreadyVerified) {

                emailAlreadyVerified.style.display = "none";

            }

        }



        function startOtpResendTimer() {
            
            // Clear previous timer
            if (resendTimerInterval) {
                clearInterval(resendTimerInterval);
                resendTimerInterval = null;
            }
            


            if (!sendEmailOtp || !otpResendTimer) {

                return;

            }



            let remainingSeconds = RESEND_TIME;



            sendEmailOtp.disabled = true;

            sendEmailOtp.textContent = "Resend OTP";



            otpResendTimer.style.display = "block";



            clearInterval(resendTimerInterval);



            const updateTimer = () => {



                const minutes = Math.floor(remainingSeconds / 60);

                const seconds = remainingSeconds % 60;



                otpResendTimer.textContent =

                    `Resend OTP available in ${minutes}:${String(seconds).padStart(2, "0")}`;



                if (remainingSeconds <= 0) {



                    clearInterval(resendTimerInterval);



                    otpResendTimer.style.display = "none";



                    sendEmailOtp.disabled = false;

                    sendEmailOtp.textContent = "Resend OTP";



                    return;

                }



                remainingSeconds--;

            };



            updateTimer();



            resendTimerInterval = setInterval(updateTimer, 1000);

        }



        /* SEND EMAIL OTP */

        sendEmailOtp?.addEventListener("click", async () => {



            const emailValue = email?.value.trim() || "";



            if (!emailValue) {

                alert("Email address is required.");

                return;

            }



            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailValue)) {

                alert("Please enter a valid email address.");

                return;

            }



            sendEmailOtp.disabled = true;

            sendEmailOtp.textContent = "Sending...";



            try {



                const csrfToken =

                    document.querySelector('input[name="_token"]')?.value ||

                    "";



                const response = await fetch(

                    "{{ route('employer.verifyEmailSendOtp') }}", {

                        method: "POST",



                        headers: {

                            "X-Requested-With": "XMLHttpRequest",

                            "Accept": "application/json",

                            "Content-Type": "application/json",

                            "X-CSRF-TOKEN": csrfToken

                        },



                        body: JSON.stringify({

                            email: emailValue

                        })

                    }

                );



                const data = await response.json();



                if (response.ok && data.status === true) {



                    alert(

                        data.message ||

                        "OTP sent successfully to your email."

                    );



                    if (otpEmailRow) {

                        otpEmailRow.style.display = "block";

                    }



                    if (otpEmail) {

                        otpEmail.value = "";

                        otpEmail.focus();

                    }



                    if (verifyEmailBtn) {

                        verifyEmailBtn.disabled = true;

                    }



                    sendEmailOtp.textContent = "Resend OTP";



                    // Start 5 minute resend timer

                    startOtpResendTimer();



                    return;

                }



                alert(

                    data.message ||

                    "Unable to send OTP."

                );



                sendEmailOtp.disabled = false;

                sendEmailOtp.textContent = "Send OTP";



            } catch (error) {



                console.error("Send Email OTP Error:", error);



                alert(

                    "Something went wrong while sending OTP."

                );



                sendEmailOtp.disabled = false;

                sendEmailOtp.textContent = "Send OTP";

            }

        });





        /* OTP INPUT */

        otpEmail?.addEventListener("input", () => {



            otpEmail.value = otpEmail.value

                .replace(/\D/g, "")

                .slice(0, 6);



            if (verifyEmailBtn) {

                verifyEmailBtn.disabled =

                    otpEmail.value.length !== 6;

            }

        });





        /* VERIFY EMAIL OTP */

        verifyEmailBtn?.addEventListener("click", async () => {



            const emailValue = email?.value.trim() || "";

            const otpValue = otpEmail?.value.trim() || "";



            if (!otpValue || otpValue.length !== 6) {

                alert("Please enter the 6-digit OTP.");

                return;

            }



            verifyEmailBtn.disabled = true;

            verifyEmailBtn.textContent = "Verifying...";



            try {



                const csrfToken =

                    document.querySelector('input[name="_token"]')?.value ||

                    "";



                const response = await fetch(

                    "{{ route('employer.verifyEmailVerifyOtp') }}", {

                        method: "POST",



                        headers: {

                            "X-Requested-With": "XMLHttpRequest",

                            "Accept": "application/json",

                            "Content-Type": "application/json",

                            "X-CSRF-TOKEN": csrfToken

                        },



                        body: JSON.stringify({

                            email: emailValue,

                            otp: otpValue

                        })

                    }

                );



                const data = await response.json();



                if (response.ok && data.status === true) {



                    emailVerified = true;
                    
                    // STOP RESEND TIMER
                    if (resendTimerInterval) {
                        clearInterval(resendTimerInterval);
                        resendTimerInterval = null;
                    }
                
                    // HIDE RESEND TIMER TEXT
                    if (otpResendTimer) {
                        otpResendTimer.style.display = "none";
                        otpResendTimer.textContent = "";
                    }
                    


                    alert(

                        data.message ||

                        "Email verified successfully."

                    );



                    if (verifyEmailBtn) {

                        verifyEmailBtn.textContent = "Verified";

                        verifyEmailBtn.disabled = true;

                    }



                    if (otpEmail) {

                        otpEmail.disabled = true;

                    }



                    if (otpEmailRow) {

                        otpEmailRow.style.display = "none";

                    }



                    if (sendEmailOtp) {

                        sendEmailOtp.style.display = "none";

                    }



                    if (emailAlreadyVerified) {

                        emailAlreadyVerified.style.display = "inline-block";

                    }



                    return;

                }



                alert(

                    data.message ||

                    "Invalid OTP. Please try again."

                );



                verifyEmailBtn.disabled = false;

                verifyEmailBtn.textContent = "Verify";



            } catch (error) {



                console.error("Verify Email OTP Error:", error);



                alert(

                    "Something went wrong while verifying OTP."

                );



                verifyEmailBtn.disabled = false;

                verifyEmailBtn.textContent = "Verify";

            }

        });



        /* -------------------------

            STEP 2 SUBMIT

        ------------------------- */

        

        const submitForm = $("submitForm");

        

        submitForm?.addEventListener("click", async () => {

            

            // ==========================================

            // ERROR ELEMENTS

            // ==========================================

            const orgNameError = $("orgNameError");

            const orgWebsiteError = $("orgWebsiteError");

            const orgDescriptionError = $("orgDescriptionError");

            const orgCityError = $("orgCityError");

            const industryError = $("industryError");

            const employeeCountError = $("employeeCountError");

        

            // ==========================================

            // CLEAR PREVIOUS ERRORS

            // ==========================================

            clearFieldError($("orgName"), orgNameError);

            clearFieldError($("orgWebsite"), orgWebsiteError);

            clearFieldError($("orgDescription"), orgDescriptionError);

            clearFieldError($("orgCity"), orgCityError);

            clearFieldError($("industry"), industryError);

            clearFieldError($("employeeCount"), employeeCountError);

        

            /*

            |--------------------------------------------------------------------------

            | STEP 1 DATA

            |--------------------------------------------------------------------------

            */

        

            const companyName = $("company")?.value.trim() || "";

            const fullName = $("fullName")?.value.trim() || "";

            const emailValue = $("personalEmail")?.value.trim() || "";

            const phoneValue = $("phone")?.value.trim() || "";

        

            /*

            |--------------------------------------------------------------------------

            | STEP 2 DATA

            |--------------------------------------------------------------------------

            */

        

            const organizationName = $("orgName")?.value.trim() || "";

            const isFreelancer = $("isFreelancer")?.checked || false;

        

            const organizationWebsite =

                $("orgWebsite")?.value.trim() || "";

        

            const organizationDescription =

                $("orgDescription")?.value.trim() || "";

        

            const organizationCity =

                $("orgCity")?.value.trim() || "";

        

            const industry =

                $("industry")?.value || "";

        

            const employeeCount =

                $("employeeCount")?.value || "";

        

            const noWebsite =

                $("noWebsite")?.checked || false;


            /*

            |--------------------------------------------------------------------------

            | STEP 1 VALIDATION

            |--------------------------------------------------------------------------

            */

        

            if (!fullName) {

                alert("Full name is required.");

                showStep(1);

                return;

            }

        

            if (!emailValue) {

                alert("Email address is required.");

                showStep(1);

                return;

            }

        

            if (!emailVerified) {

                alert("Please verify your email address before submitting.");

                showStep(1);

                return;

            }

        

            /*

            |--------------------------------------------------------------------------

            | STEP 2 VALIDATION

            |--------------------------------------------------------------------------

            */

        

            if (!isFreelancer && !organizationName) {

                showFieldError(

                    $("orgName"),

                    orgNameError,

                    "Organization name is required."

                );

                

                $("orgName")?.focus();

                return;

            }

        

            if (!noWebsite && !organizationWebsite) {

                showFieldError(

                    $("orgWebsite"),

                    orgWebsiteError,

                    "Organization website is required."

                );

                $("orgWebsite")?.focus();

                return;

            }

            

            if (!orgDescription.value.trim()) {

                showFieldError(

                    orgDescription,

                    orgDescriptionError,

                    "Organization description is required."

                );

            

                orgDescription.focus();

                return;

            }

        

            if (!organizationCity) {

                showFieldError(

                    $("orgCity"),

                    orgCityError,

                    "Please Enter City"

                );

                $("orgCity")?.focus();

                return;

            }

            

            if (!industry) {

                showFieldError(

                    $("industry"),

                    industryError,

                    "Please select an industry"

                );

                $("industry")?.focus();

                return;

            }

            

            if (!employeeCount) {

                showFieldError(

                    $("employeeCount"),

                    employeeCountError,

                    "Please select number of employees"

                );

                $("employeeCount")?.focus();

                return;

            }

        

            /*

            |--------------------------------------------------------------------------

            | FORM DATA

            |--------------------------------------------------------------------------

            */

        

            const formData = new FormData();

        

            /*

            |--------------------------------------------------------------------------

            | STEP 1

            |--------------------------------------------------------------------------

            */

        

            formData.append("full_name", fullName);

            formData.append("company_name", companyName);

            formData.append("email", emailValue);

            formData.append("phone", phoneValue);

            formData.append("email_verified", emailVerified ? "1" : "0");

        

            /*

            |--------------------------------------------------------------------------

            | STEP 2

            |--------------------------------------------------------------------------

            */

        

            formData.append("organization_name", organizationName);

            formData.append("is_freelancer", isFreelancer ? "1" : "0");

            formData.append("organization_website", organizationWebsite);

            formData.append("organization_description", organizationDescription);

            formData.append("organization_city", organizationCity);

            formData.append("industry", industry);

            formData.append("employee_count", employeeCount);

            formData.append("no_website", noWebsite ? "1" : "0");


        

            /*

            |--------------------------------------------------------------------------

            | LOGO

            |--------------------------------------------------------------------------

            */

        

            const logoFileInput = $("logoFileInput");

        

            if (

                logoFileInput &&

                logoFileInput.files &&

                logoFileInput.files.length > 0

            ) {

                formData.append(

                    "organization_logo",

                    logoFileInput.files[0]

                );

            }

        

            /*

            |--------------------------------------------------------------------------

            | DOCUMENTS

            |--------------------------------------------------------------------------

            */

        

            const documentFiles = window.selectedCompanyDocuments || [];

            // Documents are optional
            if (documentFiles.length > 0) {
                documentFiles.forEach(file => {
                    formData.append("documents[]", file);
                });
            }

            /*

            |--------------------------------------------------------------------------

            | SUBMIT BUTTON

            |--------------------------------------------------------------------------

            */

        

            submitForm.disabled = true;

        

            const originalButtonHtml = submitForm.innerHTML;

        

            submitForm.innerHTML = `

                <span>Submitting...</span>

            `;

        

            try {

        

                const csrfToken =

                    document.querySelector('input[name="_token"]')?.value || "";

        

                const response = await fetch(

                    "{{ route('employer.getStarted.save') }}",

                    {

                        method: "POST",

        

                        headers: {

                            "X-Requested-With": "XMLHttpRequest",

                            "Accept": "application/json",

                            "X-CSRF-TOKEN": csrfToken

                        },

        

                        body: formData

                    }

                );

        

                const data = await response.json();

        

                if (response.ok && data.status === true) {

        

                    alert(

                        data.message ||

                        "Your details have been saved successfully."

                    );

        

                    if (data.redirect) {

                        window.location.href = data.redirect;

                    }

        

                    return;

                }

        

                /*

                |--------------------------------------------------------------------------

                | Validation / Server Error

                |--------------------------------------------------------------------------

                */

        

            if (data.errors) {

            

                if (data.errors.organization_name) {

                    showFieldError(

                        $("orgName"),

                        $("orgNameError"),

                        data.errors.organization_name[0]

                    );

                }

            

                if (data.errors.organization_website) {

                    showFieldError(

                        $("orgWebsite"),

                        $("orgWebsiteError"),

                        data.errors.organization_website[0]

                    );

                }

            

                if (data.errors.organization_city) {

                    showFieldError(

                        $("orgCity"),

                        $("orgCityError"),

                        data.errors.organization_city[0]

                    );

                }

            

                if (data.errors.industry) {

                    showFieldError(

                        $("industry"),

                        $("industryError"),

                        data.errors.industry[0]

                    );

                }

            

                if (data.errors.employee_count) {

                    showFieldError(

                        $("employeeCount"),

                        $("employeeCountError"),

                        data.errors.employee_count[0]

                    );

                }

            

                return;

            } else {

        

                    alert(

                        data.message ||

                        "Unable to save your details."

                    );

                }

        

            } catch (error) {

        

                console.error(

                    "Employer Get Started Submit Error:",

                    error

                );

        

                alert(

                    "Something went wrong while submitting your details."

                );

        

            } finally {

        

                submitForm.disabled = false;

                submitForm.innerHTML = originalButtonHtml;

            }

        });



        const noWebsite = $("noWebsite");

        const orgWebsite = $("orgWebsite");

        noWebsite?.addEventListener("change", () => {

        

            if (!orgWebsite) {

                return;

            }

        

            orgWebsite.disabled = noWebsite.checked;

        

            if (noWebsite.checked) {

                orgWebsite.value = "";

            }

        });
    });

</script>



<!-- ====== Company Documents Upload JS ====== -->

<script>

    const dropzone = document.getElementById('dropzone');

    const fileInputDoc = document.getElementById('fileInputDoc');

    const uploadBtn = document.getElementById('uploadBtn');

    const fileList = document.getElementById('fileList');



    // click button or dropzone opens file picker

    uploadBtn.addEventListener('click', (e) => {

        e.stopPropagation();

        fileInputDoc.click();

    });

    dropzone.addEventListener('click', () => fileInputDoc.click());



    // drag events

    ['dragenter', 'dragover'].forEach(evt => {

        dropzone.addEventListener(evt, (e) => {

            e.preventDefault();

            e.stopPropagation();

            dropzone.classList.add('dragover');

        });

    });



    ['dragleave', 'drop'].forEach(evt => {

        dropzone.addEventListener(evt, (e) => {

            e.preventDefault();

            e.stopPropagation();

            dropzone.classList.remove('dragover');

        });

    });



    dropzone.addEventListener('drop', (e) => {

        const files = e.dataTransfer.files;

        handleFiles(files);

    });



    fileInputDoc.addEventListener('change', (e) => {

        handleFiles(e.target.files);

        fileInputDoc.value = ''; // allow re-selecting same file

    });



    function formatSize(bytes) {

        if (bytes < 1024) return bytes + ' B';

        if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB';

        return (bytes / (1024 * 1024)).toFixed(1) + ' MB';

    }



    function fileIconSVG(name) {

        const ext = name.split('.').pop().toLowerCase();

        if (ext === 'pdf') {

            return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2h9l5 5v15H6z"/><path d="M15 2v5h5"/></svg>';

        }

        return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>';

    }



    function handleFiles(files) {

    

        [...files].forEach(file => {

    

            // Prevent duplicate files

            const alreadyExists =

                window.selectedCompanyDocuments.some(

                    existingFile =>

                        existingFile.name === file.name &&

                        existingFile.size === file.size

                );

    

            if (alreadyExists) {

                return;

            }

    

            window.selectedCompanyDocuments.push(file);

    

            createFileItem(file);

        });

    }



    function createFileItem(file) {

        const item = document.createElement('div');

        item.className = 'file-item';

        item.innerHTML = `

      <div class="file-top">

        <div class="file-icon">${fileIconSVG(file.name)}</div>

        <div class="file-info">

          <div class="file-name">${file.name}</div>

          <div class="file-size">${formatSize(file.size)}</div>

        </div>

        <button class="file-remove" title="Remove">

          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>

        </button>

      </div>

      <div class="progress-track">

        <div class="progress-fill"></div>

      </div>

      <div class="progress-bottom">

        <span class="progress-status">Uploading...</span>

        <span class="progress-percent">0%</span>

      </div>

    `;



        fileList.prepend(item);



        const fill = item.querySelector('.progress-fill');

        const percentLabel = item.querySelector('.progress-percent');

        const statusLabel = item.querySelector('.progress-status');

        const removeBtn = item.querySelector('.file-remove');



        removeBtn.addEventListener('click', () => {

        

            const index =

                window.selectedCompanyDocuments.findIndex(

                    selectedFile =>

                        selectedFile.name === file.name &&

                        selectedFile.size === file.size

                );

        

            if (index !== -1) {

                window.selectedCompanyDocuments.splice(index, 1);

            }

        

            item.remove();

        });



        // simulate upload progress

        let progress = 0;

        const interval = setInterval(() => {

            progress += Math.random() * 18 + 6;

            if (progress >= 100) {

                progress = 100;

                clearInterval(interval);

                statusLabel.innerHTML = `

          <span class="status-done">

            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>

            Uploaded

          </span>`;

            }

            fill.style.width = progress + '%';

            percentLabel.textContent = Math.floor(progress) + '%';

        }, 250);

    }

</script>

<script>
    // document.addEventListener("DOMContentLoaded", function () {
    
    //     const logoInput = document.getElementById("logoFileInput");
    //     const logoList = document.getElementById("logoFileList");
    
    //     console.log("Logo input:", logoInput);
    //     console.log("Logo list:", logoList);
    
    //     if (!logoInput) {
    //         console.error("logoFileInput not found");
    //         return;
    //     }
    
    //     if (!logoList) {
    //         console.error("logoFileList not found");
    //         return;
    //     }
    
    //     logoInput.addEventListener("change", function (event) {
    
    //         console.log("Logo change event fired");
    
    //         logoList.innerHTML = "";
    
    //         const file = event.target.files[0];
    
    //         console.log("Selected logo:", file);
    
    //         if (!file) {
    //             return;
    //         }
    
    //         // File type validation
    //         const allowedTypes = [
    //             "image/jpeg",
    //             "image/png"
    //         ];
    
    //         if (!allowedTypes.includes(file.type)) {
    //             alert("Please select a JPG, JPEG or PNG image.");
    //             logoInput.value = "";
    //             return;
    //         }
    
    //         // 1 MB validation
    //         if (file.size > 1024 * 1024) {
    //             alert("Logo size must not exceed 1 MB.");
    //             logoInput.value = "";
    //             return;
    //         }
    
    //         const reader = new FileReader();
    
    //         reader.onload = function (e) {
    
    //             logoList.innerHTML = `
    //                 <div class="logo-preview-item">
    
    //                     <div class="logo-preview">
    //                         <img
    //                             src="${e.target.result}"
    //                             alt="Organization Logo"
    //                         >
    //                     </div>
    
    //                     <div class="logo-file-info">
    
    //                         <div class="logo-file-name">
    //                             ${file.name}
    //                         </div>
    
    //                         <button
    //                             type="button"
    //                             class="remove-logo"
    //                             id="removeLogo"
    //                         >
    //                             Remove
    //                         </button>
    
    //                     </div>
    
    //                 </div>
    //             `;
    
    //             const removeButton =
    //                 document.getElementById("removeLogo");
    
    //             removeButton?.addEventListener("click", function () {
    
    //                 logoInput.value = "";
    //                 logoList.innerHTML = "";
    
    //             });
    
    //         };
    
    //         reader.onerror = function () {
    //             console.error("Unable to read logo file.");
    //             alert("Unable to preview this image.");
    //         };
    
    //         reader.readAsDataURL(file);
    
    //     });
    
    // });
</script>

@endsection