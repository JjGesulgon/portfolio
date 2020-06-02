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
        <div v-for="project in projects" v-bind:key="project.name" class="mt-5">
            <b-container class="bv-example-row mb-5">
                <b-row>
                    <b-col sm>
                        <b-img :src="`/storage/images/${project.image}`" fluid alt="Responsive image"></b-img>
                    </b-col>
                    <b-col sm class="text-center">{{ project.name }}</b-col>
                </b-row>
            </b-container>
        </div>
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
</style>
<script>
export default {
    data() {
        return {
            ifReady: false,
            projects: '',
            hasProjects: false,
        };
    },
    created() {
        let promise = new Promise((resolve, reject) => {
            axios.get('/api/projects').then(res => {
                console.log(res.data);
                this.projects = res.data.data;
                // this.hasProjects = true
                // this.ifReady = true
                resolve();
            }).catch(error => {
                this.ifReady = true
            });
        });
    },
}
</script>