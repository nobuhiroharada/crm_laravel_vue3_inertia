<script setup>

</script>

<template>
    <div v-if="$page.props.flash.status === 'success'"
    class="bg-blue-300 text-white p-4">
        {{ $page.props.flash.message }}
    </div>
</template>