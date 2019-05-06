<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Repositories\FotoRepository;

class UploadImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $model;
    private $model_id;
    private $image;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($model, $image, $model_id = null)
    {
        $this->model = $model;
        $this->model_id = $model_id;
        $this->image = $image;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Criando e persistindo no BD uma nova foto já associada a entidade
        $foto = \App\Models\Foto::create($this->image);
        $entity = $this->model::find($this->model_id);

        if ($entity) {
            $entity->foto()->save($foto);
        }

        // Upload p/ Cloudinary e delete local
        $publicId = uniqid('vestylle_upload_') . rand(1, 420);
        FotoRepository::sendToCloudinary($foto, $publicId, config('cloudinary.CLOUDINARY_CLOUD_FOLDER'));
        FotoRepository::deleteLocal($foto->id);
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
