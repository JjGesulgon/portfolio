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
                        <router-link to="/experience">Experiences</router-link>&nbsp;>> Add Experience
                    </div>
                    <div class="card-body header-margin">
                        <div v-if="ifReady">
                            <form v-on:submit.prevent="createNewExperience">
                                <div class="form-group">
                                    <label><strong>Role</strong></label>
                                    <input id="role" type="text" class="form-control" v-model="role" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                                <div class="form-group">
                                    <label><strong>Company Name</strong></label>
                                    <input type="text" class="form-control" v-model="company_name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                                <div class="form-group">
                                    <label><strong>Employment Type</strong></label>
                                    <input type="text" class="form-control" v-model="employment_type" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                                <div class="form-group">
                                    <label><strong>Location</strong></label>
                                    <input type="text" class="form-control" v-model="location" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                                <div class="form-group">
                                    <label><strong>Start Date</strong></label>
                                    <input type="date" class="form-control" v-model="start_date" autocomplete="off" required>
                                </div>
                                <input type="checkbox" id="isCurrent" v-model="isCurrent">
                                <label for="isCurrent"><strong>Current Job</strong></label>
                                <div class="form-group" v-if="!isCurrent">
                                    <label><strong>End Date</strong></label>
                                    <input type="date" class="form-control" v-model="end_date" autocomplete="off">
                                </div>
                                <div v-if="errors != []">
                                    <div class="alert alert-danger" v-for="error in errors">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <strong>Error!</strong> {{ error[0] }}
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-secondary btn-sm">Add Experience</button>
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
                role: '',
                company_name: '',
                employment_type: '',
                location: '',
                start_date: '',
                end_date: '',
                isCurrent: true,
                errors: []
            };
        },

        mounted() {
                var date = new Date();
                this.start_date = date;
        },

        methods: {
            createNewExperience() {
                this.ifReady = false;
                this.errors = [];

                axios.post('/api/experience', this.$data).then(res => {
                     this.$router.push({ name: 'experience.index' });
                }).catch(err => {
                    this.errors = err.response.data.errors
                    this.ifReady = true;
                    console.log(err.response);
                });
            },

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