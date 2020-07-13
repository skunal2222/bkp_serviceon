var addNewVehicle = document.querySelector('.add-vehicle-btn');
var html, newHtml;
var data = [];

var Newvehicle = function(number, running, madeyear){
	this.number = number;
	this.running = running;
	this.madeyear = madeyear;
}

function addItem(num, bikerun, manuyear){
	var newItem;
 	newItem = new Newvehicle(num, bikerun, manuyear)
 	data.push(newItem);
 	return newItem;
}

function getInput(){
	return{
		vehicleNumber: document.querySelector('.vehicle__number').value,
		totalBikeRunning: document.querySelector('.total__kms').value,
		manufactureYear: document.querySelector('.manufactured__year').value				
	};
}

function addListItem(obj){
	html ='<div class="col-lg-6 col-sm-12 col-12 pb-4"><div class="card card-1 vehicles"><div class="d-flex"><h6 class="saved-vehicle-number">%vehicleNumber%</h6><a href="#" class="ml-auto"><i class="fas fa-times"></i></a></div><h6 class="saved-vehicle-details">Kawasaki Ninja ZX - 10R<br>%totalBikeRunning% Km | Manufactured in %manufactureYear%</h6></div></div>'
	newHtml = html.replace('%vehicleNumber%', obj.vehicleNumber);
	newHtml = newHtml.replace('%totalBikeRunning%', obj.totalBikeRunning);
	newHtml = newHtml.replace('%manufactureYear%', obj.manufactureYear);
	document.querySelector('.saved-vehicles-details').insertAdjacentHTML('beforeend', newHtml);
}

if(addNewVehicle){
	addNewVehicle.addEventListener('click', function(){
		var input = getInput();
		addItem(input.vehicleNumber, input.totalBikeRunning, input.manufactureYear );
		addListItem(input);
	});
}