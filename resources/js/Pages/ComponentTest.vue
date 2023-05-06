<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Label from '@/Components/InputLabel.vue'
import Input from '@/Components/TextInput.vue'
</script>

<template>
<GuestLayout>
    <Label value="件名">タイトル1</Label>
    <Label value="">タイトル2</Label>
    <Label>タイトル3</Label>
    <Input modelValue="初期値が入ります"></Input>
</GuestLayout>
</template>