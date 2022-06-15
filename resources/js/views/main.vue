<template>
    <app-layout>
        <template slot="content">
            <UrlShortenerForm />
        </template>
    </app-layout>
</template>

<script>
import AppLayout from "../components/AppLayout";
export default {
    name: "mainPage",
    components: {
        AppLayout,
        'UrlShortenerForm': () => import("../components/Form")
    }
}
</script>

<style scoped>

</style>
