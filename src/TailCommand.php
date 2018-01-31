<?php
namespace Mikromike\LogTailer;
use SplFileInfo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;


class TailCommand extends Command
{
  /**
    * The console command name.
    *
    * @var string
    */
   protected $name = 'tail';




    protected $signature = 'tail {--lines=100}';
    protected $description = 'Tail the latest updated logfile even from subdirectory  ';

    public function handle()
    {
        $logDirectory = storage_path('logs');  //location for log file

        if (! $path = $this->findLatestLogFile($logDirectory)) {
            $this->warn("Could not find a log file in `{$logDirectory}`.");
            return;
        }
        $lines = $this->option('lines');
        $this->info("start tailing  {$logDirectory} ");
        //$this->info("start tailing file  {$logFile} ");
        $tailCommand = "tail -f -n {$lines} ".escapeshellarg($path);

        (new Process($tailCommand))
            ->setTimeout(null)
            ->run(function ($type, $line) {
                $this->output->write($line);
            });
    }
    protected function findLatestLogFile(string $directory)
    {
        $logFile = collect(File::allFiles($directory))
            ->sortByDesc(function (SplFileInfo $file) {
                return $file->getMTime();
            })
            ->first();
        return $logFile
            ? $logFile->getPathname()
            : false;
    }
    protected function executeCommand($command)
    {
        $output = $this->output;
    }
}
