<?php

namespace App\Http\Controllers;

use App\Jobs\UploadImage;
use Illuminate\Http\Request;

class UploadImageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendFiles(Request $request)
    {
        $model = $request->input('model');
        $model_id = $request->input('model_id');
        $files = $request->file('files');

        if (!$files) {
            return false;
        }

        try {
            foreach ($files as $file) {
                //Criando path inicial para direcionar o arquivo
                $destinationPath = storage_path().'/images/';
                //Pega o formato da imagem
                $extension = $file->getClientOriginalExtension();
                //usando o intervention para criar a imagem
                $filename = time();
                $file = \Image::make($file->getRealPath());
                $fullpath = $destinationPath.$filename.'.'.$extension;
                $upload_success = $file->save($fullpath);
                if ($upload_success) {
                    $file_data = [
                        'image_name' => $filename,
                        'image_path' => $destinationPath,
                        'image_extension' => $extension,
                    ];

                    $this->dispatch(new UploadImage($model, $file_data, $model_id));
                }
            }

            return response('success', 200);
        } catch (Exception $e) {
            return response('image upload error', 500);
        }
    }
}
