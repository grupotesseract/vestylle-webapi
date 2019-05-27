<?php

namespace App\Mail;

use App\Models\FaleConosco;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FaleConoscoCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(FaleConosco $faleConosco)
    {
        $this->faleConosco = $faleConosco;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('EMAIL_ORIGEM_CONTATO'))
            ->markdown('emails.fale-conosco-created')
            ->with([
                'pessoa' => $this->faleConosco->pessoa,
                'contato' => $this->faleConosco->contato,
                'assunto' => $this->faleConosco->assunto,
                'mensagem' => $this->faleConosco->mensagem,
            ]);
    }
}
