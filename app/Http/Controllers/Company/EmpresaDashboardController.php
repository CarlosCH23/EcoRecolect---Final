<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CollectionSchedule;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EmpresaDashboardController extends Controller
{
    public function index()
    {
        $companyId = Auth::id();
        $today = Carbon::today();

        // 🔹 1. Total programados para hoy
        $totalProgramados = CollectionSchedule::where('collector_company_id', $companyId)
            ->whereDate('scheduled_for', $today)
            ->count();

        // 🔹 2. Total completados
        $totalCompletados = CollectionSchedule::where('collector_company_id', $companyId)
            ->where('status', CollectionSchedule::STATUS_COMPLETED)
            ->count();

        // 🔹 3. Porcentaje completado
        $porcentajeCompletado = $totalProgramados > 0
            ? round(($totalCompletados / $totalProgramados) * 100, 1)
            : 0;

        // 🔹 4. Empaquetar métricas
        $metrics = [
            'totalProgramados'     => $totalProgramados,
            'totalCompletados'     => $totalCompletados,
            'porcentajeCompletado' => $porcentajeCompletado,
        ];

        return view('company.dashboard', compact('metrics'));
    }
}
