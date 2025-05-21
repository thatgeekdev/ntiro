<div class="mb-2 block text-sm font-medium text-slate-900 for={{ $for }}">
    {{ $slot }} 
    @if ($required)
        <span class="text-color-red">*</span>
    @else
        <span class="text-gray-500">(optional)</span>
    @endif
</div>