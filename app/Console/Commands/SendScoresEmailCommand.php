<?php

namespace App\Console\Commands;

use App\Mail\StudentScores;
use App\Models\Student;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendScoresEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:score-mails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send massage with scores';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $students = Student::all();
        
        foreach ($students as $student){
            Mail::send(new StudentScores($student));
        }
    }
}
