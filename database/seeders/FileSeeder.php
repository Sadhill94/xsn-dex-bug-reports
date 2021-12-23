<?php

namespace Database\Seeders;

use Illuminate\Filesystem\Filesystem;
use App\Models\File;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    protected $public_storage_path;
    protected $fileSystem;

    public function __construct(Filesystem $fileSystem)
    {
        $this->fileSystem = $fileSystem;
        $this->public_storage_path = public_path() . '/storage/uploads/tests';
    }

    public function run()
    {
        $isDirectoryExist = $this->isExistingDirectory();

        if($isDirectoryExist){
            $this->cleanUploadsTestDirectory();
        }

        $this->createFilesPlaceholder();
        $this->populateTestDirectoryWithFiles();
    }

    public function createFilesPlaceholder()
    {
        File::factory()
            ->count(1)
            ->createPlaceholders()
            ->create();
    }

    public function populateTestDirectoryWithFiles()
    {
        File::factory()
            ->count(rand(20,30))
            ->mockFiles()
            ->create();
    }

    public function isExistingDirectory(): bool
    {
        return $this->fileSystem->exists($this->public_storage_path);
    }

    public function cleanUploadsTestDirectory()
    {
        $this->fileSystem->cleanDirectory($this->public_storage_path);
    }
}
