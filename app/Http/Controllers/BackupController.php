<?php

namespace App\Http\Controllers;

use Illuminate\Console\View\Components\Alert;
use App\Http\Requests;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BackupController extends Controller
{
    public function index()
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        $respuesta = [];
        $backup_id = 1;
        // if($disk != null)
        // {
            $files = $disk->files(config('backup.backup.name'));
            // make an array of backup files, with their filesize and creation date
            foreach ($files as $k => $f) {
                // only take the zip files into account
                if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                    $respuesta[] = [
                        'id' => $backup_id,
                        'file_path' => $f,
                        'file_name' => str_replace(config('backup.backup.name') . '/', '', $f),
                        'file_size' => $disk->size($f),
                        'last_modified' => $disk->lastModified($f),
                        //'last_modified' => Carbon::hasFormat($disk->lastModified($f), 'MMMM DD Y H:m'),
                        //'create_from_date' => Carbon::createFromDate($disk->lastModified($f))->age
                    ];
                    $backup_id = $backup_id + 1;
                }
            }
            // reverse the backups, so the newest one would be on top
            $respuesta = array_reverse($respuesta);

        // }
        return view("backup")->with(compact('respuesta'));
        //return dd($respuesta);
    }

    public function create()
    {
        try {
            // start the backup process
            Artisan::call('backup:run');
            $output = Artisan::output();
            // log the results
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
            // return the results as a response to the ajax call
            //Alert::success('New backup created');
            return redirect()->back();
        } catch (Exception $e) {
            //Flash::error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Downloads a backup zip file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function download($file_name)
    {
        $file = config('laravel-backup.backup.name') . '/' . $file_name;
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);
        if ($disk->exists($file)) {
            //$fs = Storage::disk(config('laravel-backup.backup.destination.disks')[0])->getDriver();
            //$stream = $fs->readStream($file);

            // return Response::stream(function () use ($stream) {
            //     fpassthru($stream);
            // }, 200, [
            //     "Content-Type" => $fs->getMimetype($file),
            //     "Content-Length" => $fs->getSize($file),
            //     "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            // ]);
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }

    /**
     * Deletes a backup file.
     */
    public function delete($file_name)
    {
        $disk = Storage::disk(config('laravel-backup.backup.destination.disks')[0]);
        if ($disk->exists(config('laravel-backup.backup.name') . '/' . $file_name)) {
            $disk->delete(config('laravel-backup.backup.name') . '/' . $file_name);
            return redirect()->back();
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }
}
