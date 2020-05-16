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
                        <router-link to="/experience">Experience</router-link>&nbsp;>> View Experience
                    </div>
                    <div class="card-body">
                        <div v-if="ifReady">
                            <fieldset disabled>
                                <div class="form-group">
                                    <label for="role"><strong>Role</strong></label>
                                    <input type="text" class="form-control" v-model="experience.role">
                                </div>
                                <div class="form-group">
                                    <label for="company_name"><strong>Company Name</strong></label>
                                    <input type="text" class="form-control" v-model="experience.company_name">
                                </div>
                                <div class="form-group">
                                    <label for="employment_type"><strong>Employment Type</strong></label>
                                    <input type="text" class="form-control" v-model="experience.employment_type">
                                </div>
                                <div class="form-group">
                                    <label for="location"><strong>Location</strong></label>
                                    <input type="text" class="form-control" v-model="experience.location">
                                </div>
                                <div class="form-group">
                                    <label for="start_date"><strong>Start Date</strong></label>
                                    <input type="date" class="form-control" v-model="experience.start_date">
                                </div>
                                <input type="checkbox" id="isCurrent" v-model="isCurrent">
                                <label for="isCurrent"><strong>Current Job</strong></label>
                                <div class="form-group" v-if="!isCurrent">
                                    <label for="end_date"><strong>End Date</strong></label>
                                    <input type="date" class="form-control" v-model="experience.end_date">
                                </div>
                            </fieldset>
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
                experience: '',
                isCurrent: '',
            };
        },

        mounted() {
            let promise = new Promise((resolve, reject) => {
                axios.get('/api/experience/' + this.$route.params.id).then(res => {
                    this.experience = res.data.experience;
                    if (this.experience.end_date == null){
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