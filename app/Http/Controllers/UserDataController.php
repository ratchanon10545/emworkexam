<?php

namespace App\Http\Controllers;

use App\Models\UserData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserDataController extends Controller
{

    public function index(Request $request){
        // $users = UserData::all();
        $search = $request->input('search');
        $sort = $request->input('sort', 'desc');

        $users = UserData::where(function ($query) use ($search) {
            $query->where('firstname', 'like', "%{$search}%")
                ->orWhere('lastname', 'like', "%{$search}%")
                ->orWhere(DB::raw("CONCAT(firstname, ' ', lastname)"), 'like', "%{$search}%");
        })
        ->get();
        
        $users = $sort === 'desc'
        ? $users->sortByDesc(function ($user) {
            return Carbon::parse($user->birthday)->age;
        })
        : $users->sortBy(function ($user) {
            return Carbon::parse($user->birthday)->age;
        });

        $users = $users->values();

        foreach ($users as $user) {
            $user->age = Carbon::parse($user->birthday)->age;
        }

        // $counts = $users->groupBy(function ($user) {
        //     return Carbon::parse($user->birthday)->age;
        // })->map(function ($age) {
        //     return $age->count();
        // });

        return view('welcome' , compact('users', 'search' , 'sort' ));
    }

    public function store(Request $request){
        $request->validate([
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'prefix' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'birthday' => 'required'
        ]);

        $path = $request->file('profile')->store('profile', 'public');

        UserData::create([
            'profile_path' => $path,
            'prefix' => $request->prefix,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'birthday' => $request->birthday,
        ]);

        return redirect()->back()->with('success', 'User uploaded successfully.');
    }

    public function edit(UserData $user){
        return view('users.edit' , compact('user'));
    }

    public function update(Request $request , UserData $user){
        $request->validate([
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'prefix' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'birthday' => 'required'
        ]);

        if ($request->hasFile('profile')) {
            if ($user->profile_path && Storage::disk('public')->exists($user->profile_path)) {
                Storage::disk('public')->delete($user->profile_path);
            }

            $path = $request->file('profile')->store('profile', 'public');
        }
        else{
            $path = $user->profile_path ;
        }

        $user->update([
            'profile_path' => $path,
            'prefix' => $request->prefix,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'birthday' => $request->birthday,
        ]);

        return redirect()->route('home')->with('success', 'User updated successfully.');
    }

    public function delete(UserData $user){
        Storage::disk('public')->delete($user->profile_path);
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    public function showAgeChart()
    {
        $users = UserData::select(DB::raw('TIMESTAMPDIFF(YEAR, birthday, CURDATE()) as age'))
                    ->get();

        
        $ageGroups = $users->groupBy('age')->map(function ($group) {
            return count($group);
        })->sortKeys();

        
        $labels = $ageGroups->keys();
        $data = $ageGroups->values();

        return view('users.age_chart', compact('labels', 'data'));
    }

    public function ageReport()
    {
        $users = UserData::select(DB::raw('TIMESTAMPDIFF(YEAR, birthday, CURDATE()) as age'))
                    ->get();

        
        $ageGroups = $users->groupBy('age')->map(function ($group) {
            return count($group);
        })->sortKeys();


        return view('users.age_report', compact('ageGroups'));
    }
}
