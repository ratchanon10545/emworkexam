@extends('layouts.default')
@section('Title' , 'Graph')
@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Users graph by age</h2>

    <canvas id="ageChart" width="600" height="300"></canvas>

    <div class="flex justify-between">
        <a href="{{route('home')}}" class="text-white bg-gray-600 p-2 rounded-md">Back</a>
        <a href="{{route('users.age_report')}}" class="text-white bg-blue-600 p-2 rounded-md">Report</a>
    </div>
</div>

<script
    {{-- ใช้ Chart.js --}}
    src="https://cdn.jsdelivr.net/npm/chart.js">
</script>
<script>
    const ctx = document.getElementById('ageChart').getContext('2d');

    const ageChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Number of Users',
                data: @json($data),
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Age'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number'
                    },
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endsection