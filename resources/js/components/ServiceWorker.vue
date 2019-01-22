<template>
    <span></span>
</template>
<script>
export default {
  name: 'ServiceWorker',
  // VULL EXECUTAR EL REGISTRE DEL SERVICE WORKER
  mounted () {
    if ('serviceWorker' in navigator) {
      navigator.serviceWorker.register('/service-worker.js')
    } else {
      console.log('Navegador obsolet')
    }
  }
}
</script>
