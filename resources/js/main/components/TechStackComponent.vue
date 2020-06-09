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
                        I follow a “Use whatever is the most efficient” mindset. So where reasonable, I prefer to utilize a Laravel + Vue Stack but I'm not scared to touch new or different technologies if the project demands it.
                        I'm used to work with large-scaled applications and its requirements.
                        </p>
                    </b-col>
                    <b-col sm>
                        <div class="text-center tech-skill-content" v-if="ifReady == true">
                            <b-button variant="outline-dark" class="mr-2 ml-2 mb-2 button-text" v-for="skill in skills" v-bind:key="skill.name">{{ skill.name }}</b-button>
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
                    <b-col class="tech-icon">
                        <!-- <h2 class="text-right tech-stack-title">Technology Stack & Experience.</h2> -->
                        <!-- <h2 class="tech-title">Technology Stack & Skills.</h2> -->
                        <!-- <h2 class="text-left tech-stack-title">Workflow & Processes</h2> -->
                    </b-col>
                    <b-col class="tech-title2">
                        <div class="text-center">
                            <h2 class="text-left tech-stack-title2">Project Workflow & Processes</h2>
                        </div>
                    </b-col>
                </b-row>
                <b-row class="tech-stack-content">
                    <b-col sm>
                        <!-- v-if="ifReady == true" -->
                        <div class="text-center tech-skill-content2">
                            <b-button variant="outline-dark" class="mr-2 ml-2 mb-2 button-text">Agile</b-button>
                            <b-button variant="outline-dark" class="mr-2 ml-2 mb-2 button-text">Scrum</b-button>
                            <b-button variant="outline-dark" class="mr-2 ml-2 mb-2 button-text">PWA</b-button>
                            <b-button variant="outline-dark" class="mr-2 ml-2 mb-2 button-text">Remote Work</b-button>
                            <b-button variant="outline-dark" class="mr-2 ml-2 mb-2 button-text">Testing</b-button>
                            <b-button variant="outline-dark" class="mr-2 ml-2 mb-2 button-text">Continuous Integration</b-button>
                            <b-button variant="outline-dark" class="mr-2 ml-2 mb-2 button-text">Automation</b-button>
                            <b-button variant="outline-dark" class="mr-2 ml-2 mb-2 button-text">Code Review</b-button>
                        </div>
                        <!-- v-if="ifReady == false" -->
                        <!-- <div class="mb-5">
                            <div class="d-flex justify-content-center mb-3">
                                <b-spinner label="Loading..."></b-spinner>
                            </div>
                        </div> -->
                    </b-col>
                    <b-col sm>
                        <p class="tech-stack-content-paragraph2">I like to work agile and in cross-functional teams and got experience from previous projects.
                            To collaborate with UI / UX and Back-End colleagues to create fast and accessible results across the stack is my usual workflow.
                            I also enjoy technical discussions and brainstorming to improve the overall project workflow.
                        </p>
                    </b-col>
                </b-row>
                <div class="text-left mb-5 tech-cog-icon2">
                    <i class="fas fa-cog fa-spin icon-style"></i>
                </div>
            </b-container>
        </div>
    </div>
</template>
<style scoped>
    div >>> p {
        font-family: 'Raleway', sans-serif !important;
    }

    .button-text{
        font-family: 'Raleway', sans-serif !important;
    }

    @media (min-width: 360px) and (max-width: 766px) {
        .tech-stack-title{
            color: #101010;
            font-family: 'Raleway', sans-serif !important;
            text-align: left !important;
        }
        .tech-stack-title2{
            color: #101010;
            font-family: 'Raleway', sans-serif !important;
            text-align: left !important;
        }
    }
    @media (min-width: 768px) and (max-width: 1024px) {
        .tech-stack-title{
            color: #101010;
            font-family: 'Raleway', sans-serif !important;
            text-align: left !important;
        }
        .tech-stack-title2{
            color: #101010;
            font-family: 'Raleway', sans-serif !important;
            text-align: right !important;
        }
    }
    @media (max-width: 1024px) {
        .tech-icon{
            margin: 0 auto;
            display: none !important;
        }
        /* .tech-stack-title{
            color: #101010;
            font-family: 'Raleway', sans-serif !important;
            text-align: left !important;
        }
        .tech-stack-title2{
            color: #101010;
            font-family: 'Raleway', sans-serif !important;
            text-align: right !important;
        } */
        .tech-stack-content-paragraph{
            text-align: left;
            margin-left: 0 !important;
        }
        .tech-skill-content{
            margin-top: 3em !important;
            margin-right: 0 !important;
            margin-bottom: 1em !important;
        }

        .tech-stack-content-paragraph2{
            color: #101010;
            text-align: left;
            margin-right: 0 !important;
        }

        .tech-skill-content2{
            margin-top: -2em !important;
            margin-left: 0 !important;
            margin-bottom: 3em;
        }

        .tech-stack-box{
            background-color: #dbdbdb;
            position: relative;
            width: 100%;
            height: 100%;

            -webkit-clip-path: polygon(0 0, 100% 0, 100% 56%, 0 100%) !important;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%) !important;
        }

        .tech-stack-design{
            padding-bottom: 10em !important;
            margin-bottom: 10em !important;
        }
    }
    .tech-cog-icon2{
        margin-left: 16em;
    }

    .tech-stack-design{
        /* padding-bottom: 15em !important; */
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
    
    .tech-stack-title{
        color: #101010;
        font-family: 'Raleway', sans-serif !important;
    }

    .tech-stack-title2{
        color: #101010;
        font-family: 'Raleway', sans-serif !important;
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
        margin-left: 25em;
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