<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Jobs'=>route('jobs.index')]" />


    <x-card class="mb-4 text-sm">
        <form action="{{ route('jobs.index') }}" method="GET">
            
        <div class="mb-4 grid grid-cols-2 gap-4">
            <div>
                <div class="mb-1 font-semibold">Search</div>
                <x-text-input name="search" value="{{ request('search') }}" placeholder="Search for any text"  />
            </div>
            <div>
                <div class="mb-1 font-semibold">Salary</div>

                <div class="flex space-x-2">
                    <x-text-input name="min_salary" value="{{ request('min_salary') }}" placeholder="From" />
                    <x-text-input name="max_salary" value="{{ request('max_salary') }}" placeholder="To" />
                </div>
            </div>
            <div>
                <div class="mb-1 font-semibold">Experience</div>
                <x-radio-group name="experience" :options="\App\Models\Job::$experience"/>
            </div>
            <div>
                <div class="mb-1 font-semibold">Category</div>
                <x-radio-group name="category" :options="\App\Models\Job::$category"/>

            </div>
        </div>
        <button class="w-full rounded-md border border-slate-300 bg-white px-2.5 py-1.5 text-center text-sm font-semibold text-balck shadow-sm hover::bg-slate-100">Filter</button>
    </form>
    </x-card>


    @foreach ($jobs as $job)
    <x-job-card class="mb-4" :$job>
        <div class="p-2">
            <x-link-button :href="route('jobs.show', $job)">View Job</x-link-button>
        </div>
    </x-job-card>
    @endforeach
</x-layout>