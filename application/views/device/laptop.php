<svg version="1.1" 
     xmlns="http://www.w3.org/2000/svg" 
     xmlns:xlink="http://www.w3.org/1999/xlink" 
     xml:space="preserve" 
     width="{scale-total-width}" height="{scale-total-height}"
     viewBox="{viewbox}">
    <path fill="#00000" stroke="red"
        d="M 0,0 
           m {base-width-offset},0
           m {corner-width},0
           h {width}
           h {width-dif}
           s {outer-edge-bezier-top-right}
           v {outer-height}
           h {base-width-offset}
           v {base-height}
           s {outer-edge-bezier-bottom-right}
           h -{base-width}
           s {outer-edge-bezier-bottom-left}
           v -{base-height}
           h {base-width-offset}
           v -{outer-height}
           s {outer-edge-bezier-top-left}
           h {width-dif}
           v {corner-height}
           v {height}
           h {width}
           v -{height}
           h -{width}z" />
</svg>