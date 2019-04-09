<?php

namespace App\Mail;

use App\Repositories\FaleConoscoRepository;
// use App\Models\Loja;
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
    public function __construct(FaleConoscoRepository $faleConoscoRepo)//, Loja $loja)
    {
        $this->faleConosco = $faleConoscoRepo->model();
        // $this->loja = $loja;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.fale-conosco-created');
    }
}
