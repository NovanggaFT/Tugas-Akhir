@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <h1 class="text-2xl font-bold text-center text-gray-800">DASHBOARD</h1>
    <p class="text-center text-gray-400 text-sm">manajemen penjualan & stok</p>

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-5 max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 border-l-8 border-l-purple-500">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">NILAI ASET</p>
            <p class="text-2xl font-bold text-gray-800 mt-2">Rp 6.500.000</p>
            <p class="text-sm text-gray-500 mt-2">500 porsi bahan baku</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 border-l-8 border-l-blue-500">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">PENJUALAN HARI INI</p>
            <p class="text-2xl font-bold text-gray-800 mt-2">Rp 3.000.000</p>
            <p class="text-sm text-gray-500 mt-2">200 porsi terjual</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 border-l-8 border-l-green-500">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">PROFIT MINGGUAN</p>
            <p class="text-2xl font-bold text-gray-800 mt-2">Rp 2.400.000</p>
            <p class="text-sm text-gray-500 mt-2">1200 porsi dari target</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 border-l-8 border-l-orange-500">
            <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">EFISIENSI</p>
            <p class="text-2xl font-bold text-gray-800 mt-2">85.7%</p>
            <p class="text-sm text-gray-500 mt-2">Sisa stok: 200 porsi</p>
        </div>
    </div>

    <div class="mt-6 flex flex-wrap justify-center gap-3">
        <button onclick="openModal('penjualan')" class="px-5 py-2.5 bg-blue-500 hover:bg-blue-600 text-white rounded-xl transition font-medium text-sm">
            Input Penjualan
        </button>
        <button onclick="openModal('belanja')" class="px-5 py-2.5 bg-green-500 hover:bg-green-600 text-white rounded-xl transition font-medium text-sm">
            Belanja Stok
        </button>
        <a href="{{ url('/manage') }}" class="px-5 py-2.5 bg-gray-500 hover:bg-gray-600 text-white rounded-xl transition font-medium text-sm">
            Manage Data
        </a>
    </div>
</div>

<!-- Modal -->
<div id="modal-overlay" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 id="modal-title" class="text-lg font-semibold text-gray-800">Form</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 text-xl">✕</button>
        </div>
        <form id="modal-form" onsubmit="handleSubmit(event)">
            <div id="modal-body"></div>
            <div class="flex gap-3 mt-4">
                <button type="button" onclick="closeModal()" class="flex-1 px-4 py-2 border border-gray-200 rounded-xl text-gray-600 hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-xl transition font-medium">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(type) {
        document.getElementById('modal-overlay').classList.remove('hidden');
        document.getElementById('modal-title').textContent = type === 'penjualan' ? '📝 Input Penjualan' : '🛒 Input Belanja';
    }
    function closeModal() {
        document.getElementById('modal-overlay').classList.add('hidden');
    }
    function handleSubmit(e) {
        e.preventDefault();
        alert('Submit!');
        closeModal();
    }
</script>
@endsection