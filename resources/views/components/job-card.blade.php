<x-card class="mb-4">
    <div class="mb-4 flex justify-between">
        <h2 class="text-lg font-medium">{{ $job->title }}</h2>
        <div class="text-slate-500">
            ${{ number_format($job->salary) }}  {{--add curency would be nice --}}
        </div>
    </div>

    <div class="flex items-center justify-between text-sm text-slade-500">
        <div class="flex items-center space-x-4">
            <div>{{ $job->employer->company_name }}</div>
            <div>{{ $job->location }}</div>
            @if ($job->deleted_at)
                <div class="text-xs text-red-500">Deleted</div> 
            @endif
        </div>
        <div class="flex space-x-1 text-xs">
            <x-tag>
                <a href="{{ route('jobs.index',['experience' => $job->experience]) }}">
                    {{ Str::ucfirst($job->experience) }}
                </a>
            </x-tag>
            <x-tag>
                <a href="{{ route('jobs.index',['category' => $job->category]) }}">
                    {{ Str::ucfirst($job->category) }}
                </a>
            </x-tag>
        </div>
    </div>


    {{$slot}}

</x-card> 