<?php

namespace Modules\TomatoBackup\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\TomatoBackup\App\Services\SpatieLaravelBackup;
use Sushi\Sushi;

class BackupDestination extends Model
{
    use Sushi;

//    protected $table = 'backups';

    protected ?array $rows;

    public function getRows(): array
    {
        $this->rows = [];

        foreach (SpatieLaravelBackup::getDisks() as $disk) {
            $this->rows = array_merge($this->rows, SpatieLaravelBackup::getBackupDestinationData($disk));
        }

        return $this->rows;
    }

    protected function sushiShouldCache()
    {
        return false;
    }
}
