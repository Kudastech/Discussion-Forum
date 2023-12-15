@extends('layouts.layout')

{{-- @section('title', 'Dashboard') --}}

@section('content')
    <div class="row">
        <div class="col-3">
            @include('includes.side-bar')
        </div>
        <div class="col-6">
            @include('includes.success-message')

            @include('idea.includes.submit-idea')
            <hr>

            @forelse ($idea as $ideas)
                <div class="mt-3">
                    @include('idea.includes.idea-card')
                </div>
            @empty
                <p class="text-center mt-4">No Results Found.</p>
            @endforelse

            <div class="mt-3">
                {{ $idea->withQueryString()->links() }}
            </div>
        </div>
        <div class="col-3">
            @include('includes.search')
            @include('includes.follow-box')
        </div>
    </div>
@endsection
