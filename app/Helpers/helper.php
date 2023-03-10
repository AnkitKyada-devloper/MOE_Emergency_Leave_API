<?php
namespace App\Helpers;

class Helper{
    public static function success($message)
    {
        return response()->json(['code' => 200,'message' => 'Successfully !..'.$message,], 200);
    }
    public static function validated($validated)
    {
        return response()->json(['code' => 422,'message' => $validated->errors()], 422);
        
    }
  
    public static function successData($message,$userdata)
    {
        return response()->json(['code' => 200,'message' => 'Successfully !..'.$message,'data'=>$userdata], 200);
    }
    public static function catch()
    {
        return response()->json(['code' => 500,'message' => 'Error'], 500);
    }
    public static function error($message)
    {
        return response()->json(['code' => 404,'message' => 'Error !..'.$message], 404);
    }
    public static function logout($message)
    {
        return response()->json(['code' => 200,'message' => 'Successfully !..'.$message], 200);
    }
}