<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CropImageController extends Controller
{

    public function index()
    {
        return view('cropImage');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function cropImageUploadAjax(Request $request)
    {
        $user_id=Auth::id();

        $data = $_POST['image'];
        $image_array_1 = explode(";", $data);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);
        $image_name = time() . '.png';
        file_put_contents($image_name, $data);
       return response()->json(['success'=>'Crop Image Uploaded Successfully']);
    }
}
