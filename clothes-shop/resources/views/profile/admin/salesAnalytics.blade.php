<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Sales Analytics</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="min-h-screen w-full flex relative">

        <!-- SIDEBAR -->
        <aside class="fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 shadow-lg z-20">
            <div class="h-20 flex items-center justify-center border-b border-gray-200">
                <span class="text-xl font-bold text-blue-700">Admin Menu</span>
            </div>

            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-100 hover:text-blue-800">Dashboard</a>
                <a href="{{ route('products.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-100 hover:text-blue-800">Product Management</a>
                <a href="#" class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-100 hover:text-blue-800">Order Management</a>
                <a href="{{ url('/admin/sales-analytics') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-100 hover:text-blue-800">Sales & Analytics</a>
                <a href="#" class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-100 hover:text-blue-800">Customer Management</a>
                <a href="#" class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-100 hover:text-blue-800">Inventory & Supply</a>
                <a href="#" class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-100 hover:text-blue-800">User Roles & Permissions</a>
                <a href="#" class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-100 hover:text-blue-800">Payments & Shipments</a>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="flex-1 ml-64 flex">
            <main class="p-10 w-full min-w-0">

                <h1 class="text-3xl font-bold mb-6">Admin Sales Analytics</h1>

                <!-- TOTAL ORDERS CARD -->
                <div class="mb-6 p-6 bg-white shadow rounded-lg flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Orders Placed</p>
                        <p id="total-orders" class="text-4xl font-bold text-blue-600">{{ $totalOrders }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-400">Auto-refresh every 15 seconds</p>
                        <p id="order-updated-at" class="text-sm text-gray-500">{{ now()->format('Y-m-d H:i:s') }}</p>
                    </div>
                </div>

                <!-- CHARTS -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="p-6 bg-white shadow rounded-lg">
                        <h2 class="text-xl font-semibold mb-4">Top Products by Quantity Sold</h2>
                        <div id="top-products-chart" class="w-full h-[400px]"></div>
                    </div>

                    <div class="p-6 bg-white shadow rounded-lg">
                        <h2 class="text-xl font-semibold mb-4">Products Sold by Category</h2>
                        <div id="category-pie-chart" class="w-full h-[400px]"></div>
                    </div>
                </div>

                <!-- TABLE -->
                <div class="mt-6 p-6 bg-white shadow rounded-lg">
                    <h2 class="text-xl font-semibold mb-4">Top Products Table</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rank</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity Sold</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($topProducts as $index => $item)
                                    <tr>
                                        <td class="px-6 py-3">{{ $index + 1 }}</td>
                                        <td class="px-6 py-3">{{ $item->product->name ?? 'Unknown' }}</td>
                                        <td class="px-6 py-3">{{ $item->total_qty }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                @include('components.footer')

            </main>
        </div>
    </div>

    <!-- GOOGLE CHARTS -->
    <script src="https://www.gstatic.com/charts/loader.js"></script>

    <script>
        google.charts.load('current', { packages: ['corechart', 'bar'] });
        google.charts.setOnLoadCallback(drawCharts);

        const topProducts = @json(
            $topProducts->map(fn($item) => [
                $item->product->name ?? 'Unknown',
                (int) $item->total_qty,
            ])
        );

        const categoryBreakdown = @json(
            $categoryBreakdown->map(fn($item) => [
                $item->category_name,
                (int) $item->total_qty,
            ])
        );

        function drawCharts() {
            drawTopProductsChart();
            drawCategoryPieChart();
        }

        function drawTopProductsChart() {
            const data = new google.visualization.DataTable();
            data.addColumn('string', 'Product');
            data.addColumn('number', 'Quantity');
            data.addRows(topProducts);

            const chart = new google.visualization.BarChart(
                document.getElementById('top-products-chart')
            );

            chart.draw(data, {
                bars: 'horizontal',
                colors: ['#2563eb'],
                legend: { position: 'none' }
            });
        }

        function drawCategoryPieChart() {
            const data = new google.visualization.DataTable();
            data.addColumn('string', 'Category');
            data.addColumn('number', 'Quantity');
            data.addRows(categoryBreakdown);

            const chart = new google.visualization.PieChart(
                document.getElementById('category-pie-chart')
            );

            chart.draw(data, {
                pieHole: 0.42,
                colors: ['#2563eb', '#1e40af', '#60a5fa', '#93c5fd']
            });
        }
    </script>

</body>
</html>