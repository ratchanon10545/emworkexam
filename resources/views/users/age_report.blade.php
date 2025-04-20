@extends('layouts.default')
@section('Title' , 'Report')
@section('content')
<div class="max-w-2xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Report on the number of Users by age</h2>

    <table class="w-full border-collapse border border-gray-300 mb-5">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2 text-left">Age</th>
                <th class="border px-4 py-2 text-left">Number of Users</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ageGroups as $age => $count)
                <tr>
                    <td class="border px-4 py-2">{{ $age }} ปี</td>
                    <td class="border px-4 py-2">{{ $count }} คน</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="border px-4 py-2 text-center text-gray-500">ไม่พบข้อมูล</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <a href="{{route('home')}}" class="text-white bg-gray-600 p-2 rounded-md ">Back</a>
</div>
@endsection
