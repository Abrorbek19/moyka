<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $like = DB::table('like')->insert([
            'comment_id'=>$input["comment_id"],
            'created_at'=>$input["created_at"],
            'ip_address'=>$input["ip_address"],
        ]);
        if ($like) {
            return redirect()->back();
        } else {
            // Qo'shish muvaffaqiyatli amalga oshmadi
            return redirect()->back()->with('error', 'Xatolik yuz berdi.');
        }
    }

    public function unlike(Request $request){
        $input = $request->all();

        $commentId = $input["comment_id"];
        $createdAt = $input["created_at"];
        $ip = $input["ip_address"];

        $unlike = DB::table('like')->where(['comment_id'=> $commentId,'created_at'=>$createdAt,'ip_address'=>$ip])->first();

        if ($unlike){
            DB::table('like')->where(['comment_id'=> $commentId,'created_at'=>$createdAt,'ip_address'=>$ip])->delete();
        }else{
            // Qo'shish muvaffaqiyatli amalga oshmadi
            return redirect()->back()->with('error', 'Xatolik yuz berdi.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
