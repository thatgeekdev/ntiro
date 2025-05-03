<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Jobs'=>route('jobs.index'), $job->title =>'#']" />
    <x-job-card class="mb-4" :$job>
        <p class="text-sm text-slate-500 mb-4">
            {!! nl2br(e($job->description)) !!}
        </p>
        <x-link-button :href="route('jobs.application.create', $job)"> Apply </x-link-button>
    </x-job-card>

    <x-card class="mb-4">
        <h2 class="mb-4 text-lg font-medium">
            More jobs on | {{ $job->employer->company_name }}
        </h2>
        <div class="text-sm text-slade-500">
            @foreach ($job->employer->jobs as $otherjob)
            <div class="mb-4 flex justify-between">
                <div>
                    <div class="text-slate-700">
                        <a href="{{ route('jobs.show', $otherjob) }}">{{ $otherjob->title }}</a>
                    </div>
                    <div class="text-xs text-slate-500">
                        {{ $otherjob->created_at->diffForHumans() }}
                    </div>
                </div>
                <div class="text-xs">
                    {{ number_format($otherjob->salary) }}</div>
            </div>
            @endforeach
        </div>
    </x-card>
</x-layout>