;(function(){

  function getPaths() {
    return Array.prototype.slice.call(document.querySelectorAll('.tilrPath-path'))
  }

  function setDash(x) {
    var length							 = x.getTotalLength()
    x.style.strokeDashoffset = length - 0.1
    x.style.strokeDasharray	 = length
    return x
  }

  function setLength(x) {
    var length			 = x.getTotalLength()
    var windowCenter = window.innerHeight/1.5
    var offset			 = (x.getBoundingClientRect().top - windowCenter)*-1
    var height			 = x.getBoundingClientRect().height
    var ratio				 = offset/height
    if(ratio > 0 && ratio < 1){
      x.style.strokeDashoffset = length - (ratio*length)
    } else if(ratio < 0){
      x.style.strokeDashoffset = length - 0.1
    } else if(ratio > 1){
      x.style.strokeDashoffset = 0
    }
  }

  var paths = getPaths()

  paths.map(setDash)

  addEventListener('scroll', function() {
    paths.map(setLength)
  })

  addEventListener('resize', function() {
    paths.map(setLength)
  })

})()
