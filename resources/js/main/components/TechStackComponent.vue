<template>
    <div>
        <div class="tech-stack-box">
            <b-container fluid class="p-4 text-center tech-stack-design">
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
        <div class="tech-stack-box2">
            <b-container fluid class="p-4 text-center tech-stack-design2">
                <b-row class="tech-stack-content2">
                    <b-col class="tech-title">
                        <!-- <h2 class="text-right tech-stack-title">Technology Stack & Experience.</h2> -->
                        <!-- <h2 class="tech-title">Technology Stack & Skills.</h2> -->
                    </b-col>
                    <b-col class="tech-icon">
                        <div class="text-center">
                            <h2 class="text-left tech-stack-title">Workflow & Processes</h2>
                        </div>
                    </b-col>
                </b-row>
                <b-row class="tech-stack-content">
                    <b-col sm>
                        <div class="text-center tech-skill-content2" v-if="ifReady == true">
                            <b-button variant="outline-dark" class="mr-2 ml-2 mb-2">Agile</b-button>
                            <b-button variant="outline-dark" class="mr-2 ml-2 mb-2">Scrum</b-button>
                            <b-button variant="outline-dark" class="mr-2 ml-2 mb-2">PWA</b-button>
                            <b-button variant="outline-dark" class="mr-2 ml-2 mb-2">Remote Work</b-button>
                            <b-button variant="outline-dark" class="mr-2 ml-2 mb-2">Testing</b-button>
                            <b-button variant="outline-dark" class="mr-2 ml-2 mb-2">Continuous Integration</b-button>
                            <b-button variant="outline-dark" class="mr-2 ml-2 mb-2">Automation</b-button>
                            <b-button variant="outline-dark" class="mr-2 ml-2 mb-2">Code Review</b-button>
                        </div>
                        <div v-if="ifReady == false" class="mb-5">
                            <div class="d-flex justify-content-center mb-3">
                                <b-spinner label="Loading..."></b-spinner>
                            </div>
                        </div>
                    </b-col>
                    <b-col sm>
                        <p class="tech-stack-content-paragraph2">I like to work agile and in cross-functional teams and got experience from previous projects.
                            To collaborate with UI / UX and Back-End colleagues to create fast and accessible results across the stack is my usual workflow.
                            I also enjoy technical discussions and brainstorming to improve the overall project workflow.
                        </p>
                    </b-col>
                </b-row>
            </b-container>
        </div>
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

    .tech-stack-design{
        padding-bottom: 15em !important;
    }
    .tech-stack-design2{
        padding-bottom: 0 !important;
        /* transform: skewY(10deg); */
    }

    .tech-stack-box{
        background-color: #dbdbdb;
        position: relative;
        width: 100%;
        height: 100%;

        -webkit-clip-path: polygon(0 0, 100% 0, 100% 56%, 0 100%);
        clip-path: polygon(0 0, 100% 0, 100% 35%, 0 100%);
    }
    .tech-stack-box2{
        position: relative;
        width: 100%;
        height: 100%;
        background-color: transparent;
    }

    /* .tech-stack-box2::after{
        position: absolute;
        width: 100%;
        height: 100%;
        content: '';
        background:inherit;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        transform-origin: top left;
        transform: skewY(-10deg);
    } */
    
    .tech-stack-title{
        color: #101010;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }
    .tech-stack-content{
        margin-top: 5em;
        margin-bottom: 5em;
    }
    .tech-stack-content2{
        margin-top: -10em !important;
        /* margin: 5em; */
        margin-bottom: 5em;
    }
    .tech-stack-content-paragraph{
        color: #101010;
        text-align: left;
        margin-left: 20em;
    }
    .tech-stack-content-paragraph2{
        color: #101010;
        text-align: left;
        margin-right: 20em;
    }
    
    .tech-skill-content{
        margin-right: 20em;
    }

    .tech-skill-content2{
        margin-left: 30em;
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