<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('ordering.ordering_active_inventory', 0);
        $this->migrator->add('ordering.ordering_active_inventory_web_branch', 1);
        $this->migrator->add('ordering.ordering_active_inventory_direct_branch', 1);
    }
};
