<x-mail::message>
    {{ $job->title }},
    Nice to Meet you

    <x-mail::button :url="url('/jobs/' . $job->id)">
        View your Job Listing
    </x-mail::button>

    Thanks,<br>
    {{ config('Example App') }}
</x-mail::message>
