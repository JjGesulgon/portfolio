<template>
    <div class="main_content">
        <div class="info">
            <div class="mr-auto mt-5 lettering">
                Skills
            </div>
            <div>
                <div class="d-flex flex-row-reverse">
                    <label class="text-secondary clickableText header-margin" @click.prevent.default="viewSkills">
                        <i class="fas fa-long-arrow-alt-left"></i>&nbsp;
                        <strong>Back</strong>
                    </label>
                </div>
                <div class="card">
                    <div class="card-header">
                        <router-link to="/skills">Skills</router-link>&nbsp;>> Add Skill
                    </div>
                    <div class="card-body">
                        <div v-if="ifReady">
                            <form v-on:submit.prevent="createNewSkill">
                                <div class="form-group">
                                    <label><strong>Name</strong></label>
                                    <input id="name" type="text" class="form-control" v-model="name" autocomplete="off" minlength="2" maxlength="255" required>
                                </div>
                                <div v-if="errors != []">
                                    <div class="alert alert-danger" v-for="error in errors">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <strong>Error!</strong> {{ error[0] }}
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-secondary btn-sm">Create New Skill</button>
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
                errors: []
            };
        },

        mounted() {
                var date = new Date();
                this.start_date = date;
        },

        methods: {
            createNewSkill() {
                this.ifReady = false;
                this.errors = [];

                axios.post('/api/skill', this.$data).then(res => {
                     this.$router.push({ name: 'skills.index' });
                }).catch(err => {
                    this.errors = err.response.data.errors
                    this.ifReady = true;
                    console.log(err.response);
                });
            },

            viewSkills() {
                this.$router.push({
                    name: 'skills.index'
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