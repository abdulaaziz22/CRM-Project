<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Request as MyRequest;
use App\Models\analytic as MyAnalytic ;

class Analytic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:analytic {id} {status} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now=date('Y-m-d');
        $request=MyRequest::find($this->argument('id'));
        $MyAnalytic=MyAnalytic::where('date','=',$now)->first();
        if($MyAnalytic){
            $this->argument('status')== 'create' ? $MyAnalytic->update([
                'total_requests'=> $MyAnalytic->total_requests+1,
            ]) : $MyAnalytic->update([
                'completed_requests'=> $MyAnalytic->completed_requests+1,
            ]);
            $this->info('The command was successful!');
        }
        else{
            $this->argument('status')== 'create' ? MyAnalytic::create([
                'date'=>$now,
                'total_requests'=> 1,
                'completed_requests'=>0
            ]) : MyAnalytic::create([
                'date'=>$now,
                'total_requests'=> 0,
                'completed_requests'=>1
            ]);
            $this->info('The command was successful!');
        }


    }
}
