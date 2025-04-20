@extends('layouts.default')
@section('Title' , 'Edit')
@section('content')
<form  action="{{route('user.update' , $user->id)}}" method="POST" class="max-w-md mx-auto" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="relative flex justify-center z-0 w-full mb-5 group ">
       <div class="w-50">
        <img src="{{ asset('storage/' . $user->profile_path) }}" alt="">
       </div>
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <input type="file" name="profile" id="profile" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
        <label for="profile" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Profile</label>
        @error('profile')
            <p class="text-red-500 text-xs">{{$message}}</p>
        @enderror
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <label for="prefix" class="block mb-2 text-xs font-medium text-gray-500 dark:text-white">Select an Prefix</label>
        <select id="prefix" name="prefix" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected></option>
            <option value="นาย" {{$user->prefix == 'นาย' ? 'selected' : ''}}>นาย</option>
            <option value="นาง" {{$user->prefix == 'นาง' ? 'selected' : ''}}>นาง</option>
            <option value="นางสาว" {{$user->prefix == 'นางสาว' ? 'selected' : ''}}>นางสาว</option>
        </select>
        @error('prefix')
            <p class="text-red-500 text-xs">{{$message}}</p>
        @enderror
        
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <input value="{{$user->firstname}}" type="text" name="firstname" id="firstname" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="firstname" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
        @error('firstname')
            <p class="text-red-500 text-xs">{{$message}}</p>
        @enderror
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <input value="{{$user->lastname}}" type="text" name="lastname" id="lastname" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="lastname" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm password</label>
        @error('lastname')
            <p class="text-red-500 text-xs">{{$message}}</p>
        @enderror
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <input value="{{$user->birthday}}" type="date" name="birthday" id="birthday" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="birthday" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm password</label>
        @error('birthday')
            <p class="text-red-500 text-xs">{{$message}}</p>
        @enderror
    </div>
    
    <div class="flex justify-between">
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        <a href={{route('home')}} class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Cancle</a>
    </div>
  </form>
  
@endsection