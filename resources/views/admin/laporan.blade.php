@extends('layouts.administrator')

@section('title', 'Laporan & Analisis')

@section('content')

{{-- TOPBAR --}}
<div class="admin-topbar">
    <div>
        <div class="topbar-title">Laporan & Analisis</div>
        <div class="topbar-subtitle">Data agregat dari seluruh transaksi platform</div>
    </div>
</div>

{{-- STAT CARDS --}}
<div class="row g-3 mb-3">
    <div class="col-6 col-xl-3">
        <div class="laporan-stat-card">
            <div class="laporan-stat-icon">
                <i class="bi bi-recycle"></i>
            </div>
            <div class="laporan-stat-num">{{ $totalLimbahTon }} ton</div>
            <div class="laporan-stat-label">Total limbah tersalurkan</div>
            <div class="laporan-stat-trend up">
                <i class="bi bi-arrow-up-short"></i> 12% <span>dari bulan lalu</span>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="laporan-stat-card">
            <div class="laporan-stat-icon">
                <i class="bi bi-receipt"></i>
            </div>
            <div class="laporan-stat-num">{{ $totalTransaksi }}</div>
            <div class="laporan-stat-label">Total transaksi</div>
            <div class="laporan-stat-trend up">
                <i class="bi bi-arrow-up-short"></i> 6% <span>dari bulan lalu</span>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="laporan-stat-card">
            <div class="laporan-stat-icon">
                <i class="bi bi-box-seam"></i>
            </div>
            <div class="laporan-stat-num">{{ $rataRata }} kg</div>
            <div class="laporan-stat-label">Rata-rata per transaksi</div>
            <div class="laporan-stat-trend up">
                <i class="bi bi-arrow-up-short"></i> 3% <span>dari bulan lalu</span>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="laporan-stat-card">
            <div class="laporan-stat-icon">
                <i class="bi bi-pie-chart"></i>
            </div>
            <div class="laporan-stat-num">{{ $tingkatSelesai }}%</div>
            <div class="laporan-stat-label">Tingkat Penyelesaian</div>
            <div class="laporan-stat-trend up">
                <i class="bi bi-arrow-up-short"></i> 2% <span>dari bulan lalu</span>
            </div>
        </div>
    </div>
</div>

{{-- CHARTS ROW --}}
<div class="row g-3 mb-3">
    {{-- Bar Chart --}}
    <div class="col-12 col-xl-7">
        <div class="laporan-chart-card">
            <div class="laporan-chart-title">Volume limbah tersalurkan per minggu (kg)</div>
            <div class="laporan-chart-wrap">
                <canvas id="chartBar"></canvas>
            </div>
        </div>
    </div>

    {{-- Donut Chart --}}
    <div class="col-12 col-xl-5">
        <div class="laporan-chart-card">
            <div class="laporan-chart-title">Berdasarkan peruntukan</div>
            <div class="laporan-donut-wrap">
                <canvas id="chartDonut"></canvas>
                <div class="laporan-donut-legend" id="donutLegend"></div>
            </div>
        </div>
    </div>
</div>

{{-- TABEL ROW --}}
<div class="row g-3">
    {{-- Mitra Kuliner Teraktif --}}
    <div class="col-12 col-xl-6">
        <div class="laporan-table-card">
            <div class="laporan-table-title">Mitra kuliner teraktif</div>
            <table class="laporan-table w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Usaha</th>
                        <th>Total Listing</th>
                        <th>Total Tersalurkan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mitraAktif as $i => $mitra)
                        <tr>
                            <td>
                                <span class="laporan-rank">{{ $i + 1 }}</span>
                            </td>
                            <td class="laporan-usaha-name">{{ $mitra->nama_usaha }}</td>
                            <td>{{ $mitra->total_listing }}</td>
                            <td>
                                @php
                                    $kg = $mitra->total_tersalurkan ?? 0;
                                    echo $kg >= 1000
                                        ? round($kg / 1000, 1) . ' Ton'
                                        : $kg . ' Kg';
                                @endphp
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="laporan-lihat-semua">
                <a href="#">Lihat Semua <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>

    {{-- Pengelola Pangan Teraktif --}}
    <div class="col-12 col-xl-6">
        <div class="laporan-table-card">
            <div class="laporan-table-title">Pengelola teraktif</div>
            <table class="laporan-table w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Usaha</th>
                        <th>Total Listing</th>
                        <th>Total Tersalurkan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengelolaAktif as $i => $pengelola)
                        <tr>
                            <td>
                                <span class="laporan-rank">{{ $i + 1 }}</span>
                            </td>
                            <td class="laporan-usaha-name">{{ $pengelola->nama_usaha }}</td>
                            <td>{{ $pengelola->total_listing }}</td>
                            <td>
                                @php
                                    $kg = $pengelola->total_tersalurkan ?? 0;
                                    echo $kg >= 1000
                                        ? round($kg / 1000, 1) . ' Ton'
                                        : $kg . ' Kg';
                                @endphp
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">Belum ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="laporan-lihat-semua">
                <a href="#">Lihat Semua <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // ── DATA DARI BLADE ──────────────────────────────────────
    const mingguData    = @json($mingguData);
    const peruntukanData = @json($peruntukanData);

    // ── WARNA PALETTE ────────────────────────────────────────
    const paletteDonut = ['#1abc9c', '#f5c26b', '#5b8dee', '#e57373', '#ab47bc', '#26a69a'];

    // ── BAR CHART ────────────────────────────────────────────
    const ctxBar = document.getElementById('chartBar').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: mingguData.map(d => d.label),
            datasets: [{
                data: mingguData.map(d => d.berat),
                backgroundColor: '#1abc9c',
                borderRadius: 6,
                borderSkipped: false,
                barThickness: 40,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => ctx.parsed.y + ' kg'
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 12 }, color: '#888' }
                },
                y: {
                    grid: { color: '#f0f0f0' },
                    ticks: {
                        font: { size: 11 },
                        color: '#aaa',
                        callback: v => v
                    },
                    beginAtZero: true,
                }
            }
        }
    });

    // ── DONUT CHART ──────────────────────────────────────────
    const ctxDonut = document.getElementById('chartDonut').getContext('2d');
    new Chart(ctxDonut, {
        type: 'doughnut',
        data: {
            labels: peruntukanData.map(d => d.label),
            datasets: [{
                data: peruntukanData.map(d => d.total),
                backgroundColor: paletteDonut.slice(0, peruntukanData.length),
                borderWidth: 0,
                hoverOffset: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            cutout: '68%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => ' ' + ctx.label + ': ' + ctx.parsed + '%'
                    }
                }
            }
        }
    });

    // ── CUSTOM LEGEND DONUT ──────────────────────────────────
    const legendEl = document.getElementById('donutLegend');
    const totalPeruntukan = peruntukanData.reduce((s, d) => s + d.total, 0);
    peruntukanData.forEach((d, i) => {
        const pct = totalPeruntukan > 0 ? Math.round((d.total / totalPeruntukan) * 100) : 0;
        legendEl.innerHTML += `
            <div class="donut-legend-item">
                <span class="donut-legend-dot" style="background:${paletteDonut[i]}"></span>
                <span class="donut-legend-label">${d.label}</span>
                <span class="donut-legend-pct">${pct}%</span>
            </div>`;
    });
</script>
@endpush