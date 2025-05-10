@extends('layouts.layouts')

@section('content')
<div class="container">
  <div class="row g-4">

    <!-- Total Users -->
    <div class="col-md-4">
      <div class="card shadow-sm border-left-primary">
        <div class="card-body">
          <h5 class="card-title">Total Users</h5>
          <h2>{{ $totalUsers }}</h2>
          <i class="bi bi-people-fill text-primary fs-1"></i>
        </div>
      </div>
    </div>

    <!-- Total Projects -->
    <div class="col-md-4">
      <div class="card shadow-sm border-left-success">
        <div class="card-body">
          <h5 class="card-title">Total Projects</h5>
          <h2>{{ $totalProjects }}</h2>
          <i class="bi bi-folder-fill text-success fs-1"></i>
        </div>
      </div>
    </div>

    <!-- Total Tasks -->
    <div class="col-md-4">
      <div class="card shadow-sm border-left-info">
        <div class="card-body">
          <h5 class="card-title">Total Tasks</h5>
          <h2>{{ $totalTasks }}</h2>
          <i class="bi bi-list-task text-info fs-1"></i>
        </div>
      </div>
    </div>

    <!-- Completed Tasks -->
    <div class="col-md-4">
      <div class="card shadow-sm border-left-success">
        <div class="card-body">
          <h5 class="card-title">Completed Tasks</h5>
          <h2>{{ $completedTasks }}</h2>
          <i class="bi bi-check-circle-fill text-success fs-1"></i>
        </div>
      </div>
    </div>

    <!-- Pending Tasks -->
    <div class="col-md-4">
      <div class="card shadow-sm border-left-warning">
        <div class="card-body">
          <h5 class="card-title">Pending Tasks</h5>
          <h2>{{ $pendingTasks }}</h2>
          <i class="bi bi-hourglass-split text-warning fs-1"></i>
        </div>
      </div>
    </div>

    <!-- Overdue Tasks -->
    <div class="col-md-4">
      <div class="card shadow-sm border-left-danger">
        <div class="card-body">
          <h5 class="card-title">Overdue Tasks</h5>
          <h2>{{ $overdueTasks }}</h2>
          <i class="bi bi-exclamation-triangle-fill text-danger fs-1"></i>
        </div>
      </div>
    </div>
    <div class="card mt-4">
      <div class="card-header">
        <h5>Daily Task Activity (Last 7 Days)</h5>
      </div>
      <div class="card-body">
        <div id="dailyActivityChart" style="height: 400px;"></div>
      </div>
    </div>
    
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    var options = {
      chart: {
        type: 'line',
        height: 400
      },
      series: [{
        name: 'Created',
        data: @json($createdData)
      }, {
        name: 'Updated',
        data: @json($updatedData)
      }, {
        name: 'Completed',
        data: @json($completedData)
      }],
      xaxis: {
        categories: @json($labels),
        title: { text: 'Date' }
      },
      yaxis: {
        title: { text: 'Number of Tasks' }
      },
      colors: ['#007bff', '#ffc107', '#28a745'],
      stroke: {
        curve: 'smooth',
        width: 2
      },
      markers: {
        size: 4
      }
    };

    var chart = new ApexCharts(document.querySelector("#dailyActivityChart"), options);
    chart.render();
  });
</script>

@endsection
