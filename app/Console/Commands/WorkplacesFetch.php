<?php

namespace App\Console\Commands;

use App\Dto\Workplace\WorkplaceDto;
use App\Models\Company;
use App\Services\Workplace\WorkplaceService;
use App\Services\Workplace\WorkplaceServiceInterface;
use Illuminate\Console\Command;

class WorkplacesFetch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'workplaces:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Successfully workplaces fetched';

    private WorkplaceServiceInterface $workplaceService;

    public function __construct()
    {
        parent::__construct();
        $this->workplaceService = new WorkplaceService();
    }

    /**
     * @return void
     */
    public function handle()
    {
        $companies = Company::all();
        foreach ($companies as $company) {
            $this->workplaceService->workplace((new WorkplaceDto())->setCompanyId($company->company_id));
        }
    }
}
