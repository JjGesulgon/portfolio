<template>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top" v-bind:style="bgc">
        <a class="navbar-brand text-item-color" href="/">
                Hello World
                <!-- <img src="/images/amclogo-medium.png" width="150" height="50" class="mr-2"> -->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse my-2 my-lg-0" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <router-link class="nav-link text-item-color" :to="{ name: 'overview'}" >Home</router-link>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-item-color" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Nav Dropdown
                    </a>
                    <div class="dropdown-menu">
                        <!-- <router-link class="dropdown-item" :to="{ name: 'about-bacolod.quick-facts.geophysical' }">Quick Facts</router-link> -->
                        <a class="dropdown-item" target="_blank">Dropdown 1</a>
                        <a class="dropdown-item" target="_blank">Dropdown 2</a>
                        <a class="dropdown-item" target="_blank">Dropdown 3</a>
                    </div> 
                </li>
            </ul>
        </div>
    </nav>
</template>

<style>
.hover-pointer:hover{
    cursor:pointer;
}

.text-item-color{
    color: #ffffff !important;
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
</style>


<script>
export default {
    data(){
        return{
            bgc: {backgroundColor: '#192841'}
        }
    },

    // mounted(){
    //      let promise = new Promise((resolve, reject) => {
    //             axios.get('/api/theme/get-theme').then(res => {
    //                 this.bgc.backgroundColor = res.data.theme.navbar_color
    //                 resolve();
    //             });
    //         });
    // }
}
</script>
