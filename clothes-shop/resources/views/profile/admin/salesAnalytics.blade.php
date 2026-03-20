<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Sales Analytics</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-playfair text-black">

    <div class="min-h-screen w-full flex relative">

        <!-- SIDEBAR -->
         
        <x-admin-sidebar/>

        <!-- MAIN CONTENT -->
        <div class="flex-1 ml-64 flex">
            <main class="p-10 w-full min-w-0">

                <h1 class="text-3xl font-bold text-[#14213D] mb-6">Admin Sales Analytics</h1>

                <!-- TOTAL ORDERS CARD -->
                <div class="mb-6 p-6 bg-white shadow rounded-lg flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Orders Placed</p>
                        <p id="total-orders" class="text-4xl font-bold text-[#14213D]">{{ $totalOrders }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-400">Auto-refresh every 15 seconds</p>
                        <p id="order-updated-at" class="text-sm text-gray-500">{{ now()->format('Y-m-d H:i:s') }}</p>
                    </div>
                </div>

                <!-- CHARTS -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="p-6 bg-white shadow rounded-lg">
                        <h2 class="text-xl font-semibold text-[#14213D] mb-4">Top Products by Quantity Sold</h2>
                        <div id="top-products-chart" class="w-full h-[400px]"></div>
                    </div>

                    <div class="p-6 bg-white shadow rounded-lg">
                        <h2 class="text-xl font-semibold text-[#14213D] mb-4">Products Sold by Category</h2>
                        <div id="category-pie-chart" class="w-full h-[400px]"></div>
                    </div>
                </div>

                <!-- TABLE -->
                <div class="mt-6 p-6 bg-white shadow rounded-lg">
                    <h2 class="text-xl font-semibold text-[#14213D] mb-4">Top Products Table</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Rank</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Product</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Quantity Sold</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @foreach($topProducts as $index => $item)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $item->product->name ?? 'Unknown' }}</td>
                                        <td class="px-6 py-4 text-sm font-semibold text-gray-700">{{ $item->total_qty }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

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
                colors: ['#14213D'],
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
                colors: ['#14213D', '#1F3A5F', '#FCA311', '#9CA3AF', '#E5E7EB']
            });
        }
    </script>

</body>
</html>
