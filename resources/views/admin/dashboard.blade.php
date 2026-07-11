@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<!-- Statistics Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <!-- Stat card 1: Revenue -->
    <div class="glass-panel border border-[#D4AF37]/20 p-6 rounded-2xl relative overflow-hidden shadow-md gold-glow">
        <div class="absolute top-0 right-0 w-24 h-24 bg-[#D4AF37]/5 rounded-full blur-xl pointer-events-none"></div>
        <div class="flex justify-between items-center mb-4">
            <span class="text-[10px] tracking-widest uppercase text-slate-500 font-bold">TOTAL PENDAPATAN</span>
            <div class="w-8 h-8 rounded-full bg-[#D4AF37]/10 flex items-center justify-center text-[#D4AF37] shrink-0 text-xs font-bold shadow-sm">
                Rp
            </div>
        </div>
        <span class="block text-2xl font-extrabold text-slate-800">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
        <span class="text-[10px] text-slate-500 mt-2 block">Dihitung dari semua vote berbayar sukses</span>
    </div>

    <!-- Stat card 2: Votes -->
    <div class="glass-panel border border-[#D4AF37]/20 p-6 rounded-2xl relative overflow-hidden shadow-md">
        <div class="absolute top-0 right-0 w-24 h-24 bg-rose-500/5 rounded-full blur-xl pointer-events-none"></div>
        <div class="flex justify-between items-center mb-4">
            <span class="text-[10px] tracking-widest uppercase text-slate-500 font-bold">TOTAL SUARA MASUK</span>
            <div class="w-8 h-8 rounded-full bg-rose-100 flex items-center justify-center text-rose-600 shrink-0 shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <span class="block text-2xl font-extrabold text-slate-800">{{ number_format($totalVotes) }} Suara</span>
        <span class="text-[10px] text-slate-500 mt-2 block">Akumulasi real-time secara nasional</span>
    </div>

    <!-- Stat card 3: Candidates -->
    <div class="glass-panel border border-[#D4AF37]/20 p-6 rounded-2xl relative overflow-hidden shadow-md gold-glow">
        <div class="absolute top-0 right-0 w-24 h-24 bg-[#D4AF37]/5 rounded-full blur-xl pointer-events-none"></div>
        <div class="flex justify-between items-center mb-4">
            <span class="text-[10px] tracking-widest uppercase text-slate-500 font-bold">FINALIS DUTA KAMPUS</span>
            <div class="w-8 h-8 rounded-full bg-[#D4AF37]/10 flex items-center justify-center text-[#D4AF37] shrink-0 shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
        </div>
        <span class="block text-2xl font-extrabold text-slate-800">{{ $totalCandidates }} Finalis</span>
        <span class="text-[10px] text-slate-500 mt-2 block">Kategori Prince dan Princess aktif</span>
    </div>

    <!-- Stat card 4: Admins -->
    <div class="glass-panel border border-[#D4AF37]/20 p-6 rounded-2xl relative overflow-hidden shadow-md">
        <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-500/5 rounded-full blur-xl pointer-events-none"></div>
        <div class="flex justify-between items-center mb-4">
            <span class="text-[10px] tracking-widest uppercase text-slate-500 font-bold">PENGGUNA ADMINISTRATOR</span>
            <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 shrink-0 shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
        </div>
        <span class="block text-2xl font-extrabold text-slate-800">{{ $totalAdmins }} Pengguna</span>
        <span class="text-[10px] text-slate-500 mt-2 block">Akses penuh pengelolaan sistem</span>
    </div>
</div>

<!-- Standings and Analytics breakdown -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
    <!-- Candidates votes bar chart standing -->
    <div class="glass-panel border border-[#D4AF37]/20 p-6 rounded-2xl lg:col-span-2 shadow-lg gold-glow">
        <h3 class="text-sm font-bold tracking-wider uppercase text-slate-800 mb-6 border-b border-slate-100 pb-3 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-[#D4AF37] gold-shine"></span>
            Klasemen Perolehan Suara
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Prince Column -->
            @php
                $maxPrinceVotes = $princeCandidates->max('current_votes');
            @endphp
            <div>
                <h4 class="text-xs font-bold uppercase tracking-wider text-[#D4AF37] mb-5 flex items-center gap-2">
                    <span>👑</span> Klasemen Prince
                </h4>
                <div class="space-y-4.5">
                    @forelse($princeCandidates as $candidate)
                    @php
                        $pct = $maxPrinceVotes > 0 ? ($candidate->current_votes / $maxPrinceVotes) * 100 : 0;
                    @endphp
                    <div>
                        <div class="flex justify-between items-center text-xs mb-1.5">
                            <div class="flex items-center gap-2 min-w-0">
                                <span class="px-1.5 py-0.5 rounded text-[8px] uppercase tracking-wider font-extrabold bg-[#D4AF37]/10 border border-[#D4AF37]/30 text-[#D4AF37] shrink-0">
                                    Rank {{ $loop->iteration }}
                                </span>
                                <span class="font-bold text-slate-800 truncate max-w-[130px]">{{ $candidate->name }}</span>
                                <span class="text-[9px] text-slate-500 font-semibold shrink-0">({{ $candidate->candidate_number }})</span>
                            </div>
                            <span class="font-extrabold text-[#D4AF37] shrink-0 text-[11px]">{{ number_format($candidate->current_votes) }} Suara</span>
                        </div>
                        <div class="w-full h-2 rounded-full bg-[#D4AF37]/5 border border-[#D4AF37]/10 overflow-hidden">
                            <div class="h-full rounded-full bg-gradient-to-r from-[#D4AF37] to-[#F5D061] transition-all duration-1000" style="width: {{ $pct }}%"></div>
                        </div>
                    </div>
                    @empty
                    <p class="text-slate-500 text-xs">Belum ada kandidat Prince.</p>
                    @endforelse
                </div>
            </div>

            <!-- Princess Column -->
            @php
                $maxPrincessVotes = $princessCandidates->max('current_votes');
            @endphp
            <div>
                <h4 class="text-xs font-bold uppercase tracking-wider text-[#D4AF37] mb-5 flex items-center gap-2">
                    <span>👑</span> Klasemen Princess
                </h4>
                <div class="space-y-4.5">
                    @forelse($princessCandidates as $candidate)
                    @php
                        $pct = $maxPrincessVotes > 0 ? ($candidate->current_votes / $maxPrincessVotes) * 100 : 0;
                    @endphp
                    <div>
                        <div class="flex justify-between items-center text-xs mb-1.5">
                            <div class="flex items-center gap-2 min-w-0">
                                <span class="px-1.5 py-0.5 rounded text-[8px] uppercase tracking-wider font-extrabold bg-[#D4AF37]/10 border border-[#D4AF37]/30 text-[#D4AF37] shrink-0">
                                    Rank {{ $loop->iteration }}
                                </span>
                                <span class="font-bold text-slate-800 truncate max-w-[130px]">{{ $candidate->name }}</span>
                                <span class="text-[9px] text-slate-500 font-semibold shrink-0">({{ $candidate->candidate_number }})</span>
                            </div>
                            <span class="font-extrabold text-[#D4AF37] shrink-0 text-[11px]">{{ number_format($candidate->current_votes) }} Suara</span>
                        </div>
                        <div class="w-full h-2 rounded-full bg-[#D4AF37]/5 border border-[#D4AF37]/10 overflow-hidden">
                            <div class="h-full rounded-full bg-gradient-to-r from-[#D4AF37] to-[#F5D061] transition-all duration-1000" style="width: {{ $pct }}%"></div>
                        </div>
                    </div>
                    @empty
                    <p class="text-slate-500 text-xs">Belum ada kandidat Princess.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Faculty vote distribution -->
    <div class="glass-panel border border-[#D4AF37]/20 p-6 rounded-2xl shadow-lg flex flex-col justify-between gold-glow">
        <div>
            <h3 class="text-sm font-bold tracking-wider uppercase text-slate-800 mb-6 border-b border-slate-100 pb-3 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-[#D4AF37] gold-shine"></span>
                Penyebaran Suara Fakultas
            </h3>
            
            <div class="space-y-4">
                @foreach($facultyVotes as $fac)
                @php
                    $facPct = $totalVotes > 0 ? ($fac->total_votes / $totalVotes) * 100 : 0;
                @endphp
                <div>
                    <div class="flex justify-between items-center text-xs mb-1">
                        <span class="text-slate-700 font-medium truncate max-w-[150px]">{{ $fac->faculty }}</span>
                        <span class="font-bold text-[#D4AF37]">{{ number_format($fac->total_votes) }} ({{ number_format($facPct, 1) }}%)</span>
                    </div>
                    <div class="w-full h-1.5 rounded-full bg-[#D4AF37]/5 border border-[#D4AF37]/10">
                        <div class="h-full rounded-full bg-[#D4AF37] transition-all duration-700" style="width: {{ $facPct }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="mt-6 p-4 rounded-xl bg-[#D4AF37]/5 border border-[#D4AF37]/25 text-[10px] text-slate-600 leading-relaxed font-medium">
            <span class="font-bold text-slate-800 block mb-1">💡 Tips Admin:</span>
            Papan klasemen ini tersinkronisasi langsung dengan landing page pengguna. Jika ingin menambahkan suara offline, silakan buka menu <strong>Manajemen Finalis</strong>.
        </div>
    </div>
</div>

<!-- Pengaturan E-Voting -->
<div class="glass-panel border border-[#D4AF37]/20 p-6 rounded-2xl shadow-lg mb-10 gold-glow">
    <h3 class="text-sm font-bold tracking-wider uppercase text-slate-800 mb-6 border-b border-slate-100 pb-3 flex items-center gap-2">
        <svg class="w-4 h-4 text-[#D4AF37]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Pengaturan E-Voting
    </h3>
    <form action="{{ route('admin.settings.update') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
        @csrf
        <div>
            <label for="voting_start" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Tanggal Mulai Voting</label>
            <input type="datetime-local" id="voting_start" name="voting_start" value="{{ \Carbon\Carbon::parse($votingStart)->format('Y-m-d\TH:i') }}" required class="w-full px-4 py-3 rounded-xl bg-white border border-[#D4AF37]/20 focus:outline-none focus:border-[#D4AF37] text-xs md:text-sm text-slate-700 font-semibold shadow-sm">
        </div>
        <div>
            <label for="voting_end" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Tanggal Selesai Voting</label>
            <input type="datetime-local" id="voting_end" name="voting_end" value="{{ \Carbon\Carbon::parse($votingEnd)->format('Y-m-d\TH:i') }}" required class="w-full px-4 py-3 rounded-xl bg-white border border-[#D4AF37]/20 focus:outline-none focus:border-[#D4AF37] text-xs md:text-sm text-slate-700 font-semibold shadow-sm">
        </div>
        <div>
            <label for="event_year" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">Tahun Event</label>
            <input type="number" id="event_year" name="event_year" min="2000" max="2100" value="{{ $eventYear }}" required class="w-full px-4 py-3 rounded-xl bg-white border border-[#D4AF37]/20 focus:outline-none focus:border-[#D4AF37] text-xs md:text-sm text-slate-700 font-semibold shadow-sm">
        </div>
        <div>
            <button type="submit" class="w-full py-3.5 px-6 rounded-xl btn-gold-shine text-[#2C2416] font-bold tracking-wider hover:shadow-lg transition-all text-xs uppercase cursor-pointer">
                Simpan Pengaturan
            </button>
        </div>
    </form>
</div>

<!-- Recent Transactions Log -->
<div class="glass-panel border border-[#D4AF37]/20 p-6 rounded-2xl shadow-lg gold-glow">
    <div class="flex justify-between items-center border-b border-slate-100 pb-4 mb-6">
        <h3 class="text-sm font-bold tracking-wider uppercase text-slate-800 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-[#D4AF37] animate-ping"></span>
            Aktivitas Vote Terbaru
        </h3>
        <a href="{{ route('admin.transactions') }}" class="text-[10px] uppercase font-bold tracking-wider text-[#D4AF37] border border-[#D4AF37]/30 hover:border-[#D4AF37] px-3 py-1.5 rounded-lg transition-all hover:bg-[#D4AF37]/5">
            Lihat Semua Log
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-100 text-[10px] text-slate-500 uppercase tracking-widest font-semibold">
                    <th class="py-3 px-4">Invoice</th>
                    <th class="py-3 px-4">Pendukung</th>
                    <th class="py-3 px-4">WhatsApp</th>
                    <th class="py-3 px-4">Kandidat Terpilih</th>
                    <th class="py-3 px-4 text-center">Jumlah Vote</th>
                    <th class="py-3 px-4 text-right">Pembayaran</th>
                    <th class="py-3 px-4 text-center">Status</th>
                </tr>
            </thead>
            <tbody class="text-xs divide-y divide-slate-50">
                @forelse($recentTransactions as $tx)
                @php
                    $statusColor = $tx->payment_status === 'success' 
                        ? 'text-emerald-700 bg-emerald-50 border-emerald-300' 
                        : 'text-[#D4AF37] bg-[#D4AF37]/5 border-[#D4AF37]/30';
                @endphp
                <tr class="hover:bg-[#D4AF37]/5 transition-all">
                    <td class="py-3.5 px-4 font-bold text-slate-800 tracking-widest">{{ $tx->id }}</td>
                    <td class="py-3.5 px-4 font-semibold text-slate-700">
                        {{ $tx->voter_name }}
                        <span class="block text-[10px] text-slate-500 font-medium mt-0.5">{{ $tx->voter_email }}</span>
                    </td>
                    <td class="py-3.5 px-4 text-slate-600">{{ $tx->voter_whatsapp }}</td>
                    <td class="py-3.5 px-4">
                        <span class="font-bold text-slate-800">{{ $tx->candidate->gender === 'putra' ? 'Prince' : 'Princess' }} {{ $tx->candidate->name }}</span>
                        <span class="block text-[9px] text-[#D4AF37] font-bold uppercase mt-0.5">Nomor: {{ $tx->candidate->candidate_number }}</span>
                    </td>
                    <td class="py-3.5 px-4 text-center font-extrabold text-[#D4AF37]">{{ number_format($tx->vote_amount) }}</td>
                    <td class="py-3.5 px-4 text-right font-semibold text-slate-700">
                        Rp {{ number_format($tx->price_total, 0, ',', '.') }}
                        <span class="block text-[9px] text-slate-500 font-medium mt-0.5">Metode: {{ $tx->payment_method ?: '-' }}</span>
                    </td>
                    <td class="py-3.5 px-4 text-center">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[9px] font-bold border uppercase {{ $statusColor }}">
                            {{ $tx->payment_status }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-8 text-center text-slate-500 text-xs">Belum ada aktivitas transaksi vote terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
