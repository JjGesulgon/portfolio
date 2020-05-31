<template>
    <div class="footer">
        <p class="footer-content">

            <i class="fab fa-instagram icon-style"></i> 
            &nbsp;  &nbsp;
            <i class="fab fa-linkedin icon-style"></i>
            &nbsp;  &nbsp;
            <i class="fab fa-dev icon-style"></i>
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
</style>