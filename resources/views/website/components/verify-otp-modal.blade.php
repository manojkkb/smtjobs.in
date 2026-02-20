<div id="verifyOtpModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 px-4 py-6">
    <div class="w-full max-w-md rounded-3xl border border-slate-200 bg-white p-6 shadow-xl">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-slate-900">Verify OTP</h3>
            <button type="button" class="text-sm text-slate-500" onclick="toggleVerifyOtpModal(false)">Close</button>
        </div>
        <p class="mt-2 text-sm text-slate-500" id="verifyOtpSubtitle">Enter the 6-digit code we sent to your phone or email.</p>
        <p class="mt-1 text-xs text-slate-400" id="verifyOtpDetail"></p>
        <form class="mt-4 space-y-4" id="verifyOtpForm">
            <label class="space-y-1 text-sm text-slate-600">
                <span class="text-[0.65rem] uppercase tracking-[0.4em] text-slate-400">OTP</span>
                <input
                    type="text"
                    name="otp"
                    id="verifyOtpValue"
                    inputmode="numeric"
                    maxlength="6"
                    class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-base font-semibold text-slate-900 focus:border-slate-400 focus:outline-none"
                    placeholder="Enter code"
                    required
                />
            </label>
            <div id="verifyOtpState" class="rounded-2xl border border-transparent bg-emerald-50 px-3 py-2 text-sm text-emerald-800 opacity-0 transition-opacity duration-200"></div>
            <button
                type="button"
                data-verify-otp-action
                class="w-full rounded-2xl bg-emerald-500 px-6 py-3 text-sm font-semibold text-white transition hover:bg-emerald-600"
            >
                Confirm code
            </button>
            <button
                type="button"
                data-change-identifier
                class="w-full rounded-2xl border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-900 transition hover:border-slate-900 hover:text-slate-900"
            >
                Change phone / email
            </button>
        </form>
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
        } else {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    };

    (function () {
        const modal = document.getElementById('verifyOtpModal');
        if (!modal) return;

        const otpInput = modal.querySelector('#verifyOtpValue');
        const verifyBtn = modal.querySelector('[data-verify-otp-action]');
        const state = modal.querySelector('#verifyOtpState');
        const subtitle = modal.querySelector('#verifyOtpSubtitle');
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        const showState = (message, success = true) => {
            if (!state) return;
            state.textContent = message;
            state.classList.toggle('border-emerald-200', success);
            state.classList.toggle('border-red-200', !success);
            state.classList.toggle('bg-emerald-50', success);
            state.classList.toggle('bg-red-50', !success);
            state.classList.toggle('text-emerald-800', success);
            state.classList.toggle('text-rose-800', !success);
            state.style.opacity = '1';
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

        const detail = modal.querySelector('#verifyOtpDetail');

        const updateSubtitle = () => {
            if (!subtitle) return;
            const identifier = window.pendingOtpIdentifier;
            const type = window.pendingOtpIdentifierType ?? 'phone';
            if (identifier) {
                const label = type === 'email' ? `email ${identifier}` : `phone ${identifier}`;
                subtitle.textContent = `Enter the code we sent to your ${label}.`;
                detail.textContent = `Code delivered via ${type === 'email' ? 'email' : 'mobile'}.`;
            } else {
                subtitle.textContent = 'Enter the 6-digit code we sent to your phone or email.';
                detail.textContent = '';
            }
        };

        const changeIdentifier = () => {
            window.toggleVerifyOtpModal(false);
            window.pendingOtpIdentifier = null;
            window.pendingOtpIdentifierType = null;
            window.pendingLoginTarget = 'candidate';
            toggleLoginModal(true);
        };

        modal.querySelector('[data-change-identifier]')?.addEventListener('click', changeIdentifier);

        verifyBtn?.addEventListener('click', async () => {
            const identifier = window.pendingOtpIdentifier;
            const otp = otpInput?.value?.trim();
            if (!identifier || !otp) {
                showState('Identifier or OTP missing.', false);
                return;
            }

            const target = window.pendingLoginTarget || 'candidate';

            verifyBtn.disabled = true;
            try {
                const payload = await postJson("{{ route('login.verifyOtp') }}", { identifier, otp, target });
                showState(payload.message ?? 'Logged in', true);
                if (payload.redirect) {
                    window.location.href = payload.redirect;
                }
            } catch (error) {
                showState(error.message, false);
            } finally {
                verifyBtn.disabled = false;
            }
        });

        modal.addEventListener('show', updateSubtitle);
        updateSubtitle();
    })();
</script>
