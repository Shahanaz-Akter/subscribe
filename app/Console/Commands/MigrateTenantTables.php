<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MigrateTenantTables extends Command
{
    protected $signature = 'tenant:migrate-tables {id}';
    protected $description = 'Migrate tables for a specific tenant';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $tenantId = $this->argument('id');

        // Retrieve the specific tenant
        $tenant = Tenant::find($tenantId);

        if (!$tenant) {
            $this->error("Tenant not found.");
            return;
        }

        // Initialize tenancy for the tenant
        tenancy()->initialize($tenant);

        // Run tenant migrations
        Artisan::call('tenants:migrate', [
            '--tenants' => [$tenant->id],
        ]);

    }
}
