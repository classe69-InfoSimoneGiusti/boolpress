<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Lead;
use App\Mail\NewContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{

    /*
    public function provaInvioEmail() {
        $leadDiProva = Lead::find(1);
        Mail::to('info@simonegiusti.it')->send(new NewContact($leadDiProva));
    }
    */

    public function store(Request $request) {

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $newLead = new Lead();
        $newLead->fill($data);
        $newLead->save();

        Mail::to('info@simonegiusti.it')->send(new NewContact($newLead));

        return response()->json([
            'success' => true
        ]);

    }

}
