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
                            <span style="padding: 40px" v-bind:style=" hasError ? 'color: red' : '' ">{{msg}}</span>
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
                console.log(res)
                return
                if (res.data.code === 200) {
                    this.hasError = false;
                    this.msg = 'Successfully updated the password please login';
                    setTimeout(function () {
                        this.$router.push({'name': 'login'});
                    }, 1000);
                } else {
                    this.hasError = true;
                    this.msg = res.data.message;
                }
            }).catch(err => {
                console.log(err)
            })
        }
    }

};
</script>
