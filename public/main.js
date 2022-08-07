
/**
  * funcion para manipular interacciones
  * y comportamiento de ña interface grafica.
  */

  
  /**
    * Menus
    *
    **/

    document.getElementById('submenu1').style = "display:none;"
    link = document.getElementById('enlace');

    document.getElementById('submenu2').style = "display:none;"
    link2 = document.getElementById('enlace2');

    document.getElementById('submenu3').style = "display:none;"
    link3 = document.getElementById('enlace3');
    

    link.addEventListener('click',function(e){
    	e.preventDefault();
    	let submenu1 = document.getElementById('submenu1');
    	if(submenu1.style.display == 'none'){
    		//console.log('abierto');
    		submenu1.style.display = 'block';
    	}else if(submenu1.style.display == 'block'){
    		//console.log('cerrado');
    		submenu1.style.display = 'none';

    	}
    });

    link2.addEventListener('click',function(e){
    	e.preventDefault();
    	let submenu2 = document.getElementById('submenu2');
    	if(submenu2.style.display == 'none'){
    		//console.log('abierto');
    		submenu2.style.display = 'block';
    	}else if(submenu2.style.display == 'block'){
    		//console.log('cerrado');
    		submenu2.style.display = 'none';

    	}
    });

    link3.addEventListener('click',function(e){
    	e.preventDefault();
    	let submenu3 = document.getElementById('submenu3');
    	if(submenu3.style.display == 'none'){
    		//console.log('abierto');
    		submenu3.style.display = 'block';
    	}else if(submenu3.style.display == 'block'){
    		//console.log('cerrado');
    		submenu3.style.display = 'none';

    	}
    });




   

  

