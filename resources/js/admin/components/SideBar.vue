<template>
    <!-- <div>  -->
        <div class="wrapper">
            <div class="sidebar logo">
                <!-- <h2>Logo</h2> -->
                <img src="/assets/logo_v2.png" width="200" height="200">
                <ul>
                    <li>
                        <router-link to="/"><i class="fas fa-home"></i>Overview</router-link>
                    </li>
                    <li>
                        <router-link to="/users"><i class="fas fa-user"></i>Users</router-link>
                    </li>
                    <li>
                        <!-- fas fa-skull -->
                        <router-link to="/about"><i class="fas fa-address-card"></i>About</router-link>
                    </li>
                    <li>
                        <router-link to="/experience"><i class="fas fa-briefcase"></i>Experiences</router-link>
                    </li>
                    <li>
                        <router-link to="/skills"><i class="fas fa-dice-six"></i>Skills</router-link>
                    </li>
                    <li>
                        <router-link to="/projects"><i class="fas fa-project-diagram"></i>Projects</router-link>
                    </li>
                </ul> 
            </div>  
        </div>   
    <!-- </div> -->
</template>
<script>
export default {
    name: "navbar-component",
}
</script>
<style>
    .logo {
        padding-top: 0px !important;
    }
</style>