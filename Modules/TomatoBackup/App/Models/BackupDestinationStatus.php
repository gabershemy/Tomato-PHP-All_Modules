<?php

namespace Modules\TomatoBackup\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\TomatoBackup\App\Services\SpatieLaravelBackup;
use Sushi\Sushi;

class BackupDestinationStatus extends Model
{
    use Sushi;

    protected array $rows;

    public function getRows(): array
    {
        $this->rows = SpatieLaravelBackup::getBackupDestinationStatusData();
        return  $this->rows;
    }
}
