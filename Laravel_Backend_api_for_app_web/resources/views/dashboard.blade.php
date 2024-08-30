<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="min-h-screen py-12 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 animate-bg-pan">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- build dashboard containers --}}
            <div class="flex justify-between bg-gray-100 py-10 px-4 space-x-4">
                <!-- First Stats Container-->
                <div class="w-72 bg-white rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-105 cursor-pointer">
                    <div class="h-20 bg-blue-500 flex items-center justify-between">
                        <p class="mr-0 text-white text-lg pl-5 flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i> UPCOMING APPOINTMENTS
                        </p>
                    </div>
                    <div class="flex justify-between px-5 pt-6 mb-2 text-sm text-gray-600">
                        <p>TOTAL</p>
                    </div>
                    <p class="py-4 text-3xl ml-5">{{ count($appointments) }}</p>
                </div>

                <!-- Second Stats Container-->
                <div class="w-72 bg-white rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-105 cursor-pointer">
                    <div class="h-20 bg-blue-500 flex items-center justify-between">
                        <p class="mr-0 text-white text-lg pl-5 flex items-center">
                            <i class="fas fa-user-md mr-2"></i> PATIENTS
                        </p>
                    </div>
                    <div class="flex justify-between px-5 pt-6 mb-2 text-sm text-gray-600">
                        <p>TOTAL</p>
                    </div>
                    <p class="py-4 text-3xl ml-5">{{ $doctor->doctor['patients'] ?? 0 }}</p>
                </div>

                <!-- Third Stats Container-->
                <div class="w-72 bg-white rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-105 cursor-pointer">
                    <div class="h-20 bg-blue-500 flex items-center justify-between">
                        <p class="mr-0 text-white text-lg pl-5 flex items-center">
                            <i class="fas fa-star mr-2"></i> RATINGS
                        </p>
                    </div>
                    <div class="flex justify-between px-5 pt-6 mb-2 text-sm text-gray-600">
                        <p>TOTAL</p>
                    </div>
                    <p class="py-4 text-3xl ml-5">
                        {{-- return average rating --}}
                        @if(isset($reviews))
                            @php
                            $reviewCount = count($reviews);
                            $averageRating = $reviewCount ? array_sum(array_column($reviews->toArray(), 'ratings')) / $reviewCount : 0;
                            @endphp
                        @endif
                        {{ number_format($averageRating, 1) }}
                    </p>
                </div>

                <!-- Fourth Stats Container-->
                <div class="w-72 bg-white rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-105 cursor-pointer">
                    <div class="h-20 bg-blue-500 flex items-center justify-between">
                        <p class="mr-0 text-white text-lg pl-5 flex items-center">
                            <i class="fas fa-comments mr-2"></i> REVIEWS
                        </p>
                    </div>
                    <div class="flex justify-between px-5 pt-6 mb-2 text-sm text-gray-600">
                        <p>TOTAL</p>
                    </div>
                    <p class="py-4 text-3xl ml-5">{{ count($reviews) }}</p>
                </div>
            </div>

            {{-- Display Latest Reviews --}}
<div class="bg-gradient-to-r from-blue-50 to-indigo-100 overflow-hidden shadow-xl sm:rounded-lg mt-10 transform transition duration-500 hover:scale-105">
    <div class="row">
        <div class="col-md-7 mt-4">
            <div class="card">
                <div class="card-header bg-amber-500 text-white my-3 py-2 px-3 rounded-t-lg shadow-md">
                    <h6 class="mb-0 text-lg font-semibold">Latest Reviews</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    @if(isset($reviews) && !$reviews->isEmpty())
                        <ul class="list-group">
                            @foreach ($reviews as $review)
                                @if(!empty($review->reviews))
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-white shadow-md rounded-lg hover:bg-blue-50 transition duration-300 ease-in-out">
                                        <div class="d-flex flex-column w-full">
                                            <div class="flex justify-between items-center mb-2">
                                                <h6 class="text-sm font-semibold text-gray-800">{{ $review->reviewed_by }}</h6>
                                                <span class="text-xs text-gray-500">{{ $review->created_at->format('M d, Y') ?? '-' }}</span>
                                            </div>
                                            <div class="text-sm text-gray-700">
                                                <i class="fas fa-quote-left mr-2 text-blue-400"></i>
                                                {{ $review->reviews }}
                                                <i class="fas fa-quote-right ml-2 text-blue-400"></i>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @else
                        <div class="border-0 d-flex p-4 mb-2 mt-3 bg-white shadow-md rounded-lg text-center">
                            <h6 class="mb-3 text-sm text-gray-600">No Reviews Yet!</h6>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


        </div>
    </div>
</x-app-layout>

<style>
@keyframes bg-pan {
    0% { background-position: 0% 50%; }
    100% { background-position: 100% 50%; }
}
.bg-gradient-to-r {
    background-size: 200% 200%;
    animation: bg-pan 4s infinite alternate;
}
</style>
