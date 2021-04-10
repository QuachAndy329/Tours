locationList();

document.getElementById("newLocation").addEventListener("click", addLocation);
document.getElementById("cancelNewLocation").addEventListener("click", locationList);

function addLocation() {
    document.getElementById("locationList").style.display = "none";
    document.getElementById("locationForm").style.display = "inline-block";
}

function locationList() {
    document.getElementById("locationList").style.display = "inline-block";
    document.getElementById("locationForm").style.display = "none";
}

tourList(); 

document.getElementById("newTour").addEventListener("click", newTour); 
document.getElementById("cancelnewTour").addEventListener("click", tourList); 

function newTour(){
    document.getElementById("tourList").style.display = "none"; 
    document.getElementById("tourForm").style.display = "inline-block"; 
}

function tourList() {
    document.getElementById("tourList").style.display = "inline-block";
   document.getElementById("tourForm").style.display = "none";
}
