<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Form;
use App\Mail\FormCreated;

class FormController extends Controller
{
    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'fields' => ['required', 'array'],
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $data = $validator->validate();
        $data['user_id'] = auth()->id();
        $data['fields'] = json_encode($data['fields']);

        $form = Form::create($data);

        \Mail::to(auth()->user())
                ->send(new FormCreated($form));

        return response()->json(['success' => true]);
    }
}
