<template>
    <div> 
        <div class="wrapper">
            <div class="sidebar">
                <h2>Logo</h2>
                <ul>
                    <li>
                        <router-link to="/"><i class="fas fa-home"></i>Overview</router-link>
                    </li>
                    <li>
                        <router-link to="/users"><i class="fas fa-user"></i>Users</router-link>
                    </li>
                    <li>
                        <router-link to="/intro"><i class="fas fa-address-card"></i>Intro</router-link>
                    </li>
                    <li>
                        <router-link to="/about"><i class="fas fa-skull"></i>About</router-link>
                    </li>
                    <li>
                        <router-link to="/experience"><i class="fas fa-briefcase"></i>Experiences</router-link>
                    </li>
                    <li>
                        <router-link to="/skills"><i class="fas fa-dice-six"></i>Skills</router-link>
                    </li>
                </ul> 
            </div>  
        </div>   
    </div>
</template>
<script>
export default {
    name: "navbar-component",
}
</script>