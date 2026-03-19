@extends('layouts.app')

@section('title', 'Reservation Confirmed | LuxDrive')

@section('content')
    <section class="section min-h-80 flex items-center">
        <div class="container w-600 text-center">
            <div class="icon-circle-bg">
                <i data-lucide="check" class="icon-xl" style="color: var(--primary);"></i>
            </div>

            <h1 class="animate-fade-in text-4xl mb-6">Confirmed!</h1>
            <p class="animate-fade-in text-muted text-xl-bold line-height-relaxed mb-12">
                Your luxury ride is secured. We've sent the confirmation details and pick-up instructions to your registered
                email.
            </p>

            <div class="glass-card animate-slide-up text-left p-10 mb-12">
                <h3 class="flex items-center gap-2 mb-8">
                    <i data-lucide="file-text" style="color: var(--primary);"></i>
                    Booking Detail
                </h3>

                <div class="flex flex-col gap-4">
                    <div class="flex justify-between border-b-thin pb-4">
                        <span class="text-muted">Booking ID</span>
                        <span class="font-bold">#LX-20941</span>
                    </div>
                    <div class="flex justify-between border-b-thin pb-4">
                        <span class="text-muted">Vehicle</span>
                        <span class="font-bold" style="color: var(--primary);">BMW M8 Competition</span>
                    </div>
                    <div class="flex justify-between border-b-thin pb-4">
                        <span class="text-muted">Rental Period</span>
                        <span class="font-bold">3 Days</span>
                    </div>
                    <div class="summary-total flex justify-between pt-6">
                        <span class="text-xl-bold">Total Paid</span>
                        <span class="text-xl-bold">$480.00</span>
                    </div>
                </div>
            </div>

            <div class="flex justify-center gap-4 animate-slide-up">
                <a href="/" class="btn btn-primary p-8" style="padding: 1rem 2rem;">Return Home</a>
                <a href="/vehicles" class="btn btn-outline p-8" style="padding: 1rem 2rem;">Browse More</a>
            </div>
        </div>
    </section>
@endsection
