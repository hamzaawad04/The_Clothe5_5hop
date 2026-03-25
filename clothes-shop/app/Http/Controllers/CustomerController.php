<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of all customers.
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'customer');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filter by email verification status
        if ($request->filled('verification')) {
            if ($request->input('verification') === 'verified') {
                $query->whereNotNull('email_verified_at');
            } elseif ($request->input('verification') === 'unverified') {
                $query->whereNull('email_verified_at');
            }
        }

        // Sort options
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Paginate results
        $customers = $query->paginate(15);

        return view('customers.index', [
            'customers' => $customers,
            'search' => $request->input('search'),
            'verification' => $request->input('verification'),
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
        ]);
    }

    /**
     * Show the form for creating a new customer.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created customer in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Password::defaults()],
            'phone' => 'nullable|string|max:15|unique:users,phone',
        ]);

        try {
            $customer = User::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'customer',
                'phone' => $validated['phone'] ?? null,
            ]);

            return redirect()->route('customers.show', $customer->user_id)
                ->with('success', 'Customer created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Failed to create customer. Please try again.');
        }
    }

    /**
     * Display the specified customer.
     */
    public function show(User $customer)
    {
        // Ensure only customer role is accessed
        if ($customer->role !== 'customer') {
            abort(404);
        }

        // Load customer's orders with items
        $orders = Order::where('user_id', $customer->user_id)
            ->with('items')
            ->latest()
            ->get();

        // Calculate customer statistics
        $stats = [
            'total_orders' => $orders->count(),
            'total_spent' => $orders->sum('total_amount'),
            'avg_order_value' => $orders->count() > 0 ? $orders->avg('total_amount') : 0,
            'last_order' => $orders->first()?->created_at,
        ];

        return view('customers.show', [
            'customer' => $customer,
            'orders' => $orders,
            'stats' => $stats,
        ]);
    }

    /**
     * Show the form for editing the specified customer.
     */
    public function edit(User $customer)
    {
        // Ensure only customer role is accessed
        if ($customer->role !== 'customer') {
            abort(404);
        }

        return view('customers.edit', [
            'customer' => $customer,
        ]);
    }

    /**
     * Update the specified customer in the database.
     */
    public function update(Request $request, User $customer)
    {
        // Ensure only customer role is accessed
        if ($customer->role !== 'customer') {
            abort(404);
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users,email,' . $customer->user_id . ',user_id',
            'phone' => 'nullable|string|max:15|unique:users,phone,' . $customer->user_id . ',user_id',
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        try {
            $customer->update([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
            ]);

            // Update password if provided
            if (!empty($validated['password'])) {
                $customer->update([
                    'password' => Hash::make($validated['password']),
                ]);
            }

            return redirect()->route('customers.show', $customer->user_id)
                ->with('success', 'Customer updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Failed to update customer. Please try again.');
        }
    }

    /**
     * Remove the specified customer from the database.
     */
    public function destroy(User $customer)
    {
        // Ensure only customer role is accessed
        if ($customer->role !== 'customer') {
            abort(404);
        }

        try {
            // Check if customer has pending orders
            $pendingOrders = Order::where('user_id', $customer->user_id)
                ->whereIn('status', ['pending', 'processing'])
                ->count();

            if ($pendingOrders > 0) {
                return back()->with('error', 'Cannot delete customer with pending orders.');
            }

            $customerName = $customer->first_name . ' ' . $customer->last_name;
            $customer->delete();

            return redirect()->route('customers.index')
                ->with('success', "Customer '{$customerName}' deleted successfully.");
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete customer. Please try again.');
        }
    }

    /**
     * Export customers list to CSV.
     */
    public function export()
    {
        $customers = User::where('role', 'customer')
            ->orderBy('created_at', 'desc')
            ->get();

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=customers_" . date('Y-m-d') . ".csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $callback = function () use ($customers) {
            $file = fopen('php://output', 'w');
            
            // Write headers
            fputcsv($file, [
                'Customer ID',
                'First Name',
                'Last Name',
                'Email',
                'Phone',
                'Email Verified',
                'Registration Date'
            ]);

            // Write customer data
            foreach ($customers as $customer) {
                fputcsv($file, [
                    $customer->user_id,
                    $customer->first_name,
                    $customer->last_name,
                    $customer->email,
                    $customer->phone ?? 'N/A',
                    $customer->email_verified_at ? 'Yes' : 'No',
                    $customer->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get customer analytics/dashboard.
     */
    public function analytics()
    {
        $totalCustomers = User::where('role', 'customer')->count();
        $verifiedCustomers = User::where('role', 'customer')->whereNotNull('email_verified_at')->count();
        $unverifiedCustomers = $totalCustomers - $verifiedCustomers;

        // Top customers by spending
        $topCustomers = User::where('role', 'customer')
            ->withSum('orders', 'total_amount')
            ->orderBy('orders_sum_total_amount', 'desc')
            ->limit(10)
            ->get();

        // Customers by registration date (last 7 days)
        $newCustomersLastWeek = User::where('role', 'customer')
            ->where('created_at', '>=', now()->subDays(7))
            ->count();

        return view('customers.analytics', [
            'totalCustomers' => $totalCustomers,
            'verifiedCustomers' => $verifiedCustomers,
            'unverifiedCustomers' => $unverifiedCustomers,
            'topCustomers' => $topCustomers,
            'newCustomersLastWeek' => $newCustomersLastWeek,
        ]);
    }

    /**
     * Bulk delete customers.
     */
    public function bulkDelete(Request $request)
    {
        $validated = $request->validate([
            'customer_ids' => 'required|array|min:1',
            'customer_ids.*' => 'required|integer|exists:users,user_id',
        ]);

        try {
            $deleted = User::whereIn('user_id', $validated['customer_ids'])
                ->where('role', 'customer')
                ->delete();

            return response()->json([
                'success' => true,
                'message' => "{$deleted} customer(s) deleted successfully.",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete customers. Some may have pending orders.',
            ], 400);
        }
    }

    /**
     * Get customer by ID (for AJAX).
     */
    public function getCustomer(User $customer)
    {
        if ($customer->role !== 'customer') {
            return response()->json(['error' => 'Not found'], 404);
        }

        return response()->json([
            'user_id' => $customer->user_id,
            'first_name' => $customer->first_name,
            'last_name' => $customer->last_name,
            'email' => $customer->email,
            'phone' => $customer->phone,
            'email_verified' => $customer->email_verified_at !== null,
            'created_at' => $customer->created_at,
        ]);
    }
}
