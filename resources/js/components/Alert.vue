<template>
    <div class="p-4 mb-4 my-2 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        {{ msg }}
    </div>
</template>

<script>
export default {
  name: 'Alert',
  props: {
    msg: String,
  }
}
</script>