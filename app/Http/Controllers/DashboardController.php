<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Models\Journal;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Statistik Cepat
        $todayJournalsCount = Journal::whereDate('date', $today)->count();
        $totalTeachers = Teacher::count();
        $totalClassrooms = Classroom::count();

        // Fitur Baru: Daftar Guru Mengajar Hari Ini
        $todayActivities = Journal::with(['teacher', 'subject', 'classroom'])
            ->whereDate('date', $today)
            ->latest()
            ->get();

        // Data Grafik: Aktivitas Mengajar 7 Hari Terakhir
        $chartData = [
            'labels' => [],
            'data' => []
        ];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $chartData['labels'][] = $date->isoFormat('D MMM');
            $chartData['data'][] = Journal::whereDate('date', $date)->count();
        }

        return view('dashboard', compact(
            'todayJournalsCount', 
            'totalTeachers', 
            'totalClassrooms', 
            'todayActivities', 
            'chartData'
        ));
    }
}