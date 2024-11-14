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
use Spatie\DbDumper\Databases\MySql;
use Spatie\DbDumper\Compressors\GzipCompressor;
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
                //if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                if ((substr($f, -4) == '.zip' || substr($f, -3) == '.gz') && $disk->exists($f)) {
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
        try {
            // Copia mediante comandos Artisan
            // Artisan::call("backup:run --only-db --disable-notifications");
            // $output = Artisan::output();

            // Copia mediante libreria db-dump
            $db_name = env('DB_DATABASE','wms_websystem_01');
            $fecha = Carbon::now()->format('Y-m-d-H-i-s');
            $output = MySql::create()
            ->setDbName($db_name)
            ->setUserName('root')
            ->setPassword('')
            ->addExtraOption('--routines')
            ->useCompressor(new GzipCompressor())
            ->dumpToFile(storage_path('app/Laravel').'/'.'backup-'.$fecha.'.sql.gz');

            return response()->json(['status' => 'success', 'msg' => $output]);
        } catch (Exception $e) {
             return response()->json(['status' => 'error', 'msg' => $e]);
        }
    }

    public function create_all()
    {
        try {
            // Copia mediante comandos Artisan
            Artisan::call("backup:run --disable-notifications");
            $output = Artisan::output();

            return response()->json(['status' => 'success', 'msg' => $output]);
        } catch (Exception $e) {
             return response()->json(['status' => 'error', 'msg' => $e]);
        }
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
