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
    .b-row{
        margin: 0px !important;
    }
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

    .display-flex{
         display: flex;
    }

    .navi-item{
        margin-right: 210px !important;
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
    .header{
        /* padding-top: 5px !important;
        padding-bottom: 5px !important;
        padding-left: 20px !important;
        padding-right: 20px !important; */
        background: #fff;
        color: #717171;
        border-bottom: 1px solid #e0e4e8;
    }

    .info{
        /* margin: 20px; */
        color: #717171;
        line-height: 25px;
    }

    .main_content{
        width: auto;
        /* margin-left: 200px; */
        background-color: #101010;
    }

    .main_content .header{
        /* padding: 20px; */
        background: #fff;
        color: #717171;
        border-bottom: 1px solid #e0e4e8;
    }

    .main_content .info{
        /* margin-left: 40px;
        margin-right: 40px;
        margin-top: 20px; */
        color: #717171;
        line-height: 25px;
    }

    .main_content .info div{
        margin-bottom: 20px;
    }



</style>