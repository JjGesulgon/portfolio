<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        Hello World Test if ga change
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "example-component",
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
