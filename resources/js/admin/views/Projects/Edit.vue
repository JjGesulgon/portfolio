<template>
    <div class="main_content">
        <div class="info">
            <div class="mr-auto mt-5 lettering">
                Projects
            </div>
            <div>
                <div class="d-flex flex-row-reverse">
                    <label class="text-secondary clickableText header-margin" @click.prevent.default="viewProject">
                        <i class="fas fa-long-arrow-alt-left"></i>&nbsp;
                        <strong>Back</strong>
                    </label>
                </div>
                <div class="card">
                    <div class="card-header">
                        <router-link to="/projects">Projects</router-link>&nbsp;>> Edit Project
                    </div>
                    <div class="card-body">
                        <div v-if="ifReady">
                            <form v-on:submit.prevent="editAdmin">
                                <div class="form-group">
                                    <label><strong>Name</strong></label>
                                    <input type="text" class="form-control" v-model="name" autocomplete="off" minlength="2" maxlength="255">
                                </div>
                                <div class="form-group">
                                    <label>Image (optional)</label>
                                    <input type="file" class="form-control-file" @change="onFileSelected">
                                </div>
                                <div class="form-group">
                                    <label><strong>Description</strong></label>
                                    <tinymce-component
                                        v-model="description"
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
                                <div class="form-group">
                                    <label><strong>Role</strong></label>
                                    <input type="text" class="form-control" v-model="role">
                                </div>
                                <div class="form-group">
                                    <label><strong>Live Link</strong></label>
                                    <input type="text" class="form-control" v-model="live_link">
                                </div>
                                <div class="form-group">
                                    <label><strong>Github Link</strong></label>
                                    <input type="text" class="form-control" v-model="github_link">
                                </div>
                                <div v-if="errors != []">
                                    <div class="alert alert-danger" v-for="error in errors">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <strong>Error!</strong> {{ error[0] }}
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary btn-sm" @click.prevent.default="updateProject">Update Project</button>
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
                ifReady: false,
                id: '',
                name: '',
                image: '',
                description: '',
                role: '',
                live_link: '',
                github_link: '',
                errors: []
            };
        },

        mounted() {
            let promise = new Promise((resolve, reject) => {
                axios.get('/api/projects/' + this.$route.params.id).then(res => {
                    console.log()
                    this.id    = res.data.project.id;
                    this.name  = res.data.project.name;
                    this.image = res.data.project.image;
                    this.description = res.data.project.description;
                    this.role = res.data.project.role;
                    this.live_link = res.data.project.live_link;
                    this.github_link = res.data.project.github_link;
                    resolve();
                });
            });

            promise.then(() => {
                this.ifReady = true;
            });
        },

        methods: {
            onFileSelected(event) {
                this.image = event.target.files[0];
            },

            viewProject() {
                this.$router.push({
                    name: 'projects.index'
                });
            },
            updateProject() {
                this.errors = [];
                this.ifReady = false;
                let formData = new FormData();
                formData.append('_method','PATCH');
                formData.append('name', this.name);
                formData.append('image', this.image);
                formData.append('description', this.description);
                formData.append('role', this.role);
                formData.append('live_link', this.live_link);
                formData.append('github_link', this.github_link);

                axios.post('/api/projects/' + this.$route.params.id, formData).then(res => {
                    this.toast('Success','Project updated', 'Successfully submitted the request', 'secondary')
                    this.$router.push({
                        name: 'projects.index'
                    });
                    this.ifReady = true;
                    }).catch(err => {
                        this.errors = err.response.data.errors;
                        this.ifReady = true;
                        console.log(err);
                        this.toast('Error','Failed to submit', 'Unable to process request!', 'danger')
                    });
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