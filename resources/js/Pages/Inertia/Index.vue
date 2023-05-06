<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div v-if="$page.props.flash.message" class="bg-blue-300">
        {{ $page.props.flash.message }}
    </div>
ああああ
</template>