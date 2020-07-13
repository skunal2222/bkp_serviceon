function getInput() {
	return{
		addressOne: document.querySelector('.address__one').value,
		addressTwo: document.querySelector('.address__two').value,
		landMark: document.querySelector('.land__mark').value,
		name: document.querySelector('.houseName').value
	};
}

function addNewItem(obj){
	var html, newHtml;

	html = '<div class="col-lg-6 col-md-12 col-sm-12 pb-4"><div class="card card-1 home-address"><h6 class="home-name">Home</h6><h6 class="exact-address">%address_one% </span><span>%address_two% </span><span>%landmark% </span></h6><div class="edit-delete-address  pt-3"><a href="#" data-toggle="modal" data-target="#editAddressModal">Edit</a><a href="#" class="pl-3">Delete</a></div></div></div>';
	newHtml = html.replace('%address_one%', obj.addressOne);
	newHtml = newHtml.replace('%address_two%', obj.addressTwo);
	newHtml = newHtml.replace('%landmark%', obj.landMark);
	document.querySelector('.after__html').insertAdjacentHTML('beforeend', newHtml);
}

/*function addLocation(obj) {
	var location, newLocation;

	location = '<span><h5 class="user-entered-location">%location%</h5></span>'
	newLocation = location.replace('%location%', obj);
	document.querySelector('.user__location').insertAdjacentHTML('beforeend', newLocation);
}*/

/*document.querySelector('#location-select').addEventListener("keyup", function(event) {
  	if (event.keyCode === 13) {
  	var inputLocation = document.querySelector('#location-select').value;
  	addLocation(inputLocation);
  }
});*/

var el = document.querySelector('.save_addressbtn');
if(el){
el.addEventListener('click', function(){
	var input = getInput();
	addNewItem(input);
	console.log(input);
});
}





function addBikeBrand(obj) {
	var brnad, newBrand;

	brand = '<div class="col-lg-3 col-md-4 col-sm-12 col-12 pb-4"><div class="card search-bike-brand"><div class="d-flex"><h6 class="">Brand</h6><a href="#" class="ml-auto"><i class="fas fa-times"></i></a></div><h3 class="user-selected-bike">%brand%</h3></div></div>'
	newBrand = brand.replace('%brand%', obj);
	document.querySelector('.after__brand').insertAdjacentHTML('beforeend', newBrand);
}



document.querySelector('.search__brand').addEventListener("keyup", function(event) {
  	if (event.keyCode === 13) {
  	var bikeBrand = document.querySelector('.search__brand').value;
  	addBikeBrand(bikeBrand);
  }
});



