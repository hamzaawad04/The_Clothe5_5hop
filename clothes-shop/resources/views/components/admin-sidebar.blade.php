@props(['activeItem' => null])

@php
    $base = 'block px-4 py-2 rounded-lg text-sm font-medium transition';
    $inactiveClass = 'text-gray-700 hover:bg-[#14213D] hover:text-[#FCA311]';
    $activeClass = 'bg-[#14213D] text-[#FCA311]';

    $isActive = function (array $patterns, ?string $itemKey = null) use ($activeItem): bool {
        if ($itemKey !== null && $activeItem === $itemKey) {
            return true;
        }
        foreach ($patterns as $pattern) {
            if (request()->routeIs($pattern)) {
                return true;
            }
        }
        return false;
    };
@endphp

<aside style="width:256px; min-height:100%; background:white; border-right:1px solid #e5e7eb; box-shadow:2px 0 4px rgba(0,0,0,0.05);">

    <div style="height:64px; display:flex; align-items:center; justify-content:center; border-bottom:1px solid #e5e7eb;">
        <span class="text-xl font-bold text-[#14213D]">Admin Menu</span>
    </div>

    <nav class="p-4 space-y-4">
        <a href="{{ route('admin.dashboard.admindashboard') }}"
           class="{{ $base }} {{ $isActive(['admin.dashboard'], 'dashboard') ? $activeClass : $inactiveClass }}">
            Dashboard
        </a>
        <a href="{{ route('admin.products.index') }}"
           class="{{ $base }} {{ $isActive(['admin.products.*'], 'products') ? $activeClass : $inactiveClass }}">
            Product Management
        </a>
        <a href="{{ route('admin.orders.index') }}"
           class="{{ $base }} {{ $isActive(['admin.orders.*'], 'orders') ? $activeClass : $inactiveClass }}">
            Order Management
        </a>
        <a href="{{ route('admin.dashboard.sales-analytics') }}"
           class="{{ $base }} {{ $isActive(['admin.sales-analytics'], 'sales-analytics') ? $activeClass : $inactiveClass }}">
            Sales & Analytics
        </a>
        <a href="{{ route('admin.customers.index') }}"
           class="{{ $base }} {{ $isActive(['admin.customers.*'], 'customers') ? $activeClass : $inactiveClass }}">
            User Management
        </a>

    </nav>

</aside>