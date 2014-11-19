<svg version="1.1" 
     xmlns="http://www.w3.org/2000/svg" 
     xmlns:xlink="http://www.w3.org/1999/xlink" 
     xml:space="preserve" 
    width="{scale-total-width}" height="{scale-total-height}"
     viewBox="{viewbox}">
    <path fill="#00000" transform="rotate({rotate})" 
        d="M {start-point} 
           m {width-dif},0
           h {width}
           h {width-dif},0
           s {outer-edge-bezier-top-right}
           v {outer-height}
           s {outer-edge-bezier-bottom-right}
           h -{half-outer-width}
           v -{button-offset} 
           s {button-bezier-bottom-right}
           v 0
           s {button-bezier-top-right} 
           h 0
           s {button-bezier-top-left} 
           v 0
           s {button-bezier-bottom-left} 
           v {button-offset}
           h -{half-outer-width}
           s {outer-edge-bezier-bottom-left}
           v -{outer-height}
           s {outer-edge-bezier-top-left}
           h {width-dif}
           v {corner-height}
           v {height}
           h {width}
           v -{height}
           h -{width}z" />
</svg>