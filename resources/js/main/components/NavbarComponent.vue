<template>
    <div>
        <b-navbar toggleable="lg" type="dark" class="navbar-inner" fixed="top">
            <!-- <b-navbar-brand href="#">
                <b-img-lazy v-bind="mainProps" left src="/assets/logo_v3.png" alt="Left image"></b-img-lazy>
            </b-navbar-brand> -->

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>
                <!-- Right aligned nav items -->
                <b-navbar-nav class="ml-auto navbar-item-group">
                    <b-nav-item href="#" class="navbar-items"><i class="fas fa-home"></i>&nbsp; Home</b-nav-item>
                    <b-nav-item href="#" class="navbar-items"><i class="fas fa-id-card"></i>&nbsp; About</b-nav-item>
                    <b-nav-item href="#" class="navbar-items"><i class="fas fa-project-diagram"></i>&nbsp; Projects</b-nav-item>
                    <b-nav-item href="#" class="navbar-items"><i class="fas fa-envelope"></i>&nbsp; Contact</b-nav-item>
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
                width: 30,
                height: 30,
                // class: 'navbar-inner'
                // class: 'my-5'
            }
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
