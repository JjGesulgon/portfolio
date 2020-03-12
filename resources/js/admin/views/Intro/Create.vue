<template>
    <div class="main_content">
        <div class="info">
            <div class="mr-auto mt-5 lettering">
                Intro
            </div>
            <div>
                <div class="d-flex flex-row-reverse">
                    <button type="button"  class="btn btn-secondary" @click.prevent.default="viewIntro">Back</button>
                </div>
                <div class="card">
                    <div class="card-header">
                        Create New Intro
                    </div>
                    <div class="card-body">
                        <div v-if="ifReady">
                            <form v-on:submit.prevent="createNewIntro">
                                <div class="form-group">
                                    <label>Image (optional)</label>
                                    <input type="file" class="form-control-file" @change="onFileSelected">
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input id="name" type="text" class="form-control" v-model="name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                                <div class="form-group">
                                    <label>Body</label>
                                    <!-- <textarea class="form-control" v-model="body" id="body" rows="20"></textarea> -->
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
                                <button type="submit" class="btn btn-primary btn-sm">Create Intro</button>
                            </form>
                        </div>

                        <div v-else>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
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
                image: null,
                name: '',
                body: '',
                errors: [],
                
            };
        },

        mounted() {
        },

        methods: {
            createNewIntro() {
                this.ifReady = false;
                this.errors = [];

                let formData = new FormData();

                if (this.image != null) {
                    formData.append('image', this.image);
                }

                formData.append('name', this.name);
                formData.append('body', tinyMCE.activeEditor.getContent());

                axios.post('/api/intro', formData).then(res => {
                    this.$router.push({ name: 'intro.index' });
                }).catch(err => {
                    this.errors = err.response.data.errors
                    this.ifReady = true;
                    console.log(err.response);
                });
            },

            viewIntro() {
                this.$router.push({
                    name: 'intro.index'
                });
            },

             onFileSelected(event) {
                this.image = event.target.files[0];
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
        margin-left: 200px;
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