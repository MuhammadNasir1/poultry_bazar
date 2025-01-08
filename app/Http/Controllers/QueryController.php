<?php

namespace App\Http\Controllers;

use App\Models\Queries;
use App\Models\User;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    // answer query
    public function answerQuery(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'query_id' => 'required',
                'query_status' => 'required',
                'query_response' => 'required',
            ]);

            $query = Queries::where('query_id', $validatedData['query_id'])->first();

            $query->query_status = $validatedData['query_status'];
            $query->query_response = $validatedData['query_response'];

            $query->save();

            return response()->json(['success' => true, 'message' => 'Query Answered'], 200);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // answer query

    // get queries
    public function getQueries()
    {
        $queries = Queries::get();
        foreach($queries as $query ){
            $user = User::Select('name' , 'email', 'user_image')->where('id', $query->added_user_id)->first();
            $query->user = $user;
        }
        return view('queries', ['queries' => $queries]);

    }
}
