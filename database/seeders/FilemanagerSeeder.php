<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Filemanager;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class FilemanagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = public_path('demo');
        $files = File::allFiles($path);
        foreach ($files as $file) {

           $f = Filemanager::create([
                'title' => pathinfo($file->getRealPath(), PATHINFO_FILENAME),
                'description' => pathinfo($file->getRealPath(), PATHINFO_FILENAME),
                'filename' => $file->getFilename(),
                'path' => 'filemanager/'.$file->getFilename(),
                'size' => $file->getSize(),
                'extension' =>  File::extension($file->getRealPath()),
                'type' => mime_content_type($file->getRealPath()),
                'created_by' => NULL,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'is_enable' => 1,
                'grouping' => 'others',
            ]);

            File::copy($file->getRealPath(), public_path($f->filename));
            
        }
    }
}
