<div id="verifyOtpModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 px-4 py-6">
    <div class="w-full max-w-md rounded-2xl sm:rounded-3xl border border-slate-200 bg-white p-5 sm:p-8 shadow-xl">
        <!-- Header with Close Button -->
        <div class="flex items-center justify-between mb-5 sm:mb-6">
            <h3 class="text-xl sm:text-2xl font-bold text-slate-900">Enter Verification Code</h3>
            <button type="button" class="text-slate-400 hover:text-slate-600 transition" onclick="toggleVerifyOtpModal(false)">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <p class="text-xs sm:text-sm text-slate-600 mb-1" id="verifyOtpSubtitle">
            Enter the 6-digit code we sent to your <span class="font-bold text-slate-900 bg-yellow-100 px-1 rounded">phone or email</span>
        </p>
        <button type="button" onclick="backToLoginModal()" class="text-xs sm:text-sm text-blue-600 hover:text-blue-700 font-semibold mb-4 sm:mb-5">Modify phone/email</button>
        
        <form class="space-y-4 sm:space-y-5" id="verifyOtpForm">
            <div>
                <label class="text-xs uppercase tracking-wider text-slate-400 mb-2 block">Verification Code</label>
                <input
                    type="text"
                    name="otp"
                    id="verifyOtpValue"
                    inputmode="numeric"
                    pattern="[0-9]{6}"
                    maxlength="6"
                    class="w-full rounded-lg sm:rounded-xl border-2 border-slate-200 bg-white px-3 sm:px-4 py-2.5 sm:py-3 text-xl sm:text-2xl font-bold text-center text-slate-900 tracking-widest focus:border-slate-900 focus:outline-none transition"
                    placeholder="000000"
                    required
                />
            </div>

            <div id="verifyOtpState" class="hidden rounded-lg sm:rounded-xl border-2 px-3 sm:px-4 py-2.5 sm:py-3 text-xs sm:text-sm font-medium"></div>

            <button
                type="button"
                data-verify-otp-action
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
            <button type="button" onclick="resendOtpInModal()" class="text-xs sm:text-sm text-slate-600 hover:text-slate-900 font-medium">
                Didn't receive code? <span class="underline">Resend OTP</span>
            </button>
        </div>
    </div>
</div>

<script>
    window.pendingOtpIdentifier = window.pendingOtpIdentifier || null;
    
    window.toggleVerifyOtpModal = function (show = true) {
        const modal = document.getElementById('verifyOtpModal');
        if (!modal) return;
        if (show) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            updateOtpSubtitle();
            // Focus on OTP input
            setTimeout(() => {
                document.getElementById('verifyOtpValue')?.focus();
            }, 100);
        } else {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    };

    window.backToLoginModal = function() {
        toggleVerifyOtpModal(false);
        window.pendingOtpIdentifier = null;
        window.pendingOtpIdentifierType = null;
        toggleLoginModal(true);
    };

    window.resendOtpInModal = async function() {
        const identifier = window.pendingOtpIdentifier;
        const target = window.pendingLoginTarget || 'candidate';
        
        if (!identifier) {
            showOtpState('No identifier found. Please start over.', false);
            return;
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        try {
            const response = await fetch("<?php echo e(route('login.sendOtp')); ?>", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken || ''
                },
                body: JSON.stringify({ identifier, target })
            });

            if (!response.ok) {
                const errorPayload = await response.json().catch(() => ({}));
                throw new Error(errorPayload?.message || 'Failed to resend OTP');
            }

            const payload = await response.json();
            showOtpState(payload.message ?? 'OTP resent successfully!', true);
            
            // Show OTP in development mode
            if (payload?.otp) {
                showOtpState(`${payload.message} (Code: ${payload.otp})`, true);
            }
        } catch (error) {
            showOtpState(error.message, false);
        }
    };

    function updateOtpSubtitle() {
        const subtitle = document.getElementById('verifyOtpSubtitle');
        if (!subtitle) return;
        
        const identifier = window.pendingOtpIdentifier;
        const type = window.pendingOtpIdentifierType ?? 'phone';
        if (identifier) {
            const label = type === 'email' ? 'email' : 'phone number';
            subtitle.innerHTML = `Enter the 6-digit code we sent to your ${label}<span class="font-bold text-slate-900 bg-yellow-100 px-1 rounded">: ${identifier}</span>`;
        } else {
            subtitle.innerHTML = 'Enter the 6-digit code we sent to your <span class="font-bold text-slate-900 bg-yellow-100 px-1 rounded">phone or email</span>';
        }
    }

    function showOtpState(message, success = true) {
        const state = document.getElementById('verifyOtpState');
        if (!state) return;
        
        state.textContent = message;
        state.classList.remove('hidden');
        
        if (success) {
            state.classList.remove('border-red-200', 'bg-red-50', 'text-red-800');
            state.classList.add('border-emerald-200', 'bg-emerald-50', 'text-emerald-800');
        } else {
            state.classList.remove('border-emerald-200', 'bg-emerald-50', 'text-emerald-800');
            state.classList.add('border-red-200', 'bg-red-50', 'text-red-800');
        }
    }

    function validateOtp(otp) {
        const otpRegex = /^\d{6}$/;
        return otpRegex.test(otp);
    }

    (function () {
        const modal = document.getElementById('verifyOtpModal');
        if (!modal) return;

        const otpInput = modal.querySelector('#verifyOtpValue');
        const verifyBtn = modal.querySelector('[data-verify-otp-action]');
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        // Handle OTP input validation
        otpInput?.addEventListener('input', () => {
            // Remove non-numeric characters
            otpInput.value = otpInput.value.replace(/\D/g, '');
            
            const isValid = validateOtp(otpInput.value);
            verifyBtn.disabled = !isValid;
            
            // Auto-submit when 6 digits are entered
            if (isValid) {
                setTimeout(() => {
                    verifyBtn?.click();
                }, 300);
            }
        });

        const postJson = async (url, payload) => {
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
                const message = errorPayload?.message || 'Unexpected error';
                throw new Error(message);
            }
            return response.json();
        };

        verifyBtn?.addEventListener('click', async () => {
            const identifier = window.pendingOtpIdentifier;
            const otp = otpInput?.value?.trim();
            
            if (!identifier || !otp) {
                showOtpState('Identifier or OTP missing.', false);
                return;
            }

            if (!validateOtp(otp)) {
                showOtpState('Please enter a valid 6-digit OTP', false);
                return;
            }

            const target = window.pendingLoginTarget || 'candidate';

            verifyBtn.disabled = true;
            verifyBtn.innerHTML = '<svg class="w-4 h-4 sm:w-5 sm:h-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><span>Verifying...</span>';

            try {
                const payload = await postJson("<?php echo e(route('login.verifyOtp')); ?>", { identifier, otp, target });
                showOtpState(payload.message ?? 'Login successful!', true);
                
                setTimeout(() => {
                    if (payload.redirect) {
                        window.location.href = payload.redirect;
                    } else {
                        window.location.href = target === 'recruiter' ? '/recruiter/dashboard' : '/candidate/dashboard';
                    }
                }, 1000);
            } catch (error) {
                showOtpState(error.message, false);
            } finally {
                verifyBtn.disabled = false;
                verifyBtn.innerHTML = '<svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg><span>Verify & Login</span>';
            }
        });
    })();
</script>
<?php /**PATH D:\smtjobs\resources\views/website/components/verify-otp-modal.blade.php ENDPATH**/ ?>