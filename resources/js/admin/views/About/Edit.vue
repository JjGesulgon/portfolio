<template>
    <div class="main_content">
        <div class="info">
            <div class="mr-auto mt-5 lettering">
                About
            </div>
            <div>
                <div class="d-flex flex-row-reverse">
                    <button type="button"  class="btn btn-secondary" @click.prevent.default="viewAbout">Back</button>
                </div>
                <div class="card">
                    <div class="card-header">
                        Edit About
                    </div>
                    <div class="card-body">
                        <div v-if="ifReady">
                            <form v-on:submit.prevent="updateAbout">
                                <div class="form-group">
                                    <label>Image (optional)</label>
                                    <input type="file" class="form-control-file" @change="onFileSelected">
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" v-model="name" minlength="2" maxlength="255" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label>Body</label>
                                    <tinymce-component
                                        v-model="body"
                                        api-key="v8631ogi6aq7uc2h9z8tr72t2r3krmwlsbj5k4swk4i448f9"
                                        :init="{
                                            height: 500,
                                            menubar: false,
                                            plugins: [
                                            'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
                                            ],
                                            menubar: 'file edit view insert format tools table help',
                                            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
                                            toolbar_sticky: true,
                                        }"
                                    />
                                </div>
                                <div v-if="errors != []">
                                    <div class="alert alert-danger" v-for="error in errors">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <strong>Error!</strong> {{ error[0] }}
                                    </div>
                                </div>

                                <button type="button" class="btn btn-success btn-sm" @click.prevent.default="updateAbout">Update About</button>
                            </form>
                        </div>
                        <div v-else>
                            <div class="container loader"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                ifReady: true,
                id: '',
                image: null,
                currentImage: '',
                name: '',
                body: '',
                errors: []
            };
        },

        mounted() {
            let promise = new Promise ((resolve, reject) => {
                axios.get('/api/about').then(res => {
                    this.id             = res.data.about.id;
                    tinyMCE.activeEditor.setContent(res.data.about.body);
                    resolve();
                });
            });

            promise.then(() => {
                this.ifReady = true;
            });
        },

        methods: {
            updateAbout() {
                this.ifReady = false;
                this.errors = [];

                let formData = new FormData();
                formData.append('_method','PATCH');
                formData.append('body', tinyMCE.activeEditor.getContent());

                axios.post('/api/about/' + this.id, formData).then(res => {
                    this.$router.push({
                        name: 'about.index',
                    });
                }).catch(err => {
                    this.errors = err.response.data.errors;
                    this.ifReady = true;
                });
            },

            viewAbout() {
                this.$router.push({
                    name: 'about.index'
                });
            },
        }
    }
</script>
<style scoped>
    .display-flex{
         display: flex;
    }

    .navi-item{
        margin-right: 210px !important;
    }

    .lettering{
        font-size: 45px;
    }
    .header{
        padding-top: 5px !important;
        padding-bottom: 5px !important;
        padding-left: 20px !important;
        padding-right: 20px !important;
        background: #fff;
        color: #717171;
        border-bottom: 1px solid #e0e4e8;
    }

    .info{
        margin: 20px;
        color: #717171;
        line-height: 25px;
    }

    .main_content{
        width: auto;
    }

    .main_content .header{
        padding: 20px;
        background: #fff;
        color: #717171;
        border-bottom: 1px solid #e0e4e8;
    }

    .main_content .info{
        margin-left: 40px;
        margin-right: 40px;
        margin-top: 20px;
        color: #717171;
        line-height: 25px;
    }

    .main_content .info div{
        margin-bottom: 20px;
    }

</style>