<template>
    <div class="main_content">
        <div class="info">
            <div class="mr-auto mt-5 lettering">
                Projects
            </div>
            <div>
                <div class="d-flex flex-row-reverse">
                    <label class="text-secondary clickableText header-margin" @click.prevent.default="viewProjects">
                        <i class="fas fa-long-arrow-alt-left"></i>&nbsp;
                        <strong>Back</strong>
                    </label>
                </div>
                <div class="card">
                    <div class="card-header">
                        <router-link to="/projects">Projects</router-link>&nbsp;>> View Project
                    </div>
                    <div class="card-body">
                        <div v-if="ifReady">
                            <fieldset disabled>
                                <div class="form-group">
                                    <label for="name"><strong>Name</strong></label>
                                    <input type="text" class="form-control" v-model="projects.name">
                                </div>
                                <div class="form-group">
                                    <label for="description"><strong>Description</strong></label>
                                    <div class="body" v-html="projects.description"></div>
                                </div>
                                <div class="form-group">
                                    <label for="role"><strong>Role</strong></label>
                                    <input type="text" class="form-control" v-model="projects.role">
                                </div>
                                <div class="form-group">
                                    <label for="live_link"><strong>Live Link</strong></label>
                                    <input type="text" class="form-control" v-model="projects.live_link">
                                </div>
                                <div class="form-group">
                                    <label for="github_link"><strong>Github Link</strong></label>
                                    <input type="text" class="form-control" v-model="projects.github_link">
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
                projects: '',
                isCurrent: '',
            };
        },

        mounted() {
            let promise = new Promise((resolve, reject) => {
                axios.get('/api/projects/' + this.$route.params.id).then(res => {
                    this.projects = res.data.project;
                    resolve();
                });
            });

            promise.then(() => {
                this.ifReady = true;
            });
        },

        methods: {
            viewProjects() {
                this.$router.push({
                    name: 'projects.index'
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