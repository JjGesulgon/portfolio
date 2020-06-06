<template>
    <div>
        <b-container class="bv-example-row mb-5 contact-box">
            <h2 class="first-text-label"> Don't be a stranger</h2>
            <h3 class="second-text-label"> just say hello.</h3>
            <b-row class="mt-5">
                <b-col>
                    <div class="third-text-label">
                        Feel free to get in touch with me. I am always open to discussing new projects, creative ideas or opportunities to be part of your visions.
                    </div>
                    <div class="contact-email-header">
                        Need help?
                    </div>
                    <div class="contact-email">
                        jjgesulgon@gmail.com
                    </div>

                    <div class="contact-email-header">
                        Feel like talking?
                    </div>
                    <div class="contact-email">
                        +63 925 869 6132
                    </div>
                </b-col>
                <b-col>
                    <div>
                        <b-form-input v-model="name" placeholder="Name"></b-form-input>
                    </div>
                    <div class="email-textbox">
                        <b-form-input v-model="email" placeholder="Email"></b-form-input>
                    </div>
                    <div class="email-textbox">
                        <b-form-textarea
                            id="textarea-rows"
                            v-model="message"
                            placeholder="Message"
                            rows="5"
                        ></b-form-textarea>
                    </div>
                    <div class="mail-button">
                        <b-button variant="outline-secondary">Send</b-button>
                    </div>
                </b-col>
            </b-row>
        </b-container>
        <footer-component style="position:fixed !important;"></footer-component>
    </div>
</template>
<style scoped>
    .contact-box{
        padding-top: 11.5em;
        /* 6c359b */
    }

    .first-text-label{
        color: #6c359b !important;
    }

    .second-text-label{
        color: #636064 !important;
    }

    .third-text-label{
        color: #636064 !important;
    }

    .contact-email-header{
        padding-top: 5em !important;
        padding-bottom: 0.5em !important;
        color: #636064 !important;
        font-size: 12px !important;
    }

    .contact-email{
        /* color: #101010 !important; */
        color: #636064 !important;
        font-weight: bold;
    }

    .email-textbox{
        padding-top: 2em !important;
    }

    .mail-button{
        padding-top: 2em !important;
    }

    .footer-class{
        /* padding-top: 5em !important; */
        position: absolute;
        bottom: 0;
    }
</style>
<script>
export default {
    
}
</script>