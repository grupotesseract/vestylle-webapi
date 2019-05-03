<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class RemoverImagem implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $imagem_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($imagem_id)
    {
        $this->imagem_id = $imagem_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $foto = \App\Models\Foto::find($this->imagem_id);
        $retornoCloudinary = \Cloudder::destroyImage($foto->cloudinary_id);
        $foto->delete();
    }
}
