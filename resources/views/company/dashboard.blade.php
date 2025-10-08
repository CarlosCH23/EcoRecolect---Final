<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl">Panel Empresa Recolectora</h2>
  </x-slot>

  <div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white shadow rounded-lg p-6">
        <p class="mb-2">Bienvenido, {{ auth()->user()->name }} 👋</p>
        <p class="text-sm text-gray-600">Gestiona tus servicios y rendimiento.</p>

      {{-- 🔹 MÉTRICAS PRINCIPALES PARA EMPRESA RECOLECTORA --}}
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        {{-- Programados Hoy --}}
        <div class="card p-4 sm:p-5">
          <div class="flex justify-between items-start">
            <div class="space-y-1">
              <p class="text-[13px] text-slate-500">Servicios Programados Hoy</p>
              <p class="text-2xl font-extrabold text-ink">{{ number_format($metrics['totalProgramados']?? 0) }}</p>
              <p class="text-[11px] text-muted">Recolector asignado</p>
            </div>
            <span class="rounded-full bg-slate-100 text-slate-500 h-8 w-8 inline-flex items-center justify-center">📅</span>
          </div>
        </div>

        {{-- Completados Hoy --}}
        <div class="card p-4 sm:p-5">
          <div class="flex justify-between items-start">
            <div class="space-y-1">
              <p class="text-[13px] text-slate-500">Completados Hoy</p>
              <p class="text-2xl font-extrabold text-ink">{{ number_format($metrics['completadosHoy']?? 0)}}</p>
              <p class="text-[11px] text-muted">{{ $metrics['porcentajeCompletado'] }}% completados</p>
            </div>
            <span class="rounded-full bg-blue-100 text-blue-500 h-8 w-8 inline-flex items-center justify-center">✅</span>
          </div>
        </div>

        {{-- Peso Total --}}
        <div class="card p-4 sm:p-5">
          <div class="flex justify-between items-start">
            <div class="space-y-1">
              <p class="text-[13px] text-slate-500">Peso Total</p>
              <p class="text-2xl font-extrabold text-ink">{{ number_format($metrics['pesoTotal']?? 0, 2)}} kg</p>
              <p class="text-[11px] text-muted">Residuos procesados</p>
            </div>
            <span class="rounded-full bg-green-100 text-green-600 h-8 w-8 inline-flex items-center justify-center">⚖️</span>
          </div>
        </div>

        {{-- Flota Disponible --}}
        <div class="card p-4 sm:p-5">
          <div class="flex justify-between items-start">
            <div class="space-y-1">
              <p class="text-[13px] text-slate-500">Flota Disponible</p>
              <p class="text-2xl font-extrabold text-ink">{{ number_format($metrics['flotaDisponible']?? 0) }}</p>
              <p class="text-[11px] text-muted">Vehículos activos</p>
            </div>
            <span class="rounded-full bg-slate-100 text-slate-500 h-8 w-8 inline-flex items-center justify-center">🚛</span>
          </div>
        </div>

      </div>
            </div>      


        <div class="mt-8">
          <h3 class="font-semibold text-lg text-gray-800 mb-2">Servicios Asignados Hoy</h3>
          <p class="text-sm text-gray-500 mb-4">Recolecciones programadas para tu empresa.</p>

          <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead class="bg-gray-100 text-gray-700 text-sm">
              <tr>
                <th class="py-2 px-3 text-left">Cliente</th>
                <th class="py-2 px-3 text-left">Dirección</th>
                <th class="py-2 px-3 text-left">Tipo Residuo</th>
                <th class="py-2 px-3 text-left">Hora</th>
                <th class="py-2 px-3 text-left">Estado</th>
                <th class="py-2 px-3 text-left">Acciones</th>
              </tr>
            </thead>
            <tbody class="text-sm text-gray-600">
              <tr>
                <td class="py-2 px-3">Clínica Mascotín</td>
                <td class="py-2 px-3">Cra 12 #45-23</td>
                <td class="py-2 px-3">Orgánicos</td>
                <td class="py-2 px-3">10:00 AM</td>
                <td class="py-2 px-3">Pendiente</td>
                <td class="py-2 px-3 flex gap-2">
                  <button class="px-2 py-1 bg-green-600 text-white rounded text-xs">Iniciar</button>
                  <button class="px-2 py-1 bg-blue-600 text-white rounded text-xs">Finalizar</button>
                  <button class="px-2 py-1 bg-yellow-500 text-white rounded text-xs">Reportar</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
