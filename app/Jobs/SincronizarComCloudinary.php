<?php

namespace App\Jobs;

use App\Repositories\FotoRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SincronizarComCloudinary implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $foto;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($foto)
    {
        $this->foto = $foto;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $publicId = uniqid('vestylle_upload_') . rand(1,420);
        FotoRepository::sendToCloudinary($this->foto, $publicId, config('cloudinary.CLOUDINARY_CLOUD_FOLDER'));
        FotoRepository::deleteLocal($this->foto->id);
        sleep(1);
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(Exception $exception)
    {
        \Log::info(json_encode($exception));
    }
}
