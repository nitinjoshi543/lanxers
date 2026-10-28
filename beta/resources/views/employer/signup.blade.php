@extends('employer.layouts.main')

@section('main-section')
<link rel="stylesheet" href="{{ asset('frontend/css/singup-login.css') }}?v={{ filemtime(public_path('frontend/css/singup-login.css')) }}" />

<section class="employeer-signup">
    <div class="signup-page">
        <div class="form-card">
            <h1 class="title">Welcome Back!</h1>
            <div class="linebar"></div>
            <p>Log in to your account and continue your journey with Lanxers.</p>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('employer.signup.store') }}" method="POST" id="signupForm" novalidate>
                @csrf

                <div class="field">
                    <label>Representative Name</label>
                    <div class="input-wrap">
                        <svg class="leading" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M8.00039 1.60156C7.1517 1.60156 6.33777 1.9387 5.73765 2.53882C5.13753 3.13894 4.80039 3.95287 4.80039 4.80156C4.80039 5.65026 5.13753 6.46419 5.73765 7.0643C6.33777 7.66442 7.1517 8.00156 8.00039 8.00156C8.84908 8.00156 9.66302 7.66442 10.2631 7.0643C10.8632 6.46419 11.2004 5.65026 11.2004 4.80156C11.2004 3.95287 10.8632 3.13894 10.2631 2.53882C9.66302 1.9387 8.84908 1.60156 8.00039 1.60156ZM5.60039 4.80156C5.60039 4.16504 5.85325 3.55459 6.30333 3.10451C6.75342 2.65442 7.36387 2.40156 8.00039 2.40156C8.63691 2.40156 9.24736 2.65442 9.69745 3.10451C10.1475 3.55459 10.4004 4.16504 10.4004 4.80156C10.4004 5.43808 10.1475 6.04853 9.69745 6.49862C9.24736 6.94871 8.63691 7.20156 8.00039 7.20156C7.36387 7.20156 6.75342 6.94871 6.30333 6.49862C5.85325 6.04853 5.60039 5.43808 5.60039 4.80156ZM4.00759 8.80156C3.79687 8.80061 3.58804 8.8413 3.39309 8.92128C3.19813 9.00127 3.0209 9.11897 2.87156 9.26764C2.72223 9.41631 2.60373 9.59301 2.52287 9.7876C2.44201 9.98219 2.40039 10.1908 2.40039 10.4016C2.40039 11.7544 3.06679 12.7744 4.10839 13.4392C5.13399 14.0928 6.51639 14.4016 8.00039 14.4016C9.48439 14.4016 10.8668 14.0928 11.8924 13.4392C12.934 12.7752 13.6004 11.7536 13.6004 10.4016C13.6004 9.97722 13.4318 9.57025 13.1318 9.27019C12.8317 8.97013 12.4247 8.80156 12.0004 8.80156H4.00759ZM3.20039 10.4016C3.20039 9.95916 3.55879 9.60156 4.00759 9.60156H12.0004C12.2126 9.60156 12.416 9.68585 12.5661 9.83588C12.7161 9.98591 12.8004 10.1894 12.8004 10.4016C12.8004 11.4488 12.3028 12.2288 11.462 12.764C10.606 13.3104 9.38839 13.6016 8.00039 13.6016C6.61239 13.6016 5.39479 13.3104 4.53879 12.764C3.69879 12.228 3.20039 11.4496 3.20039 10.4016Z" fill="#D6D3D1"/>
                        </svg>
                        <input type="text" id="repName" name="name" value="{{ old('name') }}" placeholder="Enter your Name here...">
                        <div class="error-msg" id="nameError"></div>
                    </div>
                </div>

                <div class="field">
                    <label>Email Address</label>
                    <div class="input-wrap">
                        <svg class="leading" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
                            <path d="M12.1875 2.5H2.8125C1.94956 2.5 1.25 3.19956 1.25 4.0625V10.9375C1.25 11.8004 1.94956 12.5 2.8125 12.5H12.1875C13.0504 12.5 13.75 11.8004 13.75 10.9375V4.0625C13.75 3.19956 13.0504 2.5 12.1875 2.5Z" stroke="#D6D3D1" stroke-width="1.1875" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M1.25 4.6875L7.5 8.75L13.75 4.6875" stroke="#D6D3D1" stroke-width="1.1875" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <input type="text" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your Email here...">
                        <div class="error-msg" id="emailError"></div>
                    </div>
                </div>

                <div class="field">
                    <label>Password</label>
                    <div class="input-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M10.7917 6.41406H3.20833C2.40292 6.41406 1.75 7.06698 1.75 7.8724V11.3724C1.75 12.1778 2.40292 12.8307 3.20833 12.8307H10.7917C11.5971 12.8307 12.25 12.1778 12.25 11.3724V7.8724C12.25 7.06698 11.5971 6.41406 10.7917 6.41406Z" stroke="#D6D3D1" stroke-width="1.10833" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4.0835 6.41406V4.08073C4.0835 3.30718 4.39079 2.56532 4.93777 2.01833C5.48475 1.47135 6.22661 1.16406 7.00016 1.16406C7.77371 1.16406 8.51558 1.47135 9.06256 2.01833C9.60954 2.56532 9.91683 3.30718 9.91683 4.08073V6.41406" stroke="#D6D3D1" stroke-width="1.10833" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <input type="password" id="password" name="password" placeholder="Enter Password here...">
                        <button type="button" class="toggle-pass" id="togglePass">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" id="eyeOpen" style="display:none;">
                                <path d="M14.1213 14.1213C14.6839 13.5587 15 12.7956 15 12C15 11.2044 14.6839 10.4413 14.1213 9.87868C13.5587 9.31607 12.7956 9 12 9C11.2044 9 10.4413 9.31607 9.87868 9.87868C9.31607 10.4413 9 11.2044 9 12C9 12.7956 9.31607 13.5587 9.87868 14.1213C10.4413 14.6839 11.2044 15 12 15C12.7956 15 13.5587 14.6839 14.1213 14.1213Z" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2 12C3.6 7.903 7.336 5 12 5C16.664 5 20.4 7.903 22 12C20.4 16.097 16.664 19 12 19C7.336 19 3.6 16.097 2 12Z" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" id="eyeClosed" >
                                <path d="M9.88 9.88C9.34 10.42 9 11.17 9 12C9 13.66 10.34 15 12 15C12.83 15 13.58 14.66 14.12 14.12" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6.61 6.61C4.5 8.02 2.93 10 2 12C3.6 16.097 7.336 19 12 19C13.68 19 15.26 18.61 16.66 17.92" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14.51 5.36C13.71 5.13 12.87 5 12 5C16.664 5 20.4 7.903 22 12C21.53 13.2 20.86 14.3 20.03 15.24" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M1 1L23 23" stroke="#BEBEBE" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <div class="error-msg" id="passwordError"></div>
                    </div>
                    
                </div>

                <div class="input-singup">
                    <div class="field">
                        <label>Country</label>
                        <div class="input-wrap">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a15 15 0 0 1 0 18M12 3a15 15 0 0 0 0 18"/></svg>
                            <select name="country_id" id="country">
                                <option value="" selected disabled>Select Country</option>
                                @foreach($countries as $c)
                                <option value="{{ $c->id }}" {{ old('country_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="error-msg" id="countryError"></div>
                    </div>

                    <div class="field">
                        <label>State</label>
                        <div class="input-wrap">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a15 15 0 0 1 0 18M12 3a15 15 0 0 0 0 18"/></svg>
                            <select name="state_id" id="state">
                                <option value="">Select State</option>
                            </select>
                        </div>
                        <div class="error-msg" id="stateError"></div>
                    </div>
                </div>

                <div class="terms-row">
                    <div class="check-box">
                        <input type="checkbox" id="agree" name="agree" value="1" {{ old('agree') ? 'checked' : '' }}>
                        <label for="agree">Yes, I understand and agree to the
                            <a href="{{ route('terms.and.conditions') }}">Terms of Service</a>, Including the 
                            <a href="{{ route('user.agreement') }}">User Agreement</a> and <a href="{{ route('privacy.policy') }}">Privacy Policy</a>.
                        </label>
                    </div>
                </div>
                <div class="error-msg" id="agreeError"></div>

                <button type="submit" class="submit-btn" id="submitBtn" disabled>Create my account
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </form>
        </div>
        <div class="smart-hiring">
            <img src="{{ asset('frontend/images/right-img.png') }}" alt="">
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('signupForm');
        if (!form) return;

        const $ = id => form.querySelector('#' + id);

        const fullName    = $('repName');
        const email       = $('email');
        const password    = $('password');
        const countrySel  = $('country');
        const stateSel    = $('state');
        const agree       = $('agree');
        const submitBtn   = $('submitBtn');
        const togglePass  = $('togglePass');
        const eyeOpen     = $('eyeOpen');
        const eyeClosed   = $('eyeClosed');

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const nameRegex  = /^[a-zA-Z\s.'-]+$/;

        const STATES_URL = "{{ route('employer.get.states', ['country_id' => 999999]) }}";

        const escapeHtml = str => String(str).replace(/[&<>"']/g, m => ({
            '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
        }[m]));

        function setError(fieldId, errorId, message) {
            const field = $(fieldId);
            const box = $(errorId);
            if (box) {
                box.textContent = message || '';
                box.style.display = message ? 'block' : 'none';   // 👈 CSS ka display:none override karta hai jab message ho
            }
            if (field) field.classList.toggle('error', !!message);
            return !message;
        }

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
            
                if (v === '') {
                    return 'Password is required';
                }
            
                if (v.length < 8) {
                    return 'Password must be at least 8 characters';
                }
            
                if (v.length > 64) {
                    return 'Password cannot be longer than 64 characters';
                }
            
                if (!/[a-z]/.test(v)) {
                    return 'Password must contain at least one lowercase letter';
                }
            
                if (!/[A-Z]/.test(v)) {
                    return 'Password must contain at least one uppercase letter';
                }
            
                if (!/[0-9]/.test(v)) {
                    return 'Password must contain at least one number';
                }
            
                if (!/[^A-Za-z0-9]/.test(v)) {
                    return 'Password must contain at least one special character';
                }
            
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

        const fieldMap = {
            name:     ['repName', 'nameError'],
            email:    ['email', 'emailError'],
            password: ['password', 'passwordError'],
            country:  ['country', 'countryError'],
            state:    ['state', 'stateError'],
            agree:    ['agree', 'agreeError'],
        };

        const serverFieldMap = {
            name: 'name',
            email: 'email',
            password: 'password',
            country_id: 'country',
            state_id: 'state',
            agree: 'agree',
        };

        const touched = {};

        const serverErrors = {
            name:     @json($errors->first('name')),
            email:    @json($errors->first('email')),
            password: @json($errors->first('password')),
            country:  @json($errors->first('country_id')),
            state:    @json($errors->first('state_id')),
            agree:    @json($errors->first('agree')),
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

        function clearAllErrors() {
            Object.values(fieldMap).forEach(([fieldId, errorId]) => setError(fieldId, errorId, ''));
        }

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
        ].forEach(([key, el]) => el.addEventListener('blur', () => {
            touched[key] = true;
            validateAll();
        }));

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

        togglePass.addEventListener('click', () => {
            const hidden = password.type === 'password';
            password.type = hidden ? 'text' : 'password';
            eyeOpen.style.display = hidden ? 'none' : 'block';
            eyeClosed.style.display = hidden ? 'block' : 'none';
        });

        /* ---------- Submit — AJAX, no page reload ---------- */
        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            Object.keys(rules).forEach(k => touched[k] = true);

            if (!validateAll(true)) {
                document.querySelector('.field.error, .terms-row.error')
                    ?.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return;
            }

            submitBtn.disabled = true;
            submitBtn.textContent = 'Creating…';

            try {
                const res = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: new FormData(form),
                });

                const data = await res.json();

                if (res.status === 422 || data.success === false) {
                    clearAllErrors();

                    if (data.errors) {
                        Object.entries(data.errors).forEach(([serverKey, messages]) => {
                            const localKey = serverFieldMap[serverKey] || serverKey;
                            if (fieldMap[localKey]) {
                                setError(fieldMap[localKey][0], fieldMap[localKey][1], Array.isArray(messages) ? messages[0] : messages);
                            }
                        });
                    } else if (data.message) {
                        setError('email', 'emailError', data.message);
                    }

                    document.querySelector('.field.error, .terms-row.error')
                        ?.scrollIntoView({ behavior: 'smooth', block: 'center' });

                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Create my account';
                    return;
                }

                if (data.success && data.redirect) {
                    window.location.href = data.redirect;
                    return;
                }

                submitBtn.disabled = false;
                submitBtn.textContent = 'Create my account';

            } catch (err) {
                console.error('Signup request failed:', err);
                submitBtn.disabled = false;
                submitBtn.textContent = 'Create my account';
            }
        });

        validateAll();
    });
</script>
@endsection