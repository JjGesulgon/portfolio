<template>
    <div>
        <projects-header-component></projects-header-component>
        <div class="text-center sub-intro">
            <div class="pt-5">
                <b-img src="/assets/pencil.svg" fluid alt="Responsive image" class="icon-design"></b-img>
            </div>
            <div class="text-center projects-text-content">
                <p>What I've been up to.</p>
            </div>
        </div>
        <div v-if="ifReady == true" v-for="project in projects" v-bind:key="project.name" class="project-container">
            <div class="text-center project-title mb-3">
                {{ project.name }}
            </div>
            <b-container class="bv-example-row mb-5">
                <b-row>
                    <b-col sm>
                        <b-img :src="`/storage/images/${project.image}`" fluid alt="Responsive image"></b-img>
                    </b-col>
                    <b-col sm>
                        <div class="mt-2">
                            <b-row>
                                <b-col cols="4" class="project-property-label">Description:</b-col>
                                <b-col cols="8">
                                    <div v-html="project.description"></div>
                                </b-col>
                            </b-row>
                            <b-row class="mb-2">
                                <b-col cols="4" class="project-property-label">Role:</b-col>
                                <b-col cols="8">
                                    {{ project.role}}
                                </b-col>
                            </b-row>
                            <b-row class="mb-2">
                                <b-col cols="4" class="project-property-label">Repository Link:</b-col>
                                <b-col cols="8" v-if="project.github_link != 'n/a'">
                                    <a :href="project.github_link">{{ project.github_link}}</a>
                                </b-col>
                                <b-col cols="8" v-else>
                                    Unavailable due to company policy.
                                </b-col>
                            </b-row>
                            <b-row class="mb-2">
                                <b-col cols="4" class="project-property-label">Live Link:</b-col>
                                <b-col cols="8" v-if="project.live_link != 'n/a'">
                                    <a :href="project.live_link">{{ project.live_link}}</a>
                                </b-col>
                                <b-col cols="8" v-else>
                                    Under Development
                                </b-col>
                            </b-row>
                        </div>
                    </b-col>
                </b-row>
            </b-container>
        </div>
        <div v-if="ifReady == false">
            <div class="d-flex justify-content-center project-container-loading">
                <b-spinner label="Loading..."></b-spinner>
            </div>
        </div>
        <footer-component></footer-component>
    </div>
</template>
<style scoped>
    .main-content{
        padding-top: 10em;
    }
    .button-size{
        font-size: 5em;
    }
    .icon-design{
        filter: grayscale(100%);
        width: 80px;
        height: 80px;
    }
    .projects-text-content{
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 30px;
        font-weight: 100;
        color: #4b4848;
        padding-top: 1em;
        padding-bottom: 0.5em;
    }
    .sub-intro{
        background-color: #dbdbdb;
    }

    .project-title{
        font-weight: bolder;
        font-size: 20px;
    }

    .project-property-label{
        font-weight: bold;
        text-align: right;
    }

    .project-container{
        margin-top: 5em !important;
    }

    .project-container-loading{
        margin-top: 5em !important;
        margin-bottom: 16.5em;
    }

    @media (min-width: 768px) and (max-width: 1022px){
        .project-container-loading{
            margin-top: 5em !important;
            margin-bottom: 20em;
        }
    }
    @media (min-width: 1024px){
        .project-container-loading{
            margin-top: 5em !important;
            margin-bottom: 41.3em;
        }
    }
</style>
<script>
export default {
    data() {
        return {
            ifReady: false,
            projects: null,
            hasProjects: false,
        };
    },
    created() {
        let promise = new Promise((resolve, reject) => {
            axios.get('/api/projects').then(res => {
                console.log(res.data);
                this.projects = res.data.data;
                this.hasProjects = true
                this.ifReady = true
                resolve();
            }).catch(error => {
                this.ifReady = true
            });
        });
    },
}
</script>