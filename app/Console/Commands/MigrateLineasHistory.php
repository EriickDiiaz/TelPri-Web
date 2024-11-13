<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Linea;
use App\Models\Historial;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\DB;

class MigrateLineasHistory extends Command
{
    protected $signature = 'lineas:migrate-history';
    protected $description = 'Migrate old Lineas history to Spatie Activity Log';

    public function handle()
    {
        $this->info('Starting migration of Lineas history...');

        $oldHistories = Historial::all();

        $bar = $this->output->createProgressBar(count($oldHistories));

        DB::beginTransaction();

        try {
            foreach ($oldHistories as $oldHistory) {
                $linea = Linea::find($oldHistory->linea_id);

                if (!$linea) {
                    $this->warn("Linea with ID {$oldHistory->linea_id} not found. Skipping...");
                    continue;
                }

                $attributes = $this->getAttributes($oldHistory);
                $old = $this->getOldAttributes($oldHistory);

                Activity::create([
                    'log_name' => 'lineas',
                    'description' => 'updated',
                    'subject_type' => Linea::class,
                    'subject_id' => $oldHistory->linea_id,
                    'causer_type' => 'App\Models\User',
                    'causer_id' => $oldHistory->usuario_id,
                    'properties' => [
                        'attributes' => $attributes,
                        'old' => $old,
                    ],
                    'created_at' => $oldHistory->created_at,
                    'updated_at' => $oldHistory->updated_at,
                ]);

                $bar->advance();
            }

            DB::commit();
            $bar->finish();
            $this->info("\nMigration completed successfully!");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("\nAn error occurred during migration: " . $e->getMessage());
        }
    }

    private function getAttributes($oldHistory)
    {
        $attributes = $this->getLineaAttributes($oldHistory->linea_id);
        $attributes[$oldHistory->campo] = $oldHistory->valor_nuevo;
        return $attributes;
    }

    private function getOldAttributes($oldHistory)
    {
        $attributes = $this->getLineaAttributes($oldHistory->linea_id);
        $attributes[$oldHistory->campo] = $oldHistory->valor_anterior;
        return $attributes;
    }

    private function getLineaAttributes($lineaId)
    {
        $linea = Linea::find($lineaId);
        return [
            'linea' => $linea->linea,
            'vip' => $linea->vip,
            'inventario' => $linea->inventario,
            'serial' => $linea->serial,
            'plataforma' => $linea->plataforma,
            'estado' => $linea->estado,
            'titular' => $linea->titular,
            'acceso' => $linea->acceso,
            'localidad_id' => $linea->localidad_id,
            'piso_id' => $linea->piso_id,
            'mac' => $linea->mac,
            'campo_id' => $linea->campo_id,
            'par' => $linea->par,
            'directo' => $linea->directo,
            'observacion' => $linea->observacion,
        ];
    }
}