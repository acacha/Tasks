<template>
    <canvas id="canvas" ref="canvas" width="400" height="400" style="background-color: #333"></canvas>
</template>

<script>
export default {
  name: 'Clock',
  methods: {
    drawClock (ctx, radius) {
      this.drawFace(ctx, radius)
      this.drawNumbers(ctx, radius)
      // console.log('drawClock')
      var fps = 60
      setTimeout(() => {
        window.requestAnimationFrame(() => this.drawClock(ctx, radius))
        // Drawing code goes here
      }, 1000 / fps)
      this.drawTime(ctx, radius)
    },
    drawTime (ctx, radius) {
      var now = new Date()
      var hour = now.getHours()
      var minute = now.getMinutes()
      var second = now.getSeconds()
      var millis = now.getMilliseconds()
      // hour
      hour = hour % 12
      hour = (hour * Math.PI / 6) + (minute * Math.PI / (6 * 60)) + (second * Math.PI / (360 * 60))
      this.drawHand(ctx, hour, radius * 0.5, radius * 0.07)
      // minute
      minute = (minute * Math.PI / 30) + (second * Math.PI / (30 * 60))
      this.drawHand(ctx, minute, radius * 0.8, radius * 0.07)
      // second
      second = (second * Math.PI / 30)
      // console.log(second)
      this.drawHand(ctx, second, radius * 0.9, radius * 0.02)

      millis = (millis * Math.PI / 30000) + second
      console.log(millis)
      this.drawHand(ctx, millis, radius * 0.9, radius * 0.02)
    },
    drawHand (ctx, pos, length, width) {
      ctx.beginPath()
      ctx.lineWidth = width
      ctx.lineCap = 'round'
      ctx.moveTo(0, 0)
      ctx.rotate(pos)
      ctx.lineTo(0, -length)
      ctx.stroke()
      ctx.rotate(-pos)
    },
    drawNumbers (ctx, radius) {
      var ang
      var num
      ctx.font = radius * 0.15 + 'px arial'
      ctx.textBaseline = 'middle'
      ctx.textAlign = 'center'
      for (num = 1; num < 13; num++) {
        ang = num * Math.PI / 6
        ctx.rotate(ang)
        ctx.translate(0, -radius * 0.85)
        ctx.rotate(-ang)
        ctx.fillText(num.toString(), 0, 0)
        ctx.rotate(ang)
        ctx.translate(0, radius * 0.85)
        ctx.rotate(-ang)
      }
    },
    drawFace (ctx, radius) {
      var grad

      ctx.beginPath()
      ctx.arc(0, 0, radius, 0, 2 * Math.PI)
      ctx.fillStyle = 'white'
      ctx.fill()

      grad = ctx.createRadialGradient(0, 0, radius * 0.95, 0, 0, radius * 1.05)
      grad.addColorStop(0, '#333')
      grad.addColorStop(0.5, 'white')
      grad.addColorStop(1, '#333')
      ctx.strokeStyle = grad
      ctx.lineWidth = radius * 0.1
      ctx.stroke()

      ctx.beginPath()
      ctx.arc(0, 0, radius * 0.1, 0, 2 * Math.PI)
      ctx.fillStyle = '#333'
      ctx.fill()
    }
  },
  mounted () {
    this.canvas = this.$refs.canvas
    let ctx = this.canvas.getContext('2d')
    var radius = this.canvas.height / 2
    radius = radius * 0.90
    ctx.translate(radius, radius)
    ctx.arc(0, 0, radius, 0, 2 * Math.PI)
    ctx.fillStyle = 'white'
    ctx.fill()
    this.drawFace(ctx, radius)
    this.drawNumbers(ctx, radius)
    this.drawClock(ctx, radius)
  }
}
</script>
