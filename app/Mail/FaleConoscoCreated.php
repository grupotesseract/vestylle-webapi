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
    public function __construct(FaleConosco $faleConosco, $lojaNome, $usuario)
    {
        $this->faleConosco = $faleConosco;
        $this->lojaNome = $lojaNome;
        $this->usuario = $usuario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.fale-conosco-created')
                    ->with([
                        'lojaNome' => $this->lojaNome,
                        'pessoa' => $this->usuario,
                        'contato' => $this->faleConosco->contato,
                        'assunto' => $this->faleConosco->assunto,
                        'mensagem' => $this->faleConosco->mensagem,
                    ]);
    }
}
