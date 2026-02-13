@extends('layouts.app')

@section('title',$campaign->title)

@section('content')

<div class="grid md:grid-cols-2 gap-10">

    <img src="{{ asset('storage/'.$campaign->image) }}" 
         class="rounded-2xl shadow-lg">

    <div>
        <h1 class="text-3xl font-bold">{{ $campaign->title }}</h1>

        <p class="mt-4 text-gray-600">
            {{ $campaign->description }}
        </p>

        <div class="mt-6">
            <form id="donation-form">
                @csrf
                <input type="number" name="amount"
                       class="w-full border p-3 rounded-xl"
                       placeholder="Masukkan nominal donasi"
                       required>

                <button type="submit"
                        class="w-full mt-4 bg-green-500 text-white py-3 rounded-xl">
                    Donasi Sekarang
                </button>
            </form>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
document.getElementById('donation-form').addEventListener('submit', function(e){
    e.preventDefault();

    fetch("{{ route('donate',$campaign->id) }}", {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}",
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            amount: document.querySelector('[name=amount]').value
        })
    })
    .then(res => res.json())
    .then(data => {
        snap.pay(data.snap_token);
    });
});
</script>
@endpush
