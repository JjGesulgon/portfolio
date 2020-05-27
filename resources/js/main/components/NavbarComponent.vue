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
    </div>
</template>

<style>
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
    background:transparent;
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
</style>


<script>
export default {
    data(){
        return{
            bgc: {backgroundColor: '#192841'},
            mainProps: {
                // center: true,
                // fluidGrow: true,
                // blank: true,
                // blankColor: '#bbb',
                // width: 60,
                // height: 60,
                width: 30,
                height: 30,
                // class: 'navbar-inner'
                // class: 'my-5'
            }
        }
    },
}
</script>
