<?php

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        // ... otro código ...

        if ($request->header('X-GitHub-Event') === 'push') {
            // Ejecutar el comando git pull
            $process = new Process(['git', 'pull', 'origin', 'main']);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            // El comando git pull se ejecutó correctamente
            return response('Git pull successful', 200);
        }

        // ... otro código ...
    }
}
