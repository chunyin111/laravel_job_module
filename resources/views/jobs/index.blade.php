<x-layout>
    <x-slot:heading>
        Jobs Page
    </x-slot:heading>
    <div class ="space-y-4">
        @foreach ($jobs as $job)
            <a class='block px-4 py-6 border border-gray-200 rounded-lg' href = '/jobs/{{ $job['id'] }}'>
                <div class ="font-bold text-blue-500 text-sm">{{ $job->employer->name }}</div>
                <div>
                    <strong class = "text-laracasts">{{ $job['title'] }}</strong> Salary is {{ $job['salary'] }}
                </div>
            </a>
        @endforeach
        <div>
            {{ $jobs->links() }}
        </div>
    </div>
</x-layout>
