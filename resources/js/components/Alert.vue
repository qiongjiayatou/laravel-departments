<template>
    <div v-if="show" :class="['alert', status ? 'alert-' + status : '']">
        {{ message }}
    </div>
</template>

<script>
export default {
    name: 'Alert',
    props: {
        show: { 
            required: true, 
            default: false 
        },
        message: { 
            required: true, 
        },
        status: {
            required: true
        }

    }
}
</script>