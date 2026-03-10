@extends('candidate.layouts.app')

@section('title', 'Settings · SMTJobs')

@section('content')
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-8 pt-24">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900">Settings</h1>
            <p class="text-slate-600 mt-2">Manage your account preferences</p>
        </div>

        <div class="space-y-6">
            {{-- Account Information --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h2 class="text-xl font-semibold text-slate-900 mb-4">Account Information</h2>
                <form class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-900 mb-2">Full Name</label>
                        <input type="text" id="name" value="{{ $candidate->user->name }}" class="w-full rounded-xl border border-slate-300 px-4 py-2 text-slate-900 transition focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-900">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-900 mb-2">Email Address</label>
                        <input type="email" id="email" value="{{ $candidate->user->email }}" class="w-full rounded-xl border border-slate-300 px-4 py-2 text-slate-900 transition focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-900">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-slate-900 mb-2">Phone Number</label>
                        <input type="tel" id="phone" value="{{ $candidate->phone }}" class="w-full rounded-xl border border-slate-300 px-4 py-2 text-slate-900 transition focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-900">
                    </div>
                    <button type="submit" class="rounded-xl bg-slate-900 px-6 py-2 text-sm font-semibold text-white transition hover:bg-black">
                        Save Changes
                    </button>
                </form>
            </div>

            {{-- Password --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h2 class="text-xl font-semibold text-slate-900 mb-4">Change Password</h2>
                <form class="space-y-4">
                    <div>
                        <label for="current_password" class="block text-sm font-semibold text-slate-900 mb-2">Current Password</label>
                        <input type="password" id="current_password" class="w-full rounded-xl border border-slate-300 px-4 py-2 text-slate-900 transition focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-900">
                    </div>
                    <div>
                        <label for="new_password" class="block text-sm font-semibold text-slate-900 mb-2">New Password</label>
                        <input type="password" id="new_password" class="w-full rounded-xl border border-slate-300 px-4 py-2 text-slate-900 transition focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-900">
                    </div>
                    <div>
                        <label for="confirm_password" class="block text-sm font-semibold text-slate-900 mb-2">Confirm New Password</label>
                        <input type="password" id="confirm_password" class="w-full rounded-xl border border-slate-300 px-4 py-2 text-slate-900 transition focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-900">
                    </div>
                    <button type="submit" class="rounded-xl bg-slate-900 px-6 py-2 text-sm font-semibold text-white transition hover:bg-black">
                        Update Password
                    </button>
                </form>
            </div>

            {{-- Email Notifications --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h2 class="text-xl font-semibold text-slate-900 mb-4">Email Notifications</h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-semibold text-slate-900">Job Recommendations</p>
                            <p class="text-sm text-slate-600">Receive personalized job recommendations</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-slate-900 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-slate-900"></div>
                        </label>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-semibold text-slate-900">Application Updates</p>
                            <p class="text-sm text-slate-600">Updates on your job applications</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-slate-900 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-slate-900"></div>
                        </label>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-semibold text-slate-900">New Messages</p>
                            <p class="text-sm text-slate-600">Notifications for new messages from recruiters</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-slate-900 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-slate-900"></div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Privacy --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h2 class="text-xl font-semibold text-slate-900 mb-4">Privacy</h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-semibold text-slate-900">Profile Visibility</p>
                            <p class="text-sm text-slate-600">Allow recruiters to view your profile</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-slate-900 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-slate-900"></div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Danger Zone --}}
            <div class="rounded-2xl border border-red-200 bg-red-50 p-6">
                <h2 class="text-xl font-semibold text-red-900 mb-4">Danger Zone</h2>
                <p class="text-sm text-red-700 mb-4">Once you delete your account, there is no going back. Please be certain.</p>
                <button type="button" class="rounded-xl bg-red-600 px-6 py-2 text-sm font-semibold text-white transition hover:bg-red-700">
                    Delete Account
                </button>
            </div>
        </div>
    </div>
@endsection
