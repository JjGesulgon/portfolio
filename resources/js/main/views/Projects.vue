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
    
}
</script>