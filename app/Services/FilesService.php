<?php

namespace App\Services;

use App\Repository\FilesRepository;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class FilesService
{
    protected $filesRepository;
    public $allowed_extensions;

    public function __construct(FilesRepository $filesRepository)
    {
        $this->allowed_extensions = array("jpg", "jpeg", "png", "gif", "txt", "log");
        $this->filesRepository = $filesRepository;
    }


    public function validate_many($filesArray, $hasCommonSizeRestriction = true)
    {
        $sizeAllowedInByte = $hasCommonSizeRestriction ? 2000000 : 6000000; // 2mb - 6mb

        foreach ($filesArray as $file) {
            $extension = $file->getClientOriginalExtension();
            $fileSize = $file->getSize();
            $fileName = $file->getClientOriginalName();

            $isFileTooHeavy = $fileSize > $sizeAllowedInByte;

            if(!in_array($extension, $this->allowed_extensions)){
                throw new BadRequestException('File type not allowed : .'.$extension);
            }

            if ($isFileTooHeavy || !$fileSize) {
                throw new BadRequestException(
                    'File size not allowed for '.$fileName.', maximum is 2MB');
            }

            if ($fileSize == 0) {
                throw new BadRequestException('File '.$fileName.' is empty.');
            }
        }
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
