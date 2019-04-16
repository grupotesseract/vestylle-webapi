<template>
    <div class="row slider-container">
        <div class="col">
            <a class="prev-image-link" @click="prev"><i class="fa fa-chevron-left"></i></a>
        </div>
        <div class="col" v-for="number in [currentNumber]">
          <img class="slider-image" :alt="'Foto indisponível'" :src="currentImage"/>
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
            }
        },
        computed: {
            currentImage: function() {
              const currentNumber = this.currentNumber;
              const images = this.images;
              console.log(images);
              console.log(images[Math.abs(currentNumber) % images.length].urlCloudinary);
              return images[Math.abs(currentNumber) % images.length].urlCloudinary;
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
        animation: fadein 0.8s;
    }

    @keyframes fadein {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

</style>
