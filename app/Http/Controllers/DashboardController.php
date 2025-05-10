<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Tache;
use App\Models\User;
use Carbon\Carbon;

use function PHPSTORM_META\map;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $totalUsers = User::count();
        $totalProjects =Project::count();
        $totalTasks = Tache::count();
        $completedTasks = Tache::where('statut', 'completed')->count();
        $pendingTasks = Tache::where('statut', 'on_hold')->count();
        $overdueTasks = Tache::where('date_fin', '<', now())->where('statut', '!=', 'completed')->count();
        
        $days = collect(range(6, 0))->map(function ($i) {
            return Carbon::today()->subDays($i)->format('Y-m-d');
        });
    
        $created = Tache::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->whereBetween('created_at', [now()->subDays(6)->startOfDay(), now()->endOfDay()])
            ->groupBy('date')
            ->pluck('total', 'date');
    
        $updated = Tache::select(DB::raw('DATE(updated_at) as date'), DB::raw('count(*) as total'))
            ->whereBetween('updated_at', [now()->subDays(6)->startOfDay(), now()->endOfDay()])
            ->groupBy('date')
            ->pluck('total', 'date');
    
        $completed = Tache::select(DB::raw('DATE(updated_at) as date'), DB::raw('count(*) as total'))
            ->where('statut', 'completed')
            ->whereBetween('updated_at', [now()->subDays(6)->startOfDay(), now()->endOfDay()])
            ->groupBy('date')
            ->pluck('total', 'date');
    
        $labels = $days->map(function ($day) {
            return Carbon::parse($day)->format('d M');
        });
    
        $createdData = $days->map(fn($day) => $created[$day] ?? 0);
        $updatedData = $days->map(fn($day) => $updated[$day] ?? 0);
        $completedData = $days->map(fn($day) => $completed[$day] ?? 0);
    
      
        return view('pages.admin.dashboard', compact(
            'totalUsers', 
            'totalProjects', 
            'totalTasks', 
            'completedTasks', 
            'pendingTasks', 
            'overdueTasks' , 'labels',
            'createdData',
            'updatedData',
            'completedData' ,
        ));
    }
}
