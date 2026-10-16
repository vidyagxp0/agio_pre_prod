<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Throwable;

class SendDocumentMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    public $email;
    public $document;
    public $template;
    public $subject;

    public $tries = 3;
    public $backoff = 10;

    public function __construct(
        array $data,
        string $email,
        $document,
        string $template,
        string $subject
    ) {
        $this->data = $data;
        $this->email = $email;
        $this->document = $document;
        $this->template = $template;
        $this->subject = $subject;
    }

    public function handle()
    {
        Log::info('Document mail job started', [
            'document_id' => $this->document->id,
            'recipient' => $this->email,
            'template' => $this->template,
            'subject' => $this->subject,
        ]);

        try {
            Mail::send(
                $this->template,
                array_merge($this->data, [
                    'document' => $this->document,
                ]),
                function ($message) {
                    $message->to($this->email)
                        ->subject($this->subject);
                }
            );

            Log::info('Document mail send completed', [
                'document_id' => $this->document->id,
                'recipient' => $this->email,
                'template' => $this->template,
            ]);

        } catch (Throwable $e) {
            Log::error('Document mail job failed', [
                'document_id' => $this->document->id ?? null,
                'recipient' => $this->email,
                'template' => $this->template,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            throw $e;
        }
    }

    public function failed(Throwable $e)
    {
        Log::critical('Document mail job permanently failed', [
            'document_id' => $this->document->id ?? null,
            'recipient' => $this->email,
            'template' => $this->template,
            'error' => $e->getMessage(),
        ]);
    }
}
