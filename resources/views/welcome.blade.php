@extends('layouts.default')
@section('Title' , 'Home')
@section('content')
    <div class="">
        <div>
            <form action="{{route('user.store') }}" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="shadow-2xl flex space-x-3 p-2 rounded-b-md">
                    <div>
                        <label for="profile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Profile</label>
                        <input type="file" name="profile" id="profile">
                        @error('profile')
                            <p class="text-red-500 text-xs">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="prefix" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an Prefix</label>
                        <select id="prefix" name="prefix" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected></option>
                            <option value="นาย">นาย</option>
                            <option value="นาง">นาง</option>
                            <option value="นางสาว">นางสาว</option>
                        </select>
                        @error('prefix')
                            <p class="text-red-500 text-xs">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">FirstName</label>
                        <input type="text" name="firstname" id="firstname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        @error('firstname')
                            <p class="text-red-500 text-xs">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">LastName</label>
                        <input type="text" name="lastname" id="lastname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        @error('lastname')
                            <p class="text-red-500 text-xs">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthday</label>
                        <input type="date" name="birthday" id="birthday" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                        @error('birthday')
                            <p class="text-red-500 text-xs">{{$message}}</p>
                        @enderror
                    </div>
                   
                    
                    <div class="items-end flex">
                        <button type="submit" class="p-2 bg-green-600 rounded-md items-center block text-white cursor-pointer">Add</button>
                    </div>
                </div>
            </form>
        
        <div>
            <form method="GET" action="{{ route('home') }}" class="mb-4">
                <input type="text" name="search" value="{{ $search }}" placeholder="ค้นหาชื่อหรือชื่อ-นามสกุล"
                class="bg-gray-50 mb-5 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                
                <input  type="hidden" name="sort" value="{{ $sort }}">
                
                <a href="{{ route('home', ['search' => $search, 'sort' => $sort === 'desc' ? 'asc' : 'desc']) }}"
                class="bg-gray-600 text-white px-4 py-2 rounded whitespace-nowrap">
                เรียงตามอายุ: {{ $sort === 'desc' ? 'มาก → น้อย' : 'น้อย → มาก' }}
                </a>
            
            </form>
            <div class="mb-2 flex items-center space-x-2">
                <a class="bg-blue-600 w-15 text-white rounded-md p-2 " href="{{route('users.age_chart')}}">
                    Graph</a>
                    <p>Users total : {{count($users)}}</p>
            </div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Profile
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Prefix
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Firstname
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Lastname
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Birthday
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Age
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Updated_AT
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-20 h-20" src="{{ asset('storage/' . $user->profile_path) }}" alt="">
                        </th>
                        <td class="px-6 py-4">
                            {{$user->prefix}}
                        </td>
                        <td class="px-6 py-4">
                            {{$user->firstname}}
                        </td>
                        <td class="px-6 py-4">
                            {{$user->lastname}}
                        </td>
                        <td class="px-6 py-4">
                            {{$user->birthday}}
                        </td>
                        <td class="px-6 py-4">
                            {{$user->age}}
                        </td>
                        <td class="px-6 py-4">
                            {{$user->updated_at}}
                        </td>
                        <td class="px-6 py-4 text-right flex space-x-2">
                            <a href="/users/{{$user->id}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            <form method="POST" action="{{route('user.delete' , $user->id)}}" onsubmit="return confirmSubmit()">
                                @csrf
                                 @method('DELETE')
                                <button class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <script>
        function confirmSubmit() {
            return confirm("Are you sure to delete this user?");
        }
    </script>
@endsection