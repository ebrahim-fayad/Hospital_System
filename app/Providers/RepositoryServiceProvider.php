<?php

namespace App\Providers;

use App\Interfaces\Admin\Ambulances\AmbulanceRepositoryInterface;
use App\Interfaces\Admin\Doctors\DoctorRepositoryInterface;
use App\Interfaces\Admin\Finances\PaymentRepositoryInterface;
use App\Interfaces\Admin\Finances\ReceiptRepositoryInterface;
use App\Interfaces\Admin\Insurances\InsuranceRepositoryInterface;
use App\Interfaces\Admin\Patients\PatientRepositoryInterface;
use App\Interfaces\Admin\RayEmployees\RayEmployeeRepositoryInterface;
use App\Interfaces\Admin\Sections\SectionRepositoryInterface;
use App\Interfaces\Admin\Services\ServiceRepositoryInterface;
use App\Interfaces\Doctor\Diagnostics\DiagnosticRepositoryInterface;
use App\Interfaces\Doctor\Invoices\InvoiceRepositoryInterface;
use App\Interfaces\Doctor\Laboratories\LaboratoryRepositoryInterface;
use App\Interfaces\Doctor\Rays\RayRepositoryInterface;
use App\Repository\Admin\Ambulances\AmbulanceRepository;
use App\Repository\Admin\Doctors\DoctorRepository;
use App\Repository\Admin\Finances\PaymentRepository;
use App\Repository\Admin\Finances\ReceiptRepository;
use App\Repository\Admin\Insurances\InsuranceRepository;
use App\Repository\Admin\Patients\PatientRepository;
use App\Repository\Admin\RayEmployees\RayEmployeeRepository;
use App\Repository\Admin\Sections\SectionRepository;
use App\Repository\Admin\Services\ServiceRepository;
use App\Repository\Doctor\Diagnostics\DiagnosticRepository;
use App\Repository\Doctor\Invoices\InvoiceRepository;
use App\Repository\Doctor\Laboratories\LaboratoryRepository;
use App\Repository\Doctor\Rays\RayRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SectionRepositoryInterface::class, SectionRepository::class);
        $this->app->bind(DoctorRepositoryInterface::class, DoctorRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(InsuranceRepositoryInterface::class, InsuranceRepository::class);
        $this->app->bind(AmbulanceRepositoryInterface::class, AmbulanceRepository::class);
        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);
        $this->app->bind(ReceiptRepositoryInterface::class, ReceiptRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(InvoiceRepositoryInterface::class, InvoiceRepository::class);
        $this->app->bind(DiagnosticRepositoryInterface::class, DiagnosticRepository::class);
        $this->app->bind(RayRepositoryInterface::class, RayRepository::class);
        $this->app->bind(LaboratoryRepositoryInterface::class, LaboratoryRepository::class);
        $this->app->bind(RayEmployeeRepositoryInterface::class, RayEmployeeRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
