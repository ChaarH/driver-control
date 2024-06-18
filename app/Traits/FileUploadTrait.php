<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

trait FileUploadTrait
{
    public $folderName = 'storage/app/public/users';

    public $rule = 'image|max:2000';

    private function validateFileAction($file)
    {
        $rules = array('fileupload' => $this->rule);
        $file  = array('fileupload' => $file);

        $fileValidator = Validator::make($file, $rules);

        if ($fileValidator->fails()) {

            $messages = $fileValidator->messages();

            return redirect()->back()->withInput(request()->all())
                ->withErrors($messages);

        }
    }

    private function validateFile($files)
    {

        if (is_array($files)) {
            foreach ($files as $file) {
                return $this->validateFileAction($file);
            }
        }

        return $this->validateFileAction($files);
    }

    private function saveFileInDirectory($file): string|bool
    {
        $fileName = preg_replace('/\s+/', '_', time() . strtoupper(uniqid()) . '.' . $file->getClientOriginalExtension());

        if ($file->move($this->folderName, $fileName)) {
            return $this->folderName . '/' . $fileName;
        }

        return false;
    }

    private function deletePhotosInDirectory($files): bool
    {
        try {
            foreach ($files as $file) {
                $path_file = "storage/app/public/{$file}";

                if (file_exists($path_file)) {
                    File::delete($path_file);
                }
            }

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function saveFiles($file): string|bool
    {
        if (!empty($file)) {
            $this->validateFile($file);

            return $this->saveFileInDirectory($file);
        }

        return false;
    }
}