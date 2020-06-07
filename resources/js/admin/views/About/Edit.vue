<template>
    <div class="main_content">
        <div class="info">
            <div class="mr-auto mt-5 lettering">
                About
            </div>
            <div>
                <div class="d-flex flex-row-reverse">
                    <label class="text-secondary clickableText header-margin" @click.prevent.default="viewAbout">
                        <i class="fas fa-long-arrow-alt-left"></i>&nbsp;
                        <strong>Back</strong>
                    </label>
                </div>
                <div class="card">
                    <div class="card-header">
                        <router-link to="/about">About</router-link>&nbsp;>> Edit About
                    </div>
                    <div class="card-body header-margin">
                        <div v-if="ifReady">
                            <form v-on:submit.prevent="updateAbout">
                                <div class="form-group">
                                    <label><strong>Body</strong></label>
                                    <!-- font_formats: 'Arial=arial,helvetica,sans-serif; Courier New=courier new,courier,monospace; AkrutiKndPadmini=Akpdmi-n; Raleway', -->
                                    <!-- fontsize_formats: '11px 12px 13px 14px 15px 16px 18px 24px 36px 48px', -->
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

                                <button type="button" class="btn btn-secondary btn-sm" @click.prevent.default="updateAbout">Update About</button>
                            </form>
                        </div>
                        <div v-else>
                            <div class="d-flex justify-content-center mb-3">
                                <b-spinner label="Loading..."></b-spinner>
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
                    this.toast('Success','About updated', 'Successfully submitted the request', 'secondary')
                    this.$router.push({
                        name: 'about.index',
                    });
                }).catch(err => {
                    this.errors = err.response.data.errors;
                    this.ifReady = true;
                    this.toast('Error','Failed to submit', 'Unable to process request!', 'danger')
                });
            },

            viewAbout() {
                this.$router.push({
                    name: 'about.index'
                });
            },

            onFileSelected(event) {
                this.image = event.target.files[0];
            },

            toast(title, subtitle, body, variant) {
                // Toast element
                const h = this.$createElement

                // Increment the toast count
                this.count++

                // Create the message
                const vNodesMsg = h(
                'p',
                { class: ['text-center', 'mb-0'] },
                [
                    h('b-spinner', { props: { type: 'grow', small: true } }),
                    `  `,
                    h('strong', { class: 'text-muted' }, body),
                    `  `,
                    // ` ${body} `,
                    h('b-spinner', { props: { type: 'grow', small: true } })
                ]
                )

                // Create the title
                const vNodesTitle = h(
                'div',
                { class: ['d-flex', 'flex-grow-1', 'align-items-baseline', 'mr-2'] },
                [
                    h('strong', { class: 'mr-2' }, title),
                    h('small', { class: 'ml-auto text-italics' }, subtitle)
                ]
                )
                // Pass the VNodes as an array for message and title
                this.$bvToast.toast([vNodesMsg], {
                    title: [vNodesTitle],
                    solid: true,
                    toaster: 'b-toaster-bottom-right',
                    variant: variant
                })
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