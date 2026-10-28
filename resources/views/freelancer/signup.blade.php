@extends('layouts.main')

@section('main-section')

<link rel="stylesheet" href="{{ asset('frontend/css/auth.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/authresponsive.css') }}" media="(max-width: 990px)">

<section class="employeer-signup">
    <div class="container">
        <div class="signup-page">

            <div class="smart-hiring">
                <h2>Find work you<br> <span> love.</span></h2>
                <p>Create your freelancer account and connect with clients from around the world. Turn your skills into income and grow your career on your own terms.</p>

                <div class="features-wrapper">
                    {{-- ...aapke 3 feature-item blocks bilkul waise hi... --}}
                </div>
            </div>

            <div class="form-card">
                <h1 class="title">Sign up to find work you love</h1>
                <p class="login-line">Already have an account ? <a href="{{ route('jobseekers.login') }}">Log in</a></p>

                <div class="icon-wrap">
                    <img src="{{ asset('frontend/images/hire-talent1.png') }}" alt="">
                </div>

                <form action="{{ route('jobseekers.signup.store') }}" method="POST" id="signupForm" novalidate>
                    @csrf
                    <input type="hidden" name="role" value="freelancer">

                    {{-- Full Name --}}
                    <div class="field" id="nameField">
                        <label for="officialName">Full Name</label>
                        <div class="input-wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M4 18C4 16.9391 4.42143 15.9217 5.17157 15.1716C5.92172 14.4214 6.93913 14 8 14H16C17.0609 14 18.0783 14.4214 18.8284 15.1716C19.5786 15.9217 20 16.9391 20 18C20 18.5304 19.7893 19.0391 19.4142 19.4142C19.0391 19.7893 18.5304 20 18 20H6C5.46957 20 4.96086 19.7893 4.58579 19.4142C4.21071 19.0391 4 18.5304 4 18Z" stroke="#BEBEBE" stroke-width="2" stroke-linejoin="round" />
                                <path d="M12 10C13.6569 10 15 8.65685 15 7C15 5.34315 13.6569 4 12 4C10.3431 4 9 5.34315 9 7C9 8.65685 10.3431 10 12 10Z" stroke="#BEBEBE" stroke-width="2" />
                            </svg>
                            <input type="text" name="name" id="officialName" value="{{ old('name') }}" placeholder="Enter your Name here..." autocomplete="name">
                        </div>
                        <div class="error-msg" id="nameError"></div>
                    </div>

                    {{-- Email --}}
                    <div class="field" id="emailField">
                        <label for="email">Email Address</label>
                        <div class="input-wrap">
                            <svg class="leading" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="5" width="18" height="14" rx="2" />
                                <path d="M3 7l9 6 9-6" />
                            </svg>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Enter your Email here..." autocomplete="email">
                        </div>
                        <div class="error-msg" id="emailError"></div>
                    </div>

                    {{-- Password --}}
                    <div class="field" id="passwordField">
                        <label for="password">Password</label>
                        <div class="input-wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M12 17C11.4696 17 10.9609 16.7893 10.5858 16.4142C10.2107 16.0391 10 15.5304 10 15C10 13.89 10.89 13 12 13C12.5304 13 13.0391 13.2107 13.4142 13.5858C13.7893 13.9609 14 14.4696 14 15C14 15.5304 13.7893 16.0391 13.4142 16.4142C13.0391 16.7893 12.5304 17 12 17ZM18 20V10H6V20H18ZM18 8C18.5304 8 19.0391 8.21071 19.4142 8.58579C19.7893 8.96086 20 9.46957 20 10V20C20 20.5304 19.7893 21.0391 19.4142 21.4142C19.0391 21.7893 18.5304 22 18 22H6C5.46957 22 4.96086 21.7893 4.58579 21.4142C4.21071 21.0391 4 20.5304 4 20V10C4 8.89 4.89 8 6 8H7V6C7 4.67392 7.52678 3.40215 8.46447 2.46447C9.40215 1.52678 10.6739 1 12 1C12.6566 1 13.3068 1.12933 13.9134 1.3806C14.52 1.63188 15.0712 2.00017 15.5355 2.46447C15.9998 2.92876 16.3681 3.47995 16.6194 4.08658C16.8707 4.69321 17 5.34339 17 6V8H18ZM12 3C11.2044 3 10.4413 3.31607 9.87868 3.87868C9.31607 4.44129 9 5.20435 9 6V8H15V6C15 5.20435 14.6839 4.44129 14.1213 3.87868C13.5587 3.31607 12.7956 3 12 3Z" fill="#BEBEBE" />
                            </svg>
                            <input type="password" name="password" id="password" placeholder="Enter Password here..." autocomplete="new-password">
                            <button type="button" class="toggle-pass" id="togglePass" aria-label="Toggle password visibility">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" id="eyeOpen" style="display:none;">
                                    <path d="M14.1213 14.1213C14.6839 13.5587 15 12.7956 15 12C15 11.2044 14.6839 10.4413 14.1213 9.87868C13.5587 9.31607 12.7956 9 12 9C11.2044 9 10.4413 9.31607 9.87868 9.87868C9.31607 10.4413 9 11.2044 9 12C9 12.7956 9.31607 13.5587 9.87868 14.1213C10.4413 14.6839 11.2044 15 12 15C12.7956 15 13.5587 14.6839 14.1213 14.1213Z" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M2 12C3.6 7.903 7.336 5 12 5C16.664 5 20.4 7.903 22 12C20.4 16.097 16.664 19 12 19C7.336 19 3.6 16.097 2 12Z" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" id="eyeClosed" >
                                    <path d="M9.88 9.88C9.34 10.42 9 11.17 9 12C9 13.66 10.34 15 12 15C12.83 15 13.58 14.66 14.12 14.12" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6.61 6.61C4.5 8.02 2.93 10 2 12C3.6 16.097 7.336 19 12 19C13.68 19 15.26 18.61 16.66 17.92" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M14.51 5.36C13.71 5.13 12.87 5 12 5C16.664 5 20.4 7.903 22 12C21.53 13.2 20.86 14.3 20.03 15.24" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M1 1L23 23" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                        <div class="error-msg" id="passwordError"></div>
                    </div>

                    <div class="input-singup">
                        {{-- Country --}}
                        <div class="field" id="countryField">
                            <label for="country">Country</label>
                            <div class="input-wrap">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="9" />
                                    <path d="M3 12h18M12 3a15 15 0 0 1 0 18M12 3a15 15 0 0 0 0 18" />
                                </svg>
                                <select name="country_id" id="country">
                                    <option value="">Select Country</option>
                                    @foreach($countries as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="error-msg" id="countryError"></div>
                        </div>

                        {{-- State --}}
                        <div class="field" id="stateField">
                            <label for="state">State</label>
                            <div class="input-wrap">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="9" />
                                    <path d="M3 12h18M12 3a15 15 0 0 1 0 18M12 3a15 15 0 0 0 0 18" />
                                </svg>
                                <select name="state_id" id="state">
                                    <option value="">Select Country first</option>
                                </select>
                            </div>
                            <div class="error-msg" id="stateError"></div>
                        </div>
                    </div>

                    {{-- Terms --}}
                    <div class="terms-row" id="agreeField">
                        <input type="checkbox" id="agree" name="agree" value="1">
                        <label for="agree">Yes, I understand and agree to the <a href="#">Terms of Service</a>, Including the <a href="#">User Agreement</a> and <a href="#">Privacy Policy</a>.</label>
                    </div>
                    <div class="error-msg" id="agreeError"></div>

                    <button type="submit" class="submit-btn" id="submitBtn" disabled>Create my account</button>
                </form>
            </div>

        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const $ = id => document.getElementById(id);

        const form = $('signupForm');
        if (!form) return;

        const fullName = $('officialName');
        const email = $('email');
        const password = $('password');
        const countrySel = $('country');
        const stateSel = $('state');
        const agree = $('agree');
        const submitBtn = $('submitBtn');
        const togglePass = $('togglePass');
        const eyeOpen = $('eyeOpen');
        const eyeClosed = $('eyeClosed');

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const nameRegex = /^[a-zA-Z\s.'-]+$/;

        const STATES_URL = "{{ route('jobseekers.get.states', ['country_id' => 999999]) }}";

        const escapeHtml = str => String(str).replace(/[&<>"']/g, m => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;'
        } [m]));

        /* ---------- Error helper ---------- */
        function setError(fieldId, errorId, message) {
            const field = $(fieldId);
            const box = $(errorId);
            if (box) box.textContent = message || '';
            if (field) field.classList.toggle('error', !!message);
            return !message;
        }

        /* ---------- Rules ---------- */
        const rules = {
            name() {
                const v = fullName.value.trim();
                if (v === '') return 'Name is required';
                if (v.length < 3) return 'Name must be at least 3 characters';
                if (v.length > 255) return 'Name is too long';
                if (!nameRegex.test(v)) return 'Name can only contain letters';
                return '';
            },
            email() {
                const v = email.value.trim();
                if (v === '') return 'Email is required';
                if (!emailRegex.test(v)) return 'please add valid credential';
                return '';
            },
            password() {
                const v = password.value;
                if (v === '') return 'Password is required';
                if (v.length < 6) return 'Password must be at least 6 characters';
                return '';
            },
            country() {
                return countrySel.value === '' ? 'Please select a country' : '';
            },
            state() {
                return stateSel.value === '' ? 'Please select a state' : '';
            },
            agree() {
                return agree.checked ? '' : 'You must accept the terms to continue';
            }
        };

        /* ---------- Field map ---------- */
        const fieldMap = {
            name: ['nameField', 'nameError'],
            email: ['emailField', 'emailError'],
            password: ['passwordField', 'passwordError'],
            country: ['countryField', 'countryError'],
            state: ['stateField', 'stateError'],
            agree: ['agreeField', 'agreeError'],
        };

        const touched = {};

        const serverErrors = {
            name: @json($errors->first('name')),
            email: @json($errors->first('email')),
            password: @json($errors->first('password')),
            country: @json($errors->first('country_id')),
            state: @json($errors->first('state_id')),
            agree: @json($errors->first('agree')),
        };

        function validate(key, force) {
            const [fieldId, errorId] = fieldMap[key];
            const msg = rules[key]();

            if (!touched[key] && serverErrors[key]) {
                setError(fieldId, errorId, serverErrors[key]);
                return false;
            }
            if (!touched[key] && !force) {
                setError(fieldId, errorId, '');
                return msg === '';
            }
            setError(fieldId, errorId, msg);
            return msg === '';
        }

        function validateAll(force) {
            const ok = Object.keys(rules).map(k => validate(k, force)).every(Boolean);
            submitBtn.disabled = !ok;
            submitBtn.classList.toggle('enabled', ok);
            return ok;
        }

        /* ---------- Listeners ---------- */
        const bind = (el, key, evt = 'input') => {
            el.addEventListener(evt, () => {
                touched[key] = true;
                serverErrors[key] = '';
                validateAll();
            });
        };

        bind(fullName, 'name');
        bind(email, 'email');
        bind(password, 'password');
        bind(countrySel, 'country', 'change');
        bind(stateSel, 'state', 'change');
        bind(agree, 'agree', 'change');

        [
            ['name', fullName],
            ['email', email],
            ['password', password]
        ]
        .forEach(([key, el]) => el.addEventListener('blur', () => {
            touched[key] = true;
            validateAll();
        }));

        /* ---------- Country → State ---------- */
        countrySel.addEventListener('change', async function() {
            const countryId = this.value;

            stateSel.innerHTML = '<option value="">Loading...</option>';
            stateSel.disabled = true;
            validateAll();

            if (!countryId) {
                stateSel.innerHTML = '<option value="">Select Country first</option>';
                stateSel.disabled = false;
                return;
            }

            try {
                const res = await fetch(STATES_URL.replace('999999', countryId), {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) throw new Error('HTTP ' + res.status);

                const states = await res.json();

                if (!states.length) {
                    stateSel.innerHTML = '<option value="">No states available</option>';
                    return;
                }

                stateSel.innerHTML = '<option value="">Select State</option>' +
                    states.map(s => `<option value="${s.id}">${escapeHtml(s.name)}</option>`).join('');

            } catch (err) {
                console.error('States fetch failed:', err);
                stateSel.innerHTML = '<option value="">Failed to load states</option>';
            } finally {
                stateSel.disabled = false;
                validateAll();
            }
        });

        /* ---------- Password toggle ---------- */
        togglePass.addEventListener('click', () => {
            const hidden = password.type === 'password';
            password.type = hidden ? 'text' : 'password';
            eyeOpen.style.display = hidden ? 'none' : 'block';
            eyeClosed.style.display = hidden ? 'block' : 'none';
        });

        /* ---------- Submit ---------- */
        form.addEventListener('submit', (e) => {
            Object.keys(rules).forEach(k => touched[k] = true);

            if (!validateAll(true)) {
                e.preventDefault();
                document.querySelector('.field.error, .terms-row.error')
                    ?.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                return;
            }
            submitBtn.disabled = true;
            submitBtn.textContent = 'Creating…';
        });

        validateAll();
    });
</script>

@endsection