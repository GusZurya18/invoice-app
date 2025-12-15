@extends('layouts.master')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

    {{-- Custom Styles --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .stats-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(118, 75, 162, 0.3);
        }

        .chart-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .revenue-highlight {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .counter {
            transition: all 0.3s ease;
        }

        /* Fix chart container height */
        .chart-wrapper {
            position: relative;
            height: 400px;
            width: 100%;
        }

        .chart-wrapper canvas {
            max-height: 400px !important;
        }
    </style>

    <div class="gradient-bg">
        <div class="p-6">
            {{-- Header Card - Simple Design --}}
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-white mb-2 flex items-center">
                            Selamat Datang kembali, {{ $user->name }}!
                            <span class="ml-2">👋</span>
                        </h1>
                        <p class="text-white">Berikut ringkasan bisnis Anda untuk hari ini.</p>
                    </div>
                </div>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                {{-- Total Invoice Card --}}
                <div class="stats-card card-hover p-6 rounded-2xl">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-file-invoice text-blue-600 text-xl"></i>
                        </div>
                        <span class="text-green-500 text-sm font-medium">↗ 12%</span>
                    </div>
                    <h3 class="text-gray-600 text-sm font-medium">Total Invoice</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2 counter" data-target="{{ $totalInvoices }}">0</p>
                </div>

                {{-- Total Task Bulan Ini --}}
                <div class="stats-card card-hover p-6 rounded-2xl">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-box text-orange-600 text-xl"></i>
                        </div>
                        <span class="text-green-500 text-sm font-medium">↗ 8%</span>
                    </div>
                    <h3 class="text-gray-600 text-sm font-medium">Total Task Bulan Ini</h3>
                    <p class="text-3xl font-bold text-gray-800 mt-2 counter" data-target="{{ $totalTaskBulanIni }}">0</p>
                </div>
            </div>
        </div>
    </div>

    {{-- CDN Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ============================
            // Animate Counters
            // ============================
            function animateCounter(element) {
                const target = parseInt(element.getAttribute('data-target'));
                let count = 0;
                const increment = target / 50; // 50 langkah biar smooth
                const timer = setInterval(() => {
                    count += increment;
                    if (count >= target) {
                        element.textContent = target.toLocaleString('id-ID');
                        clearInterval(timer);
                    } else {
                        element.textContent = Math.floor(count).toLocaleString('id-ID');
                    }
                }, 30);
            }

            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => animateCounter(counter));

            // ============================
            // Chart Produk Terlaris (Bar)
            // ============================
            const ctxTopProducts = document.getElementById('topProductsChart').getContext('2d');
            new Chart(ctxTopProducts, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($topProducts->pluck('product_name')) !!},
                    datasets: [{
                        label: 'Total Terjual',
                        data: {!! json_encode($topProducts->pluck('total_sold')) !!},
                        backgroundColor: [
                            'rgba(99, 102, 241, 0.8)',
                            'rgba(139, 92, 246, 0.8)',
                            'rgba(236, 72, 153, 0.8)',
                            'rgba(59, 130, 246, 0.8)',
                            'rgba(16, 185, 129, 0.8)',
                            'rgba(245, 158, 11, 0.8)',
                            'rgba(239, 68, 68, 0.8)'
                        ],
                        borderColor: [
                            'rgba(99, 102, 241, 1)',
                            'rgba(139, 92, 246, 1)',
                            'rgba(236, 72, 153, 1)',
                            'rgba(59, 130, 246, 1)',
                            'rgba(16, 185, 129, 1)',
                            'rgba(245, 158, 11, 1)',
                            'rgba(239, 68, 68, 1)'
                        ],
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                color: '#6B7280'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#6B7280'
                            }
                        }
                    },
                    animation: {
                        duration: 1500,
                        easing: 'easeInOutQuart'
                    }
                }
            });

            // ============================
            // Chart Penjualan (Doughnut)
            // ============================
            const ctxSales = document.getElementById('salesChart').getContext('2d');
            new Chart(ctxSales, {
                type: 'doughnut',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Persentase Penjualan',
                        data: @json($data),
                        backgroundColor: [
                            '#3b82f6', '#22c55e', '#ef4444', '#eab308',
                            '#8b5cf6', '#ec4899', '#14b8a6'
                        ],
                        borderColor: '#ffffff',
                        borderWidth: 3,
                        hoverOffset: 15
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '65%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 20,
                                font: {
                                    size: 12,
                                    family: 'Inter'
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: '#667eea',
                            borderWidth: 1,
                            cornerRadius: 8,
                            callbacks: {
                                label: function(context) {
                                    let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    let value = context.raw;
                                    let percentage = ((value / total) * 100).toFixed(1);
                                    return `${context.label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    },
                    animation: {
                        animateRotate: true,
                        duration: 1500
                    }
                }
            });

            // ============================
            // Chart Kategori (Bar) - Updated Style
            // ============================
            const ctxCategory = document.getElementById('categoryChart').getContext('2d');
            new Chart(ctxCategory, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($categorySales->pluck('category')) !!},
                    datasets: [{
                        label: 'Total Terjual',
                        data: {!! json_encode($categorySales->pluck('total_sold')->map(fn($v) => (int) $v)) !!},
                        backgroundColor: [
                            'rgba(99, 102, 241, 0.8)',
                            'rgba(16, 185, 129, 0.8)',
                            'rgba(239, 68, 68, 0.8)',
                            'rgba(245, 158, 11, 0.8)',
                            'rgba(139, 92, 246, 0.8)',
                            'rgba(236, 72, 153, 0.8)',
                            'rgba(59, 130, 246, 0.8)'
                        ],
                        borderColor: [
                            'rgba(99, 102, 241, 1)',
                            'rgba(16, 185, 129, 1)',
                            'rgba(239, 68, 68, 1)',
                            'rgba(245, 158, 11, 1)',
                            'rgba(139, 92, 246, 1)',
                            'rgba(236, 72, 153, 1)',
                            'rgba(59, 130, 246, 1)'
                        ],
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: '#667eea',
                            borderWidth: 1,
                            cornerRadius: 8,
                            callbacks: {
                                label: function(context) {
                                    return `${context.dataset.label}: ${context.raw}`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                color: '#6B7280'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#6B7280'
                            }
                        }
                    },
                    animation: {
                        duration: 1500,
                        easing: 'easeInOutQuart'
                    }
                }
            });
        });
    </script>

@endsection
