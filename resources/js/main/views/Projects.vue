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
        <div v-if="ifReady == true" v-for="project in projects" v-bind:key="project.name" class="project-container">
            <!-- <div class="text-center project-title mb-3 project-content">
                {{ project.name }}
            </div> -->
            <b-container class="bv-example-row mb-5">
                <b-row>
                    <b-col sm v-if="project.project_images.length > 0">
                        <!-- <b-img :src="`/storage/images/${project.image}`" fluid alt="Responsive image" class="overlay"></b-img> -->
                        <div class="container-image" v-b-modal.modal-center @click="viewProjectImage(project.project_images, project.name)">
                            <!-- <img src="img_avatar.png" alt="Avatar" class="image" style="width:100%"> -->
                            <b-img :src="`/storage/images/${project.image}`" fluid alt="Responsive image" class="image"></b-img>
                            <div class="middle">
                                <div class="text">Click to view</div>
                            </div>
                        </div>
                    </b-col>
                    <b-col sm class="image-con" v-else>
                        <div class="container-image2 text-center project-image-unavailable ">
                            Image Unavailable
                        </div>
                    </b-col>
                    <b-col sm>
                        <div class="mt-2">
                             <b-row class="mb-2">
                                <b-col cols="4" class="project-property-label">Project Name:</b-col>
                                <b-col cols="8" class="project-content">
                                    {{ project.name }}
                                </b-col>
                            </b-row>
                            <b-row>
                                <b-col cols="4" class="project-property-label">Description:</b-col>
                                <b-col cols="8" class="project-content">
                                    <div class="project-content" v-html="project.description"></div>
                                </b-col>
                            </b-row>
                            <b-row class="mb-2">
                                <b-col cols="4" class="project-property-label">Role:</b-col>
                                <b-col cols="8" class="project-content">
                                    {{ project.role}}
                                </b-col>
                            </b-row>
                            <b-row class="mb-2">
                                <b-col cols="4" class="project-property-label">Repository Link:</b-col>
                                <b-col cols="8" class="project-content" v-if="project.github_link != 'n/a'">
                                    <a :href="project.github_link" target="_blank" class="project-content">Click Here</a>
                                </b-col>
                                <b-col cols="8" class="project-content" v-else>
                                    Unavailable due to company policy.
                                </b-col>
                            </b-row>
                            <b-row class="mb-2">
                                <b-col cols="4" class="project-property-label">Live Link:</b-col>
                                <b-col cols="8" class="project-content" v-if="project.live_link != 'n/a'">
                                    <a :href="project.live_link" target="_blank" class="project-content">Click Here</a>
                                </b-col>
                                <b-col cols="8" class="project-content" v-else>
                                    Under Development
                                </b-col>
                            </b-row>
                        </div>
                    </b-col>
                </b-row>
            </b-container>
        </div>
        <b-modal id="modal-center" size="xl" centered header-bg-variant="dark" header-text-variant="light" body-bg-variant="light" footer-bg-variant="dark" footer-text-variant="light">
            <!-- <b-img :src="`/storage/images/${this.selectedImage}`" fluid alt="Responsive image"></b-img> -->
            <!-- @sliding-start="onSlideStart" @sliding-end="onSlideEnd" -->
            <!-- v-model="slide" -->
            <b-carousel
                id="carousel-1"
                :interval="4000"
                controls
                indicators
                background="#ababab"
                img-width="1024"
                img-height="480"
                style="text-shadow: 1px 1px 2px #333;"
                >
                <!-- Text slides with image -->
                <!-- text="Nulla vitae elit libero, a pharetra augue mollis interdum." -->
                <b-carousel-slide
                    v-for="projectImage in this.selectedImage" v-bind:key="projectImage.caption"
                    :caption="projectImage.caption"
                    :img-src="`/storage/images/${projectImage.image}`"
                ></b-carousel-slide>
            </b-carousel>
            <template v-slot:modal-footer>
                <b>{{ this.caption }}</b>
            </template>
        </b-modal>
        <div v-if="ifReady == false">
            <div class="d-flex justify-content-center project-container-loading">
                <b-spinner label="Loading..."></b-spinner>
            </div>
        </div>
        <footer-component></footer-component>
    </div>
</template>
<style scoped>
/* @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap'); */
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
        /* font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; */
        font-family: 'Raleway', sans-serif !important;
        font-size: 30px;
        font-weight: 100;
        color: #4b4848;
        padding-top: 1em;
        padding-bottom: 0.5em;
    }
    .sub-intro{
        background-color: #dbdbdb;
    }

    .project-title{
        font-weight: bolder;
        font-size: 20px;
    }

    .project-property-label{
        font-weight: bold !important;
        text-align: right;
        font-family: 'Raleway', sans-serif !important;
    }
    .image-con{
        background-color: #d6d6d6;
    }

    .project-image-unavailable{
        font-family: 'Raleway', sans-serif !important;
        padding-top: 2em;
        padding-bottom: 2em;
        color: #101010;
    }

    .project-content{
        font-family: 'Raleway', sans-serif !important;
    }

    .project-container{
        margin-top: 5em !important;
    }

    .project-container-loading{
        margin-top: 5em !important;
        margin-bottom: 16.5em;
    }

    @media (min-width: 768px) and (max-width: 1022px){
        .project-container-loading{
            margin-top: 5em !important;
            margin-bottom: 20em;
        }
    }
    @media (min-width: 1024px){
        .project-container-loading{
            margin-top: 5em !important;
            margin-bottom: 41.3em;
        }
    }

/* /////////////////////////////////////////////////// */
/* overlay */
/* /////////////////////////////////////////////////// */

div >>> p {
    font-family: 'Raleway', sans-serif !important;
  }

.container-image {
  position: relative;
  /* width: 50%; */
}

.container-image2 {
  position: relative;
  /* width: 50%; */
}

.image {
  opacity: 1;
  display: block;
  /* width: 100%; */
  /* height: auto; */
  transition: .5s ease;
  backface-visibility: hidden;
}

.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.container-image:hover .image {
  opacity: 0.3;
}

.container-image:hover .middle {
  opacity: 1;
}

.text {
  /* background-color: #4CAF50; */
  color: #101010;
  font-size: 25px;
  font-weight: 300 !important;
  padding: 16px 32px;
  font-family: 'Raleway', sans-serif !important;
}


</style>
<script>
export default {
    data() {
        return {
            ifReady: false,
            projects: null,
            hasProjects: false,
            selectedImage: '',
            caption: ''
        };
    },
    created() {
        let promise = new Promise((resolve, reject) => {
            axios.get('/api/projects').then(res => {
                console.log(res.data);
                this.projects = res.data.data;
                this.hasProjects = true
                this.ifReady = true
                resolve();
            }).catch(error => {
                this.ifReady = true
            });
        });
    },
    methods:{
        viewProjectImage(image, caption){
            this.selectedImage = image;
            this.caption = caption;
        }
    }
}
</script>