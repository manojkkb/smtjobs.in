<div id="loginModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/60 px-4 py-6">
    <div class="w-full max-w-md rounded-3xl border border-slate-200 bg-white p-6 shadow-xl">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-slate-900">Login with OTP</h3>
            <button type="button" class="text-sm text-slate-500" onclick="toggleLoginModal(false)">Close</button>
        </div>
        <p class="mt-2 text-sm text-slate-500">Enter your mobile number or email and we’ll send an OTP you can use to log in instantly.</p>
        <div class="mt-3 flex items-center gap-2 text-[0.65rem] uppercase tracking-[0.4em] text-slate-400">
            <span class="rounded-full border border-slate-400 bg-slate-900 px-3 py-1 text-white">Request code only</span>
        </div>
        <form class="mt-4 space-y-4" id="otpLoginForm">
            <label class="space-y-1 text-sm text-slate-600">
                <span class="text-[0.65rem] uppercase tracking-[0.4em] text-slate-400">Phone or email</span>
                <input
                    type="text"
                    name="identifier"
                    id="otpIdentifier"
                    autocomplete="username"
                    class="w-full rounded-2xl border border-slate-200 bg-[#e7e7e7] px-4 py-3 text-base font-semibold text-slate-900 focus:border-slate-400 focus:outline-none"
                    placeholder="+91 XXXXXXXXXX or you@email.com"
                    required
                />
            </label>
            <div id="loginOtpState" class="rounded-2xl border border-transparent bg-emerald-50 px-3 py-2 text-sm text-emerald-800 opacity-0 transition-opacity duration-200"></div>
            <div class="space-y-3">
                <button
                    type="button"
                    data-send-otp
                    class="w-full rounded-2xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800"
                >
                    Send OTP
                </button>
            </div>
        </form>
        <p class="mt-4 text-xs text-slate-500">We’ll never share your number. OTP valid for 5 minutes.</p>
    </div>
</div>

<?php if (! $__env->hasRenderedOnce('048339a9-4443-4e62-9eaa-5acc290cfd58')): $__env->markAsRenderedOnce('048339a9-4443-4e62-9eaa-5acc290cfd58'); ?>
        <script>
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
                window.pendingLoginTarget = target;
                toggleLoginModal(true);
            };

            document.addEventListener('DOMContentLoaded', () => {
                const modal = document.getElementById('loginModal');
                if (!modal) return;

                const sendBtn = modal.querySelector('[data-send-otp]');
                const identifierInput = modal.querySelector('#otpIdentifier');
                const status = modal.querySelector('#loginOtpState');
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                const showStatus = (message, success = true) => {
                    if (!status) return;
                    status.textContent = message;
                    status.classList.toggle('border-emerald-200', success);
                    status.classList.toggle('border-red-200', !success);
                    status.classList.toggle('bg-emerald-50', success);
                    status.classList.toggle('bg-red-50', !success);
                    status.classList.toggle('text-emerald-800', success);
                    status.classList.toggle('text-rose-800', !success);
                    status.style.opacity = '1';
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
                        showStatus('Enter phone or email first.', false);
                        return;
                    }

                    sendBtn.disabled = true;
                    try {
                        const payload = await postJson("<?php echo e(route('login.sendOtp')); ?>", {
                            identifier,
                            target: window.pendingLoginTarget,
                        });
                        showStatus(payload.message ?? 'OTP sent', true);
                        window.pendingOtpIdentifier = identifier;
                        window.pendingOtpIdentifierType = payload.identifier_type ?? (identifier.includes('@') ? 'email' : 'phone');
                        toggleLoginModal(false);
                        if (payload?.otp) {
                            showStatus(`${payload.message} (Code: ${payload.otp})`, true);
                        }
                        toggleVerifyOtpModal(true);
                    } catch (error) {
                        showStatus(error.message, false);
                    } finally {
                        sendBtn.disabled = false;
                    }
                });
            });
        </script>
<?php endif; ?>
<?php /**PATH D:\smtjobs\resources\views/website/components/login-modal.blade.php ENDPATH**/ ?>