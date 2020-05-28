<template>
    <div class="tech-stack-box">
        <b-container fluid class="p-4 text-center">
            <b-row class="tech-stack-content">
                <b-col class="tech-title">
                    <h2 class="text-right tech-stack-title">Technology Stack & Experience.</h2>
                    <!-- <h2 class="tech-title">Technology Stack & Skills.</h2> -->
                </b-col>
                <b-col class="tech-icon">
                    <div class="text-center">
                        <i class="fas fa-cog fa-spin icon-style"></i>
                    </div>
                </b-col>
            </b-row>
            <b-row class="tech-stack-content">
                <b-col sm>
                    <p class="tech-stack-content-paragraph">Javascript Front-End and PHP Back-End architecture is my daily business.
                       I follow a “Use whatever is the most efficient” mindset. So where reasonable, I like to utilize a Laravel + Vue Stack but I'm not scared to touch new or different technologies if the project demands it.
                       I'm used to work with large-scaled applications and its requirements.
                    </p>
                </b-col>
                <b-col sm>
                    <div class="text-center tech-skill-content" v-if="ifReady == true">
                        <b-button variant="outline-dark" class="mr-2 ml-2 mb-2" v-for="skill in skills" v-bind:key="skill.name">{{ skill.name }}</b-button>
                    </div>
                    <div v-if="ifReady == false" class="mb-5">
                        <div class="d-flex justify-content-center mb-3">
                            <b-spinner label="Loading..."></b-spinner>
                        </div>
                    </div>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>
<style scoped>
    @media (max-width: 1024px) {
        .tech-icon{
            margin: 0 auto;
            display: none !important;
        }
        .tech-stack-title{
            color: #101010;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            text-align: left !important;
        }
        .tech-stack-content-paragraph{
            text-align: left;
            margin-left: 0 !important;
        }
        .tech-skill-content{
            margin-right: 0 !important;
        }
    }

    .tech-stack-box{
        background-color: #dbdbdb;
    }
    
    .tech-stack-title{
        color: #101010;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }
    .tech-stack-content{
        margin-top: 5em;
        margin-bottom: 5em;
    }
    .tech-stack-content2{
        margin: 5em;
        margin-bottom: 5em;
    }
    .tech-stack-content-paragraph{
        color: #101010;
        text-align: left;
        margin-left: 20em;
    }
    .tech-skill-content{
        margin-right: 20em;
    }
    .icon-style{
        font-size: 3em;
    }
</style>
<script>
    export default {
        data() {
            return {
                ifReady: false,
                skills: '',
                hasSkill: false,
            };
        },

        mounted() {
            let promise = new Promise((resolve, reject) => {
                axios.get('/api/skills').then(res => {
                    console.log(res);
                    this.skills = res.data.data;
                    this.hasSkill = true
                    this.ifReady = true
                    resolve();
                }).catch(error => {
                    this.ifReady = true
                });
            });
        },
    }
</script>