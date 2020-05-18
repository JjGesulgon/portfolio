<template>
    <div class="main_content">
        <div class="info">
            <div class="mr-auto mt-5 lettering">
                Experience
            </div>
            <div>
                <div class="d-flex flex-row-reverse">
                    <label class="text-secondary clickableText header-margin" @click.prevent.default="viewExperience">
                        <i class="fas fa-long-arrow-alt-left"></i>&nbsp;
                        <strong>Back</strong>
                    </label>
                </div>
                <div class="card">
                    <div class="card-header">
                        <router-link to="/experience">Experiences</router-link>&nbsp;>> Edit Experience
                    </div>
                    <div class="card-body header-margin">
                        <div v-if="ifReady">
                            <form v-on:submit.prevent="editAdmin">
                                <div class="form-group">
                                    <label><strong>Role</strong></label>
                                    <input type="text" class="form-control" v-model="role" autocomplete="off" minlength="2" maxlength="255">
                                </div>
                                <div class="form-group">
                                    <label><strong>Company Name</strong></label>
                                    <input type="text" class="form-control" v-model="company_name">
                                </div>
                                <div class="form-group">
                                    <label><strong>Employee Type</strong></label>
                                    <input type="text" class="form-control" v-model="employment_type">
                                </div>
                                <div class="form-group">
                                    <label><strong>Location</strong></label>
                                    <input type="text" class="form-control" v-model="location">
                                </div>
                                <div class="form-group">
                                    <label><strong>Start Date</strong></label>
                                    <input type="date" class="form-control" v-model="start_date">
                                </div>
                                <input type="checkbox" id="isCurrent" v-model="isCurrent">
                                <label for="isCurrent"><strong>Current Job</strong></label>
                                <div class="form-group"  v-if="!isCurrent">
                                    <label><strong>End Date</strong></label>
                                    <input type="date" class="form-control" v-model="end_date">
                                </div>
                                <div v-if="errors != []">
                                    <div class="alert alert-danger" v-for="error in errors">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <strong>Error!</strong> {{ error[0] }}
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary btn-sm" @click.prevent.default="updateExperience">Update Experience</button>
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
                role: '',
                company_name: '',
                employment_type: '',
                location: '',
                start_date: '',
                end_date: '',
                isCurrent: '',
                errors: []
            };
        },

        mounted() {
            let promise = new Promise((resolve, reject) => {
                axios.get('/api/experience/' + this.$route.params.id).then(res => {
                    console.log()
                    this.id    = res.data.experience.id;
                    this.role  = res.data.experience.role;
                    this.company_name = res.data.experience.company_name;
                    this.employment_type = res.data.experience.employment_type;
                    this.location = res.data.experience.location;
                    this.start_date = res.data.experience.start_date;
                    this.end_date = res.data.experience.end_date;

                    if (this.end_date == null){
                        this.isCurrent = true
                    }
                    resolve();
                });
            });

            promise.then(() => {
                this.ifReady = true;
            });
        },

        methods: {
            viewExperience() {
                this.$router.push({
                    name: 'experience.index'
                });
            },
            updateExperience() {
                this.errors = [];
                let formData = new FormData();
                formData.append('_method','PATCH');
                formData.append('role', this.role);
                formData.append('company_name', this.company_name);
                formData.append('employment_type', this.employment_type);
                formData.append('location', this.location);
                formData.append('start_date', this.start_date);
                if(!this.isCurrent){
                    formData.append('end_date', this.end_date);
                    if (this.end_date == null){
                        alert("Error: End date can't be null")
                        return
                    }
                }
                axios.post('/api/experience/' + this.$route.params.id, formData).then(res => {
                    this.toast('Success','Experience updated', 'Successfully submitted the request', 'secondary')
                    this.$router.push({
                        name: 'experience.index'
                    });
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