<x-app-layout :show-navigation="true">

    <x-slot name="sidebar">
        <x-admin-sidebar :activeItem="'customers'" />
    </x-slot>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold text-[#14213D]">Customer Management</h1>
            <a href="{{ route('admin.customers.create') }}"
                class="inline-flex items-center px-4 py-2 bg-[#14213D] text-[#FCA311] font-semibold rounded hover:bg-[#FCA311] hover:text-[#14213D] transition">
                Add Customer
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 rounded border border-green-200 bg-green-50 text-green-700 px-4 py-3">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 rounded border border-red-200 bg-red-50 text-red-700 px-4 py-3">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Search and Filter Form -->
            <div class="mb-6 bg-white shadow-sm rounded-lg p-4">
                <form method="GET" action="{{ route('admin.customers.index') }}" class="flex items-end gap-4">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Name, email, or phone..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#14213D] focus:border-[#14213D]">
                    </div>
                    <div class="w-40">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                        <select name="role" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#14213D] focus:border-[#14213D]">
                            <option value="">All Roles</option>
                            <option value="customer" {{ request('role') === 'customer' ? 'selected' : '' }}>Customer</option>
                            <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                    <div class="w-40">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Verification</label>
                        <select name="verification" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#14213D] focus:border-[#14213D]">
                            <option value="">All Status</option>
                            <option value="verified" {{ request('verification') === 'verified' ? 'selected' : '' }}>Verified</option>
                            <option value="unverified" {{ request('verification') === 'unverified' ? 'selected' : '' }}>Unverified</option>
                        </select>
                    </div>
                    <button type="submit" class="px-6 py-2 bg-[#14213D] text-[#FCA311] font-semibold rounded hover:bg-[#FCA311] hover:text-[#14213D] transition whitespace-nowrap">
                        Filter
                    </button>
                </form>
            </div>

            <div class="overflow-x-auto bg-white shadow-sm rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">ID</th>
                            <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">Name</th>
                            <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">Email</th>
                            <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">Phone</th>
                            <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">Role</th>
                            <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">Verified</th>
                            <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">Joined</th>
                            <th class="px-6 py-3 text-left text-m font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($customers as $customer)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $customer->user_id }}</td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-semibold text-gray-900">{{ $customer->first_name }} {{ $customer->last_name }}</p>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $customer->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $customer->phone ?? 'N/A' }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-semibold {{ $customer->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ ucfirst($customer->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @if ($customer->email_verified_at)
                                        <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-semibold bg-green-100 text-green-800">
                                            ✓ Verified
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-semibold bg-yellow-100 text-yellow-800">
                                            Unverified
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $customer->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('admin.customers.show', $customer->user_id) }}"
                                            class="text-sm font-semibold text-[#14213D] hover:underline">
                                            View
                                        </a>
                                        <a href="{{ route('admin.customers.edit', $customer->user_id) }}"
                                            class="text-sm font-semibold text-[#14213D] hover:underline">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.customers.destroy', $customer->user_id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-sm font-semibold text-red-500 hover:underline"
                                                onclick="return confirm('Delete this customer?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">No customers found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($customers->hasPages())
                <div class="mt-6">
                    {{ $customers->links() }}
                </div>
            @endif

        </div>
    </div>

</x-app-layout>
