<x-layout>
    <x-slot:title>
        Welcome
    </x-slot:title>

    <div class="max-w-2xl mx-auto space-y-4">
        @forelse ($chirps as $chirp)
            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <div class="font-semibold">
                        {{ $chirp->user?->name ?? 'Guest' }}
                    </div>
                    <div class="mt-1">
                        {{ $chirp->message }}
                    </div>
                    <div class="mt-2 text-sm text-base-content/60">
                        {{ $chirp->created_at?->format('M j, Y g:i A') }}
                    </div>
                </div>
            </div>
        @empty
            <div class="card bg-base-100 shadow">
                <div class="card-body text-base-content/60">
                    No chirps yet.
                </div>
            </div>
        @endforelse
    </div>
</x-layout>
