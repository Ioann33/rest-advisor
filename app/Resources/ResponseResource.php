<?php
namespace Resources;

class ResponseResource
{
    public function handle(array $response, string $responseType): void
    {
        $message = $response['activity'] ?? "No advice for selected rest type and number of participants, try to change one of them";
        match ($responseType) {
            'file' => $this->outputToFile($message),
            'console' => $this->outputToConsole($message),
        };
    }

    protected function outputToConsole(string $message): void
    {
        echo $message.PHP_EOL;
    }

    protected function outputToFile(string $message): void
    {
        file_put_contents(__DIR__.'/../../output/advice.txt', $message);
        echo "Take your advice in file 👇".PHP_EOL.realpath('output/advice.txt').PHP_EOL;
    }
}