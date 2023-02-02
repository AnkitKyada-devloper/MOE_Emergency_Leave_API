<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emergencyleave;
use App\Models\Leave_attechements;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use TheSeer\Tokenizer\Exception;


class emergencyleaveController extends Controller
{

    public function leave(Request $request)
    {

        try {

            $validated = Validator::make(
                $request->all(),
                [
                    'leave_type_id' => 'required|not_in:-- Choose Leave Type --',
                    'reason' => 'required',
                    'fromDate1' => 'required',
                    'toDate1' => 'required|same:fromDate1',
                    'totalNoOfDays' => 'required',
                    'pendingLeaves' => 'nullable',
                    'paidLeaves' => 'nullable',
                    'lost_of_pay' => 'nullable'
                ]
            );

            if ($validated->fails()) {
                return response()->json(['code' => 422, 'message' => 'Error'], 422);
            }

            $leave = new Emergencyleave;
            $leave->register_user_id = Auth::user()->id;
            $leave->leave_type_id = $request->leave_type_id; //6<-Emergencyid
            $leave->reason = $request->reason;
            $leave->fromDate1 = $request->fromDate1;
            $leave->toDate1 = $request->toDate1;
            $leave->totalNoOfDays = $request->totalNoOfDays;
            $leave->pendingLeaves = $request->pendingLeaves;
            $leave->paidLeaves = $request->paidLeaves;
            $leave->lost_of_pay = $request->lost_of_pay;
            $leave->save();

            $encrypted = Crypt::encryptString($leave->id);
            return response()->json(['code' => 200, 'message' => 'Successfully..'], 200);
        } catch (Exception $e) {
            return response()->json(['code' => 500, 'message' => 'Error'], 500);
        }
    }
    public function Leave_attechements(Request $request)
    {
        try {
            $validated = Validator::make($request->all(), [
                'attechement_type_id' => 'required',
                'upload_document.*' => 'required|mimes:png,jpg,pdf',
                'location_latitude' => 'required',
                'location_longitude' => 'required'
            ]);

            if ($validated->fails()) {
                return response()->json(['code' => 422, 'message' => 'Error'], 422);
            }

            $upload_document = [];
            $files = $request->upload_document;
            $leave_id = $request->leave_id;
            $decrypted = Crypt::decryptString($leave_id);

            $user_id = Auth::user()->id;
            $path = "reports/";
            $slash = "/";
            $url = $path . $user_id . $slash . $decrypted;

            foreach ($files as $file) {

                $leave1 = new Leave_attechements;
                $leave1->leave_id = $decrypted;
                $leave1->attechement_type_id = $request->attechement_type_id;
                $leave1->location_latitude = $request->location_latitude;
                $leave1->location_longitude = $request->location_longitude;

                $data = $file->getClientOriginalName();
                $filename = time() . '_' . $data;
                $file->move($url, $filename);
                $leave1->upload_document = $url . $filename;
                $leave1->save();
            }
            return response()->json(['code' => 200, 'message' => 'Successfully..'], 200);
        } catch (Exception $e) {
            return response()->json(['code' => 500, 'message' => 'Error'], 500);
        }
    }
}