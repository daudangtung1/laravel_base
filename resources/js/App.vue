<template>
    <div class="container">
        <div class="text-center" style="margin: 20px 0;">
            <span class="text-secondary">FAQ</span>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/" class="nav-item nav-link">Home</router-link>
                    <!-- <router-link to="/add" class="nav-item nav-link">Add Faq</router-link> -->
                </div>
            </div>
        </nav>
        <router-view></router-view>
    </div>
</template>
<script>
export default {}
</script>