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
                        <router-link to="/about"><i class="fas fa-address-book"></i>About</router-link>
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