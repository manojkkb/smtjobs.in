# Livewire & Alpine.js Setup Guide

## ✅ Configuration Complete

Your recruiter panel is now configured to use **Laravel Livewire v4** and **Alpine.js v3**.

## 📦 What Was Configured

### 1. **Alpine.js** (`resources/js/app.js`)
- Alpine.js imported and initialized globally
- Available as `window.Alpine` in all views

### 2. **Livewire Configuration**
- Published config file: `config/livewire.php`
- Directives added to `resources/views/recruiter/layouts/app.blade.php`:
  - `@livewireStyles` in `<head>`
  - `@livewireScripts` before `</body>`

### 3. **Vite Hot Reload** (`vite.config.js`)
- Configured to watch Livewire components and views
- Auto-refresh on file changes

### 4. **Built Assets**
- Assets compiled with Alpine.js included
- Production-ready build created

---

## 🚀 Using Livewire Components

### Creating a New Component

```bash
php artisan make:livewire Recruiter/ComponentName
```

This creates a single-file component in:
`resources/views/components/recruiter/⚡component-name.blade.php`

### Example Component Structure

```php
<?php

use Livewire\Component;
use Livewire\Attributes\Computed;

new class extends Component
{
    public $count = 0;
    
    public function increment()
    {
        $this->count++;
    }
    
    #[Computed]
    public function doubleCount()
    {
        return $this->count * 2;
    }
};
?>

<div>
    <h3>Count: {{ $count }}</h3>
    <h3>Double: {{ $this->doubleCount }}</h3>
    <button wire:click="increment">Increment</button>
</div>
```

### Using Components in Views

```blade
{{-- In any Blade view --}}
<livewire:recruiter.component-name />

{{-- Or using Blade component syntax --}}
<x-recruiter.⚡component-name />
```

---

## 🎨 Using Alpine.js

Alpine.js is available globally and can be used in any Blade template.

### Basic Alpine.js Example

```blade
<div 
    x-data="{ open: false, count: 0 }"
    x-init="console.log('Component initialized')"
>
    <button @click="open = !open">Toggle</button>
    <button @click="count++">Increment: <span x-text="count"></span></button>
    
    <div x-show="open" x-transition>
        <p>This content is toggleable!</p>
    </div>
</div>
```

### Common Alpine.js Directives

- `x-data` - Define component data
- `x-show` / `x-if` - Conditional rendering
- `x-transition` - Add transitions
- `@click` - Event listener (shorthand for `x-on:click`)
- `x-text` - Update text content
- `x-bind:class` or `:class` - Dynamic classes
- `x-model` - Two-way binding

---

## 🔥 Combining Livewire + Alpine.js

The real power comes from combining both!

### Example: Stats Component

```blade
<div 
    x-data="{ 
        isRefreshing: false,
        lastUpdate: new Date().toLocaleTimeString()
    }"
>
    <p>Count: {{ $count }}</p>
    <p x-text="'Last update: ' + lastUpdate"></p>
    
    <button 
        wire:click="refresh"
        @click="
            isRefreshing = true; 
            lastUpdate = new Date().toLocaleTimeString();
            setTimeout(() => isRefreshing = false, 500)
        "
        :disabled="isRefreshing"
    >
        <span x-show="!isRefreshing">Refresh</span>
        <span x-show="isRefreshing">Loading...</span>
    </button>
</div>
```

### Magic Property: `$wire`

Access Livewire component from Alpine:

```blade
<div x-data="{ count: $wire.entangle('count') }">
    {{-- count is now synced with Livewire --}}
    <button @click="count++">Increment (Alpine)</button>
    <button wire:click="increment">Increment (Livewire)</button>
</div>
```

---

## 📖 Example Component Created

A demo component has been created at:
`resources/views/components/recruiter/⚡dashboard-stats.blade.php`

### Using the Dashboard Stats Component

Add this to your dashboard (`resources/views/recruiter/dashboard/index.blade.php`):

```blade
@extends('recruiter.layouts.app')

@section('content')
    <div class="space-y-6">
        <h1>Dashboard</h1>
        
        {{-- Livewire Stats Component with Alpine.js interactivity --}}
        <livewire:recruiter.dashboard-stats />
        
        {{-- Rest of your dashboard content --}}
    </div>
@endsection
```

**Features:**
- ✅ Real-time stats from database
- ✅ Auto-refresh every 30 seconds
- ✅ Manual refresh button with Alpine.js animation
- ✅ Live timestamp updates
- ✅ Smooth transitions

---

## 🛠️ Development Workflow

### Start Development Server

```bash
npm run dev
```

This starts Vite with hot module replacement (HMR). Changes to:
- Livewire components (`app/Livewire/**`)
- Views (`resources/views/**`)
- JavaScript (`resources/js/**`)

Will automatically reload the browser.

### Build for Production

```bash
npm run build
```

---

## 📚 Learn More

- **Livewire Docs**: https://livewire.laravel.com/docs
- **Alpine.js Docs**: https://alpinejs.dev/start-here
- **Livewire v4 Changes**: https://livewire.laravel.com/docs/upgrade

---

## 🎯 Best Practices

1. **Use Livewire for:** Server-side logic, database operations, complex state
2. **Use Alpine.js for:** UI interactions, animations, simple toggles
3. **Combine them for:** Rich, reactive components with minimal JavaScript
4. **Performance:** Use `#[Computed]` for expensive operations with caching

---

## 🐛 Troubleshooting

### Livewire styles not loading?
Make sure `@livewireStyles` is in the `<head>` and `@livewireScripts` before `</body>`.

### Alpine.js not working?
Check browser console for errors. Ensure assets are built: `npm run build`

### Hot reload not working?
1. Check `npm run dev` is running
2. Verify `vite.config.js` has correct refresh paths
3. Clear browser cache

---

**You're all set! 🎉**

Start building reactive, modern components with Livewire and Alpine.js!
