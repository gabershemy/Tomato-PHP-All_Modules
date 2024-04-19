<?php

namespace Modules\TomatoBackup\App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;
use Spatie\Backup\Tasks\Backup\BackupJobFactory;

class CreateBackupJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;

    protected string $option;

    public function __construct(string $option = '')
    {
        $this->option = $option;
    }

    public function handle()
    {
        $options = [];
        if ($this->option === 'only-db') {
            $options['--only-db'] = true;
        }

        if ($this->option === 'only-files') {
            $options['--only-files'] = true;
        }

        if (! empty($this->option)) {
            $prefix = str_replace('_', '-', $this->option).'-';

            $options['--filename'] = $prefix.date('Y-m-d-H-i-s').'.zip';
        }

        Artisan::call('backup:run', $options);
    }
}
