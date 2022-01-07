<?php

namespace App\Services;

use App\Repository\FilesRepository;
use Illuminate\Support\Str;

class FilesService
{
    protected $filesRepository;

    public function __construct(FilesRepository $filesRepository)
    {
        $this->filesRepository = $filesRepository;
    }

    /**
     * Upload file on the app's storage and then create the reference in the database
     * @param $files
     * @param $issueId
     */
    public function store_many($files, $issueId, $type = 'bug')
    {
        $storage_path = 'uploads/bug-reports';
        if($type != 'bug'){
            $storage_path = 'uploads/feature-requests';
        }

        $filesCreated = [];
        foreach ($files as $file) {
            $data['file_name'] = time().'_'.$file->getClientOriginalName();
            $data['display_name'] = $file->getClientOriginalName();
            $data['extension'] = $file->getClientOriginalExtension();
            $data['size'] = $file->getSize();
            $data['issue_id'] = $issueId;

            $data['file_path'] = $file->storeAs($storage_path, $data['file_name'], 'public');

            array_push($filesCreated,$this->filesRepository->create($data));
        }
        return $filesCreated;
    }

    public function delete($id): bool
    {
        $file = $this->filesRepository->getById($id);
        unlink(public_path().$file->file_path);

        return $this->filesRepository->delete($file->id);
    }

    public function download($id)
    {
        $file = $this->filesRepository->getById($id);
        $file_name = $file->display_name;
        if(!Str::contains($file->display_name, ['.jpg', '.jpeg', '.png', '.txt', '.log', '.gif'])){
            $file_name = $file->display_name.'.'.$file->extension;
        }
        if($file){
            return response()->download(public_path().''.$file->file_path, $file_name);
        }
        return response('File not found', 404);
    }
}
