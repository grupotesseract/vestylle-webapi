<template>
    <div class="row slider-container" v-if="images.length > 0">
        <div class="col">
            <a class="prev-image-link" @click="prev"><i class="fa fa-chevron-left"></i></a>
        </div>
        <div class="col" v-for="number in [currentNumber]">
          <button type="button" class="btn btn-danger remove-img-button" title="Excluir imagem" @click="removeImg(currentImage)"><i class="fa fa-trash"></i></button>
          <img class="slider-image" :alt="'Foto indisponível'" :src="currentImage.urlCloudinary"/>
        </div>
        <div class="col">
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
                        showConfirmButton: true
                    });
                }.bind(this)).catch(function(data) {
                    console.log('error');
                });
            }
        },
        computed: {
            currentImage: function() {
              const currentNumber = this.currentNumber;
              const images = this.images;
              return images[Math.abs(currentNumber) % images.length];
            }
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

</style>
