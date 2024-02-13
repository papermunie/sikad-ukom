<?php


namespace App\Observers;


use App\Models\ActivityLog;
use App\Models\PemasukanKas;
use App\Models\PengeluaranKas;
use App\Events\LogActivity;
use App\Models\FinancialTransaction;

class FinancialTransactionObserver
{
    public function created($model)
    {
        $this->logActivity($model, 'created');
    }

    public function updated($model)
    {
        $this->logActivity($model, 'updated');
    }

    public function deleted($model)
    {
        $this->logActivity($model, 'deleted');
    }

    private function logActivity($model, $action)
    {
        ActivityLog::create([
            'entity' => class_basename($model),
            'entity_id' => $model->getKey(),
            'action' => $action,
            event(new LogActivity($model, $action)),
        ]);
    }
   
   }
   