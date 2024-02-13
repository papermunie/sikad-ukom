<?php

namespace App\Listeners;

use App\Events\LogActivity;

class FinancialTransactionEventListener
{
    /**
     * Handle the event.
     *
     * @param  LogActivity  $event
     * @return void
     */
    public function handle(LogActivity $event)
    {
        // Mendapatkan informasi dari event
        $entity = $event->entity;
        $entityId = $event->entityId;
        $action = $event->action;

        // Menyimpan atau melakukan tindakan lain sesuai kebutuhan
        $this->saveToConsole($entity, $entityId, $action);
    }

    /**
     * Menyimpan informasi log ke console.
     *
     * @param  string  $entity
     * @param  int  $entityId
     * @param  string  $action
     * @return void
     */
    private function saveToConsole($entity, $entityId, $action)
    {
        // Contoh: Mencetak informasi log ke console
        echo "Log Activity: Entity '$entity' with ID '$entityId' $action." . PHP_EOL;
    }
}