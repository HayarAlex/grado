@if(session('status')== 'Agregado')
<body onload="notifyAdd();"></body>
<script>
	function notifyAdd(){
    	'use strict';
	    resetToastPosition();
	    $.toast({
	      heading: 'Operación exitosa!',
	      text: 'Se agrego el registro correctamente.',
	      showHideTransition: 'slide',
	      icon: 'success',
	      loaderBg: '#f96868',
	      position: 'bottom-right'
	    })
    };
</script>   			
@endif
@if(session('status')== 'Actualizado')
<body onload="notifyAdd();"></body>
<script>
	function notifyAdd(){
    	'use strict';
	    resetToastPosition();
	    $.toast({
	      heading: 'Operación exitosa!',
	      text: 'Se actualizo el registro correctamente.',
	      showHideTransition: 'slide',
	      icon: 'success',
	      loaderBg: '#f96868',
	      position: 'bottom-right'
	    })
    };
</script>   			
@endif
@if(session('status')== 'Desactivado')
<body onload="notifyAdd();"></body>
<script>
	function notifyAdd(){
    	'use strict';
	    resetToastPosition();
	    $.toast({
	      heading: 'Operación exitosa!',
	      text: 'Se desactivo el registro correctamente.',
	      showHideTransition: 'slide',
	      icon: 'success',
	      loaderBg: '#f96868',
	      position: 'bottom-right'
	    })
    };
</script>   			
@endif
@if(session('status')== 'Activado')
<body onload="notifyAdd();"></body>
<script>
	function notifyAdd(){
    	'use strict';
	    resetToastPosition();
	    $.toast({
	      heading: 'Operación exitosa!',
	      text: 'Se activo el registro correctamente.',
	      showHideTransition: 'slide',
	      icon: 'success',
	      loaderBg: '#f96868',
	      position: 'bottom-right'
	    })
    };
</script>  			
@endif
@if(session('status')== 'Eliminado')
<body onload="notifyAdd();"></body>
<script>
	function notifyAdd(){
    	'use strict';
	    resetToastPosition();
	    $.toast({
	      heading: 'Operación exitosa!',
	      text: 'Se elimino el registro correctamente.',
	      showHideTransition: 'slide',
	      icon: 'success',
	      loaderBg: '#f96868',
	      position: 'bottom-right'
	    })
    };
</script> 			
@endif
@if(session('status')== 'NotLogin')
<body onload="notifyAdd();"></body>
<script>
	function notifyAdd(){
    	'use strict';
	    resetToastPosition();
	    $.toast({
	      heading: 'Alerta!',
	      text: 'Porfavor inicia sesión.',
	      showHideTransition: 'slide',
	      icon: 'warning',
	      loaderBg: '#f96868',
	      position: 'bottom-right'
	    })
    };
</script>   			
@endif
@if(session('status') == 'SinStock')
<body onload="notifySinStock();"></body>
<script>
    function notifySinStock(){
        'use strict';
        resetToastPosition();
        $.toast({
            heading: 'Sin Stock',
            text: 'No hay suficiente stock para realizar la operación.',
            showHideTransition: 'slide',
            icon: 'error',
            loaderBg: '#f96868',
            position: 'bottom-right'
        });
    };
</script>
@endif