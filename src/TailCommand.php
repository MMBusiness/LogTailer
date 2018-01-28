<?php
namespace Mikromike\LogTailer;
use SplFileInfo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;

class TailCommand extends Command
{
    protected $signature = 'tail {--LogDir}{--lines=100}';
    protected $description = 'Tail the latest updated logfile even from subdirectory  ';
    public function handle()
    {
        $logDirectory = storage_path('logs');  //location for log file
        if (! $path = $this->findLatestLogFile($logDirectory)) {
            $this->warn("Could not find a log file in `{$logDirectory}`.");
            return;
        }
        $lines = $this->option('lines');
        $logDirectory = $this->option('LogDir');
        $this->info("start tailing {$path}");
        $tailCommand = "tail -f {LogDir} -n {$lines} ".escapeshellarg($path);
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
