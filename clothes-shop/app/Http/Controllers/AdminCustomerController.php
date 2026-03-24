<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminCustomerController extends Controller
{
    /**
     * Display a listing of all customers.
     */
    public function index(Request $request)
    {
        $query = User::query();

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

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->input('role'));
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
        
        // Validate sort column to prevent SQL injection
        $allowed_sorts = ['user_id', 'first_name', 'last_name', 'email', 'role', 'created_at'];
        if (!in_array($sortBy, $allowed_sorts)) {
            $sortBy = 'created_at';
        }
        
        $query->orderBy($sortBy, $sortOrder);

        // Paginate results
        $customers = $query->paginate(15);

        return view('admin.customers.index', [
            'customers' => $customers,
            'search' => $request->input('search'),
            'role' => $request->input('role'),
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
        $roles = ['customer', 'admin'];
        return view('admin.customers.create', compact('roles'));
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
            'role' => 'required|in:customer,admin',
        ]);

        try {
            $customer = User::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
                'phone' => $validated['phone'] ?? null,
            ]);

            return redirect()->route('admin.customers.show', $customer->user_id)
                ->with('success', 'Customer created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Failed to create customer. Please try again.');
        }
    }

    /**
     * Display the specified customer with detailed information.
     */
    public function show(User $customer)
    {
        // Load customer's orders with items
        $orders = Order::where('user_id', $customer->user_id)
            ->with('items')
            ->latest()
            ->get();

        // Calculate customer statistics
        $stats = [
            'total_orders' => $orders->count(),
            'total_spent' => $orders->sum('total_amount'),
            'avg_order_value' => $orders->count() > 0 ? round($orders->avg('total_amount'), 2) : 0,
            'last_order' => $orders->first()?->created_at,
        ];

        return view('admin.customers.show', [
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
        $roles = ['customer', 'admin'];
        return view('admin.customers.edit', [
            'customer' => $customer,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified customer in the database.
     */
    public function update(Request $request, User $customer)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users,email,' . $customer->user_id . ',user_id',
            'phone' => 'nullable|string|unique:users,phone,' . $customer->user_id . ',user_id',
            'role' => 'required|in:customer,admin',
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        try {
            // Store old role for logging purposes
            $oldRole = $customer->role;

            // Update basic customer details
            $customer->update([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'role' => $validated['role'],
            ]);

            // Update password if provided
            if (!empty($validated['password'])) {
                $customer->update([
                    'password' => Hash::make($validated['password']),
                ]);
            }

            // Create a success message with role change notification
            $message = 'Customer updated successfully.';

            return redirect()->route('admin.customers.show', $customer->user_id)
                ->with('success', $message);
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
        try {
            $allowedStatuses = ['Completed', 'Refunded'];
            $hasBlockedOrders = Order::where('user_id', $customer->user_id)
                ->whereNotIn('status', $allowedStatuses)
                ->exists();

            if ($hasBlockedOrders) {
                return back()->with('error', "Can't delete user unless all orders are Completed or Refunded.");
            }

            $customerName = $customer->first_name . ' ' . $customer->last_name;
            $email = $customer->email;

            $orders = $customer->orders()->with(['items', 'return'])->get();

            foreach ($orders as $order) {
                $order->return()->delete();
                $order->items()->delete();
                $order->delete();
            }

            $customer->cart()->delete();
            $customer->delete();

            return redirect()->route('admin.customers.index')
                ->with('success', "Customer '{$customerName}' ({$email}) has been deleted successfully.");
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete customer. Please try again.');
        }
    }

    /**
     * Bulk action handler - change role for multiple customers
     */
    public function bulkChangeRole(Request $request)
    {
        $validated = $request->validate([
            'customer_ids' => 'required|array|min:1',
            'customer_ids.*' => 'required|integer|exists:users,user_id',
            'new_role' => 'required|in:customer,admin',
        ]);

        try {
            $updated = User::whereIn('user_id', $validated['customer_ids'])
                ->update(['role' => $validated['new_role']]);

            return redirect()->route('admin.customers.index')
                ->with('success', "{$updated} customer(s) role updated to '{$validated['new_role']}'.");
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update customer roles. Please try again.');
        }
    }

    /**
     * Export customers list to CSV.
     */
    public function export()
    {
        $customers = User::orderBy('created_at', 'desc')->get();

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=customers_" . date('Y-m-d_H-i-s') . ".csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        );

        $callback = function () use ($customers) {
            $file = fopen('php://output', 'w');
            
            // Write CSV headers
            fputcsv($file, [
                'Customer ID',
                'First Name',
                'Last Name',
                'Email',
                'Phone',
                'Role',
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
                    ucfirst($customer->role),
                    $customer->email_verified_at ? 'Yes' : 'No',
                    $customer->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get customer statistics (for dashboard).
     */
    public function statistics()
    {
        $totalCustomers = User::count();
        $adminCount = User::where('role', 'admin')->count();
        $customerCount = User::where('role', 'customer')->count();
        $verifiedCount = User::whereNotNull('email_verified_at')->count();

        return view('admin.customers.statistics', [
            'totalCustomers' => $totalCustomers,
            'adminCount' => $adminCount,
            'customerCount' => $customerCount,
            'verifiedCount' => $verifiedCount,
            'unverifiedCount' => $totalCustomers - $verifiedCount,
        ]);
    }

    /**
     * Verify customer email (admin action).
     */
    public function verifyEmail(User $customer)
    {
        try {
            $customer->update([
                'email_verified_at' => now(),
            ]);

            return redirect()->route('admin.customers.show', $customer->user_id)
                ->with('success', 'Customer email verified successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to verify customer email. Please try again.');
        }
    }

    /**
     * Unverify customer email (admin action).
     */
    public function unverifyEmail(User $customer)
    {
        try {
            $customer->update([
                'email_verified_at' => null,
            ]);

            return redirect()->route('admin.customers.show', $customer->user_id)
                ->with('success', 'Customer email verification removed.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to unverify customer email. Please try again.');
        }
    }

    /**
     * Get customer details via AJAX.
     */
    public function getCustomerData(User $customer)
    {
        return response()->json([
            'user_id' => $customer->user_id,
            'first_name' => $customer->first_name,
            'last_name' => $customer->last_name,
            'email' => $customer->email,
            'phone' => $customer->phone,
            'role' => $customer->role,
            'email_verified' => $customer->email_verified_at !== null,
            'created_at' => $customer->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $customer->updated_at->format('Y-m-d H:i:s'),
        ]);
    }
}
