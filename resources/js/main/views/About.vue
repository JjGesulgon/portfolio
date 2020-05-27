<template>
    <div>
        <b-navbar toggleable="lg" type="dark" class="navbar-inner" fixed="top">
            <b-navbar-brand href="#">
                <b-img-lazy v-bind="mainProps" left src="/assets/logo_v4.png" alt="Left image"></b-img-lazy>
            </b-navbar-brand>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>
                <!-- Right aligned nav items -->
                <b-navbar-nav class="ml-auto navbar-item-group">
                    
                    <b-nav-item href="#" class="navbar-items"><router-link to="/" class="text-item-color"><i class="fas fa-home"></i>&nbsp;Home</router-link></b-nav-item>
                    <b-nav-item href="#" class="navbar-items"><router-link to="/about" class="text-item-color"><i class="fas fa-id-card"></i>&nbsp; About</router-link></b-nav-item>
                    <b-nav-item href="#" class="navbar-items"><router-link to="/" class="text-item-color"><i class="fas fa-project-diagram"></i>&nbsp; Projects</router-link></b-nav-item>
                    <b-nav-item href="#" class="navbar-items"><router-link to="/" class="text-item-color"><i class="fas fa-envelope"></i>&nbsp; Contact</router-link></b-nav-item>
                </b-navbar-nav>
            </b-collapse>

        </b-navbar>

        <div class="main_content full-screen-display">
            <b-container class="bv-example-row" v-if="ifReady == true">
                <b-row>
                    <b-col>
                        <b-card
                            title="Jj Gesulgon"
                            img-src="/assets/jj_picture.jpg"
                            img-alt="Image"
                            img-top
                            tag="article"
                            style="max-width: 20rem;"
                            class="mb-2 text-center"
                        >
                            <b-card-text class="mt-3">
                                <div>
                                    <i class="fas fa-code"></i>&nbsp; Fullstack Web Developer
                                </div>
                                <div>
                                    <i class="fas fa-map-marker-alt"></i>&nbsp; Bacolod City, Philippines
                                </div>
                                <div>
                                    <i class="fas fa-envelope"></i>&nbsp; jjgesulgon@gmail.com
                                </div>
                            </b-card-text>
                        </b-card>
                    </b-col>
                    <!-- <div class="w-100"></div> -->
                    <b-col>
                        <p class="text-center" v-if="!hasAbout"> No About Yet</p>
                        <br>
                        <div class="body" v-html="about.body"></div>
                    </b-col>
                </b-row>
            </b-container>
            <div v-if="ifReady == false">
                <div class="d-flex justify-content-center mb-3">
                    <b-spinner label="Loading..."></b-spinner>
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
        mounted() {
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
/* NavBar */
/* //////////////////////////////////////////////////// */
    .hover-pointer:hover{
        cursor:pointer;
    }

    .text-item-color{
        color: #ffffff !important;
        opacity: 70%;
    }

    .navbar-background{
        background-color:#d8f3fc;
        border: none;
    }

    .search-textbox{
        border: 1px solid #010071;
        background:transparent;
        border-radius: 0px !important;
    }

    .navi-link {
    display: block;
    /* color: #007bff; */
    color: #ffffff !important;
    }

    /* enable absolute positioning */
    .inner-addon { 
    position: relative; 
    }

    /*style icon */
    .inner-addon .fa{
    position: absolute;
    padding: 10px;
    pointer-events: none;
    }

    /*align icon */
    .left-addon .fa  { left:  0px;}
    .right-addon .fa { right: 0px;}

    /*add padding*/
    .left-addon input  { padding-left:  30px; }
    .right-addon input { padding-right: 30px; }

    .navbar-inner {
        background:#101010;
        /* background: #4b4276; */
        /* background: rgb(72, 36, 134); */
    }

    .navbar-items {
        font-size: 14px;
        margin-right: 3em;
    }

    .navbar-item-group {
        margin-right: 5em;
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
        margin-top: 10em !important;
    }
</style>