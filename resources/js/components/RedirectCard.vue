<template>
    <h3 v-bind:style="hasError ? 'color: red' : 'color: green' ">{{ msg }}</h3>
</template>

<script>
export default {
    name: "RedirectCard",
    data() {
        return {
            'shorturl': '',
            'msg': 'Redirecting....',
            'hasError': false
        }
    },
    mounted() {
        this.shorturl = this.$route.params.shorturl
        this.getFullUrl()
    },
    methods: {
        getFullUrl() {
            axios.get('/api/v1/url-shortener/' + this.shorturl)
                .then(res => {
                    window.location.href = res.data.data.full_url
                })
                .catch(err => {
                    this.hasError = true
                    this.msg = err.response.data.message
                })
        }
    }
}
</script>

<style scoped>

</style>
