@extends('statamic::layout')
@section('title', 'Health')

<?php
if (request()->has('fresh')) {
    Artisan::call(\Spatie\Health\Commands\RunHealthChecksCommand::class);
}

$checkResults = resolve(\Spatie\Health\ResultStores\ResultStore::class)->latestResults();
$lastRanAt = \Illuminate\Support\Carbon::parse($checkResults?->finishedAt);
?>

@push('head')
    <style>.text-red-500 { color: rgb(239 68 68) }</style>
@endpush

@section('content')
    <div class="flex flex-wrap justify-center space-y-3">
        <div class="flex justify-center w-full">
            <x-health-logo/>
        </div>
        @if ($lastRanAt)
            <div class="{{ $lastRanAt->diffInMinutes() > 5 ? 'text-red' : 'text-gray' }} text-sm text-center font-medium">
                {{ __('health::notifications.check_results_from') }} {{ $lastRanAt->diffForHumans() }}
            </div>
        @endif
    </div>
    <div class="mt-2 md:mt-4">
        @if (count($checkResults?->storedCheckResults ?? []))
            <dl class="grid grid-cols-1 gap-1 sm:gap-3 md:gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($checkResults->storedCheckResults as $result)
                    @include('statamic-health::components.card')
                @endforeach
            </dl>
        @endif
    </div>
@endsection
