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

<aside class="fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 shadow-lg z-20">
    <div class="h-20 flex items-center justify-center border-b border-gray-200">
        <span class="text-xl font-bold text-[#14213D]">Admin Menu</span>
    </div>

    <nav class="p-4 space-y-4">
        <a href="{{ route('admin.dashboard') }}"
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

        <a href="{{ route('admin.sales-analytics') }}"
           class="{{ $base }} {{ $isActive(['admin.sales-analytics'], 'sales-analytics') ? $activeClass : $inactiveClass }}">
            Sales & Analytics
        </a>

        <a href="#"
           class="{{ $base }} {{ $activeItem === 'customers' ? $activeClass : $inactiveClass }}">
            Customer Management
        </a>

        <a href="#"
           class="{{ $base }} {{ $activeItem === 'inventory' ? $activeClass : $inactiveClass }}">
            Inventory & Supply
        </a>

        <a href="#"
           class="{{ $base }} {{ $activeItem === 'roles' ? $activeClass : $inactiveClass }}">
            User Roles & Permissions
        </a>

        <a href="#"
           class="{{ $base }} {{ $activeItem === 'payments' ? $activeClass : $inactiveClass }}">
            Payments & Shipments
        </a>
    </nav>
</aside>