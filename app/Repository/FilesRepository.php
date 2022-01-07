<?php

namespace App\Repository;

use App\Models\File;
use Exception;

class FilesRepository
{
    public function getById($id)
    {
        return File::findOrFail($id);
    }

    public function create($data)
    {
        $fileModel = new File();
        $fileModel->name = $data['file_name'];
        $fileModel->file_path = '/storage/'.$data['file_path'];
        $fileModel->display_name = $data['display_name'];
        $fileModel->extension = $data['extension'];
        $fileModel->size = $data['size'];
        $fileModel->issue_id = $data['issue_id'];

        $fileModel->save();

        return File::find($fileModel->id);
    }

    public function delete($id)
    {
        $file = File::findOrFail($id);

        try {
            $file->delete();
            return 0;
        } catch(Exception $ex) {
            return 1;
        }
    }
}
