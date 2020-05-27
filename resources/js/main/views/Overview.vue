<template>
    <div class="main_content full-screen-display">
        <div class="content-padding">
            <div class="container text-center main-introduction">
                <h1 class="lettering-first">Hi,</h1>
                <h1 class="lettering-second">I'm Jj Gesulgon</h1>
                <h1 class="lettering-third">Fullstack Web Developer</h1>
                <b-button squared variant="outline-light mt-5" class="contact-button">Contact Me</b-button>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        
}
</script>
<style scoped>
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
        background-color: #101010;
        color: #717171;
        line-height: 25px;
    }
</style>