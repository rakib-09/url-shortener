<template>
    <app-layout>
        <template slot="content">
            <redirectCard />
        </template>
    </app-layout>
</template>

<script>
import AppLayout from "../components/AppLayout";
export default {
    name: "redirect",
    components: {
        AppLayout,
        'redirectCard': () => import("../components/RedirectCard")
    }
}
</script>

<style scoped>

</style>
