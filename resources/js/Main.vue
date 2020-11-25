<template>
<div>
    <bridge-notify/>
    <app-header/>
    <div class="min-h-screen">
        <Index/>
    </div>
    <app-footer/>
</div>
</template>

<script>
import AppHeader from './components/layouts/Header';
import AppFooter from './components/layouts/Footer';
import Index from './pages/index'
export default {
    components: {AppHeader,AppFooter,Index}
}
</script>

<style>

</style>