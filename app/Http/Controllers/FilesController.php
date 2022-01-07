<?php

namespace App\Http\Controllers;

use App\Services\CommonsService;
use App\Services\FilesService;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    protected $filesService;
    protected $commonsService;

    public function __construct(FilesService $filesService, CommonsService $commonsService)
    {
        $this->filesService = $filesService;
        $this->commonsService = $commonsService;
    }


    public function download($id)
    {
       return $this->filesService->download($id);
    }

    public function delete($id)
    {
        if(!$this->commonsService->isManager()){
            return response('Unauthorized',401);
        }

        return $this->filesService->delete($id);
    }

    public function add_single(Request $request)
    {
        if(!$this->commonsService->isManager()) {
            return response('Unauthorized',401);
        }

        $messages = [
            "files.max" => "Maximum amount of files authorized is: 4",
        ];
        request()->validate([
            'files' => ['max:1'],
        ], $messages);

        if(!$request->file('file')){
            return response('No files submitted', 400);
        }
        $this->filesService->validate_many([$request->file('file'), false]);

        $fileArray = $this->filesService->store_many([$request->file('file')], $request->issue_id);

        return response($fileArray[0]);
    }
}
