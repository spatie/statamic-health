<?php
$checkResults = resolve(\Spatie\Health\ResultStores\ResultStore::class)->latestResults();
$lastRanAt = \Illuminate\Support\Carbon::parse($checkResults?->finishedAt);

$backgroundColors = [
    \Spatie\Health\Enums\Status::ok()->value => 'rgb(209 250 229)',
    \Spatie\Health\Enums\Status::warning()->value => 'rgb(254 249 195)',
    \Spatie\Health\Enums\Status::skipped()->value => 'rgb(219 234 254)',
    \Spatie\Health\Enums\Status::failed()->value => 'rgb(254 226 226)',
    \Spatie\Health\Enums\Status::crashed()->value => 'rgb(254 226 226)',
    'default' => 'rgb(243 244 246)',
];

$iconColors = [
    \Spatie\Health\Enums\Status::ok()->value => 'rgb(16 185 129)',
    \Spatie\Health\Enums\Status::warning()->value => 'rgb(234 179 8)',
    \Spatie\Health\Enums\Status::skipped()->value => 'rgb(59 130 246)',
    \Spatie\Health\Enums\Status::failed()->value => 'rgb(239 68 68)',
    \Spatie\Health\Enums\Status::crashed()->value => 'rgb(239 68 68)',
];
?>

<div class="card flex flex-col items-center h-full" style="min-height: 130px;">
    <div class="rounded-full p-0 md:p-1 w-auto md:dark:bg-opacity-60 justify-center items-center flex" style="background-color: {{ $backgroundColors[$result->status] ?? $backgroundColors['default'] }}">
        <div class="absolute w-3.5 h-3.5 rounded-full bg-white"></div>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 relative" style="color: {{ $iconColors[$result->status] }}" viewBox="0 0 20 20" fill="currentColor">
            @switch ($result->status)
                @case(\Spatie\Health\Enums\Status::ok()->value)
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                @break
                @case(\Spatie\Health\Enums\Status::warning()->value)
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                @break
                @case(\Spatie\Health\Enums\Status::skipped()->value)
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                @break
                @case(\Spatie\Health\Enums\Status::failed()->value)
                @case(\Spatie\Health\Enums\Status::crashed()->value)
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                @break
                @default
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                @break
            @endswitch
        </svg>
    </div>
    <div class="w-full">
        <dd class="-mt-1 font-bold text-gray-900 dark:text-white md:mt-1 md:text-xl">
            {{ $result->label }}
        </dd>
        <dt class="mt-0 text-sm font-medium text-gray-600 dark:text-gray-300 md:mt-1 leading-loose">
            @if (!empty($result->notificationMessage))
                {!! \Statamic\Support\Str::markdown($result->notificationMessage) !!}
            @else
                {!! \Statamic\Support\Str::markdown($result->shortSummary) !!}
            @endif
        </dt>
    </div>
</div>
