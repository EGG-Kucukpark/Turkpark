<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    public function tasks(Request $request)
    {
        if ($request->sortBy) {

            $sira = $request->sortBy;
        } else {

            $sira = "desc";
        }


        $del = false;
        $imp = false;
        $comp = false;
        if ($request->filter === 'completed') {
            $comp = true;
        } elseif ($request->filter === 'deleted') {
            $del = true;
        } elseif ($request->filter === 'important') {
            $imp = true;
        }


        if ($request->filter) {

            if ($request->filter == 'completed') {

                return DB::table('todo')->where([['isDeleted', null], ['user_id', $request->id], ['title', 'LIKE', '%' . $request->q . '%'], ['isCompleted', $comp]])->orderBy("id", $sira)->get();
            } elseif ($request->filter == 'important') {

                return DB::table('todo')->where([['isDeleted', null], ['user_id', $request->id], ['title', 'LIKE', '%' . $request->q . '%'], ['isImportant', $imp]])->orderBy("id", $sira)->get();
            } elseif ($request->filter == 'deleted') {

                return DB::table('todo')->where([['user_id', $request->id], ['title', 'LIKE', '%' . $request->q . '%'], ['isDeleted', $del]])->orderBy("id", $sira)->get();
            }


            return DB::table('todo')->where([['isDeleted', null], ['user_id', $request->id], ['isCompleted', $comp], ['isDeleted', $del], ['isImportant', $imp]])->orwhere('isCompleted', $comp)->orwhere('isDeleted', $del)->orwhere('isImportant', $imp)->get();
        } elseif ($sira) {
            return   DB::table('todo')->where([['isDeleted', null], ['user_id', $request->id], ['title', 'LIKE', '%' . $request->q . '%']])->orderBy("id", $sira)->get();
        }


        return DB::table('todo')->where([['user_id', $request->id], ['title', 'LIKE', '%' . $request->q . '%'], ['isDeleted', null]])->get();
    }



    public function addtask(Request $request)
    {

        try {
            return DB::table('todo')->insert(
                [
                    'user_id' => $request->task['userid'],
                    'title' => $request->task['title'],
                    'description' => $request->task['description'],


                    'dueDate' => $request->task['dueDate']

                ]



            );
        } catch (Exception $exception) {

            return response()->json([$exception], 400);
        }
    }

    public function deletetask(Request $request)
    {

        return DB::table('todo')->where('id', $request->id)->update(
            [

                'isDeleted' => true,


            ]

        );
    }

    public function updatetask(Request $request)

    {



        if ($request->task['isCompleted'] === false) {

            $comp = null;
        } else {
            $comp = true;
        }





        try {
            $id = $request->task['id'];
            return DB::table('todo')->where('id', $id)->update(
                [
                    'title' => $request->task['title'],
                    'description' => $request->task['description'],
                    'isCompleted' => $comp,
                    'isDeleted' => $request->task['isDeleted'],
                    'isImportant' => $request->task['isImportant'],
                    'dueDate' => $request->task['dueDate']

                ]

            );
        } catch (Exception $exception) {

            return response()->json([$exception], 400);
        }
    }
}
