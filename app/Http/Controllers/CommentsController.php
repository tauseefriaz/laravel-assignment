<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use Input;
use Request;
use Response;
use Validator;

class CommentsController extends Controller
{

    public function index()
    {
        $data['name']     = 'comments';
        $data['comments'] = Comments::where('parent_id', 0)->get();

        return view('index', $data);
    }

    public function save(Request $request)
    {
        $inputs = Input::all()['data'];

        $rules = array(
            'name'    => 'required',
            'comment' => 'required',
        );

        $validator = Validator::make($inputs, $rules);
        if ($validator->fails()) {
            $messages = array('error' => $validator->messages());
            return Response::json($messages);
        } else {
            try {
                $comment = new Comments($inputs);
                $comment->save();
                $comment->count = $comment->count($comment);
                return Response::json($comment);
            } catch (Exception $e) {
                return Response::json($e->getMessage());
            }
        }
    }
}
