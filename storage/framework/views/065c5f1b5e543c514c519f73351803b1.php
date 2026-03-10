<div id="loginModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/60 px-4 py-6">
    <div class="w-full max-w-md rounded-2xl sm:rounded-3xl border border-slate-200 bg-white p-5 sm:p-8 shadow-xl">
        <!-- Header with Close Button -->
        <div class="flex items-center justify-between mb-5 sm:mb-6">
            <div class="flex items-center gap-2 sm:gap-3">
                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                </svg>
                <h3 class="text-xl sm:text-2xl font-bold text-slate-900">Login with OTP</h3>
            </div>
            <button type="button" class="text-slate-400 hover:text-slate-600 transition" onclick="toggleLoginModal(false)">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <p class="text-xs sm:text-sm text-slate-600 mb-4 sm:mb-5">Enter your mobile number or email and we'll send you a verification code</p>
        
        <form class="space-y-4 sm:space-y-5" id="otpLoginForm">
            <div>
                <label class="text-xs uppercase tracking-wider text-slate-400 mb-2 block">Phone or Email</label>
                <input
                    type="text"
                    name="identifier"
                    id="otpIdentifier"
                    autocomplete="username"
                    class="w-full rounded-lg sm:rounded-xl border-2 border-slate-200 bg-[#e7e7e7] px-3 sm:px-4 py-2.5 sm:py-3 text-sm sm:text-base font-medium text-slate-900 focus:border-slate-900 focus:outline-none transition"
                    placeholder="+91 XXXXXXXXXX or you@email.com"
                    required
                />
            </div>

            <div id="loginOtpState" class="hidden rounded-lg sm:rounded-xl border-2 px-3 sm:px-4 py-2.5 sm:py-3 text-xs sm:text-sm font-medium"></div>

            <button
                type="button"
                data-send-otp
                disabled
                class="w-full rounded-lg sm:rounded-xl bg-slate-900 px-5 sm:px-6 py-3 sm:py-3.5 text-sm sm:text-base font-semibold text-white transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-900 focus:ring-offset-2 flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-slate-900"
            >
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span id="loginBtnText">Continue as Candidate</span>
            </button>
        </form>

        <div class="mt-5 sm:mt-6 text-center space-y-2">
            <button type="button" onclick="switchModalUserType()" class="text-sm sm:text-base text-blue-600 hover:text-blue-700 font-semibold">
                <span id="loginSwitchText">Login as Recruiter instead?</span>
            </button>
            <p class="text-xs text-slate-500">We'll never share your information. OTP is valid for 5 minutes.</p>
        </div>
    </div>
</div>

<?php if (! $__env->hasRenderedOnce('a39dba41-c904-4370-9720-0eb1566877bc')): $__env->markAsRenderedOnce('a39dba41-c904-4370-9720-0eb1566877bc'); ?>
        <script>
            let modalSelectedTarget = 'candidate';

            window.toggleLoginModal = function (show = true) {
                const modal = document.getElementById('loginModal');
                if (!modal) return;
                if (show) {
                    modal.classList.remove('hidden');
                } else {
                    modal.classList.add('hidden');
                }
            };

            window.pendingLoginTarget = window.pendingLoginTarget || 'candidate';
            window.pendingOtpIdentifier = window.pendingOtpIdentifier || null;
            window.pendingOtpIdentifierType = window.pendingOtpIdentifierType || 'phone';

            window.openOtpModal = function (target = 'candidate') {
                modalSelectedTarget = target;
                window.pendingLoginTarget = target;
                updateModalButtonText();
                toggleLoginModal(true);
            };

            // Switch user type in modal
            window.switchModalUserType = function() {
                modalSelectedTarget = modalSelectedTarget === 'candidate' ? 'recruiter' : 'candidate';
                window.pendingLoginTarget = modalSelectedTarget;
                updateModalButtonText();
            };

            // Update button and switch text based on selected target
            function updateModalButtonText() {
                const btnText = document.getElementById('loginBtnText');
                const switchText = document.getElementById('loginSwitchText');
                const sendBtn = document.querySelector('[data-send-otp]');
                const btnIcon = sendBtn?.querySelector('svg path');
                
                if (modalSelectedTarget === 'candidate') {
                    if (btnText) btnText.textContent = 'Continue as Candidate';
                    if (switchText) switchText.textContent = 'Login as Recruiter instead?';
                    // User icon
                    if (btnIcon) btnIcon.setAttribute('d', 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z');
                } else {
                    if (btnText) btnText.textContent = 'Continue as Recruiter';
                    if (switchText) switchText.textContent = 'Login as Candidate instead?';
                    // Briefcase icon
                    if (btnIcon) btnIcon.setAttribute('d', 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z');
                }
            }

            // Validate phone number (10 digits) or email
            function validateIdentifier(value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                const phoneRegex = /^(\+\d{1,3}[-\s]?)?\d{10}$/;
                return emailRegex.test(value) || phoneRegex.test(value.replace(/[\s-]/g, ''));
            }

            document.addEventListener('DOMContentLoaded', () => {
                const modal = document.getElementById('loginModal');
                if (!modal) return;

                const sendBtn = modal.querySelector('[data-send-otp]');
                const identifierInput = modal.querySelector('#otpIdentifier');
                const status = modal.querySelector('#loginOtpState');
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                // Handle input validation
                identifierInput?.addEventListener('input', () => {
                    const identifier = identifierInput.value.trim();
                    if (validateIdentifier(identifier)) {
                        sendBtn.disabled = false;
                    } else {
                        sendBtn.disabled = true;
                    }
                });

                const showStatus = (message, success = true) => {
                    if (!status) return;
                    status.textContent = message;
                    status.classList.remove('hidden');
                    
                    if (success) {
                        status.classList.remove('border-red-200', 'bg-red-50', 'text-red-800');
                        status.classList.add('border-emerald-200', 'bg-emerald-50', 'text-emerald-800');
                    } else {
                        status.classList.remove('border-emerald-200', 'bg-emerald-50', 'text-emerald-800');
                        status.classList.add('border-red-200', 'bg-red-50', 'text-red-800');
                    }
                };

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

                sendBtn?.addEventListener('click', async () => {
                    const identifier = identifierInput?.value?.trim();
                    if (!identifier) {
                        showStatus('Please enter your phone number or email', false);
                        return;
                    }

                    sendBtn.disabled = true;
                    sendBtn.innerHTML = '<svg class="w-4 h-4 sm:w-5 sm:h-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><span>Sending...</span>';

                    try {
                        const payload = await postJson("<?php echo e(route('login.sendOtp')); ?>", {
                            identifier,
                            target: modalSelectedTarget,
                        });
                        showStatus(payload.message ?? 'OTP sent successfully!', true);
                        window.pendingOtpIdentifier = identifier;
                        window.pendingOtpIdentifierType = payload.identifier_type ?? (identifier.includes('@') ? 'email' : 'phone');
                        
                        // Show OTP in development mode
                        if (payload?.otp) {
                            showStatus(`${payload.message} (Code: ${payload.otp})`, true);
                        }
                        
                        setTimeout(() => {
                            toggleLoginModal(false);
                            toggleVerifyOtpModal(true);
                            identifierInput.value = '';
                            status.classList.add('hidden');
                        }, 1500);
                    } catch (error) {
                        showStatus(error.message, false);
                    } finally {
                        sendBtn.disabled = false;
                        updateModalButtonText();
                    }
                });

                // Initialize button text
                updateModalButtonText();
            });
        </script>
<?php endif; ?>
<?php /**PATH D:\smtjobs\resources\views/website/components/login-modal.blade.php ENDPATH**/ ?>