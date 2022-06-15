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
    name: "main",
    components: {
        AppLayout,
        'UrlShortenerForm': () => import("../components/form")
    }
}
</script>

<style scoped>

</style>
