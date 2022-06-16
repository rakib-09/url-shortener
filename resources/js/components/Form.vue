<template>
    <form v-on:submit.prevent="createUrl">
        <div class="form-group mb-2">
            <label for="full-url" class="sr-only">URL</label>
            <input type="url" class="form-control" id="full-url" placeholder="Enter your URL" v-model="full_url">
        </div>
        <div v-if="msg.length > 0" class="alert" v-bind:class="hasError ? 'alert-danger': 'alert-primary'" role="alert">
           <span v-html="msg"></span>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Confirm</button>
        </div>
    </form>
</template>

<script>
export default {
    name: "mainForm",
    data() {
        return {
            full_url: '',
            msg: '',
            hasError: false,
        }
    },
    methods: {
        createUrl() {
            axios.post('/api/v1/url-shortener', {
                'full_url': this.full_url
            }).then(res => {
                this.hasError = false
                this.msg = "<h4>ShortUrl:</h4> " + "<b>" + window.location + "/" + res.data.data.short_url + "</b>"
            }).catch(err => {
                this.hasError = true
                this.msg = err.response.data.message

            })
        }
    }
}
</script>

<style scoped>

</style>
