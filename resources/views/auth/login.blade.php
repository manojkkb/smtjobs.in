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
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">SMT Jobs</h1>
            <p class="text-xs sm:text-sm text-slate-600 mt-1 sm:mt-2">Welcome back! Login to continue</p>
        </div>

        <!-- Login with OTP Card -->
        <div id="otpRequestCard" class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-8 shadow-lg">
            <div class="mb-5 sm:mb-6">
                <h2 class="text-xl sm:text-2xl font-bold text-slate-900">Login with OTP</h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-2">Enter your mobile number or email and we'll send you a verification code</p>
            </div>

            <!-- Target Selection -->
            <div class="mb-5 sm:mb-6">
                <label class="text-xs uppercase tracking-wider text-slate-400 mb-2 sm:mb-3 block">Login as</label>
                <div class="flex gap-2 sm:gap-3">
                    <button type="button" onclick="selectTarget('candidate')" 
                            class="target-btn flex-1 px-3 sm:px-4 py-2 sm:py-2.5 rounded-lg sm:rounded-xl border-2 border-slate-900 bg-slate-900 text-white text-xs sm:text-sm font-semibold transition"
                            data-target="candidate">
                        Candidate
                    </button>
                    <button type="button" onclick="selectTarget('recruiter')" 
                            class="target-btn flex-1 px-3 sm:px-4 py-2 sm:py-2.5 rounded-lg sm:rounded-xl border-2 border-slate-200 bg-white text-slate-600 text-xs sm:text-sm font-semibold transition hover:border-slate-300"
                            data-target="recruiter">
                        Recruiter
                    </button>
                </div>
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
                    class="w-full rounded-lg sm:rounded-xl bg-slate-900 px-5 sm:px-6 py-3 sm:py-3.5 text-sm sm:text-base font-semibold text-white transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-900 focus:ring-offset-2"
                >
                    Send OTP
                </button>
            </form>

            <p class="mt-5 sm:mt-6 text-xs text-center text-slate-500">We'll never share your information. OTP is valid for 5 minutes.</p>
        </div>

        <!-- Verify OTP Card -->
        <div id="otpVerifyCard" class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-8 shadow-lg hidden">
            <div class="mb-5 sm:mb-6">
                <h2 class="text-xl sm:text-2xl font-bold text-slate-900">Verify OTP</h2>
                <p class="text-xs sm:text-sm text-slate-600 mt-2" id="otpSentMessage">Enter the 6-digit code we sent to your phone or email</p>
            </div>

            <form id="otpVerifyForm" class="space-y-4 sm:space-y-5">
                <div>
                    <label class="text-xs uppercase tracking-wider text-slate-400 mb-2 block">Verification Code</label>
                    <input
                        type="text"
                        name="otp"
                        id="otpCode"
                        inputmode="numeric"
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
                    class="w-full rounded-lg sm:rounded-xl bg-emerald-500 px-5 sm:px-6 py-3 sm:py-3.5 text-sm sm:text-base font-semibold text-white transition hover:bg-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                >
                    Verify & Login
                </button>

                <button
                    type="button"
                    onclick="backToRequest()"
                    class="w-full rounded-lg sm:rounded-xl border-2 border-slate-200 bg-white px-5 sm:px-6 py-3 sm:py-3.5 text-sm sm:text-base font-semibold text-slate-900 transition hover:border-slate-900 focus:outline-none"
                >
                    Change Phone / Email
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
        let selectedTarget = 'candidate';
        let currentIdentifier = null;
        let currentIdentifierType = null;

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        // Select target (candidate or recruiter)
        function selectTarget(target) {
            selectedTarget = target;
            const buttons = document.querySelectorAll('.target-btn');
            buttons.forEach(btn => {
                const isSelected = btn.dataset.target === target;
                btn.classList.toggle('border-slate-900', isSelected);
                btn.classList.toggle('bg-slate-900', isSelected);
                btn.classList.toggle('text-white', isSelected);
                btn.classList.toggle('border-slate-200', !isSelected);
                btn.classList.toggle('bg-white', !isSelected);
                btn.classList.toggle('text-slate-600', !isSelected);
            });
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
            sendBtn.textContent = 'Sending...';

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
                    document.getElementById('otpSentMessage').textContent = 
                        `Enter the 6-digit code we sent to your ${label}: ${currentIdentifier}`;
                    
                    document.getElementById('otpCode').focus();
                }, 1500);

            } catch (error) {
                showStatus('otpRequestStatus', error.message, false);
            } finally {
                sendBtn.disabled = false;
                sendBtn.textContent = 'Send OTP';
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
            verifyBtn.textContent = 'Verifying...';

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
                verifyBtn.textContent = 'Verify & Login';
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

        // Auto-focus on identifier input
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('identifier').focus();
        });
    </script>
</body>
</html>
