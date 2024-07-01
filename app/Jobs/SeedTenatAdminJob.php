<?php

namespace App\Jobs;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Artisan;

class SeedTenatAdminJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Tenant $tenant;

    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        tenancy()->initialize($this->tenant);

        // Run tenant-specific migrations
        Artisan::call('tenants:migrate', [
            '--tenants' => [$this->tenant->id],
        ]);

        // Create a user in the tenant's database
        User::create([
            'company' => $this->tenant->company,
            'name' => $this->tenant->name,
            'email' => $this->tenant->email,
            'password' => bcrypt($this->tenant->password),
            'status' => $this->tenant->status,
        ]);

        tenancy()->end();
    }
}
