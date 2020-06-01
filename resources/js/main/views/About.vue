<template>
    <div>
        <div class="main_content full-screen-display">
            <!-- v-if="ifReady == true" -->
            <b-container class="bv-example-row mb-5">
                <b-row>
                    <b-col sm="4">
                        <!-- img-src="/assets/jj_picture.jpg"
                            img-alt="Image"
                            img-top -->
                        <b-card
                            title="Jj Gesulgon"
                            img-src="/assets/jj_picture.jpg"
                            img-alt="Image"
                            img-top
                            tag="article"
                            style="max-width: 20rem;"
                            class="mb-2 text-center card-layout"
                        >
                            <b-card-text class="ml-4 mt-3">
                                <b-row class="justify-content-start">
                                    <b-col col lg="2"><i class="fas fa-code"></i></b-col>
                                    <b-col cols="12" md="auto">Fullstack Web Developer</b-col>
                                </b-row>
                                <b-row class="justify-content-start">
                                    <b-col col lg="2"><i class="fas fa-map-marker-alt"></i></b-col>
                                    <b-col cols="12" md="auto">Bacolod City, Philippines</b-col>
                                </b-row>
                                <b-row class="justify-content-start">
                                    <b-col col lg="2"><i class="fas fa-envelope"></i></b-col>
                                    <b-col cols="12" md="auto">jjgesulgon@gmail.com</b-col>
                                </b-row>
                            </b-card-text>
                        </b-card>
                    </b-col>
                    <!-- <div class="w-100"></div> -->
                    <b-col sm="8">
                        <div v-if="ifReady == false" class="mb-5">
                            <div class="d-flex justify-content-center about-content">
                                <b-spinner label="Loading..."></b-spinner>
                            </div>
                        </div>
                        <div v-if="ifReady == true">
                            <p class="text-center" v-if="!hasAbout"> No About Yet</p>
                            <br>
                            <div class="body" v-html="about.body"></div>
                        </div>
                    </b-col>
                </b-row>
            </b-container>
            <!-- <div v-if="ifReady == false" class="mb-5">
                <div class="d-flex justify-content-center mb-3">
                    <b-spinner label="Loading..."></b-spinner>
                </div>
            </div> -->
            <experience-component></experience-component>
            <tech-stack-component></tech-stack-component>
            <history-component></history-component>
            <footer-component></footer-component>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                ifReady: false,
                about: '',
                hasAbout: false,

                bgc: {backgroundColor: '#192841'},
                mainProps: {
                    // center: true,
                    // fluidGrow: true,
                    // blank: true,
                    // blankColor: '#bbb',
                    width: 30,
                    height: 30,
                    // class: 'navbar-inner'
                    // class: 'my-5'
                }
            };
        },
        created() {
            let promise = new Promise((resolve, reject) => {
                axios.get('/api/about').then(res => {
                    console.log(res);
                    this.about = res.data.about;
                    this.hasAbout = true
                    this.ifReady = true
                    resolve();
                }).catch(error => {
                    this.ifReady = true
                });
            });
        },
}
</script>
<style scoped>
/* //////////////////////////////////////////////////// */
/* Card */
/* //////////////////////////////////////////////////// */
    .card-layout{
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    @media (max-width: 450px) {
        .card-layout{
            margin: 0 auto;
            display: none !important;
        }
        .main_content{
            margin-top: 5em !important;
        }
    }

    @media (max-width: 766px){
        .main_content{
            width: auto;
            background-color: #f8f4f4;
            color: #717171;
            line-height: 25px;
            padding-top: 3em !important;
        }
    }

    .image-cutout{
        -webkit-clip-path: polygon(0 0, 0 100px, 100px 80px, 100px 0);
    }
/* //////////////////////////////////////////////////// */
/* Page CSS */
/* //////////////////////////////////////////////////// */

    .full-screen-display{
        /* position:fixed; */
        height: 100vh;
        width: 100vw;
    }

    .logo-size {
        max-height: 800px !important;
    }

    .contact-button{
        opacity: 70%;
    }

    .content-padding {
        padding-top: 5em;
        padding-left: 0px;
        padding-right: 0px;

        margin-right: 0px;
    }

    .introduction{
        margin-top: 0.5em;
        margin-left: 2em;
    }

    .main-introduction{
        /* padding-left: 8em; */
        margin-top: 8em;
    }
    @media (max-width: 390px) {
        .main-introduction{
        
            margin-top: 3em;
        }
    }

    .lettering-first{
        /* margin-left: 2em; */
        /* font-size:4vw; */
        font-size:60px;
        color: rgb(255, 255, 255);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: lighter;
        /* font-style: oblique; */
    }
    .lettering-second{
        /* margin-left: 2em; */
        /* font-size:4vw; */
        font-size:60px;
        color: rgb(255, 255, 255);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: lighter;
        /* font-style: oblique; */
    }
    .lettering-third{
        /* margin-left: 8em; */
        /* font-size:1vw; */
        font-size:20px;
        color: rgb(255, 255, 255);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: lighter;
        font-style: oblique;
        opacity: 70%;
    }

    .main_content{
        width: auto;
        background-color: #f8f4f4;
        color: #717171;
        line-height: 25px;
        padding-top: 10em;
        position: relative;
    }

    .about-content{
        margin-top:14em;
    }
</style>