<?php

namespace Modules\TomatoBranches\App\Console;

use Illuminate\Console\Command;
use TomatoPHP\ConsoleHelpers\Traits\RunCommand;
use Modules\TomatoBranches\App\Models\Branch;
use Modules\TomatoBranches\App\Models\Company;
use Modules\TomatoLocations\App\Models\Country;

class TomatoBranchesInstall extends Command
{
    use RunCommand;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'tomato-branches:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'install package and publish assets';

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Publish Vendor Assets');
        $this->artisanCommand(["migrate"]);
        $this->artisanCommand(["optimize:clear"]);
        $checkIfCompanyExists = Company::count();
        if($checkIfCompanyExists < 1){
            $company = Company::create([
                'country_id' => Country::first()?->id,
                'name' => "3x1",
                'ceo' => "CEO",
                'address' => "Cairo, Egypt",
                'city' => "Cairo",
                'zip' => "110821",
                'email' => "info@3x1.io",
                'phone' => "+201207860084",
                'website'=> "https://docs.tomatophp.com"
            ]);
        }
        else {
            $company = Company::first();
        }

        $checkIfBranchExists = Branch::count();
        if($checkIfBranchExists < 1){
            Branch::create([
                "name" => "Main",
                'company_id' => $company->id,
                'branch_number' => "001",
                'phone' => "+201207860084",
                'address' => "Cairo, Egypt"
            ]);
        }
        $this->info('Tomato Branches installed successfully.');
    }
}
