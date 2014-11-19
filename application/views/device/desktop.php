<svg version="1.1" 
    xmlns="http://www.w3.org/2000/svg" 
    xmlns:xlink="http://www.w3.org/1999/xlink" 
    xml:space="preserve" 
    width="{scale-total-width}" height="{scale-total-height}"
    viewBox="{viewbox}">
   <path fill="#00000"  
       d="M {start-point} 
          m {width-dif},0
          h {width}
          h {width-dif},0
          s {outer-edge-bezier-top-right}
          v {outer-height}
          s {outer-edge-bezier-bottom-right}
          h -{outer-width}
          s {outer-edge-bezier-bottom-left}
          v -{outer-height}
          s {outer-edge-bezier-top-left}
          h {width-dif}
          v {corner-height}
          v {height}
          h {width}
          v -{height}
          h -{width}z" />
   <path fill="#000000" 
         d="M {stand-start-point} 
            v {stand-height}
            l -{stand-slope-width},{stand-slope-height} 
            h -{stand-base-top-width}
            v {stand-height}
            h {stand-base-width} 
            v -{stand-height}
            h -{stand-base-top-width}
            l -{stand-slope-width},-{stand-slope-height}
            v -{stand-height}z" />
</svg>
<!--</div>-->