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
                    <form v-on:submit.prevent="SendEmail" v-if="ifReady">
                        <div>
                            <b-form-input v-model="name" placeholder="Name" required></b-form-input>
                        </div>
                        <div class="email-textbox">
                            <b-form-input v-model="email" placeholder="Email" required></b-form-input>
                        </div>
                        <div class="email-textbox">
                            <b-form-textarea
                                id="textarea-rows"
                                v-model="message"
                                placeholder="Message"
                                rows="5"
                                required
                            ></b-form-textarea>
                        </div>
                        <div class="mail-button">
                            <b-button type="submit" variant="outline-secondary">Send</b-button>
                        </div>
                    </form>
                    <div v-else>
                        <div class="d-flex justify-content-center mb-3">
                            <b-spinner label="Loading..."></b-spinner>
                        </div>
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
        font-family: 'Raleway', sans-serif !important;
    }

    .second-text-label{
        color: #636064 !important;
        font-family: 'Raleway', sans-serif !important;
    }

    .third-text-label{
        color: #636064 !important;
        font-family: 'Raleway', sans-serif !important;
    }

    .contact-email-header{
        padding-top: 5em !important;
        padding-bottom: 0.5em !important;
        color: #636064 !important;
        font-size: 12px !important;
        font-family: 'Raleway', sans-serif !important;
    }

    .contact-email{
        /* color: #101010 !important; */
        color: #636064 !important;
        font-weight: 500;
        font-family: 'Raleway', sans-serif !important;
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
    data() {
        return {
            ifReady: true,
            name: '',
            email: '',
            message: '',
        };
    },

    methods:{
        SendEmail() {
            this.ifReady = false;
            this.errors = [];

            axios.post('/api/contact-me', this.$data).then(res => {
                this.ifReady = true;
                this.name = '';
                this.email = '';
                this.message = '';
                // this.toast('Success','Project added', 'Email Sent', 'secondary')
            }).catch(err => {
                this.errors = err.response.data.errors
                this.ifReady = true;
                console.log(err.response);
                this.toast('Error','Failed to submit', 'Unable to send email!', 'danger')
            });
        },

        toast(title, subtitle, body, variant) {
                // Toast element
                const h = this.$createElement

                // Increment the toast count
                this.count++

                // Create the message
                const vNodesMsg = h(
                'p',
                { class: ['text-center', 'mb-0'] },
                [
                    // h('b-spinner', { props: { type: 'grow', small: true } }),
                    `  `,
                    h('strong', { class: 'text-muted' }, body),
                    `  `,
                    // ` ${body} `,
                    // h('b-spinner', { props: { type: 'grow', small: true } })
                ]
                )

                // Create the title
                const vNodesTitle = h(
                'div',
                { class: ['d-flex', 'flex-grow-1', 'align-items-baseline', 'mr-2'] },
                [
                    h('strong', { class: 'mr-2' }, title),
                    // h('small', { class: 'ml-auto text-italics' }, subtitle)
                ]
                )
                // Pass the VNodes as an array for message and title
                this.$bvToast.toast([vNodesMsg], {
                    title: [vNodesTitle],
                    solid: true,
                    toaster: 'b-toaster-bottom-right',
                    variant: variant
                })
            },
    }
}
</script>