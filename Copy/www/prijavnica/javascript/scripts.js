
function applyinitialcss(){
	var element=document.getElementsByTagName("input");
	for(var i=0; i<element.length;i++){
		if(element[i].type=="button"){
			addStyle(element[i],"buttonNormal");
			addEvent(element[i], "onmouseover","this.className='buttonFocus';");
			addEvent(element[i], "onmouseout", "this.className='buttonNormal';");
		}
		else {
		addStyle(element[i],"inputNormal");
		addEvent(element[i], "onfocus","this.className='inputFocus';");
		addEvent(element[i], "onblur", "this.className='inputNormal';");
		}
	}
var element=document.getElementsByTagName("select");
	for(var i=0; i<element.length;i++){
		
		addStyle(element[i],"inputNormal");
		addEvent(element[i], "onfocus","this.className='inputFocus';");
		addEvent(element[i], "onblur", "this.className='inputNormal';");
		}
}

String.prototype.trim = function(){
	return this.replace( /^\s+|\s+$/, "" );	
}

function addStyle(element, className){
	element.className = (element.className + " " + className).trim();
}

function addEvent(element, event, value){
	element.setAttribute(event, value);
}

function enableSelect(source, elementID){
	if(!source.checked){
		document.getElementById(elementID).setAttribute("disabled", "disabled");
	}
	else{
		document.getElementById(elementID).removeAttribute("disabled");
	}
}

function showhideDIV(divID){
	var div=document.getElementById(divID);
	if(div.style.visibility=="visible"){
		div.style.visibility="hidden";
		}
	else{
		div.style.visibility="visible";
	    }
}

function inputFormValidation(){
	var fields=document.inputForm.getElementsByTagName("input");
	for(var i=0; i<fields.length; i++){
		if(fields[i].type=="text" && fields[i].value==""){
			window.alert("Niste unijeli sve potrebne podatke");
			return;
		}
		else if(fields[i].type=="checkbox" && fields[i].id=="chkMajica"){
			if(fields[i].checked && document.getElementById("selectColor").selectedIndex==0){
				window.alert("Niste odabrali boju majice!");
				return;
			}
			else if(fields[i].checked && document.getElementById("selectSize").selectedIndex==0) {
				window.alert("Niste odabrali veličinu majice!");
				return;
			}
			else if(!fields[i].checked){
			document.inputForm.tip.value="unos";
			document.inputForm.submit();
			return;
			}						
			else{
			document.inputForm.tip.value="unos";
			document.inputForm.submit();
			return;
			}
		}
		
	}
		
}

/*function decorateGrid(table){
	grid = document.getElementById(table);
	addStyle(grid, 'gridTable');
	rows = grid.getElementsByTagName("tr");
	header = rows[0];
	addStyle(header, 'thead');
	for(var i=1; i<rows.length; i++){
		if(i%2==0){
			addStyle(rows[i], 'alternateRows');
		}
	}
	
	
}*/
