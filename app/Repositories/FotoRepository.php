<?php

namespace App\Repositories;

use App\Models\Foto;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class FotoRepository
 * @package App\Repositories
 * @version March 30, 2019, 12:17 am UTC
 *
 * @method Foto findWithoutFail($id, $columns = ['*'])
 * @method Foto find($id, $columns = ['*'])
 * @method Foto first($columns = ['*'])
*/
class FotoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Foto::class;
    }

    /**
     * uploadAndCreate - Guarda o arquivo no /uploads/ e cria a Foto.
     *
     * @param mixed $request
     */
    public function uploadAndCreate($request)
    {
        $files = $request->allFiles()['files'];
        $request = is_array($request) ? $request : $request->all();

        foreach ($files as $file) {
            //Quando a imagem é croppada, ele envia o blob da imagem oque nao conta como object
            if ($file && ! is_object($file)) {
                $filename = time();
                $image = \Image::make($file);
                //Criando path inicial para direcionar o arquivo
                $destinationPath = storage_path().'/images/';
                //Pega o formato da imagem
                $extension = 'jpeg';
                $upload_success = $image->save($destinationPath.$filename.'.'.$extension);
                //Se o upload da foto ocorreu com sucesso
                if ($upload_success) {

                    //adicionando as informações da foto na request
                    $file->image_name = $filename;
                    $file->image_path = $destinationPath;
                    $file->image_extension = $extension;

                    //Criando e persistindo no BD uma nova foto já associada ao user
                    $novasFotos[] = $this->model->create((array) $file);
                    // Se nao tiver funcionado, retornar false no success para o js se manisfestar
                } else {
                    return [
                        'success' => false,
                    ];
                }
            } else {

                //Criando path inicial para direcionar o arquivo
                $destinationPath = storage_path().'/images/';
                //Pega o formato da imagem
                $extension = $file->getClientOriginalExtension();

                //usando o intervention para criar a imagem
                $filename = time();
                $image = \Image::make($file->getRealPath());
                $upload_success = $image->save($destinationPath.$filename.'.'.$extension);

                //Se o upload da foto ocorreu com sucesso
                if ($upload_success) {

                    //adicionando as informações da foto na request
                    $file->image_name = $filename;
                    $file->image_path = $destinationPath;
                    $file->image_extension = $extension;

                    //Criando e persistindo no BD uma nova foto já associada ao user
                    $novasFotos[] = $this->model->create((array) $file);
                    // Se nao tiver funcionado, retornar false no success para o js se manisfestar
                } else {
                    return [
                        'success' => false,
                    ];
                }
            }
        }

        return $novasFotos;
    }

    /**
     * Metodo para enviar a foto para o cloudinary e atualizar o cloudinary_id a foto.
     *
     * @param App\Models\Foto $foto - instancia de Foto.
     * @param string $publicId - public id desejado para a foto
     * @param string $pasta - pasta do cloudinary caso esteja usando alguma
     */
    public static function sendToCloudinary($foto, $publicId, $pasta=null)
    {
        $pasta = $pasta ? ['folder' => $pasta] : [];

        //Se existir o file
        if (\File::exists($foto->fullPath)) {
            $retornoCloudinary = \Cloudder::upload($foto->fullPath, $publicId, $pasta);

            return  $foto->update([
                'cloudinary_id' => $publicId,
            ]);
        } else {
            return false;
        }
    }

    /**
     * Remove a imagem do Cloudinary
     *
     * @param $fotoID
     * @return boolean
     */
    public function removeFromCloudinary($fotoID)
    {
        $foto = $this->find($fotoID);
        $retornoCloudinary = \Cloudder::destroyImage($foto->cloudinary_id);

        return  empty($retornoCloudinary->deleted) ? false : true;
    }

    /**
     * Override BaseRepository@delete - para remover também do cloudinary
     *
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        $this->removeFromCloudinary($id);
        $this->deleteLocal($id);

        return parent::delete($id);
    }

    /**
     * Deleta o arquivo do filesystem
     *
     * @param mixed $id
     */
    public static function deleteLocal($id)
    {
        $foto = Foto::find($id);

        if ($foto && \File::exists($foto->fullPath)) {
            \File::delete($foto->fullPath);
        }
    }
}
