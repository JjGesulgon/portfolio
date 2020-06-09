<template>
    <div class="footer">
        <p class="footer-content">

            <a href="https://twitter.com/jeysqrd" class="a-link" target="_blank"><i class="fa fa-twitter-square icon-style" aria-hidden="true"></i></a>
            &nbsp;  &nbsp;
            <a href="https://www.instagram.com/jeysqrd/" class="a-link" target="_blank"><i class="fab fa-instagram icon-style"></i></a>
            &nbsp;  &nbsp;
            <a href="https://www.linkedin.com/in/jsqrd/" class="a-link" target="_blank"><i class="fab fa-linkedin icon-style"></i></a>
            &nbsp;  &nbsp;
            <a href="https://dev.to/jjgesulgon" class="a-link" target="_blank"><i class="fab fa-dev icon-style"></i></a>
        </p>
    </div>
</template>
<style>
    .footer {
        /* position: fixed; */
        position: relative;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: #6c359b;
        color: white;
        text-align: right;
    }
    
    .footer-content{
        margin-bottom: 0px !important;
        padding-bottom: 0.5em !important;
        padding-top: 0.5em !important;
        padding-right: 2em !important;
    }

    .icon-style{
        font-size: 1.5em;
    }

    .dot {
        height: 25px;
        width: 25px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
    }

    .a-link{
        color: white;
    }

    .a-link:hover{
        color: rgb(180, 179, 179);
    }

</style>