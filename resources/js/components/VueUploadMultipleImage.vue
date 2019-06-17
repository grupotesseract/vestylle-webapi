<template>
    <div >
        <div class="large-12 medium-12 small-12 filezone">
            <input name="files[]" type="file" id="files" ref="files" multiple v-on:change="handleFiles()"/>
            <p>
                <i class="fa fa-camera-retro"></i>
                Arraste as imagens até aqui ou clique para escolher
            </p>
        </div>

        <div v-for="(file, key) in files" class="file-listing">
            <img class="preview" v-bind:ref="'preview'+parseInt(key)"/>
            {{ file.name }}
            <div class="success-container" v-if="file.id > 0">
                Success
                <input type="hidden" :name="input_name" :value="file.id"/>
            </div>
            <div class="remove-container" v-else>
                <button type="button" class="btn btn-danger" v-on:click="removeFile(key)">Remover</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['input_name', 'model', 'model_id', 'post_url'],
        data() {
            return {
                files: []
            }
        },
        methods: {
            removeFile( key ){
                this.files.splice( key, 1 );
                this.getImagePreviews();
            },
            handleFiles() {
                let uploadedFiles = this.$refs.files.files;

                if (uploadedFiles.length > 10 || this.files.length == 10) {
                    swal({
                        title: 'Ops!',
                        type: 'warning',
                        html: 'O upload pode conter no máximo 10 arquivos.',
                        showConfirmButton: true
                    });
                    return;
                }

                for(var i = 0; i < uploadedFiles.length; i++) {
                    this.files.push(uploadedFiles[i]);
                }
                console.log(this.files);
                this.$emit('upload', this.files)
                this.getImagePreviews();
            },
            getImagePreviews(){
                for( let i = 0; i < this.files.length; i++ ){
                    if ( /\.(jpe?g|png|gif)$/i.test( this.files[i].name ) ) {
                        let reader = new FileReader();
                        reader.addEventListener("load", function(){
                            this.$refs['preview'+parseInt(i)][0].src = reader.result;
                        }.bind(this), false);
                        reader.readAsDataURL( this.files[i] );
                    }else{
                        this.$nextTick(function(){
                            this.$refs['preview'+parseInt(i)][0].src = '/img/generic.png';
                        });
                    }
                }
            },
            submitFiles() {
                if (!this.files.length) {
                    console.log('no files');
                    return;
                }

                let formData = new FormData();

                formData.append('model', this.model);
                formData.append('model_id', this.model_id);

                for( let i = 0; i < this.files.length; i++ ){
                    if(this.files[i].id) {
                        continue;
                    }
                    formData.append('files[]', this.files[i]);
                }

                axios.post('/' + this.post_url,
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(function(data) {
                    this.files = [];
                }.bind(this)).catch(function(data) {
                    console.log('error');
                });
            }
        }
    }
</script>

<style scoped>
    input[type="file"]{
        opacity: 0;
        width: 100%;
        height: 200px;
        position: absolute;
        cursor: pointer;
    }
    .filezone {
        margin: 1em auto;
        outline: 2px dashed grey;
        outline-offset: -10px;
        background: #ccc;
        border-radius: .4em;
        color: dimgray;
        padding: 10px 10px;
        min-height: 200px;
        cursor: pointer;
    }
    .filezone:hover {
        background: #c0c0c0;
    }

    .filezone p {
        font-size: 1.5em;
        text-align: center;
        padding: 4em 5em;
    }

    .filezone i {
        margin-right: 2em;
    }

    div.file-listing img{
        max-width: 90%;
    }

    div.file-listing{
        margin: auto;
        padding: 10px;
        border-bottom: 1px solid #ddd;
        display: flex;
        align-items: center;
        justify-content: space-around;
    }

    div.file-listing img{
        object-fit: cover;
        height: 200px;
        width: 200px;
    }

    div.success-container{
        text-align: center;
        color: green;
    }

    div.remove-container{
        text-align: center;
        align-items: center;
    }

    div.remove-container a{
        color: red;
        cursor: pointer;
    }

    a.submit-button{
        display: block;
        margin: auto;
        text-align: center;
        width: 200px;
        padding: 10px;
        text-transform: uppercase;
        background-color: #CCC;
        color: white;
        font-weight: bold;
        margin-top: 20px;
    }
</style>
