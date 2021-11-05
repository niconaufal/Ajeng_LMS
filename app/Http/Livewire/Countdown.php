<?php

namespace App\Http\Livewire;

use ActiveStatus;
use App\Sesi;
use Livewire\Component;

class Countdown extends Component
{
    public $end = 0;
    public $start = 0;

    public function render()
    {
        $jadwal = ActiveStatus::getActiveJadwal();
        $sesi = Sesi::getMySession()->first();

        $this->start = $sesi->start;
        $this->end = $sesi->end;

        return view('livewire.countdown');
    }
}
