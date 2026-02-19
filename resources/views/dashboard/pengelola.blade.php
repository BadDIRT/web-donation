@if (!auth()->user()->is_approved)
    <div class="mb-6 bg-yellow-50 border border-yellow-200 text-yellow-700 p-4 rounded-xl">
        ⏳ Akun kamu sedang menunggu persetujuan admin.
        Kamu sudah bisa melihat dashboard, tapi belum bisa membuat campaign.
    </div>
@endif
@if (auth()->user()->is_approved)
    <a href="{{ route('campaign.create') }}"
       class="btn btn-green">
       ➕ Buat Campaign
    </a>
@else
    <button disabled
        class="btn btn-gray cursor-not-allowed">
        ⛔ Menunggu Persetujuan Admin
    </button>
@endif
