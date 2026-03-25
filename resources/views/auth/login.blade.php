<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - SMT Jobs</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#e7e7e7] min-h-screen flex items-start sm:items-center justify-center pt-6 pb-6 px-4 sm:p-4">
    
    <div class="w-full max-w-md">
        <!-- Logo or Brand -->
        <div class="text-center mb-4 sm:mb-8">
            <a href="{{ url('/') }}">
                <img src="{{ asset('logos/logo.png') }}" alt="SMT Jobs" class="h-10 sm:h-12 mx-auto">
            </a>
            <p class="text-xs sm:text-sm text-slate-600 mt-1 sm:mt-2">Welcome back! Login to continue</p>
        </div>

        <!-- Login with OTP Card -->
        <div id="otpRequestCard" class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-8 shadow-lg">
            <div class="mb-5 sm:mb-6">
                <div class="flex items-center gap-2 sm:gap-3 mb-2">
                    <svg class="w-6 h-6 sm:w-7 sm:h-7 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                    <h2 class="text-xl sm:text-2xl font-bold text-slate-900">Login with OTP</h2>
                </div>
                <p class="text-xs sm:text-sm text-slate-600 mt-2">Enter your mobile number or email and we'll send you a verification code</p>
            </div>

            <form id="otpRequestForm" class="space-y-4 sm:space-y-5">
                <div>
                    <label class="text-xs uppercase tracking-wider text-slate-400 mb-2 block">Phone or Email</label>
                    <input
                        type="text"
                        name="identifier"
                        id="identifier"
                        autocomplete="username"
                        class="w-full rounded-lg sm:rounded-xl border-2 border-slate-200 bg-[#e7e7e7] px-3 sm:px-4 py-2.5 sm:py-3 text-sm sm:text-base font-medium text-slate-900 focus:border-slate-900 focus:outline-none transition"
                        placeholder="+91 XXXXXXXXXX or you@email.com"
                        required
                    />
                </div>

                <div id="otpRequestStatus" class="hidden rounded-lg sm:rounded-xl border-2 px-3 sm:px-4 py-2.5 sm:py-3 text-xs sm:text-sm font-medium"></div>

                <button
                    type="submit"
                    id="sendOtpBtn"
                    disabled
                    class="w-full rounded-lg sm:rounded-xl bg-slate-900 px-5 sm:px-6 py-3 sm:py-3.5 text-sm sm:text-base font-semibold text-white transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-900 focus:ring-offset-2 flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-slate-900"
                >
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span id="btnText">Continue as Candidate</span>
                </button>
            </form>

            <div class="mt-5 sm:mt-6 text-center space-y-2">
                <button type="button" onclick="switchUserType()" class="text-sm sm:text-base text-blue-600 hover:text-blue-700 font-semibold">
                    <span id="switchText">Login as Recruiter instead?</span>
                </button>
                <p class="text-xs text-slate-500">We'll never share your information. OTP is valid for 5 minutes.</p>
            </div>
        </div>

        <!-- Verify OTP Card -->
        <div id="otpVerifyCard" class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-8 shadow-lg hidden">
            <div class="mb-5 sm:mb-6">
                <h2 class="text-xl sm:text-2xl font-bold text-slate-900">Enter Verification Code</h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-2" id="otpSentMessage">
                    Enter the 6-digit code we sent to your <span class="font-bold text-slate-900 bg-yellow-100 px-1 rounded">phone or email</span>
                    <button type="button" onclick="backToRequest()" class="ml-2 text-blue-600 hover:text-blue-700 font-semibold underline">Modify</button>
                </p>
            </div>

            <form id="otpVerifyForm" class="space-y-4 sm:space-y-5">
                <div>
                    <label class="text-xs uppercase tracking-wider text-slate-400 mb-2 block">Verification Code</label>
                    <input
                        type="text"
                        name="otp"
                        id="otpCode"
                        inputmode="numeric"
                        pattern="[0-9]{6}"
                        maxlength="6"
                        class="w-full rounded-lg sm:rounded-xl border-2 border-slate-200 bg-white px-3 sm:px-4 py-2.5 sm:py-3 text-xl sm:text-2xl font-bold text-center text-slate-900 tracking-widest focus:border-slate-900 focus:outline-none transition"
                        placeholder="000000"
                        required
                    />
                </div>

                <div id="otpVerifyStatus" class="hidden rounded-lg sm:rounded-xl border-2 px-3 sm:px-4 py-2.5 sm:py-3 text-xs sm:text-sm font-medium"></div>

                <button
                    type="submit"
                    id="verifyOtpBtn"
                    disabled
                    class="w-full rounded-lg sm:rounded-xl bg-slate-900 px-5 sm:px-6 py-3 sm:py-3.5 text-sm sm:text-base font-semibold text-white transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-900 focus:ring-offset-2 flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Verify & Login</span>
                </button>
            </form>

            <div class="mt-5 sm:mt-6 text-center">
                <button type="button" onclick="resendOtp()" class="text-xs sm:text-sm text-slate-600 hover:text-slate-900 font-medium">
                    Didn't receive code? <span class="underline">Resend OTP</span>
                </button>
            </div>
        </div>
    </div>

    <script>
        let selectedTarget = "{{ request()->get('user', 'candidate') }}";
        let currentIdentifier = null;
        let currentIdentifierType = null;

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        // Select target (candidate or recruiter)
        function selectTarget(target) {
            selectedTarget = target;
            updateButtonText();
        }

        // Switch user type
        function switchUserType() {
            selectedTarget = selectedTarget === 'candidate' ? 'recruiter' : 'candidate';
            updateButtonText();
        }

        // Update button and switch text based on selected target
        function updateButtonText() {
            const btnText = document.getElementById('btnText');
            const switchText = document.getElementById('switchText');
            const sendBtn = document.getElementById('sendOtpBtn');
            const btnIcon = sendBtn.querySelector('svg path');
            
            if (selectedTarget === 'candidate') {
                btnText.textContent = 'Continue as Candidate';
                switchText.textContent = 'Login as Recruiter instead?';
                // User icon
                btnIcon.setAttribute('d', 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z');
            } else {
                btnText.textContent = 'Continue as Recruiter';
                switchText.textContent = 'Login as Candidate instead?';
                // Briefcase icon
                btnIcon.setAttribute('d', 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z');
            }
        }

        // Validate phone number (10 digits) or email
        function validateIdentifier(value) {
            // Email validation regex
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            // Phone validation - exactly 10 digits (optionally with +country code)
            const phoneRegex = /^(\+\d{1,3}[-\s]?)?\d{10}$/;
            
            return emailRegex.test(value) || phoneRegex.test(value.replace(/[\s-]/g, ''));
        }

        // Handle input validation
        function handleInputValidation() {
            const identifier = document.getElementById('identifier').value.trim();
            const sendBtn = document.getElementById('sendOtpBtn');
            
            if (validateIdentifier(identifier)) {
                sendBtn.disabled = false;
            } else {
                sendBtn.disabled = true;
            }
        }

        // Show status message
        function showStatus(elementId, message, isSuccess = true) {
            const statusEl = document.getElementById(elementId);
            if (!statusEl) return;

            statusEl.textContent = message;
            statusEl.classList.remove('hidden');
            
            if (isSuccess) {
                statusEl.classList.remove('border-red-200', 'bg-red-50', 'text-red-800');
                statusEl.classList.add('border-emerald-200', 'bg-emerald-50', 'text-emerald-800');
            } else {
                statusEl.classList.remove('border-emerald-200', 'bg-emerald-50', 'text-emerald-800');
                statusEl.classList.add('border-red-200', 'bg-red-50', 'text-red-800');
            }
        }

        // Post JSON to API
        async function postJson(url, payload) {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken || ''
                },
                body: JSON.stringify(payload)
            });

            if (!response.ok) {
                const errorPayload = await response.json().catch(() => ({}));
                const message = errorPayload?.message || 'An unexpected error occurred';
                throw new Error(message);
            }

            return response.json();
        }

        // Handle OTP Request Form
        document.getElementById('otpRequestForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const identifier = document.getElementById('identifier').value.trim();
            if (!identifier) {
                showStatus('otpRequestStatus', 'Please enter your phone number or email', false);
                return;
            }

            const sendBtn = document.getElementById('sendOtpBtn');
            sendBtn.disabled = true;
            sendBtn.innerHTML = '<svg class="w-4 h-4 sm:w-5 sm:h-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><span>Sending...</span>';

            try {
                const response = await postJson("{{ route('login.sendOtp') }}", {
                    identifier: identifier,
                    target: selectedTarget
                });

                currentIdentifier = identifier;
                currentIdentifierType = response.identifier_type || (identifier.includes('@') ? 'email' : 'phone');

                showStatus('otpRequestStatus', response.message || 'OTP sent successfully!', true);

                // Show OTP in development mode
                if (response.otp) {
                    showStatus('otpRequestStatus', `${response.message} (Code: ${response.otp})`, true);
                }

                // Switch to verify card after brief delay
                setTimeout(() => {
                    document.getElementById('otpRequestCard').classList.add('hidden');
                    document.getElementById('otpVerifyCard').classList.remove('hidden');
                    
                    const label = currentIdentifierType === 'email' ? 'email' : 'phone number';
                    document.getElementById('otpSentMessage').innerHTML = 
                        `Enter the 6-digit code we sent to your ${label}<span class="font-bold text-slate-900 bg-yellow-100 px-1 rounded">: ${currentIdentifier}</span> <button type="button" onclick="backToRequest()" class="ml-2 text-blue-600 hover:text-blue-700 font-semibold underline">Modify</button>`;
                    
                    // Reset OTP input and button state
                    const otpInput = document.getElementById('otpCode');
                    otpInput.value = '';
                    document.getElementById('verifyOtpBtn').disabled = true;
                    otpInput.focus();
                }, 1500);

            } catch (error) {
                showStatus('otpRequestStatus', error.message, false);
            } finally {
                sendBtn.disabled = false;
                updateButtonText();
            }
        });

        // Handle OTP Verify Form
        document.getElementById('otpVerifyForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const otp = document.getElementById('otpCode').value.trim();
            if (!otp || otp.length !== 6) {
                showStatus('otpVerifyStatus', 'Please enter a valid 6-digit OTP', false);
                return;
            }

            const verifyBtn = document.getElementById('verifyOtpBtn');
            verifyBtn.disabled = true;
            verifyBtn.innerHTML = '<svg class="w-4 h-4 sm:w-5 sm:h-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><span>Verifying...</span>';

            try {
                const response = await postJson("{{ route('login.verifyOtp') }}", {
                    identifier: currentIdentifier,
                    otp: otp,
                    target: selectedTarget
                });

                showStatus('otpVerifyStatus', response.message || 'Login successful!', true);

                // Redirect after successful login
                setTimeout(() => {
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    } else {
                        window.location.href = selectedTarget === 'recruiter' ? '/recruiter/dashboard' : '/candidate/dashboard';
                    }
                }, 1000);

            } catch (error) {
                showStatus('otpVerifyStatus', error.message, false);
            } finally {
                verifyBtn.disabled = false;
                verifyBtn.innerHTML = '<svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg><span>Verify & Sign In</span>';
            }
        });

        // Back to request form
        function backToRequest() {
            document.getElementById('otpVerifyCard').classList.add('hidden');
            document.getElementById('otpRequestCard').classList.remove('hidden');
            document.getElementById('otpCode').value = '';
            document.getElementById('otpVerifyStatus').classList.add('hidden');
            currentIdentifier = null;
            currentIdentifierType = null;
        }

        // Resend OTP
        async function resendOtp() {
            if (!currentIdentifier) {
                showStatus('otpVerifyStatus', 'No identifier found. Please start over.', false);
                return;
            }

            try {
                const response = await postJson("{{ route('login.sendOtp') }}", {
                    identifier: currentIdentifier,
                    target: selectedTarget
                });

                showStatus('otpVerifyStatus', response.message || 'OTP resent successfully!', true);
                
                // Show OTP in development mode
                if (response.otp) {
                    showStatus('otpVerifyStatus', `${response.message} (Code: ${response.otp})`, true);
                }

            } catch (error) {
                showStatus('otpVerifyStatus', error.message, false);
            }
        }

        // Validate 6-digit OTP
        function validateOtp(otp) {
            const otpRegex = /^\d{6}$/;
            return otpRegex.test(otp);
        }

        // Handle OTP input validation
        function handleOtpValidation() {
            const otpInput = document.getElementById('otpCode');
            const verifyBtn = document.getElementById('verifyOtpBtn');
            
            // Remove non-numeric characters
            otpInput.value = otpInput.value.replace(/\D/g, '');
            
            const isValid = validateOtp(otpInput.value);
            
            if (isValid) {
                verifyBtn.disabled = false;
                // Auto-submit form when 6 digits are entered
                setTimeout(() => {
                    document.getElementById('otpVerifyForm').requestSubmit();
                }, 300);
            } else {
                verifyBtn.disabled = true;
            }
        }

        // Auto-focus on identifier input
        document.addEventListener('DOMContentLoaded', () => {
            const identifierInput = document.getElementById('identifier');
            identifierInput.focus();
            updateButtonText();
            
            // Add input event listener for validation
            identifierInput.addEventListener('input', handleInputValidation);
            
            // Add input event listener for OTP validation
            const otpInput = document.getElementById('otpCode');
            otpInput.addEventListener('input', handleOtpValidation);
        });
    </script>
</body>
</html>
