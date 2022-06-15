<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Url Shortener</div>
                    <div class="card-body">
                        <form v-on:submit.prevent="createUrl">
                            <div class="form-group mb-2">
                                <label for="full-url" class="sr-only">URL</label>
                                <input type="url" class="form-control" id="full-url" placeholder="Enter your URL" v-model="full_url">
                            </div>
                            <div v-if="hasError" class="alert alert-danger" role="alert">
                                {{msg}}
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "home",
    data() {
        return {
            full_url: '',
            msg: '',
            hasError: false
        }
    },
    methods: {
        createUrl() {
            axios.post('/api/v1/url-shortener', {
                'full_url': this.full_url
            }).then(res => {

            }).catch(err => {
                this.hasError = true
                this.msg = err.response.data.message

            })
        }
    }

};
</script>
