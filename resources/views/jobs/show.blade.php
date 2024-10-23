<x-layout>
    <x-slot:heading>
        Job
    </x-slot:heading>
    <h2 class='font-bold text-lg'>{{ $job->title }}: salary is {{ $job->salary }}</h2>

    @can('edit', $job)
        {{-- this is Auth::user() can or cannor method --}}
        <p class="mt-6">
            <x-button href="/jobs/{{ $job->id }}/edit">Edit Job</x-button>
        </p>
    @endcan
</x-layout>
