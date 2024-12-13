<?php

namespace App\Http\Controllers;

use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Response;
use App\Http\Requests;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
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
                if ((substr($f, -4) == '.zip' || substr($f, -4) == '.sql') && $disk->exists($f)) {
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
            $db_name = env('DB_DATABASE', 'wms_websystem_01');
            $fecha = Carbon::now()->format('Y-m-d-H-i-s');
            $output = MySql::create()
                ->setDbName($db_name)
                ->setUserName('root')
                ->setPassword('')
                ->addExtraOption('--routines')
                //->useCompressor(new GzipCompressor())
                // ->dumpToFile(storage_path('app/Laravel') . '/' . 'backup-' . $fecha . '.sql.gz');
                ->dumpToFile(storage_path('app/Laravel') . '/' . 'backup-' . $fecha . '.sql');

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
     * Restore a DB backup.
     */
    public function restore(Request $request)
    {
        // Verificar si existe el archivo SQL
        $nombre_archivo =  $request->get('file_name');
        //if()
        $ruta_archivo = storage_path('app/Laravel') .'/'.$nombre_archivo;
        // Credenciales de la base de datos
        //$dbHost = env('DB_HOST');
        //$dbName = env('DB_DATABASE');
        //$dbUser = env('DB_USERNAME');
        //$dbPass = env('DB_PASSWORD');
        $dbHost = config('database.connections.mysql.host');
        $dbPort = config('database.connections.mysql.port');
        $dbName = config('database.connections.mysql.database');
        $dbUser = config('database.connections.mysql.username');
        $dbPass = config('database.connections.mysql.password');

        try {
            // Comando para restaurar la base de datos
            //$command = "mysql -h $dbHost -u $dbUser" . (!empty($dbPass) ? " -p$dbPass" : "") . " $dbName < $ruta ";
            $command = "mysql -h $dbHost -u $dbUser" . (!empty($dbPass) ? " -p$dbPass" : "") . " $dbName < '$ruta_archivo' ";
            //$command = 'mysql -h '.$dbHost.' -u'. $dbUser. (!empty($dbPass) ? '-p '.$dbPass : '') .$dbName < '"'.$ruta_archivo.'"';
            exec($command, $output, $result);

            if ($result === 0) {
                return response()->json(['status' => 'success', 'msg' => $command]);
            } else {
                //return response()->json(['status' => 'error', 'msg' => $result]);
                return response()->json(['status' => 'error', 'msg' => $command]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'msg' => 'Error del servidor']);
        }
    }

    /**
     * Deletes a backup file.
     */
    public function delete(Request $request)
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists(config('backup.backup.name') . '/' . $request->get('file_name'))) {
            $disk->delete(config('backup.backup.name') . '/' . $request->get('file_name'));
            return response()->json(['msg' => 'Copia eliminada satisfactoriamente', 'status' => 'ok']);
        } else {
            return response()->json(['msg' => 'El archivo no existe', 'status' => 'error']);
        }
    }
}
