@extends('layouts.base')

@section('body')
    <div class="container mx-auto px-4">
        <livewire:popular-games/>

        <div class="flex flex-col lg:flex-row my-10">
            <div class="recently-viewed w-full mr-0 lg:w-3/4 lg:mr-32">
                <livewire:recently-reviewed/>
            </div>

            <div class="most-anticipated mt-12 lg:mt-0 lg:w-1/4">
                <livewire:most-anticipated/>

                <livewire:coming-soon/>
            </div>
        </div>
    </div>
@endsection
