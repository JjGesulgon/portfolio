<template>
    <div class="main_content">
        <div class="info">
            <div class="mr-auto mt-5 lettering">
                Project Images
            </div>
            <div>
                <div class="d-flex flex-row-reverse">
                    <label class="text-secondary clickableText header-margin" @click.prevent.default="viewProjectImages">
                        <i class="fas fa-long-arrow-alt-left"></i>&nbsp;
                        <strong>Back</strong>
                    </label>
                </div>
                <div class="card">
                    <div class="card-header">
                        <router-link to="/project-images">Project Images</router-link>&nbsp;>> Edit Project
                    </div>
                    <div class="card-body">
                        <div v-if="ifReady">
                            <form v-on:submit.prevent="updateProjectImages" method="POST">
                                <div class="form-group">
                                    <label><strong>Name</strong></label>
                                    <input type="text" class="form-control" v-model="name" autocomplete="off" minlength="2" maxlength="255">
                                </div>
                                <div class="form-group">
                                    <label>Image (optional)</label>
                                    <input type="file" class="form-control-file" @change="onFileSelected">
                                </div>
                                <div class="form-group">
                                    <label>Project</label>
                                    <b-form-select v-model="selectedProject">
                                        <template v-slot:first>
                                            <b-form-select-option :value="null" disabled>-- Please select a project --</b-form-select-option>
                                        </template>
                                        <option v-for="{id, name} in this.options" 
                                            :key="name"
                                            :value="id"
                                        >
                                            {{ name }}
                                        </option>
                                    </b-form-select>
                                </div>
                                <div v-if="errors != []">
                                    <div class="alert alert-danger" v-for="error in errors">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <strong>Error!</strong> {{ error[0] }}
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary btn-sm" @click.prevent.default="updateProjectImages">Update Project</button>
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
                name: '',
                image: '',
                projID: '',
                projSelected: null,
                selectedProject: null,
                options: [],
                errors: [],
            };
        },

        mounted() {
            let promise = new Promise((resolve, reject) => {
                axios.get('/api/projectImages/' + this.$route.params.id).then(res => {
                    this.id    = res.data.project_images.id;
                    this.name  = res.data.project_images.caption;
                    this.selectedProject  = res.data.project_images.project_id;
                    resolve();
                });
            });

            promise.then(() => {
                this.ifReady = true;
            });

            let promise2 = new Promise((resolve, reject) => {
                axios.get('/api/list-projects').then(res => {
                    this.options = res.data.data;
                    resolve();
                }).catch(error => {
                    this.ifReady = true
                });
            });
        },

        methods: {
            onFileSelected(event) {
                this.image = event.target.files[0];
            },

            viewProjectImages() {
                this.$router.push({
                    name: 'project-images.index'
                });
            },

            updateProjectImages() {
                this.errors = [];
                this.ifReady = false;
                let formData = new FormData();
                formData.append('_method','PATCH');
                formData.append('caption', this.name);
                formData.append('project_id', this.selectedProject);

                if (this.image != null) {
                    formData.append('image', this.image);
                }

                axios.post('/api/projectImages/' + this.$route.params.id, formData,  {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(res => {
                    this.toast('Success','Project Image edited', 'Successfully submitted the request', 'secondary')
                    this.$router.push({ name: 'project-images.index' });
                }).catch(err => {
                    this.errors = err.response.data.errors
                    this.ifReady = true;
                    console.log(err.response);
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