<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\Mobil;
use App\Models\PesananKendaraan;
use App\Models\Sales;
use Livewire\Component;

class DashboardController extends Component
{
    public $title = "Dashboard";
    public $countSalesman=0,$countCustomer=0,$countMobil=0,$countSPK=0;
    public function render()
    {
        $this->countSalesman = Sales::count();
        $this->countCustomer = Customer::count();
        $this->countMobil = Mobil::count();
        $this->countSPK = PesananKendaraan::where('status_pesanan','!=','Draft')->count();
        
        return view('livewire.dashboard-controller');
    }
}
