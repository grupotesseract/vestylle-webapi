<template>
    <div class="row slider-container" v-if="images.length > 0">
        <div class="col" v-if="currentImage.cloudinary_id">
            <a class="prev-image-link" @click="prev"><i class="fa fa-chevron-left"></i></a>
        </div>
        <div class="col" v-for="number in [currentNumber]">
          <div v-if="isEditRoute()">
            <button type="button" class="btn btn-danger remove-img-button" title="Excluir imagem" @click="removeImg(currentImage)"><i class="fa fa-trash"></i></button>
          </div>
          <img v-if="currentImage.cloudinary_id" class="slider-image" :alt="Foto" :src="currentImage.urlCloudinary"/>
          <div v-if="!currentImage.cloudinary_id" class="slider-loader" :title="'Imagem em processamento, clique para atualizar'" v-on:click="refresh()"></div>
        </div>
        <div class="col" v-if="currentImage.cloudinary_id">
            <a class="next-image-link" @click="next"><i class="fa fa-chevron-right"></i></a>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['images'],
        data() {
            return {
                currentNumber: 0,
                images: []
            }
        },
        methods: {
            next: function() {
                this.currentNumber += 1
            },
            prev: function() {
                this.currentNumber -= 1
            },
            removeImg(currentImage) {

                swal({
                    title: 'Remover imagem?',
                    type: 'warning',
                    text: 'A página será recarregada e quaisquer alterações que não foram salvas serão perdidas.',
                    showCancelButton: true,
                    showConfirmButton: true
                })
                .then( (isConfirm) => {
                    console.log('confirmou?');
                    console.log(isConfirm);

                    if (isConfirm.value) {
                        const imgIndex = this.images.indexOf(currentImage);

                        axios.delete('/imagens/' + currentImage.id,
                            {},
                            {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                }
                            }
                        ).then(function(data) {
                            this.images.splice(imgIndex, 1 );
                            this.next();
                            swal({
                                title: 'Imagem removida com sucesso',
                                type: 'success',
                            });
                            window.setTimeout( () => window.location.reload(true), 800)
                        }.bind(this)).catch(function(data) {
                            console.log('error');
                        });

                    }
                });
            },
            isEditRoute() {
                const currentUrl = window.location.href;
                const pattern = new RegExp('edit');
                return pattern.test(currentUrl);
            },
            refresh() {
                window.location.reload(true);
            }
        },
        computed: {
            currentImage: function() {
              const currentNumber = this.currentNumber;
              const images = this.images;
              return images[Math.abs(currentNumber) % images.length];
            }
        },
        mounted() {
            window.setInterval(() => {
                const isUploading = this.images.some(image => image.cloudinary_id == null);

                if (isUploading) {
                    this.refresh();
                }
            }, 3500);
        }
    }
</script>

<style scoped>
    .slider-container {
        display: flex;
        align-items: center;
        padding: 0 5em;
    }

    .prev-image-link {
        cursor: pointer;
        font-size: 3em;
        margin-right: .5em;
    }

    .next-image-link {
        cursor: pointer;
        font-size: 3em;
        margin-left: 1em;
    }

    .slider-image {
        height: 30em;
        width: 30em;
        object-fit: cover;
        animation: fadein 0.8s;
    }

    .remove-img-button {
        position: absolute;
        margin-left: 23em;
        animation: fadein 0.8s;
    }

    @keyframes fadein {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    .slider-loader,
    .slider-loader:after {
      border-radius: 50%;
      width: 10em;
      height: 10em;
    }
    .slider-loader {
      cursor: pointer;
      margin: 60px auto;
      font-size: 10px;
      position: relative;
      text-indent: -9999em;
      border-top: 1.1em solid rgba(255, 255, 255, 0.2);
      border-right: 1.1em solid rgba(255, 255, 255, 0.2);
      border-bottom: 1.1em solid rgba(255, 255, 255, 0.2);
      border-left: 1.1em solid rgba(0, 0, 0, 0.50);
      -webkit-transform: translateZ(0);
      -ms-transform: translateZ(0);
      transform: translateZ(0);
      -webkit-animation: load8 1.1s infinite linear;
      animation: load8 1.1s infinite linear;
    }
    @-webkit-keyframes load8 {
      0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
      }
      100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }
    @keyframes load8 {
      0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
      }
      100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }


</style>
