<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    public function index(Request $request)
    {
        $query = Member::where('id', '>', 0);

        if($request->has('search')) {
            $searchStr = $request->get('search');
            $query = $query->where('first_name', 'like', "%{$searchStr}%");
        }

        return $query->paginate(10);
    }

    public function show(Member $member)
    {
        return response()->json([
            'data' => $member
        ]);
    }

    public function delete(Member $member)
    {
        $member->delete();
        return response('', 204);
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'firstName' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        $member->first_name = $request->firstName;
        $member->surname = $request->surname;
        $member->email = $request->email;
        $member->address = $request->address;
        $member->save();

        return response('', 204);
    }
}
