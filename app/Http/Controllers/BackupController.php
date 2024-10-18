<?php

namespace App\Http\Controllers;

use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Response;
use App\Http\Requests;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JeroenNoten\LaravelAdminLte\View\Components\Widget\Alert as WidgetAlert;

class BackupController extends Controller
{
    public function index()
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        $respuesta = [];
        $backup_id = 1;
        $date = "";
        $today_date = Carbon::now();
        //Carbon::setLocale('es');
        if ($disk != null) {
            $files = $disk->files(config('backup.backup.name'));
            foreach ($files as $k => $f) {
                if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                    $date = Carbon::createFromTimestamp($disk->lastModified($f));
                    $respuesta[] = [
                        'id' => $backup_id,
                        'file_path' => $f,
                        'file_name' => str_replace(config('backup.backup.name') . '/', '', $f),
                        'file_size' => $disk->size($f),
                        'create_date' => $date->toDayDateTimeString(),
                        'difference_date' => $date->diffForHumans(),
                    ];
                    $backup_id = $backup_id + 1;
                }
            }
            $respuesta = array_reverse($respuesta);
        }
        return view("backup")->with(compact('respuesta'));
        //return dd($respuesta);
    }

    public function create()
    {
        // try {
            Artisan::call("backup:run --only-db --disable-notifications");
            //Artisan::queue('backup:run', ['--only-db' => true,'--disable-notifications'=>true]);
            $output = Artisan::output();
            //return dd(Artisan::output());
            // if(function_exists('shell_exec')) {
            //     $output= "shell_exec is enabled";
            // }
            //$output = shell_exec("C:\laragon\bin\mysql\mysql-8.0.30-winx64\bin\mysqldump -h localhost -u root test > C:\laragon\www\WMS_WebSystem_01\storage\app\Laravel\main.sql");
            return response()->json(['msg' => 'Copia creada satisfactoriamente', 'status' => $output]);
        // } catch (Exception $e) {
        //     return response()->json(['msg' => 'Error', 'status' => $e]);
        // }
    }

    /**
     * Downloads a backup zip file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function download($file_name)
    {
        $file = config('backup.backup.name') . '/' . $file_name;
        return Storage::download($file);
    }

    /**
     * Deletes a backup file.
     */
    public function delete(Request $request)
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists(config('backup.backup.name') . '/' . $request->get('file_name')))
        {
            $disk->delete(config('backup.backup.name') . '/' . $request->get('file_name'));
            return response()->json(['msg' => 'Copia eliminada satisfactoriamente', 'status' => 'ok']);
        } else {
            return response()->json(['msg' => 'El archivo no existe', 'status' => 'error']);
        }
    }
}
